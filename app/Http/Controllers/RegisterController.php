<?php

namespace App\Http\Controllers;


use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Auth;

class RegisterController extends Controller
{
    // Show the registration view
    public function index()
    {
        return view('base.register');
    }

    public function register(RegisterRequest $request)
    {
    
        $default_role_id = 2;
        // Create the user using the validated data from the RegisterRequest
        $user = User::create([
            'role_id' =>$default_role_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Log in the user
        Auth::login($user);

        // Redirect to the dashboard or a similar page
        return redirect('/');  // Adjust the redirect location as needed
    }


   

}
