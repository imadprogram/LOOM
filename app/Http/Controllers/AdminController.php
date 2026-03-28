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


        $newestMembers = User::latest()->limit(2)->get();
        $newestAnnonces = Annonce::latest()->limit(2)->get();


        return view('adminStats' , compact('users' , 'activeListings' , 'soldListings' , 'activeBoosts' , 'newestMembers' , 'newestAnnonces'));
    }


    public function users(){
        $users = User::latest()->paginate(10);

        return view('adminUsers' , compact('users'));
    }
}
