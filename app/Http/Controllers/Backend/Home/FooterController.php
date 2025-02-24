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
use App\Models\Footer;


class FooterController extends Controller
{

    public function index()
    {
        $footer = Footer::leftJoin('users', 'footer_details.created_by', '=', 'users.id')
                            ->whereNull('footer_details.deleted_by')
                            ->select('footer_details.*', 'users.name as creator_name')
                            ->get();
        return view('backend.home-page.footer.index', compact('footer'));
    }

    public function create(Request $request)
    { 
        return view('backend.home-page.footer.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'url' => 'required|url',
            'contact_number' => 'required|regex:/^\+?[0-9]{1,4}?[-. ]?(\(?\d{1,3}?\)?[-. ]?)?[\d]{1,4}[-. ]?[\d]{1,4}[-. ]?[\d]{1,9}$/',
            'about' => 'required|string',
            'social_media' => 'required|array',
            'social_media.*.platform' => 'required|integer', 
            'social_media.*.link' => 'required|url',
        ], [
            'email.required' => 'Please enter an Email.',
            'url.required' => 'Please enter a Gmap URL.',
            'contact_number.required' => 'Please enter a valid Contact Number.',
            'about.required' => 'Please enter About Us information.',
            'social_media.required' => 'Please provide at least one social media link.',
        ]);

        $socialMediaData = [];
        foreach ($request->social_media as $social) {
            $socialMediaData[] = [
                'media_platform' => $social['platform'],
                'media_link' => $social['link'],         
            ];
        }

       $footer = new Footer();
       $footer->email = $request->email;
       $footer->map_url = $request->url;
       $footer->contact_number = $request->contact_number;
       $footer->about = $request->about;
       $footer->media_platform = json_encode(array_column($socialMediaData, 'media_platform')); 
       $footer->media_link = json_encode(array_column($socialMediaData, 'media_link'));        
       $footer->created_at = Carbon::now();
       $footer->created_by = Auth::user()->id; 
       $footer->save();
   
        return redirect()->route('footer.index')->with('message', 'Footer information added successfully.');
    }


    public function edit($id)
    {
        $footer = Footer::findOrFail($id);
        return view('backend.home-page.footer.edit', compact('footer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'url' => 'required|url',
            'contact_number' => 'required|regex:/^\+?[0-9]{1,4}?[-. ]?(\(?\d{1,3}?\)?[-. ]?)?[\d]{1,4}[-. ]?[\d]{1,4}[-. ]?[\d]{1,9}$/',
            'about' => 'required|string',
            'social_media' => 'required|array',
            'social_media.*.platform' => 'required|integer', 
            'social_media.*.link' => 'required|url',
        ], [
            'email.required' => 'Please enter an Email.',
            'url.required' => 'Please enter a Gmap URL.',
            'contact_number.required' => 'Please enter a valid Contact Number.',
            'about.required' => 'Please enter About Us information.',
            'social_media.required' => 'Please provide at least one social media link.',
        ]);

        $socialMediaData = [];
        foreach ($request->social_media as $social) {
            $socialMediaData[] = [
                'media_platform' => $social['platform'],
                'media_link' => $social['link'],
            ];
        }

        $footer = Footer::findOrFail($id);
        $footer->email = $request->email;
        $footer->map_url = $request->url;
        $footer->contact_number = $request->contact_number;
        $footer->about = $request->about;
        $footer->media_platform = json_encode(array_column($socialMediaData, 'media_platform')); 
        $footer->media_link = json_encode(array_column($socialMediaData, 'media_link'));
        $footer->modified_at = Carbon::now();
        $footer->modified_by = Auth::user()->id; 
        $footer->save();

        return redirect()->route('footer.index')->with('message', 'Footer information updated successfully.');
    }

    
    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Footer::findOrFail($id);
            $industries->update($data);

            return redirect()->route('footer.index')->with('message', 'Footer deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
        

}