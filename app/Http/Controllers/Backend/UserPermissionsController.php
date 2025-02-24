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
use App\Models\Permission;
use App\Models\UsersPermission;


class UserPermissionsController extends Controller
{

    public function index()
    {
        $permissionsData = UsersPermission::with('user')->get(); 
        // dd($permissionsData);
        return view('backend.users.user_permission.index', compact('permissionsData'));
    }

    public function create(Request $request)
    {
        $users = User::all()->wherenull('deleted_by'); 
        $permissions = Permission::all()->groupBy('name'); 
        
        return view('backend.users.user_permission.create',compact('users', 'permissions'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);
    
        if (UsersPermission::where('user_id', $request->user_id)->exists()) {
            return redirect()->route('user-permissions.index')
                             ->withErrors(['user_id' => 'This user already has permissions assigned.'])
                             ->withInput();
        }
    
        $permissions = array_unique($request->permissions);
    
        DB::beginTransaction();
        try {
            UsersPermission::create([
                'user_id' => $request->user_id,
                'permission_id' => json_encode($permissions), 
            ]);
    
            DB::commit();
    
            return redirect()->route('user-permissions.index')->with('message', 'Permissions saved successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('user-permissions.index')
                             ->withErrors(['error' => 'Failed to save permissions.'])
                             ->withInput();
        }
    }
      

    public function edit($id)
    {

        $user_permission = UsersPermission::find($id);
    
        $permission_ids = is_array($user_permission->permission_id) 
            ? $user_permission->permission_id 
            : json_decode($user_permission->permission_id, true);
    
        $permissions = Permission::all()->groupBy('name');
        $users = User::whereNull('deleted_by')->get();
    
        return view('backend.users.user_permission.edit', compact('user_permission', 'permission_ids', 'users', 'permissions'));
    }
    
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id', 
        ]);

        $user_permission = UsersPermission::findOrFail($id);

        $user_permission->update([
            'user_id' => $request->user_id,
            'permission_id' => $request->permissions, 
            'modified_at' => Carbon::now(),
            'modified_by' => Auth::user()->id,
        ]);

        return redirect()->route('user-permissions.index')->with('message', 'Permissions updated successfully');
    }



public function destroy(string $id)
{

    try {
        $user = UsersPermission::findOrFail($id);
        
        $user->delete();

        return redirect()->route('user-permissions.index')->with('message', 'Permissions successfully deleted');
    } catch (\Exception $ex) {
        return redirect()->back()->with('error', 'Something went wrong - ' . $ex->getMessage());
    }
}

}