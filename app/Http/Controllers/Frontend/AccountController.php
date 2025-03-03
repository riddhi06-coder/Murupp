<?php

    namespace App\Http\Controllers\frontend;
    
    use App\Http\Controllers\Controller;
    
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;

    use App\Models\User;
    use App\Models\OrderDetail;

    
    
    class AccountController extends Controller
    {
        // === My account
        public function account(Request $request)
        {
            $user = Auth::user(); 
            return view('frontend.my-account', compact('user'));
        }

        // === My account update
        public function updateAccount(Request $request)
        {
            // dd($request);
            $user = Auth::user();
    
            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'nullable|string|max:20',
                'current_password' => 'nullable|string|min:8',
                'new_password' => 'nullable|string|min:8|confirmed',
                'profile_picture' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
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

                'profile_picture.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
                'profile_picture.max' => 'Profile picture must not exceed 2MB.',
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

            // Handle Profile Picture Upload
            if ($request->hasFile('profile_picture')) {
                $profileImage = $request->file('profile_picture');
                $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
                
                // Move the uploaded file to public/uploads/profile_pictures
                $profileImage->move(public_path('uploads/profile_pictures'), $profileImageName);

                // Delete old profile picture if exists
                if (!empty($user->image)) {  // Ensure old image exists
                    $oldImagePath = public_path('uploads/profile_pictures/' . $user->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Save new profile picture path to the database
                $user->image = $profileImageName;
            }

            $user->save();
    
            return back()->with('message', 'Account updated!!');
        }


        // === My Account Orders
        public function account_orders(Request $request)
        {
            $user = Auth::user();

            // Fetch orders for the logged-in user
            $orders = DB::table('order_details')
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('frontend.my-account-orders', compact('user', 'orders'));
        }

        // === My Account Order Detailed Page
        public function account_orders_details($order_id)
        {
            $order = OrderDetail::where('order_id', $order_id)->firstOrFail();
            return view('frontend.my-account-order-details', compact('order'));
        }


        
    }