<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class LoginController extends Controller
{
    // public function login()
    // {
    //     if (Auth::guard('web')->check()) {
    //         return redirect()->route('admin.dashboard');
    //     } else {
    //         return view('backend.login');
    //     }

    // }

    public function login()
    {
        return view('backend.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|string',
        ],[
           'email.required' => 'Email Id is required',
           'password.required' => 'Password is required',
          ]);

        $credentials = $request->only('email', 'password');
        $remember_me = $request->has('remember_token') ? true : false;

        if (Auth::attempt($credentials, $remember_me)) {
            // $roles = auth()->user()->role;
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('message', 'You are logged-in Successfully.');
        }
        else{
            return redirect()->route('admin.login')->with(['Input' => $request->only('email','password'), 'message' => 'Credentials do not match our records!']);
        }

    }

    public function logout(Request $request) {
        Session::flush();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('message', 'You are logout Successfully.');
    }
    
    
    
    public function change_password()
    {
       return view('backend.forgot_password');
    }

    
   public function updatePassword(Request $request)
    {
        // dd($request);
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|same:password',
        ], [
            'email.required' => 'Email is required',
            'email.email' => 'Please provide a valid email address',
            'email.exists' => 'The email does not exist in our records',
            'password.required' => 'New Password is required',
            'password_confirmation.required' => 'Confirm Password is required',
            'password_confirmation.same' => 'Confirm Password must match the New Password',
        ]);
    
        DB::table('users')->where('email', $request->email)->update([
            'password' => Hash::make($request->password),
            'updated_at' => now(),
        ]);
        return redirect()->route('admin.login')->with("message", "Password changed successfully!");
    }


    // public function dashboard_count()
    // {
    //     $roomCount = DB::table('room_details')
    //                     ->whereNotNull('room_title') 
    //                     ->where('room_title', '!=', '')  
    //                     ->whereNull('deleted_by')  
    //                     ->count();
                        
    //     return view('backend.index', compact('roomCount'));
    // }

    public function register()
    {
        return view('backend.register');
    }
    
    public function authenticate_register(Request $request)
    {

        $messages = [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name must not exceed 255 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email is already taken.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 8 characters.',
        ];

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ], $messages);
    
        $user = new User();
        $user->name = $validated['name']; 
        $user->email = $validated['email']; 
        $user->password = Hash::make($validated['password']);
        $user->save();
    
        return redirect()->route('admin.login')->with('message', 'Account created successfully! Please log in.');
    }
    
}
