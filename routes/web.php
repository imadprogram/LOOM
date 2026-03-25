<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnnonceController;
use App\Models\Annonce;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login' , function() {
    return view('login');
})->middleware('guest')->name('login');
Route::get('/signup' , function() {
    return view('signup');
})->middleware('guest')->name('signup');





Route::middleware('auth')->group(function () {
    
    Route::get('/home' , function(){
        $annonces = Annonce::with(['user', 'image'])->latest()->get();
        return view('home', compact('annonces'));
    });

    Route::get('/profile' , function(){
        return view('profile');
    });

    Route::put('/profile' , [ProfileController::class , 'update'])->name('profile.update');
    Route::put('/profile/password' , [ProfileController::class , 'updatePassword'])->name('profile.password.update');
    

    Route::get('/sell', function(){
        $categories = \App\Models\Category::all();
        return view('sell', compact('categories'));
    });
    Route::post('/sell/item' , [AnnonceController::class , 'publish'])->name('publish.item');

    Route::get('/product/{id}' , [AnnonceController::class , 'info'])->name('product.details');
});






Route::post('/signup' , [AuthController::class , 'register'])->name('submit.signup');
Route::post('/login' , [AuthController::class , 'login'])->name('submit.login');
Route::post('/logout' , [AuthController::class , 'logout'])->name('logout');

