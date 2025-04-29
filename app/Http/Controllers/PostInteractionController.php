<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostInteractionController extends Controller
{
    public function like(Post $post)
    {
        dd($post);
        $post->likes()->firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        return back();
    }

    public function unlike(Post $post)
    {
        $post->likes()->where('user_id', auth()->id())->delete();

        return back();
    }

    public function comment(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return back();
    }
}

