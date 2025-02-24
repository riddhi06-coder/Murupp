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
use App\Models\NewArrival;


class NewArrivalsController extends Controller
{

    public function index()
    {
        $new_arrivals = NewArrival::leftJoin('users', 'new_arrivals.created_by', '=', 'users.id')
            ->leftJoin('product_details', 'product_details.id', '=', 'new_arrivals.product_name') // Match with product ID
            ->whereNull('new_arrivals.deleted_by')
            ->select('new_arrivals.*', 'users.name as creator_name', 'product_details.product_name as product_name')
            ->get();
    
        return view('backend.home-page.new-arrivals.index', compact('new_arrivals'));
    }
    

    public function create(Request $request)
    { 
        $products = DB::table('product_details')
                      ->whereNull('deleted_by')
                      ->get();
    
        return view('backend.home-page.new-arrivals.create', compact('products'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'section_heading' => 'nullable|string|max:255',
            'product_name' => 'required|exists:product_details,id',
            'product_price' => 'required|string',
            'product_size' => 'nullable|string|max:255',
            'product_image' => 'required|image|max:3072', 
        ], [
            'product_name.required' => 'The product name is required.',
            'product_name.exists' => 'The selected product is invalid.',
            'product_price.required' => 'The product price is required.',
            'product_image.required' => 'The product image is required.',
            'product_image.image' => 'The product image must be a valid image file.',
            'product_image.max' => 'The product image must not exceed 3MB in size.',
        ]);

        $imageName = null;
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/murupp/home/new-arrivals'), $imageName); 
        }

        $product = new NewArrival();
        $product->section_heading = $request->input('section_heading');
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_size = $request->input('product_size');
        $product->product_image = $imageName;
        $product->created_at = Carbon::now();
        $product->created_by = Auth::user()->id; 
        $product->save();

        return redirect()->route('new-arrivals.index')->with('message', 'Product has been successfully added!');
    }

    public function edit($id)
    {
        $new_arrival = NewArrival::findOrFail($id);
        $products = DB::table('product_details')
                      ->whereNull('deleted_by')
                      ->orderBy('product_name', 'asc')
                      ->get();
    
        return view('backend.home-page.new-arrivals.edit', compact('new_arrival', 'products'));
    }
    


    public function update(Request $request, $id)
    {
        $request->validate([
            'section_heading' => 'nullable|string|max:255',
            'product_name' => 'required|exists:product_details,id',
            'product_price' => 'required|string',
            'product_size' => 'nullable|string|max:255',
            'product_image' => 'nullable|image|max:3072', 
        ], [
            'product_name.required' => 'The product name is required.',
            'product_name.exists' => 'The selected product is invalid.',
            'product_price.required' => 'The product price is required.',
            'product_image.image' => 'The product image must be a valid image file.',
            'product_image.max' => 'The product image must not exceed 3MB in size.',
        ]);

        $product = NewArrival::findOrFail($id);

        if ($request->hasFile('product_image')) {

            $image = $request->file('product_image');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/murupp/home/new-arrivals'), $imageName);
            $product->product_image = $imageName;
        }

        $product->section_heading = $request->input('section_heading');
        $product->product_name = $request->input('product_name');
        $product->product_price = $request->input('product_price');
        $product->product_size = $request->input('product_size');
        $product->modified_at = Carbon::now();
        $product->modified_by = Auth::user()->id; 
        $product->save();

        return redirect()->route('new-arrivals.index')->with('message', 'Product has been successfully updated!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = NewArrival::findOrFail($id);
            $industries->update($data);

            return redirect()->route('new-arrivals.index')->with('message', 'New Arrivals deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}