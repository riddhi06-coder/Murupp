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
use App\Models\ProductPrints;


class ProductPrintsController extends Controller
{

    public function index()
    {
        $product_prints = ProductPrints::leftJoin('users', 'master_product_print.created_by', '=', 'users.id')
                                            ->whereNull('master_product_print.deleted_by')
                                            ->select('master_product_print.*', 'users.name as creator_name')
                                            ->get();
        return view('backend.products.product-print.index', compact('product_prints'));
    }

    public function create(Request $request)
    { 
        return view('backend.products.product-print.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'print_name' => 'required|string|max:255',
        ], [
            'print_name.required' => 'The Product Prints Name field is required.',
            'print_name.string' => 'The Product Prints Name must be a valid string.',
            'print_name.max' => 'The Product Prints Name cannot exceed 255 characters.',
        ]);
        
        try {
            $slug = Str::slug($request->print_name, '-');

            ProductPrints::create([
                'print_name' => $request->print_name,
                'slug' => $slug,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('product-prints.index')->with('message', 'Product Prints created successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create the Product Prints. Please try again.'])->withInput();
        }
    }

    public function edit($id)
    {
        $prints = ProductPrints::findOrFail($id);

        return view('backend.products.product-print.edit', compact('prints'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'print_name' => 'required|string|max:255',
        ], [
            'print_name.required' => 'The Product Prints Name field is required.',
            'print_name.string' => 'The Product Prints Name must be a valid string.',
            'print_name.max' => 'The Product Prints Name cannot exceed 255 characters.',
        ]);
        

        try {
            $category = ProductPrints::findOrFail($id);

            $category->update([
                'print_name' => $request->print_name,
                'modified_by' => Auth::user()->id, 
                'modified_at' => Carbon::now(),
            ]);

            return redirect()->route('product-prints.index')->with('message', 'Product prints updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update the Product prints. Please try again.'])->withInput();
        }
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ProductPrints::findOrFail($id);
            $industries->update($data);

            return redirect()->route('product-prints.index')->with('message', 'Product prints deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}