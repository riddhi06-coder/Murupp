<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\ProductDetails;
use App\Models\Carts;


class RegistrationController extends Controller
{

    public function register(Request $request)
    {
        return view('frontend.register');
    }

    public function authenticate_register(Request $request)
    {
        $messages = [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email is already taken.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'agree_checkbox.accepted' => 'You must agree to the terms and conditions.',
        ];

        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'agree_checkbox' => 'accepted',
        ], $messages);

        $user = new User();
        $user->email = $validated['email']; 
        $user->password = Hash::make($validated['password']);
        $user->status = 1;
        $user->save();

        return redirect()->route('frontend.index')->with('message', 'Account created successfully! Please log in.');
    }

    public function login(Request $request)
    {
        return view('frontend.login');
    }


    public function authenticate_login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|string',
        ],[
            'email.required' => 'Email Id is required',
            'password.required' => 'Password is required',
        ]);

        $credentials = $request->only('email', 'password');
        $remember_me = $request->has('remember_me'); 

        if (Auth::attempt($credentials, $remember_me)) {
            $request->session()->regenerate();

            if ($remember_me) {
                $user = Auth::user();
                $user->setRememberToken(Str::random(60)); 
                $user->save();
            }

            return redirect()->route('frontend.index')->with('message', 'You are logged in Successfully.');
        }

        return redirect()->route('frontend.login')->with(['message' => 'Credentials do not match our records!']);
    }


}