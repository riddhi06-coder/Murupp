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
use App\Models\ProductFabrics;


class ProductFabricsController extends Controller
{

    public function index()
    {
        $product_fabrics = ProductFabrics::leftJoin('users', 'master_product_fabrics.created_by', '=', 'users.id')
                                            ->whereNull('master_product_fabrics.deleted_by')
                                            ->select('master_product_fabrics.*', 'users.name as creator_name')
                                            ->get();
        return view('backend.products.product-fabrics.index', compact('product_fabrics'));
    }

    public function create(Request $request)
    { 
        return view('backend.products.product-fabrics.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'fabrics_name' => 'required|string|max:255',
        ], [
            'fabrics_name.required' => 'The Product Fabrics Name field is required.',
            'fabrics_name.string' => 'The Product Fabrics Name must be a valid string.',
            'fabrics_name.max' => 'The Product Fabrics Name cannot exceed 255 characters.',
        ]);
        
        try {
            $slug = Str::slug($request->fabrics_name, '-');

            ProductFabrics::create([
                'fabrics_name' => $request->fabrics_name,
                'slug' => $slug,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('product-fabrics.index')->with('message', 'Product Fabrics created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create the Product Fabrics. Please try again.'])->withInput();
        }
    }

    public function edit($id)
    {
        $fabrics = ProductFabrics::findOrFail($id);

        return view('backend.products.product-fabrics.edit', compact('fabrics'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fabrics_name' => 'required|string|max:255',
        ], [
            'fabrics_name.required' => 'The Product Fabrics Name field is required.',
            'fabrics_name.string' => 'The Product Fabrics Name must be a valid string.',
            'fabrics_name.max' => 'The Product Fabrics Name cannot exceed 255 characters.',
        ]);
        

        try {
            $category = ProductFabrics::findOrFail($id);

            $category->update([
                'fabrics_name' => $request->fabrics_name,
                'modified_by' => Auth::user()->id, 
                'modified_at' => Carbon::now(),
            ]);

            return redirect()->route('product-fabrics.index')->with('message', 'Product fabrics updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update the Product fabrics. Please try again.'])->withInput();
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ProductFabrics::findOrFail($id);
            $industries->update($data);

            return redirect()->route('product-fabrics.index')->with('message', 'Product fabrics deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}