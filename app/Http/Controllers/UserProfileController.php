<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UploadPostRequest;
use App\Http\Requests\UploadProfilePictureRequest;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use App\Services\ImageService;
use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use URL;

class UserProfileController extends Controller
{


    public function show(User $user)
    {
        $user = User::findOrFail($user->id);
        $userInId = Auth::user();
        $posts = $user->posts()->with(['likes', 'comments'])->get(); // Assuming you have 'likes' and 'comments' relationships defined
        $postCount = $posts->count();
        $commentsCount = $user->comments()->count();
        $userName = $user->first_name . ' ' . $user->last_name;
        $profileUserId = $user->id;

        return view('base.userProfile', compact('user', 'posts', 'postCount', 'commentsCount', 'userName', 'profileUserId', 'userInId'));
    }

    public function fetch(User $user)
    {
        $posts = $user->posts()->with('user')
            ->withCount(['comments', 'likes'])
            ->latest()
            ->paginate(6);

        return response()->json([
            'userId' => $user->id,
            'posts' => $posts->items(),
            'currentPage' => $posts->currentPage(),
            'lastPage' => $posts->lastPage(),
            'previousPageUrl' => $posts->previousPageUrl(),
            'nextPageUrl' => $posts->nextPageUrl() ? URL::to($posts->nextPageUrl()) : null,
        ]);
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

    public function store(StorePostRequest $request, User $user)
    {

        $validated = $request->validated();

        // Handle image upload using the ImageService
        if ($request->hasFile('image')) {
            $imageName = $this->imageService->uploadImage('post_images', $request->file('image'));
            $validated['image'] = $imageName;
        }

        // Set the post_date to the current time
        $validated['post_date'] = Carbon::now();


        // Create a new post and assign the user_id
        $post = new Post($validated);
        $post->user_id = $user->id; // Set the user ID from the route parameter
        $post->save(); // Save the post to the database

        return response()->json(['message' => 'Post Added Successfully']);
    }

    public function updatePofile(request $request, User $user)
    {

        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($data);
        return response()->json(['message' => 'Profile updated successfully']);
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
