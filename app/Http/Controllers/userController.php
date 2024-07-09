<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\ImageService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.Dynamic.user');
    }

    public function fetch(){

        $users =User::all();

        return response()->json(compact('users'));
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        
        return response()->json(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
         
        $user->update(['is_admin' => $validated['is_admin']]);
        return response()->json(['message' => 'User Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Delete the Users image
        (new ImageService)->deleteImage('Users', $user->image);
       
        // Delete the Users
        $user->delete();

        return response()->json(['message'=>'User deleted successfully']);
    }
}
