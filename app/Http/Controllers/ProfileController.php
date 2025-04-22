<?php

namespace App\Http\Controllers;

use App\Helpers\FileUploader;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $profile = Auth::user()->profile;

        return view('pages.profile', compact('profile'));
    }
    public function showProfileForm()
    {
        // $data = Profile::where('user_id', Auth::id())->first();

        $data = Auth::user()->profile;

        return view('pages.edit-profile', compact('data'));
    }

    public function create(Request $request)
    {
        $rules = [
            'profile_image' => ['required', 'image', 'mimes:jpg,png,jpeg'],
            'is_mathematician' => ['required'],
            'mathematical_interests' => ['required', 'array', 'min:1', 'max:5'],
            'address' => ['nullable', 'string'],
            'achievements' => ['nullable', 'string'],
            'facebook' => ['nullable', 'string'],
            'instagram' => ['nullable', 'string'],
            'linkedin' => ['nullable', 'string'],
            'youtube' => ['nullable', 'string'],
        ];

        $validatedData = $request->validate($rules);

        // Add the user ID
        $validatedData['user_id'] = Auth::id();

        // Handle profile image upload
        $validatedData['profile_image'] = FileUploader::imageUpload($request->file('profile_image'));


        // Simplify is_mathematician logic
        $validatedData['is_mathematician'] = $request->boolean('is_mathematician');

        // Encode mathematical interests
        $validatedData['mathematical_interests'] = json_encode($request->input('mathematical_interests'));

        // Create the profile
        Profile::create($validatedData);

        return back()->with('success', 'Profile Created!');
    }

    public function update(Request $request)
    {
        $rules = [
            'profile_image' => ['image', 'mimes:jpg,png,jpeg'],
            'is_mathematician' => ['string'],
            'mathematical_interests' => ['required', 'array', 'min:1', 'max:5'],
            'address' => ['nullable', 'string'],
            'achievements' => ['nullable', 'string'],
            'facebook' => ['nullable', 'string'],
            'instagram' => ['nullable', 'string'],
            'linkedin' => ['nullable', 'string'],
            'youtube' => ['nullable', 'string'],
        ];

        $validatedData = $request->validate($rules);

        $profile = Profile::where('user_id', Auth::id())->first();


        if ($request->hasFile('profile_image')) {
            $validatedData['profile_image'] = FileUploader::imageUpload($request->file('profile_image'));
        }

        // Simplify is_mathematician logic
        $validatedData['is_mathematician'] = $request->boolean('is_mathematician');

        // Encode mathematical interests
        $validatedData['mathematical_interests'] = json_encode($request->input('mathematical_interests'));

        // update profile
        $profile->update($validatedData);


        return back()->with('success', 'Profile Updated!');
    }
}
