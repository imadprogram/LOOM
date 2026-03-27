<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $attributes = $request->validate([
            'firstName' => ['required'],
            'lastName'  => ['required'],
            'email'     => ['required', 'email', 'unique:users,email'],
            'password'  => ['required']
        ]);

        $user = User::create([
            'first_name' => $attributes['firstName'],
            'last_name'  => $attributes['lastName'],
            'email'      => $attributes['email'],
            'password'   => $attributes['password']
        ]);

        Auth::login($user);

        return redirect('/home');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if(Auth::user()->is_admin){
                return redirect('/admin/dashboard');
            }
            return redirect('/home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
