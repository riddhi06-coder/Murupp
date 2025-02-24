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
use App\Models\Testimonial;


class TestimonialsController extends Controller
{

    public function index()
    {
        $testimonials = Testimonial::leftJoin('users', 'testimonials.created_by', '=', 'users.id')
                                    ->whereNull('testimonials.deleted_by')
                                    ->select('testimonials.*', 'users.name as creator_name')
                                    ->get();


        $section_details = Testimonial::whereNull('testimonials.deleted_by')  
                                    ->whereNotNull('testimonials.section_heading') 
                                    ->select('testimonials.section_heading', 'testimonials.section_title')
                                    ->get();
                                
                                    

        return view('backend.home-page.testimonials.index', compact('testimonials','section_details'));
    }

    public function create(Request $request)
    { 
        return view('backend.home-page.testimonials.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'section_heading' => 'nullable|string|max:255',
            'section_title' => 'nullable|string|max:255',
            'heading' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'star_rating' => 'required|integer|between:1,5',  
            'reviewer' => 'required|string|max:255',
        ], [
            'heading.required' => 'Please enter a Testimonials Heading.',
            'description.required' => 'Please enter a Testimonials Description.',
            'star_rating.required' => 'Please select a star rating.',
            'reviewer.required' => 'Please enter a Reviewer.',
        ]);

        $testimonial = new Testimonial();
        $testimonial->section_heading = $request->section_heading;
        $testimonial->section_title = $request->section_title;
        $testimonial->heading = $request->heading;
        $testimonial->description = $request->description;
        $testimonial->star_rating = $request->star_rating;
        $testimonial->reviewer = $request->reviewer;
        $testimonial->created_at = Carbon::now();
        $testimonial->created_by = Auth::user()->id; 

        $testimonial->save();

        return redirect()->route('testimonials.index')->with('message', 'Testimonial added successfully.');
    }

    public function edit($id)
    {
        $testimonials = Testimonial::findOrFail($id);
        return view('backend.home-page.testimonials.edit', compact('testimonials'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'section_heading' => 'nullable|string|max:255',
            'section_title' => 'nullable|string|max:255',
            'heading' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'star_rating' => 'required|integer|between:1,5',  
            'reviewer' => 'required|string|max:255',
        ], [
            'heading.required' => 'Please enter a Testimonials Heading.',
            'description.required' => 'Please enter a Testimonials Description.',
            'star_rating.required' => 'Please select a star rating.',
            'reviewer.required' => 'Please enter a Reviewer.',
        ]);

        $testimonial = Testimonial::findOrFail($id);

        $testimonial->section_heading = $request->section_heading;
        $testimonial->section_title = $request->section_title;
        $testimonial->heading = $request->heading;
        $testimonial->description = $request->description;
        $testimonial->star_rating = $request->star_rating;
        $testimonial->reviewer = $request->reviewer;
        $testimonial->modified_at = Carbon::now();
        $testimonial->modified_by = Auth::user()->id; 

        $testimonial->save();

        return redirect()->route('testimonials.index')->with('message', 'Testimonial updated successfully.');
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Testimonial::findOrFail($id);
            $industries->update($data);

            return redirect()->route('testimonials.index')->with('message', 'Testimonials deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}