<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function showForm()
    {
        return view('pages.feedback');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Feedback::create([
            'body' => json_encode($data)
        ]);

        return back()->with('success', 'Thank you for your feedback .');
    }

    public function allFeedbacks() {

        $feedbacks = Feedback::all();

        return view('admin.feedbacks',compact('feedbacks'));
    }
}
