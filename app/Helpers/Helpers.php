<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

function getMatheMaticians()
{
    return User::where('id', '!=', Auth::id())
        ->whereHas('profile', function ($query) {
            $query->where('is_mathematician', true);
        })
        ->with('profile')
        ->get();
}


function getUsersWithProfile()
{
    return User::where('id', '!=', Auth::id())
        ->whereHas('profile')
        ->with('profile')
        ->get();
}
