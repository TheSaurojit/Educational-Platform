<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getusers()
    {
        $users = User::where('is_admin', false)->get();

        return view('admin.users', compact('users'));
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        return back()->with('success', 'User Deleted');
    }
}
