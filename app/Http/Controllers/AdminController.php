<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Annonce;

class AdminController extends Controller
{
    public function dashboard(){
        $users = User::count();

        $activeListings = Annonce::where('status' , 'active')->count();
        $soldListings = Annonce::where('status' , 'sold')->count();

        $activeBoosts = Annonce::where('is_boosted' , true)->count();


        return view('adminStats' , compact('users' , 'activeListings' , 'soldListings' , 'activeBoosts'));
    }
}
