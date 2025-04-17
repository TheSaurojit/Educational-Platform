<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// Authentication

Route::controller(AuthController::class)->group(function(){

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    // Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    // Route::post('/login', [AuthController::class, 'login']);
    
    // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});



