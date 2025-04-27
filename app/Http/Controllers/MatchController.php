<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
 

    public function matchView()
    {
        $users = User::where('id', '!=', Auth::id())
            ->whereHas('profile')
            ->with('profile')
            ->get();


        return view('pages.matches',compact('users'));
    }

    // Send friend request
    public function sendRequest($receiverId)
    {
        Friendship::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $receiverId,
            'status' => 'pending'
        ]);
    }

    // Accept request
    public function acceptRequest($requestId)
    {
        $request = Friendship::findOrFail($requestId);
        if ($request->receiver_id === Auth::id()) {
            $request->update(['status' => 'accepted']);
        }
    }

    // Decline request
    public function declineRequest($requestId)
    {
        $request = Friendship::findOrFail($requestId);
        if ($request->receiver_id === Auth::id()) {
            $request->update(['status' => 'declined']);
        }
    }
}
