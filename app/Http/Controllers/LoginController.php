<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\AdminLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index()
    {
        return view('base.login');
    }

    public function showAdminLoginForm()
    {
        return view('admin.login');
    }
    public function showVendorLoginForm()
    {
        return view('vendor.login');
    }

    public function handleAdminLogin(AdminLoginRequest $request)
    {
        $user = User::with('role')->where('email', $request->email)->first();

        // Check if the user exists
        if (!$user) {
            return back()->withErrors([
                'email' => 'No account found with that email address.'
            ])->withInput($request->only('email'));
        }

        // Check if the user has the Admin role
        if (!$user->hasRole('Admin')) {
            return back()->withErrors([
                'email' => 'Access denied. You do not have administrative privileges.'
            ])->withInput($request->only('email'));
        }

        // Attempt to authenticate
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        } else {
            // Provide a clearer error message for invalid password
            return back()->withErrors([
                'password' => 'The password you entered is incorrect.'
            ])->withInput($request->only('email'));
        }
    }


    public function handleVendorLogin(AdminLoginRequest $request)
    {
        $user = User::with('role')->where('email', $request->email)->first();

        // Check if the user exists
        if (!$user) {
            return back()->withErrors([
                'email' => 'No account found with that email address.'
            ])->withInput($request->only('email'));
        }

        // Check if the user has the Admin role
        if (!$user->hasRole('Vendor')) {
            return back()->withErrors([
                'email' => 'Access denied. You do not have administrative privileges.'
            ])->withInput($request->only('email'));
        }

        // Attempt to authenticate
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/vendor/dashboard');
        } else {
            // Provide a clearer error message for invalid password
            return back()->withErrors([
                'password' => 'The password you entered is incorrect.'
            ])->withInput($request->only('email'));
        }
    }





    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        // First, check if the email exists in the database
        $user = User::where('email', $credentials['email'])->first();

        // If no user is found with the email, return with the email error
        if (!$user) {
            return back()->withErrors(['email' => 'Incorrect Email'])->withInput($request->only('email'));
        }

        // If the email is correct, attempt to log in with the credentials
        if (Auth::attempt($credentials)) {
            // Regenerate the session to protect against session fixation
            $request->session()->regenerate();

            // Redirect the user to the intended page or the homepage
            return redirect()->intended('/');
        }

        // If the credentials were incorrect (email exists but password doesn't match)
        return back()->withErrors(['password' => 'Incorrect Password'])->withInput($request->only('email', 'password'));
    }
}
