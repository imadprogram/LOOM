<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Annonce;
use App\Models\Report;

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

    public function ban($id){
        $user = User::findOrFail($id);

        $user->update([
            'is_banned' => true
        ]);

        return back();
    }


    public function unban($id){
        $user = User::findOrFail($id);

        $user->update([
            'is_banned' => false
        ]);

        return back();
    }

    public function annonces(){
        $annonces = Annonce::latest()->paginate(10);

        return view('adminAnnonces' , compact('annonces'));
    }

    public function annonceDeactivate($id){
        $annonce = Annonce::findOrFail($id);

        $annonce->update([
            'status' => 'suspended'
        ]);

        return back();
    }

    public function annonceActivate($id){
        $annonce = Annonce::findOrFail($id);

        $annonce->update([
            'status' => 'active'
        ]);

        return back();
    }

    public function annonceDelete($id){
        $annonce = Annonce::findOrFail($id);

        $annonce->delete();

        return back();
    }

    public function reports(){
        $reports = Report::latest()->paginate(10);

        return view('adminReports' , compact('reports'));
    }

    public function resolve($id) {
        $report = Report::findOrFail($id);

        $report->update([
            'status' => 'resolved'
        ]);

        return back();
    }
}
