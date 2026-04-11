<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnnonceController;
use App\Models\Annonce;
use App\Http\Controllers\BoostController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login' , function() {
    return view('login');
})->middleware('guest')->name('login');
Route::get('/signup' , function() {
    return view('signup');
})->middleware('guest')->name('signup');

Route::get('/banned', function() {
    return view('banned');
});



Route::middleware('auth' , 'banned')->group(function () {
    
    Route::get('/home' , function(){
        $annonces = Annonce::with(['user', 'image'])->orderByRaw('boosted_until > NOW() DESC')->latest()->get();
        return view('home', compact('annonces'));
    });

    Route::get('/profile' , function(){
        return view('profile');
    });

    Route::get('/my-listings' , function(){
        $listings = Annonce::with(['user' , 'image'])->where('user_id' , auth()->id())->latest()->get();
        return view('listings' , compact('listings'));
    });

    Route::put('/profile' , [ProfileController::class , 'update'])->name('profile.update');
    Route::put('/profile/password' , [ProfileController::class , 'updatePassword'])->name('profile.password.update');
    

    Route::get('/sell', function(){
        $categories = \App\Models\Category::all();
        return view('sell', compact('categories'));
    });
    Route::post('/sell/item' , [AnnonceController::class , 'publish'])->name('publish.item');

    Route::get('/product/{id}' , [AnnonceController::class , 'info'])->name('product.details');

    Route::put('/my-listings/{id}/sold' , [AnnonceController::class , 'markAsSold'])->name('mark.as.sold');
    Route::put('/my-listings/{id}/active' , [AnnonceController::class , 'markAsActive'])->name('mark.as.active');
    Route::delete('/my-listings/{id}/delete' , [AnnonceController::class , 'delete'])->name('delete.listing');
    Route::get('/my-listings/{id}/edit' , [AnnonceController::class , 'edit'])->name('edit.listing');

    Route::put('/my-listings/{id}/edit' , [AnnonceController::class , 'update'])->name('update.listing');


    Route::post('/boost/{id}' , [BoostController::class , 'checkout'])->name('boost.checkout');
    Route::get('/boost/success/{id}' , [BoostController::class, 'success'])->name('boost.success');


    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages' , [MessageController::class, 'store'])->name('messages.store');
    
    
    Route::post('/reports/{id}' , [ReportController::class , 'store'])->name('report.product');
});






Route::middleware('admin')->group(function () {

    Route::get('/admin/dashboard', [AdminController::class , 'dashboard']);


    Route::get('/admin/users' , [AdminController::class , 'users']);

    Route::put('/admin/users/ban/{id}' , [AdminController::class , 'ban'])->name('ban.user');
    Route::put('/admin/users/unban/{id}' , [AdminController::class , 'unban'])->name('unban.user');

    Route::get('/admin/annonces' , [AdminController::class , 'annonces']);
    Route::patch('/admin/annonces/deactivate/{id}' , [AdminController::class , 'annonceDeactivate'])->name('deactivate.annonce');
    Route::patch('/admin/annonces/activate/{id}' , [AdminController::class , 'annonceActivate'])->name('activate.annonce');
    Route::delete('/admin/annonces/delete/{id}' , [AdminController::class , 'annonceDelete'])->name('delete.annonce');

    Route::get('/admin/reports' , function(){
        return view('adminReports');
    });

});






Route::post('/signup' , [AuthController::class , 'register'])->name('submit.signup');
Route::post('/login' , [AuthController::class , 'login'])->name('submit.login');
Route::post('/logout' , [AuthController::class , 'logout'])->name('logout');

