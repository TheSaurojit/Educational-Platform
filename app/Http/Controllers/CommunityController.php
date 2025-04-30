<?php

namespace App\Http\Controllers;

use App\Helpers\FileUploader;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{

    public function communityView()
    {

        $posts = Post::with(['user.profile', 'likes', 'comments.user.profile'])
            ->latest()
            ->get();

        $posts = Post::with([
            'user:id,name',             // load only id, name of users
            'user.profile:user_id,profile_image', // select profile fields
            'likes:user_id,post_id',  // select likes fields
            'comments:post_id,user_id,body', // select basic comment fields
            'comments.user:id,name',    // commenter user fields
            'comments.user.profile:id,user_id,profile_image' // commenter profile
        ])->latest()->get();


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

        $validated['user_id'] = Auth::id();

        Post::create($validated);

        return to_route('community')->with('success', 'Post Created');
    }


    public function addComment(Request $request)
    {
        try {
            $validated = $request->validate([
                'post_id' => ['required', 'string'],
                'comment' => ['required', 'string']
            ]);

            Comment::create([
                'post_id' => $validated['post_id'],
                'body' => $validated['comment'],
                'user_id' => Auth::id(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Comment added successfully',
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ], 500);
        }
    }

    public function addLike(Request $request)
    {
        try {
            $validated = $request->validate([
                'post_id' => ['required', 'string']
            ]);

            $userId = Auth::id();
            $postId = $validated['post_id'];

            $existingLike = Like::where('post_id', $postId)
                ->where('user_id', $userId)
                ->first();

            if ($existingLike) {
                $existingLike->delete();

                return response()->json([
                    'success' => true,
                    'liked' => false,
                    'message' => 'Like removed'
                ]);
            } else {
                Like::create([
                    'post_id' => $postId,
                    'user_id' => $userId,
                ]);

                return response()->json([
                    'success' => true,
                    'liked' => true,
                    'message' => 'Like added'
                ]);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}
