<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;




class ChatController extends Controller
{
    private function isFriend($currentUserId, $userId)
    {

        return Friendship::where(function ($query) use ($currentUserId, $userId) {
            $query->where('sender_id', $currentUserId)
                ->where('receiver_id', $userId);
        })
            ->orWhere(function ($query) use ($currentUserId, $userId) {
                $query->where('sender_id', $userId)
                    ->where('receiver_id', $currentUserId);
            })
            ->where('status', 'accepted') // Ensure the friendship is accepted
            ->exists();
    }

    private function getChat($currentUserId, $userId)
    {
        return Chat::with('messages')->where(function ($query) use ($currentUserId, $userId) {
            $query->where('user_one_id', $currentUserId)->where('user_two_id', $userId);
        })->orWhere(function ($query) use ($currentUserId, $userId) {
            $query->where('user_one_id', $userId)->where('user_two_id', $currentUserId);
        })->first();
    }


    public function showChat(User $user)
    {
        $currentUserId = Auth::id();

        // Check if the users are friends using the Friendship model
        $friendshipExists = $this->isFriend($currentUserId, $user->id);

        // If not friends, redirect with an error message
        if (!$friendshipExists) {
            return redirect()->back()->withErrors(['error' => 'You can only chat with your matches.']);
        }


        // Check if a chat already exists
        $chat = $this->getChat($currentUserId,$user->id);


        // If no chat exists, create one
        if (!$chat) {
            $chat = Chat::create([
                'user_one_id' => $currentUserId,
                'user_two_id' => $user->id,
            ]);
        }



        $messages = $chat->messages;

        // Return the chat view with the chat record
        return view('pages.chat', compact('chat', 'messages'));
    }
}
