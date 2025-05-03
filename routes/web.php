<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

//admin  routes
Route::prefix('admin')->as('admin.')->group(function () {

    Route::middleware('isAdmin')->group(function () {

        Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

        //user feedback
        Route::get('/users-feedback', [FeedbackController::class,'allFeedbacks'])->name('feedbacks');




        //user management
        Route::get('/users', [UserController::class, 'getUsers'])->name('users');
        Route::post('/delete-user/{user}', [UserController::class, 'deleteUser'])->name('delete-user');

        Route::post('/make-mathematician/{user}', [UserController::class,'makeMathematician'])->name('makeMathematician');



        //password reset
        Route::get('/change-password', [AdminAuthController::class, 'changePasswordForm'])->name('change-password');
        Route::post('/change-password', [AdminAuthController::class, 'changePassword'])->name('change-password');
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

Route::get('/feedback', [FeedbackController::class, 'showForm'])->name('feedback');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback');


// Route::get('/', fn() => User::create([
//     'name' => "admin",
//     'email' => "admin@gmail.com",
//     'password' => Hash::make('123456789'),
//     'is_admin' => true
// ]))->name('home');



Route::middleware('isUser')->group(function () {

    Route::controller(ChatController::class)->group(function () {
        // Route::get('/chat/{user}', 'showChat')->name('chat');
    });

    Route::controller(MessageController::class)->group(function () {

        //apis
        // Route::get('/message/{chat}',  'getNewMsg');     // get messages
        // Route::post('/message/{chat}',  'storeMsg')->name('storeMsg');     // send message
        // Route::post('/messages/{message}/read',  'markAsRead');   // mark as read
    });



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

            //apis
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

//user forget password
Route::controller(PasswordController::class)->group(function () {
    // Forgot password flow
    Route::get('/forgot-password', 'showForgotForm')->name('password.request');
    Route::post('/forgot-password', 'sendResetLink')->name('password.email');

    // Password reset flow
    Route::get('/reset-password/{token}', 'showResetForm')->name('password.reset');
    Route::post('/reset-password', 'resetPassword')->name('password.update');
});
