<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

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
        return view('home');
    });
    
    Route::get('/product', function() {
        return view('product');
    });

    Route::get('/profile' , function(){
        return view('profile');
    });

    Route::put('/profile' , [ProfileController::class , 'update'])->name('profile.update');
});






Route::post('/signup' , [AuthController::class , 'register'])->name('submit.signup');
Route::post('/login' , [AuthController::class , 'login'])->name('submit.login');
Route::post('/logout' , [AuthController::class , 'logout'])->name('logout');

