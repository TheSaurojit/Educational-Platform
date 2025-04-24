<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiscoverController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');


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



Route::middleware('auth')->group(function () {

    Route::controller(DiscoverController::class)->group(function () {

        Route::get('/discover', 'index')->name('discover');
    });

    Route::controller(ProfileController::class)->group(function () {

        Route::get('/profile',  'showProfile')->name('profile')->middleware(['profileCheck']);
        Route::get('/edit-profile',  'showProfileForm')->name('create-profile');
        Route::post('/edit-profile',  'create')->name('create-profile');
        Route::post('/update-profile',  'update')->name('update-profile');
    });
});



// Authentication
Route::controller(AuthController::class)->group(function () {

    Route::get('/register',  'showRegisterForm')->name('register');
    Route::post('/register', 'register')->name('register');


    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login');


    Route::get('/verify/{token}', 'emailVerify')->name('email.verify');

    Route::post('/logout', 'logout')->name('logout');
});
