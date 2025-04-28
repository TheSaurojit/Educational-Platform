<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    

    public function  discoverView()
    {
        $mathematicians = User::where('id', '!=', Auth::id())
            ->whereHas('profile', function ($query) {
                $query->where('is_mathematician', true);
            })
            ->with('profile')
            ->get();


        return view('pages.discover', compact('mathematicians'));
    }


    public function matchView()
    {
        $users = User::where('id', '!=', Auth::id())
            ->whereHas('profile')
            ->with('profile')
            ->get();


        return view('pages.matches', compact('users'));
    }

    public function sendRequest(Request $request)
    {
        $friendship = Friendship::create([
            'user_id' => auth()->id(),
            'friend_id' => $request->friend_id,
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Friend request sent!']);
    }

    public function acceptRequest($id)
    {
        $friendship = Friendship::find($id);
        $friendship->status = 'accepted';
        $friendship->save();

        return response()->json(['message' => 'Friend request accepted!']);
    }

    public function rejectRequest($id)
    {
        $friendship = Friendship::find($id);
        $friendship->status = 'rejected';
        $friendship->save();

        return response()->json(['message' => 'Friend request rejected!']);
    }

    public function listFriends()
    {
        $friends = auth()->user()->friends()->wherePivot('status', 'accepted')->get();

        return response()->json($friends);
    }
}
