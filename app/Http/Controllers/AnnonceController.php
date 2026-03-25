<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\Image;

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
}
