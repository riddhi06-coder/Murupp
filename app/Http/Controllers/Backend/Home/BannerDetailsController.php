<?php

namespace App\Http\Controllers\Backend\Home;

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
use App\Models\BannerDetails;


class BannerDetailsController extends Controller
{

    public function index()
    {
        $banner_details = BannerDetails::leftJoin('users', 'banner_details.created_by', '=', 'users.id')
                                            ->whereNull('banner_details.deleted_by')
                                            ->select('banner_details.*', 'users.name as creator_name')
                                            ->get();
        return view('backend.home-page.banner-details.index', compact('banner_details'));
    }

    public function create(Request $request)
    { 
        return view('backend.home-page.banner-details.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'banner_heading' => 'required|string|max:255',
            'banner_title' => 'required|string|max:255',
            'banner_image' => 'required|max:3072',  
        ], [
            'banner_heading.required' => 'The banner heading is required.',
            'banner_title.required' => 'The banner title is required.',
            'banner_image.required' => 'The banner image is required.',
            'banner_image.max' => 'The banner image must not be greater than 3MB.',
        ]);
    
        $imageName = null;
    
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/murupp/home/banner'), $imageName);  
        }
    
        $banner = new BannerDetails();
        $banner->banner_heading = $request->input('banner_heading');
        $banner->banner_title = $request->input('banner_title');
        $banner->banner_images = $imageName;  
        $banner->created_at = Carbon::now(); 
        $banner->created_by = Auth::user()->id;
        $banner->save();  
    
        return redirect()->route('banner-details.index')->with('message', 'Banner has been successfully added!');
    }

    public function edit($id)
    {
        $banner_details = BannerDetails::findOrFail($id);
        return view('backend.home-page.banner-details.edit', compact('banner_details'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_heading' => 'required|string|max:255',
            'banner_title' => 'required|string|max:255',
            'banner_image' => 'nullable|max:3072',  
        ], [
            'banner_heading.required' => 'The banner heading is required.',
            'banner_title.required' => 'The banner title is required.',
            'banner_image.max' => 'The banner image must not be greater than 3MB.',
        ]);

        $banner = BannerDetails::findOrFail($id);  

        $imageName = $banner->banner_images;  
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/murupp/home/banner'), $imageName);
        }

        $banner->banner_heading = $request->input('banner_heading');
        $banner->banner_title = $request->input('banner_title');
        $banner->banner_images = $imageName;  
        $banner->modified_at = Carbon::now();
        $banner->modified_by = Auth::user()->id; 
        $banner->save();

        return redirect()->route('banner-details.index')->with('message', 'Banner has been successfully updated!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = BannerDetails::findOrFail($id);
            $industries->update($data);

            return redirect()->route('banner-details.index')->with('message', 'Banner Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

    

}