<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;




function getUsersWithProfile()
{
    return User::where('id', '!=', Auth::id())
        ->whereHas('profile')
        ->with('profile')
        ->get();
}
