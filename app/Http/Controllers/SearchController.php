<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $word = $request->input('q', '');
        $categoryId = $request->input('category', '');

        $result = [];
        $categories = \App\Models\Category::all();

        if (! empty($word) || ! empty($categoryId)) {
            $query = Annonce::where('status', 'active');

            if (! empty($word)) {
                $query->where(function ($q) use ($word) {
                    $q->where('title', 'LIKE', '%'.$word.'%')->orWhere('description', 'LIKE', '%'.$word.'%');
                });
            }

            if (! empty($categoryId)) {
                $query->where('category_id', $categoryId);
            }

            $result = $query->with(['user', 'images', 'category'])
                // CASE forces boosted (1) to show before normal/NULLs (0) in PostgreSQL
                ->orderByRaw('CASE WHEN boosted_until > NOW() THEN 1 ELSE 0 END DESC')
                ->latest()
                ->paginate(12);
        }

        return view('search', ['annonces' => $result, 'query' => $word, 'categories' => $categories, 'selectedCategory' => $categoryId]);
    }
}
