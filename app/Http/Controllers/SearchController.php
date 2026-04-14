<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;

class SearchController extends Controller
{
    public function search(Request $request) {
        $word = $request->input('q', '');

        $result = [];

        if(!empty($word)){
            $result = Annonce::where('status' , 'active')->where(function($query) use ($word) {
                $query->where('title' , 'LIKE' , '%' . $word . '%')->orWhere('description' , 'LIKE' , '%' . $word . '%');
            })
            ->with(['user' , 'images' , 'category'])
            ->orderByRaw('boosted_until > NOW() DESC')
            ->latest()
            ->paginate(12);
        }

        return view('search' , ['annonces' => $result , 'query' => $word]);
    }
}
