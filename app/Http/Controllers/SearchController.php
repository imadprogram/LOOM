<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;

class SearchController extends Controller
{
    public function search(Request $request) {
        $word = $request->input('q', '');
        $categoryId = $request->input('category', '');

        $result = [];
        $categories = \App\Models\Category::all();

        if(!empty($word) || !empty($categoryId)){
            $query = Annonce::where('status' , 'active');

            if(!empty($word)){
                $query->where(function($q) use ($word) {
                    $q->where('title' , 'LIKE' , '%' . $word . '%')->orWhere('description' , 'LIKE' , '%' . $word . '%');
                });
            }

            if(!empty($categoryId)){
                $query->where('category_id', $categoryId);
            }

            $result = $query->with(['user' , 'images' , 'category'])
                ->orderByRaw('boosted_until > NOW() DESC')
                ->latest()
                ->paginate(12);
        }

        return view('search' , ['annonces' => $result , 'query' => $word , 'categories' => $categories , 'selectedCategory' => $categoryId]);
    }
}
