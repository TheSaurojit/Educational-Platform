<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

//admin  routes
Route::prefix('admin')->as('admin.')->group(function () {

    Route::middleware('isAdmin')->group(function () {

        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    });

    Route::get('/login', [AdminAuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login');
});


Route::get('/chat', function () {
    return view('pages.chat');
});


Route::get('/privacy-policy', function () {
    return view('pages.privacy_policy');
});


Route::get('/terms-condition', function () {
    return view('pages.terms_condition');
});



//user routes
Route::get('/', [HomeController::class, 'home'])->name('home');

// Route::get('/', fn() => User::create([
//     'name' => "admin",
//     'email' => "admin@gmail.com",
//     'password' => Hash::make('P@$$WoRd!!!'),
//     'is_admin' => true
// ]))->name('home');


// Friend Request Routes

Route::middleware('isUser')->group(function () {

    Route::controller(MatchController::class)->as('friend.')->group(function () {

        Route::post('/send-request/{receiverId}', 'sendRequest')->name('send');
        Route::post('/accept-request/{senderId}', 'acceptRequest')->name('accept');
        Route::post('/reject-request/{senderId}', 'rejectRequest')->name('reject');
    });
    Route::get('/notifications',  [MatchController::class, 'notifications'])->name('notifications');


    Route::controller(MatchController::class)->group(function () {

        Route::get('/matches', 'matchView')->name('matches')->middleware('hasProfile');
        Route::get('/discover', 'discoverView')->name('discover')->middleware('hasProfile');
    });

    Route::controller(CommunityController::class)->group(function () {

        Route::get('/community', 'communityView')->name('community');

        Route::middleware('hasProfile')->group(function () {

            Route::get('/create-community', 'createCommunityView')->name('create-community');
            Route::post('/create-community', 'createCommunity')->name('create-community');

            Route::post('/add-comment', 'addComment')->name('add-comment');
            Route::post('/add-like', 'addLike')->name('add-like');
        });
    });


    Route::controller(ProfileController::class)->group(function () {

        Route::get('/profile/{userId}',  'showOthersProfile')->name('others.profile')->middleware('hasProfile');

        Route::get('/profile',  'showProfile')->name('profile')->middleware('hasProfile');

        Route::get('/edit-profile',  'showProfileForm')->name('create-profile');

        Route::post('/edit-profile',  'create')->name('create-profile');
        Route::post('/update-profile',  'update')->name('update-profile');
    });
});



//user Authentication
Route::controller(AuthController::class)->group(function () {

    Route::get('/register',  'showRegisterForm')->name('register');
    Route::post('/register', 'register')->name('register');


    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login');


    Route::get('/verify/{token}', 'emailVerify')->name('email.verify');

    Route::post('/logout', 'logout')->name('logout');
});
