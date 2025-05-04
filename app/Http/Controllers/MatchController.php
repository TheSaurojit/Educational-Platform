<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{
    public function getUserIdsThatArePendingOrAccepted(array $status): array
    {
        $userId = Auth::id();

        $sent = Friendship::where('sender_id', $userId)->whereIn('status', $status)->pluck('receiver_id')->toArray();
        $received = Friendship::where('receiver_id', $userId)->whereIn('status', $status)->pluck('sender_id')->toArray();

        $connectedIds = array_unique(array_merge($sent, $received));

        return $connectedIds;
    }

    public function  discoverView(): View
    {
        $mathematicians = User::where('id', '!=', Auth::id())
            ->whereNotIn('id', $this->getUserIdsThatArePendingOrAccepted(
                ['accepted', 'pending']
            ))
            ->whereHas('profile', function ($query) {
                $query->where('is_mathematician', true);
            })
            ->with('profile')
            ->get();


        return view('pages.discover', compact('mathematicians'));
    }


    public function matchView(): View
    {
        $NotYourMatches = User::where('id', '!=', Auth::id())
            ->whereNotIn('id', $this->getUserIdsThatArePendingOrAccepted(
                ['accepted', 'pending']
            ))
            ->whereHas('profile')
            ->with('profile')
            ->get();

        $YourMatches = User::where('id', '!=', Auth::id())
            ->whereIn('id', $this->getUserIdsThatArePendingOrAccepted(
                ['accepted']
            ))
            ->whereHas('profile')
            ->with('profile')
            ->get();

            $YourMatches->each(function ($user) {
                $user->unread_messages = Message::whereNull('read_at')->where('sender_id',$user->id)->count(); // dynamic property
            });

        return view('pages.matches', compact('NotYourMatches', 'YourMatches'));
    }

    public function sendRequest($receiverId): RedirectResponse
    {
        $senderId = Auth::id();

        // Prevent sending request to yourself
        if ($senderId == $receiverId) {
            return back()->withErrors(['error' => 'You cannot send a request to yourself']);
        }

        // Verify the receiver exists
        $receiverExists = User::where('id', $receiverId)->exists();
        if (!$receiverExists) {
            return back()->withErrors(['error' => 'User not found']);
        }

        // Check if a friendship already exists (in either direction)
        $exists = Friendship::where(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $receiverId)->where('receiver_id', $senderId);
        })->exists();

        if ($exists) {
            return back()->with(['success' => ' Match request  sent']);
        }

        try {
            // Create new friendship request
            Friendship::create([
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'status' => 'pending',
            ]);

            return back()->with(['success' => 'Match request sent ']);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to send match request. Please try again.']);
        }
    }

    public function notifications(): View
    {
        /**
         * @var User
         */
        $user = Auth::user();
        $requests = $user->receivedFriendRequests()
            ->with('sender.profile')
            ->get();


        return view('pages.notifications', compact('requests'));
    }

    public function acceptRequest($senderId): RedirectResponse
    {
        $receiverId = Auth::id();

        $friendship = Friendship::where('sender_id', $senderId)
            ->where('receiver_id', $receiverId)
            ->where('status', 'pending') // Optional but safer
            ->first();

        if (!$friendship) {
            return back();
        }

        $friendship->update(['status' => 'accepted']);

        return back()->with(['success' => 'Match request accepted!']);
    }

    public function rejectRequest($senderId): RedirectResponse
    {
        $receiverId = Auth::id();

        $friendship = Friendship::where('sender_id', $senderId)
            ->where('receiver_id', $receiverId)
            ->where('status', 'pending') // Optional but safer
            ->first();

        if (!$friendship) {
            return back();
        }
        $friendship->delete();

        return back()->with(['success' => 'Friend request rejected!']);
    }
}
