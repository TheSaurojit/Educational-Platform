<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/signin', function () {
    return view('pages.sign_in');
});

Route::get('/chat', function () {
    return view('pages.chat');
});



