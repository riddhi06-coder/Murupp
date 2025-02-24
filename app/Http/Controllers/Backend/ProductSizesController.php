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
use App\Models\ProductSizes;


class ProductSizesController extends Controller
{

    public function index()
    {
        $product_sizes = ProductSizes::leftJoin('users', 'master_product_size.created_by', '=', 'users.id')
                                            ->whereNull('master_product_size.deleted_by')
                                            ->select('master_product_size.*', 'users.name as creator_name')
                                            ->get();
        return view('backend.products.product-size.index', compact('product_sizes'));
    }

    public function create(Request $request)
    { 
        return view('backend.products.product-size.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'sizes' => 'required|string|max:255',
            'bust_sizes' => 'required|numeric',
            'waist_sizes' => 'required|numeric',
            'hips_sizes' => 'required|numeric',
        ], [
            'sizes.required' => 'The Product sizes Name field is required.',
            'sizes.string' => 'The Product sizes Name must be a valid string.',
            'sizes.max' => 'The Product sizes Name cannot exceed 255 characters.',
            'bust_sizes.required' => 'The Bust size field is required.',
            'bust_sizes.numeric' => 'The Bust size must be a valid number.',
            'waist_sizes.required' => 'The Waist Size field is required.',
            'waist_sizes.numeric' => 'The Waist Size must be a valid number.',
            'hips_sizes.required' => 'The Hips size field is required.',
            'hips_sizes.numeric' => 'The Hips size must be a valid number.',
        ]);
        
        
        try {
            $slug = Str::slug($request->sizes, '-');

            ProductSizes::create([
                'size' => $request->sizes,
                'bust' => $request->bust_sizes,
                'waist' => $request->waist_sizes,
                'hips' => $request->hips_sizes,
                'slug' => $slug,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('product-sizes.index')->with('message', 'Product sizes created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create the Product sizes. Please try again.'])->withInput();
        }
    }

    public function edit($id)
    {
        $size = ProductSizes::findOrFail($id);

        return view('backend.products.product-size.edit', compact('size'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sizes' => 'required|string|max:255',
            'bust_sizes' => 'required|numeric',
            'waist_sizes' => 'required|numeric',
            'hips_sizes' => 'required|numeric',
        ], [
            'sizes.required' => 'The Product sizes Name field is required.',
            'sizes.string' => 'The Product sizes Name must be a valid string.',
            'sizes.max' => 'The Product sizes Name cannot exceed 255 characters.',
            'bust_sizes.required' => 'The Bust size field is required.',
            'bust_sizes.numeric' => 'The Bust size must be a valid number.',
            'waist_sizes.required' => 'The Waist Size field is required.',
            'waist_sizes.numeric' => 'The Waist Size must be a valid number.',
            'hips_sizes.required' => 'The Hips size field is required.',
            'hips_sizes.numeric' => 'The Hips size must be a valid number.',
        ]);
        
        
        try {
            $category = ProductSizes::findOrFail($id);

            $category->update([
                'size' => $request->sizes,
                'bust' => $request->bust_sizes,
                'waist' => $request->waist_sizes,
                'hips' => $request->hips_sizes,
                'modified_by' => Auth::user()->id, 
                'modified_at' => Carbon::now(),
            ]);

            return redirect()->route('product-sizes.index')->with('message', 'Product sizes updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update the Product sizes. Please try again.'])->withInput();
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ProductSizes::findOrFail($id);
            $industries->update($data);

            return redirect()->route('product-sizes.index')->with('message', 'Product sizes deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
}