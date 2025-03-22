<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Carbon\Carbon;
use App\Models\User;
use App\Models\About;



class AboutController extends Controller
{

    public function index()
    {
        $aboutData = About::whereNull('deleted_by')->get(); 
        return view('backend.about.index', compact('aboutData'));
    }
    

    public function create(Request $request)
    { 
        return view('backend.about.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
        ], [
            'banner_image.required' => 'The Image field is required.',
            'banner_image.image' => 'The file must be an image.',
            'banner_image.mimes' => 'Only .jpg, .jpeg, .png, .webp formats are allowed.',
            'banner_image.max' => 'The file size must be less than 2MB.',
            'description.required' => 'The Description field is required.',
        ]);
    
        try {
            $imagePath = null;
    
            // Handle Image Upload
            if ($request->hasFile('banner_image')) {
                $image = $request->file('banner_image');
                $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/murupp/about'), $imageName);  
            }
    
            About::create([
                'banner_image' => $imageName,
                'description' => $request->description,
                'inserted_by' => Auth::id(),
                'inserted_at' => Carbon::now(),
            ]);
    
            return redirect()->route('about.index')->with('message', 'Details Inserted successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create. Please try again.'])->withInput();
        }
    }
    

    public function edit($id)
    {
        $banner_details = About::findOrFail($id); 
        return view('backend.about.edit', compact('banner_details'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_image' => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
        ], [
            'banner_image.mimes' => 'Only .jpg, .jpeg, .png, .webp formats are allowed.',
            'banner_image.max' => 'The file size must be less than 2MB.',
            'description.required' => 'The Description field is required.',
        ]);

        try {
            $about = About::findOrFail($id);
            $imageName = $about->banner_image;

            if ($request->hasFile('banner_image')) {
                $image = $request->file('banner_image');
                $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/murupp/about'), $imageName);
            }

            $about->update([
                'banner_image' => $imageName,
                'description' => $request->description,
                'modified_by' => Auth::id(),
                'modified_at' => Carbon::now(),
            ]);

            return redirect()->route('about.index')->with('message', 'Details Updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update. Please try again.'])->withInput();
        }
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = About::findOrFail($id);
            $industries->update($data);

            return redirect()->route('about.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}