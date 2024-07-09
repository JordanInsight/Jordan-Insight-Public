<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // If user is not logged in, redirect to login page
            return redirect()->route('admin.login.view');
        }

        // Check if the logged-in user is an admin
        if (!Auth::user()->hasRole('Admin')) {
            // User is not an admin, redirect to a general page or error page
            return redirect('/'); // Adjust this as needed
        }

        return $next($request);
    }
}



