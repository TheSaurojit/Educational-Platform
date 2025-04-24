<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscoverController extends Controller
{
    public function  index()
    {
        $mathematicians = getMatheMaticians();
        return view('pages.discover', compact('mathematicians'));
    }
}
