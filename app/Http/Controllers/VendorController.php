<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadProfilePictureRequest;
use App\Models\User;
use App\Services\ImageService;
use Auth;
use Hash;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function dashboard(User $user)
    {
        $user = Auth::user();
        return view('vendor.index', compact('user'));
    }


    public function edit(User $user)
    {

        $user = Auth::user();
        return view('vendor.profile.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($data);
        return response()->json(['message' => 'Profile updated successfully']);
    }


    private $imageService; // Create a private variable for the ImageService

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService; // Initialize the ImageService
    }

    public function uploadProfileImage(UploadProfilePictureRequest $request, User $user)
    {
        $validated = $request->validated();


        // Use the correct key to check if the profile picture has been uploaded.
        if ($request->hasFile('profilePic')) {
            $file = $request->file('profilePic'); // Retrieve the file with the correct key.
            $imageName = $this->imageService->uploadImage('user_profile_pictures', $file);

            // Update the user's profile picture path in the database
            $user->user_pfp = $imageName;
            $user->save();

            return response()->json(['message' => 'Image uploaded successfully']);
        } else {
            return response()->json(['message' => 'No image was uploaded'], 422);
        }
    }


    public function updatePassword(Request $request, User $user)
    {
        $data = $request->validate([
            'recent_password' => 'required',
            'new_password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z]).+$/|confirmed',
        ]);

        $user = Auth::user();
        if (Hash::check($data['recent_password'], $user->password)) { // Check if the current password is correct
            // Check if the new password is the same as the old or current password
            if (
                Hash::check($data['new_password'], $user->password) ||
                (!is_null($user->old_password) && Hash::check($data['new_password'], $user->old_password))
            ) {
                return response()->json(['message' => 'Your new password cannot be the same as your previous password.'], 422);
            } else {
                $user->old_password = $user->password; // Save the current password as old password
                $user->password = Hash::make($data['new_password']); // Update to new password
                $user->save();
                return response()->json(['message' => 'Password updated successfully']);
            }
        } else {
            return response()->json(['message' => 'Your current password is incorrect.'], 422);
        }
    }
}
