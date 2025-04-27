<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $mathematicians = User::whereHas('profile', function ($query) {
            $query->where('is_mathematician', true);
        })
            ->with('profile')
            ->get();

        return view('pages.home', compact('mathematicians'));

    }
}
