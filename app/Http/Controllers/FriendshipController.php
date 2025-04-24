<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    // Send friend request
    public function sendRequest($receiverId)
    {
        Friendship::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $receiverId,
            'status' => 'pending'
        ]);
    }

    // Accept request
    public function acceptRequest($requestId)
    {
        $request = Friendship::findOrFail($requestId);
        if ($request->receiver_id === auth()->id()) {
            $request->update(['status' => 'accepted']);
        }
    }

    // Decline request
    public function declineRequest($requestId)
    {
        $request = Friendship::findOrFail($requestId);
        if ($request->receiver_id === auth()->id()) {
            $request->update(['status' => 'declined']);
        }
    }
}
