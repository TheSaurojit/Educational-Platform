<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showCreateForm()
    {
        return view('pages.edit-profile');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'profile_image' => 'nullable|string',
            'address' => 'nullable|string',
            'mathematical_interests' => 'nullable|array',
            'achievements' => 'nullable|string',
            'is_mathematician' => 'required',

            'facebook' => 'nullable|string',
            'twitter' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'youtube' => 'nullable|string',
        ]);

        dd($request->all());

        $user = User::create([
            'profile_image' => $validatedData['profile_image'] ?? null,
            'address' => $validatedData['address'] ?? null,
            'mathematical_interests' => json_encode($validatedData['mathematical_interests'] ?? []),
            'achievements' => $validatedData['achievements'] ?? null,
            'facebook' => $validatedData['facebook'] ?? null,
            'twitter' => $validatedData['twitter'] ?? null,
            'linkedin' => $validatedData['linkedin'] ?? null,
            'youtube' => $validatedData['youtube'] ?? null,
            'is_mathematician' => $validatedData['is_mathematician'] ?? false,
        ]);
    }

}