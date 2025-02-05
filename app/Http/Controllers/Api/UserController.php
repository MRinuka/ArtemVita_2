<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Get the details of the authenticated user.
     */
    public function profile(Request $request)
    {
        $user = Auth::user();

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'profile_picture' => $user->profile_picture_url, // Accessor method in User model
            'bio' => $user->bio,
        ], 200);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Update fields if provided
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('bio')) {
            $user->bio = $request->bio;
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profilePicPath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $profilePicPath;
        }

        $user->save();

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'profile_picture' => $user->profile_picture_url, // Make sure this accessor exists in the User model
                'bio' => $user->bio,
            ]
        ], 200);
    }
}
