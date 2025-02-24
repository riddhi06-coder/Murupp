<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Permission;
use App\Models\UsersPermission;
use App\Models\CoordsDetails;


class CoordsController extends Controller
{

    public function index()
    {
        $coords = CoordsDetails::whereNull('deleted_by')->get();
        return view('backend.category-page.coords.index', compact('coords'));
    }

    public function create(Request $request)
    { 
        return view('backend.category-page.coords.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'required|max:2048',  
        ], [
            'banner_heading.required' => 'The banner heading is required.',
            'banner_image.required' => 'The banner image is required.',
            'banner_image.max' => 'The banner image must not be greater than 2MB.',
        ]);
    
        $imageName = null;
    
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/murupp/category/coords'), $imageName);  
        }
    
        $banner = new CoordsDetails();
        $banner->banner_heading = $request->input('banner_heading');
        $banner->banner_image = $imageName;  
        $banner->created_at = Carbon::now(); 
        $banner->created_by = Auth::user()->id;
        $banner->save();  
    
        return redirect()->route('co-ords.index')->with('message', 'Details has been successfully added!');
    }

    public function edit($id)
    {
        $coords_details = CoordsDetails::findOrFail($id);
        return view('backend.category-page.coords.edit', compact('coords_details'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'nullable|max:2048',  
        ], [
            'banner_heading.required' => 'The banner heading is required.',
            'banner_image.max' => 'The banner image must not be greater than 2MB.',
        ]);

        $banner = CoordsDetails::findOrFail($id);

        $imageName = $banner->banner_image;  

        if ($request->hasFile('banner_image')) {

            $image = $request->file('banner_image');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/murupp/category/coords'), $imageName);  
        }

        $banner->banner_heading = $request->input('banner_heading');
        $banner->banner_image = $imageName;
        $banner->modified_at = Carbon::now();  
        $banner->modified_by = Auth::user()->id;  
        $banner->save();  

        return redirect()->route('co-ords.index')->with('message', 'Details have been successfully updated!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = CoordsDetails::findOrFail($id);
            $industries->update($data);

            return redirect()->route('co-ords.index')->with('message', 'Details Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
}