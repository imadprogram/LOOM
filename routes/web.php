<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login' , function() {
    return view('login');
})->name('login');
Route::get('/signup' , function() {
    return view('signup');
})->name('signup');

Route::post('/signup' , [AuthController::class , 'register'])->name('submit.signup');
Route::post('/login' , [AuthController::class , 'login'])->name('submit.login');
Route::post('/logout' , [AuthController::class , 'logout'])->name('logout');

Route::get('/home' , function(){
    return view('home');
});