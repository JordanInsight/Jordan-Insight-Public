<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the user's session
        $request->session()->invalidate();

        // Regenerate the token to protect against CSRF
        $request->session()->regenerateToken();

        // Redirect to the homepage
        return redirect(route('login')); // It's common to redirect to a login page after logout
    }
    public function Adminlogout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the user's session
        $request->session()->invalidate();

        // Regenerate the token to protect against CSRF
        $request->session()->regenerateToken();

        // Redirect to the homepage
        return redirect(route('admin.login.view')); // It's common to redirect to a login page after logout
    }

    public function Vendorlogout(Request $request)
    {
        // Log the user out
        Auth::logout();

        // Invalidate the user's session
        $request->session()->invalidate();

        // Regenerate the token to protect against CSRF
        $request->session()->regenerateToken();

        // Redirect to the homepage
        return redirect(route('vendor.login.view')); // It's common to redirect to a login page after logout
    }
}
