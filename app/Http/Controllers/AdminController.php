<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
    }
    public function dashboard(User $user)
    {
        $user = Auth::user();
        return view('admin.index', compact('user'));
    }
}
