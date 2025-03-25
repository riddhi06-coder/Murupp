<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\ProductDetails;
use App\Models\Carts;
use App\Models\GuestSession;


class ForgotPasswordController extends Controller
{


    // Show Forgot Password Page
    public function forgot_password()
    {
        return view('frontend.forgot-password');
    }

    // Handle Forgot Password Form Submission
    public function update_password(Request $request)
    {
            $request->validate([
                'email' => [
                    'required',
                    'email',
                    'exists:users,email',
                    'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'
                ],
            ], [
                'email.exists' => 'We could not find an account with this email address.',
                'email.regex' => 'Please enter a valid email address format.',
            ]);

        $token = Str::random(64);

        // Store token in password_reset_tokens table
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        // Send email with reset link
        Mail::send('frontend.password-reset-mail', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Your Password');
        });

        return back()->with('message', 'A password reset link has been sent to your email.');
    }

    // Show Reset Password Page
    public function reset_password($token)
    {
        return view('frontend.reset-password', ['token' => $token]);
    }

    // Handle Password Reset Form Submission
    public function update_reset_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Verify token and email
        $resetRecord = DB::table('password_reset_tokens')
            ->where(['email' => $request->email, 'token' => $request->token])
            ->first();

        if (!$resetRecord) {
            return back()->withErrors(['email' => 'Invalid Email!']);
        }

        // Update password
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        // Remove reset token
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect()->route('user.login')->with('message', 'Your password has been reset successfully.');
    }


}