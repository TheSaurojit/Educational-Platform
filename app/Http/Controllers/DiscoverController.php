<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscoverController extends Controller
{



    public function  index()
    {
        $mathematicians = User::where('id', '!=', Auth::id())
            ->whereHas('profile', function ($query) {
                $query->where('is_mathematician', true);
            })
            ->with('profile')
            ->get();

            
        return view('pages.discover', compact('mathematicians'));
    }
}
