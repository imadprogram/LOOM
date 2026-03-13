<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request){
        $validated = $request->validate([
            'first_name' => ['string'],
            'last_name' => ['string'],
            'email' => ['email'],
        ]);

        $user = auth()->user();

        $user->update($validated);

        return back();
    }
    
    public function updatePassword(Request $request){
        $validated = $request->validate([
            'current_password' => ['current_password'],
            'new_password' => ['required' ,'confirmed'],
        ]);

        $user = auth()->user();

        $user->update([
            'password' => $validated['new_password'],
        ]);

        return back();
    }
}
