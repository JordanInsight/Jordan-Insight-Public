<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\ImageService;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::pluck('role_name', 'id'); // Get roles as id => name pairs
        return view('admin.Dynamic.users', compact('roles'));
    }

    public function fetch()
    {
        $users = User::with('role')->get();  

        return response()->json(compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return response()->json(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // Ensure role_id is being handled
        $validated = $request->validated();
        if ($request->has('role_id')) {
            $validated['role_id'] = $request->role_id;
        }
        $user->update($validated);
        return response()->json(['message' => 'User Updated Successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $User)
    {
        (new ImageService)->deleteImage('User', $User->image);

        $User->delete();

        return response()->json(['message' => 'User Deleted Successfully']);
    }
}
