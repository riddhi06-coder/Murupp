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
use App\Models\ProductCategory;


class ProductCategoryController extends Controller
{

    public function index()
    {
        $product_category = ProductCategory::leftJoin('users', 'master_product_category.created_by', '=', 'users.id')
                                        ->whereNull('master_product_category.deleted_by')
                                        ->select('master_product_category.*', 'users.name as creator_name')
                                        ->get();
        return view('backend.products.product-category.index', compact('product_category'));
    }

    public function create(Request $request)
    { 
        return view('backend.products.product-category.create');
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'category_name' => 'required|string|max:255',
        ], [
            'category_name.required' => 'The Product Category Name field is required.',
            'category_name.string' => 'The Product Category Name must be a valid string.',
            'category_name.max' => 'The Product Category Name cannot exceed 255 characters.',
        ]);
        
        try {
            $slug = Str::slug($request->category_name, '-');

            ProductCategory::create([
                'category_name' => $request->category_name,
                'slug' => $slug,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('product-category.index')->with('message', 'Product Category created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create the Product Category. Please try again.'])->withInput();
        }
    }

    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);

        return view('backend.products.product-category.edit', compact('category'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ], [
            'category_name.required' => 'The Product Category Name field is required.',
            'category_name.string' => 'The Product Category Name must be a valid string.',
            'category_name.max' => 'The Product Category Name cannot exceed 255 characters.',
        ]);

        try {
            $category = ProductCategory::findOrFail($id);

            $category->update([
                'category_name' => $request->category_name,
                'modified_by' => Auth::user()->id, 
                'modified_at' => Carbon::now(),
            ]);

            return redirect()->route('product-category.index')->with('message', 'Product Category updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update the Product Category. Please try again.'])->withInput();
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ProductCategory::findOrFail($id);
            $industries->update($data);

            return redirect()->route('product-category.index')->with('message', 'Product Category deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}