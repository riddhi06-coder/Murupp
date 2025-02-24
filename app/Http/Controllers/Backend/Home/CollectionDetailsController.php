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
use App\Models\CollectionDetail;


class CollectionDetailsController extends Controller
{

    public function index()
    {
        $collection = CollectionDetail::leftJoin('users', 'home_collection_details.created_by', '=', 'users.id')
                                    ->whereNull('home_collection_details.deleted_by')
                                    ->select('home_collection_details.*', 'users.name as creator_name')
                                    ->get();
        return view('backend.home-page.collection-details.index', compact('collection'));
    }

    public function create(Request $request)
    { 
        return view('backend.home-page.collection-details.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'product_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
        ], [
            'heading.required' => 'The heading is required.',
            'description.required' => 'The description is required.',
            'product_image.required' => 'The image is required.',
            'product_image.image' => 'The file must be a valid image.',
            'product_image.mimes' => 'Only .jpg, .jpeg, .png, .webp formats are allowed.',
            'product_image.max' => 'The image size must not exceed 3MB.',
        ]);

        $imageName = null;
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/murupp/home/collection-details'), $imageName); 
        }

        $collectionDetail = new CollectionDetail();
        $collectionDetail->heading = $request->input('heading');
        $collectionDetail->description = $request->input('description'); 
        $collectionDetail->image = $imageName;
        $collectionDetail->created_at = Carbon::now();
        $collectionDetail->created_by = Auth::user()->id; 
        $collectionDetail->save();

        return redirect()->route('collection-details.index')->with('message', 'Collection successfully added!');
    }

    public function edit($id)
    {
        $collection = CollectionDetail::findOrFail($id);
        return view('backend.home-page.collection-details.edit', compact('collection'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ], [
            'heading.required' => 'The heading is required.',
            'description.required' => 'The description is required.',
            'product_image.image' => 'The file must be a valid image.',
            'product_image.mimes' => 'Only .jpg, .jpeg, .png, .webp formats are allowed.',
            'product_image.max' => 'The image size must not exceed 3MB.',
        ]);

        $collectionDetail = CollectionDetail::findOrFail($id);

        $imageName = $collectionDetail->image; 
        if ($request->hasFile('product_image')) {
        
            $image = $request->file('product_image');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/murupp/home/collection-details'), $imageName);
        }

        $collectionDetail->heading = $request->input('heading');
        $collectionDetail->description = $request->input('description');
        $collectionDetail->image = $imageName;
        $collectionDetail->modified_at = Carbon::now();
        $collectionDetail->modified_by = Auth::user()->id; 
        $collectionDetail->save();

        return redirect()->route('collection-details.index')->with('message', 'Collection successfully updated!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = CollectionDetail::findOrFail($id);
            $industries->update($data);

            return redirect()->route('collection-details.index')->with('message', 'Collection deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}