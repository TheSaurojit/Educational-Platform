<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerificationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;


class AuthController extends Controller
{
    // Show Registration Form
    public function showRegisterForm()
    {
        return view('pages.auth.register');
    }

    // Handle Registration
    public function register(Request $request)
    {
        $data = $request->validate([
            "name" => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user = User::where('email', $data['email'])->whereNotNull('email_verified_at')->first();

        if ($user) {
            return back()->withErrors(['error' => 'Email already exists ']);
        } else {

            $token = Str::random(50);

            $user = User::updateOrCreate(
                ['email' => $data['email']], // Search criteria
                [
                    'name' => $data['name'],
                    'password' => Hash::make($data['password']), // Encrypt the password before storing
                    'email_verification_token' => $token
                ]
            );

            Mail::to($user->email)->send(new EmailVerificationMail($user));

            return to_route('login')->with('success', 'We have sent a verification link to your email account');
        }
    }


    // Show Login Form
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    // Handle Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if user exists first
        $user = User::where('email', $credentials['email'])->whereNotNull('email_verified_at')->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Please register with this email address.'
            ]);
        }

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'password' => 'Incorrect password. Please try again.'
            ]);
        }

        $request->session()->regenerate();
        return to_route('profile');
    }

    // Handle Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login');
    }

    //email verify for registering
    public function emailVerify($token)
    {

        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return to_route('login')->withErrors(['error' => 'Invalid verification token ']);
        }

        $user->email_verified_at = now();
        $user->email_verification_token = null;
        $user->save();

        return to_route('login')->with('success', 'Email verified successfully!');
    }
}
