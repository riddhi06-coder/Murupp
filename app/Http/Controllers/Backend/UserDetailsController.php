<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;


class UserDetailsController extends Controller
{

    public function index()
    {
        $users = User::all()->wherenull('deleted_by'); 
        return view('backend.users.user-list.index', compact('users'));
    }

    public function create()
    {
        return view('backend.users.user-list.create');
    }

    public function store(Request $request)
    {

        // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'status' => 'required|in:0,1', 
        ], [
            'name.required' => 'The name field is mandatory.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name cannot be more than 255 characters.',
            
            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be a valid email.',
            'email.unique' => 'The email address has already been taken.',
            
            'password.required' => 'The password field is mandatory.',
            'password.string' => 'The password must be a valid string.',
            'password.min' => 'The password must be at least 6 characters long.',

            'status.required' => 'The status field is mandatory.',
            'status.in' => 'The status must be either Active (1) or Inactive (0).',
        ]);
        // dd($request);
            $user = new User();
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['password']); 
            $user->status = $validatedData['status'];
            $user->created_by = Auth::user()->id;
            $user->created_at = Carbon::now();
            $user->save();

            return redirect()->route('user-list.index')->with('message', 'User has been created successfully.');
    }

    // for updating the USER status change
    public function updateStatus(Request $request)
    {
        $user = User::find($request->user_id); 
        if ($user) {
            $user->status = $request->status;
            $user->save(); 
            return response()->json(['success' => true,'message' => 'Status updated to Active successfully!']);
        }
        return response()->json(['success' => false,'message' => 'Status updated to Inactive successfully!'], 400);
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('backend.users.user-list.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, 
            'password' => 'nullable|string|min:6', 
            'status' => 'required|in:0,1', 
        ], [
            'name.required' => 'The name field is mandatory.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name cannot be more than 255 characters.',
            
            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be a valid email.',
            'email.unique' => 'The email address has already been taken.',
            
            'password.string' => 'The password must be a valid string.',
            'password.min' => 'The password must be at least 6 characters long.',
            
            'status.required' => 'The status field is mandatory.',
            'status.in' => 'The status must be either Active (1) or Inactive (0).',
        ]);

        $user = User::findOrFail($id);

        // Update the user's information
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->status = $validatedData['status'];
        $user->modified_at = Carbon::now();
        $user->modified_by =  Auth::user()->id;
        $user->save();

        return redirect()->route('user-list.index')->with('message', 'User has been updated successfully.');
    }

    public function destroy(string $id)
    {
        // dd($id);
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = User::findOrFail($id);
            $industries->update($data);

            return redirect()->route('user-list.index')->with('message', 'User Details has been successfully deleted');
        } catch (\Exception $ex) {

            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}