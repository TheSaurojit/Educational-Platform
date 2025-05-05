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

        return Chat::where('id', $chatId)
            ->where(function ($query) use ($currentUserId) {
                $query->where('user_one_id', $currentUserId)
                    ->orWhere('user_two_id', $currentUserId);
            })->first();
    }

    public function storeMsg(Request $request, string $chatId)
    {
        $currentUserId = Auth::id();

        $chatRecord = $this->getChat($chatId);

        if (!$chatRecord) {
            return response()->json(['error' => 'Invalid Chat'], 403);
        }

        $receiverId = $chatRecord->user_one_id === $currentUserId
            ? $chatRecord->user_two_id
            : $chatRecord->user_one_id;

        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'chat_id'     => $chatId,
            'message'     => $validated['message'],
            'sender_id'   => $currentUserId,
            'receiver_id' => $receiverId,
        ]);

        return response()->json(['success' => true], 201);
    }



    // Get messages for a specific chat
    public function getNewMsg(string $chatId)
    {

        $currentUserId = Auth::id();

        $chatRecord = $this->getChat($chatId);

        if (!$chatRecord) {
            return response()->json(['error' => 'Invalid Chat'], 403);
        }

        $receiverId = $chatRecord->user_one_id === $currentUserId
            ? $chatRecord->user_two_id
            : $chatRecord->user_one_id;


        $messages = Message::whereNull('read_at')->where('sender_id', $receiverId)->where('receiver_id', $currentUserId)->select('id','message','read_at','created_at')->oldest()->get();

        $messageIds = $messages->pluck('id');

        Message::whereIn('id', $messageIds)->update(['read_at' => now()]);

        return response()->json(['success' => true , 'messages' => $messages->toArray() ]);
    }

}
