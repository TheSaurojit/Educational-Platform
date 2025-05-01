<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    private function getChat($chatId)
    {
        $currentUserId = Auth::id();

        return Chat::where(function ($query) use ($chatId, $currentUserId) {
            $query->where('id', $chatId)
                ->where('user_one_id', $currentUserId);
        })->orWhere(function ($query) use ($chatId, $currentUserId) {
            $query->where('id', $chatId)
                ->where('user_two_id', $currentUserId);
        })->first();
    }

    // Get messages for a specific chat
    // public function getNewMsg(Request $request)
    // {

    //     // Check if the authenticated user is part of the chat
    //     if ($chat->user_one_id !== auth()->id() && $chat->user_two_id !== auth()->id()) {
    //         abort(403, 'Unauthorized');
    //     }

    //     // Fetch messages for the chat
    //     $messages = $chat->messages()->latest()->get();
    //     return response()->json($messages);
    // }

    // Store a new message in a chat
    public function storeMsg(Request $request, string $chat)
    {
        //check if user valid chatid sender->idate

        $chatRecord = $this->getChat($chat);

        dd($chatRecord);


        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'message' => $request->message,
            'sender_id' => auth()->id(),
        ]);
    }

    // Mark a message as read
    public function markAsRead(Message $message)
    {
        // Ensure the authenticated user is the one who should read the message
        if ($message->sender_id === auth()->id()) {
            return response()->json(['message' => 'You cannot mark your own message as read.'], 400);
        }

        // Mark the message as read
        $message->read_at = now();
        $message->save();

        return response()->json(['message' => 'Message marked as read']);
    }
}
