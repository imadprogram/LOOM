<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\Image;
use App\Models\Category;

class AnnonceController extends Controller
{
    public function publish(Request $request) {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['required', 'image', 'max:10240'],
        ]);

        $annonce = Annonce::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'category_id' => $validated['category_id'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('annonces', 'public');
            
            Image::create([
                'annonce_id' => $annonce->id,
                'file_path' => $path,
            ]);
        }

        return redirect('/home');
    }


    public function info($id){
        $annonce = Annonce::findOrFail($id);

        return view('product', compact('annonce'));
    }


    public function markAsSold($id){
        $annonce = Annonce::findOrFail($id);

        $annonce->update([
            'status' => 'sold'
        ]);

        return back();
    }

    public function markAsActive($id){
        $annonce = Annonce::findOrFail($id);

        if($annonce->status == "suspended"){
            return back()->with('error' , 'your product is suspended you Can NOT activate it!');
        }

        $annonce->update([
            'status' => 'active'
        ]);
        
        return back();
    }


    public function delete($id){
        $annonce = Annonce::findOrFail($id);

        $annonce->delete();

        return back();
    }

    public function edit($id) {
        $annonce = Annonce::findOrFail($id);
        $categories = Category::all();

        return view('edit', compact('annonce', 'categories'));
    }

    public function update(Request $request, $id) {
        $annonce = Annonce::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'max:10240'],
        ]);

        $annonce->update([
            'title' => $validated['title'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'category_id' => $validated['category_id'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('annonces', 'public');

            if ($annonce->image) {
                $annonce->image->update(['file_path' => $path]);
            } else {
                Image::create([
                    'annonce_id' => $annonce->id,
                    'file_path' => $path,
                ]);
            }
        }

        return redirect('/my-listings');
    }
}
