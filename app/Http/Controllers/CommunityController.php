<?php

namespace App\Http\Controllers;

use App\Helpers\FileUploader;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{

    public function communityView()
    {
        $posts = Community::with(['user.profile'])->latest()->get();
        return view('pages.community', compact('posts'));
    }

    public function createCommunityView()
    {

        return view('pages.create-community');
    }

    public function createCommunity(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'body' => ['required', 'string'],
            'image' => ['image', 'mimes:png,jpg,jpeg', 'max:2048'] // Allow images up to 2MB
        ]);

        if ($request->hasFile('image')) {

            $validated['image'] = FileUploader::imageUpload($request->file('image'));
        }

        $validated['user_id'] = Auth::id() ;

        Community::create($validated);

        return to_route('community')->with('success', 'Post Created');
    }
}
