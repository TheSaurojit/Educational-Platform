<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\DiscoverController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\ProfileController;

Route::view('/admin/home', 'admin.home');




Route::get('/notifications', function () {
    return view('pages.notifications');
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

Route::get('/', [HomeController::class, 'home'])->name('home');


Route::middleware('isUser')->group(function () {

    Route::controller(MatchController::class)->group(function () {

        Route::get('/matches', 'matchView')->name('matches')->middleware('hasProfile');
    });

    Route::controller(CommunityController::class)->group(function () {

        Route::get('/community', 'communityView')->name('community');

        Route::get('/create-community', 'createCommunityView')->name('create-community')->middleware('hasProfile');
        Route::post('/create-community', 'createCommunity')->name('create-community')->middleware('hasProfile');
    });



    Route::controller(DiscoverController::class)->group(function () {

        Route::get('/discover', 'index')->name('discover')->middleware('hasProfile');
    });

    Route::controller(ProfileController::class)->group(function () {

        Route::get('/profile',  'showProfile')->name('profile')->middleware('hasProfile');
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
