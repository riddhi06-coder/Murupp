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
use App\Models\ProductPolicy;


class ProductPoliciesController extends Controller
{

    public function index()
    {
        $policy = ProductPolicy::leftJoin('users', 'product_policies.created_by', '=', 'users.id')
                                ->whereNull('product_policies.deleted_by')
                                ->select('product_policies.*', 'users.name as creator_name')
                                ->get();
        return view('backend.home-page.product-policies.index', compact('policy'));
    }

    public function create(Request $request)
    { 
        return view('backend.home-page.product-policies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'nullable|string|max:255',
            'image_title' => 'required|string|max:255',
            'product_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
        ], [
            'image_title.required' => 'The image title is required.',
            'product_image.required' => 'The image is required.',
            'product_image.image' => 'The file must be a valid image.',
            'product_image.mimes' => 'Only .jpg, .jpeg, .png, .webp formats are allowed.',
            'product_image.max' => 'The image size must not exceed 3MB.',
        ]);

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/murupp/home/product-policies'), $imageName); 
        }

        ProductPolicy::create([
            'heading' => $request->heading,
            'description' => $request->image_title,
            'policy_image' => $imageName, 
            'created_at' => Carbon::now(),
            'created_by' => Auth::user()->id, 
        ]);

        return redirect()->route('product-policies.index')->with('message', 'Policy added successfully.');
    }

    public function edit($id)
    {
        $policy = ProductPolicy::findOrFail($id);
        return view('backend.home-page.product-policies.edit', compact('policy'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'heading' => 'nullable|string|max:255',
            'image_title' => 'required|string|max:255',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ], [
            'image_title.required' => 'The image title is required.',
            'product_image.image' => 'The file must be a valid image.',
            'product_image.mimes' => 'Only .jpg, .jpeg, .png, .webp formats are allowed.',
            'product_image.max' => 'The image size must not exceed 3MB.',
        ]);

        $productPolicy = ProductPolicy::findOrFail($id);

        // If a new image is uploaded
        if ($request->hasFile('product_image')) {

            $image = $request->file('product_image');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/murupp/home/product-policies'), $imageName);

            $productPolicy->policy_image = $imageName;
        }

        $productPolicy->heading = $request->heading;
        $productPolicy->description = $request->image_title;
        $productPolicy->modified_at = Carbon::now();
        $productPolicy->modified_by = Auth::user()->id; 
        
        $productPolicy->save();

        return redirect()->route('product-policies.index')->with('message', 'Policy updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ProductPolicy::findOrFail($id);
            $industries->update($data);

            return redirect()->route('product-policies.index')->with('message', 'Policies deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}