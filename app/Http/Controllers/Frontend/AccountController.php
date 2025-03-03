<?php

    namespace App\Http\Controllers\frontend;
    
    use App\Http\Controllers\Controller;
    
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;

    use App\Models\User;

    
    
    class AccountController extends Controller
    {
        // === My account
        public function account(Request $request)
        {
            $user = Auth::user(); 
            return view('frontend.my-account', compact('user'));
        }


        public function updateAccount(Request $request)
        {
            $user = Auth::user();
    
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'nullable|string|max:20',
                'current_password' => 'nullable|string|min:8',
                'new_password' => 'nullable|string|min:8|confirmed',
            ], [
                'first_name.required' => 'First name is required.',
                'first_name.string' => 'First name must be a valid string.',
                'first_name.max' => 'First name cannot exceed 255 characters.',
        
                'last_name.string' => 'Last name must be a valid string.',
                'last_name.max' => 'Last name cannot exceed 255 characters.',
        
                'email.required' => 'Email address is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'This email is already taken.',
        
                'phone.string' => 'Phone number must be a valid string.',
                'phone.max' => 'Phone number cannot exceed 20 characters.',
        
                'current_password.min' => 'Current password must be at least 8 characters.',
        
                'new_password.min' => 'New password must be at least 8 characters.',
                'new_password.confirmed' => 'New password and confirmation do not match.',
            ]);
    
            $user->name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
    
            if ($request->filled('current_password') && $request->filled('new_password')) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return back()->withErrors(['current_password' => 'Current password is incorrect']);
                }
                $user->password = Hash::make($request->new_password);
            }
    
            $user->save();
    
            return back()->with('message', 'Account updated!!');
        }
        
    }