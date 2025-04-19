<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('pages.home');
});


Route::get('/profile', function () {
    return view('pages.profile');
});

Route::get('/discover', function () {
    return view('pages.discover');
});

Route::get('/matches', function () {
    return view('pages.matches');
});

Route::get('/notifications', function () {
    return view('pages.notifications');
});

Route::get('/community', function () {
    return view('pages.community');
});


Route::get('/createaccount', function () {
    return view('pages.create_account');
});

Route::get('/profilepublic', function () {
    return view('pages.profile_public');
});


Route::get('/chat', function () {
    return view('pages.chat');
});

Route::controller(ProfileController::class)->group(function(){
    Route::get('/edit-profile',  'showCreateForm')->name('edit-profile');
    Route::post('/edit-profile',  'store')->name('edit-profile');

});

// Authentication
Route::controller(AuthController::class)->group(function(){

    Route::get('/register',  'showRegisterForm')->name('register');
    Route::post('/register', 'register')->name('register');

    
    Route::get('/login','showLoginForm')->name('login');
    Route::post('/login','login')->name('login');

    
    Route::get('/verify/{token}','emailVerify')->name('email.verify');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});



