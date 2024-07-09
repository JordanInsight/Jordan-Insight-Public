<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Str;

class ResetPasswordController extends Controller
{
    function showForgotPasswordForm()
    {
        return view('base.forgotPassword');
    }

    function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert(['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]);

        Mail::send('emails.forget-password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return redirect()->back()->with('success', 'A reset link has been sent to your email');
    }

    function showResetPasswordForm($token)
    {
        $record = DB::table('password_resets')->where('token', $token)->first();

        if (!$record) {
            return redirect()->route('login')->withErrors(['error' => 'Invalid token']);
        }

        $tokenCreationTime = Carbon::parse($record->created_at);
        $currentTime = Carbon::now();

        if ($currentTime->diffInHours($tokenCreationTime) > 24) {
            // Token expired
            DB::table('password_resets')->where('token', $token)->delete(); // Optional: clean up expired token
            return redirect()->route('login')->withErrors(['error' => 'This reset link has expired. Please request a new one.']);
        }

        return view('base.passwordReset', compact('token'));
    }


    function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z]).+$/|confirmed',
            'password_confirmation' => 'required'
        ]);

        $resetPasswordRecord = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$resetPasswordRecord) {
            return redirect()->back()->with('error', 'Invalid or expired token.');
        }

        User::where('email', $resetPasswordRecord->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where('token', $request->token)->delete();

        return redirect()->route('login')->with('success', 'Password reset successfully.');
    }
}
