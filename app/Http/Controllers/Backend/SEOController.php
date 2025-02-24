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
use App\Models\SeoTag;


class SEOController extends Controller
{

    public function index()
    {
        $seo = SeoTag::whereNull('deleted_by')->get();
        return view('backend.seo.index', compact('seo'));
    }

    public function create(Request $request)
    { 
        return view('backend.seo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_name'        => 'required|string|max:255',
            'page_url'         => 'required|url|max:255',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords'    => 'nullable|string|max:500',
            'meta_author'      => 'nullable|string|max:255',
            'canonical_tag'    => 'nullable|url|max:500',
            'hreflang_tag'     => 'nullable|string|max:255',
        ], [
            'page_name.required'        => 'The Page Name field is required.',
            'page_name.string'          => 'The Page Name must be a valid string.',
            'page_name.max'             => 'The Page Name should not exceed 255 characters.',
        
            'page_url.required'         => 'The Page URL field is required.',
            'page_url.url'              => 'The Page URL must be a valid URL.',
            'page_url.max'              => 'The Page URL should not exceed 255 characters.',
        
            'meta_title.max'            => 'The Meta Title should not exceed 255 characters.',
            'meta_description.max'      => 'The Meta Description should not exceed 500 characters.',
            'meta_keywords.max'         => 'The Meta Keywords should not exceed 500 characters.',
            'meta_author.max'           => 'The Meta Author should not exceed 255 characters.',
            
            'canonical_tag.url'         => 'The Canonical Tag must be a valid URL.',
            'canonical_tag.max'         => 'The Canonical Tag should not exceed 500 characters.',
        
            'hreflang_tag.max'          => 'The Hreflang Tag should not exceed 255 characters.',
        ]);
        

        SeoTag::create([
            'page_name'        => $request->page_name,
            'page_url'         => $request->page_url,
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords'    => $request->meta_keywords,
            'meta_author'      => $request->meta_author,
            'canonical_tag'    => $request->canonical_tag,
            'hreflang_tag'     => $request->hreflang_tag,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        
        return redirect()->route('seo-tags.index')->with('message', 'SEO Tag added successfully.');
    }

    public function edit($id)
    {
        $seoTag = SeoTag::findOrFail($id);

        return view('backend.seo.edit', compact('seoTag'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'page_name'        => 'required|string|max:255',
            'page_url'         => 'required|url|max:255',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords'    => 'nullable|string|max:500',
            'meta_author'      => 'nullable|string|max:255',
            'canonical_tag'    => 'nullable|string|max:500',
            'hreflang_tag'     => 'nullable|string|max:255',
        ], [
            'page_name.required'  => 'Page Name is required.',
            'page_url.required'   => 'Page URL is required.',
            'page_url.url'        => 'Please enter a valid URL format.',
        ]);

        $seoTag = SeoTag::findOrFail($id);
        $seoTag->update([
            'page_name'        => $request->page_name,
            'page_url'         => $request->page_url,
            'meta_title'       => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords'    => $request->meta_keywords,
            'meta_author'      => $request->meta_author,
            'canonical_tag'    => $request->canonical_tag,
            'hreflang_tag'     => $request->hreflang_tag,
        ]);

        return redirect()->route('seo-tags.index')->with('message', 'SEO Tag updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = SeoTag::findOrFail($id);
            $industries->update($data);

            return redirect()->route('seo-tags.index')->with('message', 'SEO Tag deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}