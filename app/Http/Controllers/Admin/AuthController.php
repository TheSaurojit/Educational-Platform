<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {

        // Validate input
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        // Retrieve input
        $email = $request->input('email');
        $password = $request->input('password');

        // Check for user existence and admin status
        $user = User::where('email', $email)->where('is_admin', true)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            // Redirect back with an error message
            return back()->withErrors(['error' => 'Invalid credentials or not authorized']);
        }

        // Authenticate the user
        Auth::login($user);

        // Regenerate session to prevent session fixation attacks
        $request->session()->regenerate();

        // Redirect to a specific page, e.g., admin dashboard
        return redirect()->route('admin.dashboard');
    }

    public function changePasswordForm() {
        return view('admin.change-password');
        // function body
    }

    public function changePassword(Request $request)
    {
        // Validate the request
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        $user = $request->user();


        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {

            return back()->withErrors(['error' => 'Entered wrong current password ']);
        }

        // Update the password
        $user->forceFill([
            'password' => Hash::make($request->new_password),
        ])->save();

        return redirect()->back()->with(['success' => 'Password changed successfully']);
    }
}
