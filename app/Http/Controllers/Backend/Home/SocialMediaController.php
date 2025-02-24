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
use App\Models\SocialMedia;


class SocialMediaController extends Controller
{

    public function index()
    {
        $social = SocialMedia::leftJoin('users', 'social_media.created_by', '=', 'users.id')
                                    ->whereNull('social_media.deleted_by')
                                    ->select('social_media.*', 'users.name as creator_name')
                                    ->get();
        return view('backend.home-page.social-media.index', compact('social'));
    }

    public function create(Request $request)
    { 
        return view('backend.home-page.social-media.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'section_heading' => 'required|string|max:255',
            'section_title' => 'required|string|max:255',
        ], [
            'section_heading.required' => 'Please enter a Section Heading.',
            'section_title.required' => 'Please enter a Section Title.',
        ]);

        $socialMedia = new SocialMedia();
        $socialMedia->section_heading = $request->section_heading;
        $socialMedia->section_title = $request->section_title;
        $socialMedia->created_at = Carbon::now();
        $socialMedia->created_by = Auth::user()->id; 

        $socialMedia->save();

        return redirect()->route('social-media.index')->with('message', 'Social Media added successfully.');
    }


    public function edit($id)
    {
        $social = SocialMedia::findOrFail($id);
        return view('backend.home-page.social-media.edit', compact('social'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'section_heading' => 'required|string|max:255',
            'section_title' => 'required|string|max:255',
        ], [
            'section_heading.required' => 'Please enter a Section Heading.',
            'section_title.required' => 'Please enter a Section Title.',
        ]);

        $socialMedia = SocialMedia::findOrFail($id);

        $socialMedia->section_heading = $request->section_heading;
        $socialMedia->section_title = $request->section_title;
        $socialMedia->modified_at = Carbon::now();
        $socialMedia->modified_by = Auth::user()->id;

        $socialMedia->save();

        return redirect()->route('social-media.index')->with('message', 'Social Media updated successfully.');
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = SocialMedia::findOrFail($id);
            $industries->update($data);

            return redirect()->route('social-media.index')->with('message', 'Social Media deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}