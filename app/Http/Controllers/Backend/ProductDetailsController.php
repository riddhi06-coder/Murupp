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
use App\Models\ProductDetails;
use App\Models\ProductCategory;
use App\Models\FabricsComposition;
use App\Models\ProductFabrics;
use App\Models\MasterCollections;
use App\Models\ProductSizes;
use App\Models\ProductPrints;


class ProductDetailsController extends Controller
{

    public function index()
    {
        $productDetails = ProductDetails::leftJoin('users', 'product_details.created_by', '=', 'users.id')
                                ->leftJoin('master_collections', 'product_details.collection_id', '=', 'master_collections.id')
                                ->whereNull('product_details.deleted_by')
                                ->select(
                                    'product_details.*', 
                                    'users.name as creator_name', 
                                    'master_collections.collection_name'
                                )
                                ->get();
                                // dd($productDetails);
        return view('backend.products.product-details.index', compact('productDetails'));
    }

    public function create(Request $request)
    { 
        $categories = ProductCategory::whereNull('deleted_by')->get();
        $fabric_composition = FabricsComposition::whereNull('deleted_by')->get();
        $product_fabric = ProductFabrics::whereNull('deleted_by')->get();
        $collections = MasterCollections::whereNull('deleted_by')->get();
        $product_sizes = ProductSizes::whereNull('deleted_at')->pluck('size', 'id');
        $product_prints = ProductPrints::whereNull('deleted_by')->pluck('print_name', 'id'); 
        return view('backend.products.product-details.create', compact('categories','fabric_composition','product_fabric','collections','product_sizes','product_prints'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'style_code' => 'required|string|max:255',
            'look_name' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'collection_name' => 'required|exists:master_collections,id',
            'product_category' => 'required|exists:master_product_category,id',
            'fabric_composition' => 'required|exists:master_fabrics_composition,id',
            'product_fabric' => 'required|exists:master_product_fabrics,id',
            'product_price' => 'required|string|min:0',
            'description' => 'required',
            'shipping' => 'required',
            'return' => 'required',
            'product_size' => 'required',
            'colors' => 'nullable',
            'thumbnail_image' => 'required|array',
            'thumbnail_image.*' => 'max:2048', 
            'gallery_image' => 'nullable|array',
            'gallery_image.*' => 'max:2048',
            'print_name' => 'nullable|array', 
            'print_name.*' => 'exists:master_product_print,id',
            'print_image.*' => 'nullable|image|max:2048', 
        ], [
            'style_code.required' => 'The product style code is required.',
            'look_name.required' => 'The full look name is required.',
            'product_name.required' => 'The product name is required.',
            'collection_name.required' => 'The collection name is required.',
            'product_category.required' => 'The product category is required.',
            'fabric_composition.required' => 'The fabric composition is required.',
            'product_fabric.required' => 'The product fabric is required.',
            'product_price.required' => 'The product price is required.',
            'description.required' => 'The product description is required.',
            'shipping.required' => 'The product Shipping details is required.',
            'return.required' => 'The product return details is required.',
            'product_size.required' => 'The product Size is required.',
            'thumbnail_image.required' => 'Please upload at least one thumbnail image.',
            'thumbnail_image.array' => 'The thumbnail image must be an array.',
            'thumbnail_image.*.max' => 'Each thumbnail image must be less than 2MB.',
            'gallery_image.*.max' => 'Each gallery image must be less than 2MB.',
            'print_image.*.max' => 'Each print image must be less than 2MB.',
            'print_name.*.exists' => 'Selected print name is invalid.',
        ]);

        $slug = Str::slug($request->product_name, '-');
        $product = new ProductDetails();

        $colors = $request->colors ?? [];

        $product->style_code = $request->style_code;
        $product->look_name = $request->look_name;
        $product->product_name = $request->product_name;
        $product->category_id = $request->product_category;
        $product->fabric_composition_id = $request->fabric_composition;
        $product->collection_id = $request->collection_name;
        $product->product_fabric_id = $request->product_fabric;
        $product->product_price = $request->product_price;
        $product->description = $request->description;
        $product->shipping = $request->shipping;
        $product->return = $request->return;
        $product->sizes = json_encode($request->product_size);
        $product->colors = json_encode($colors);
        $product->print_name = json_encode($request->print_name);
        $product->slug = $slug;
        $product->created_at = Carbon::now();
        $product->created_by = Auth::user()->id;
    
        // Handle thumbnail image upload
        if ($request->hasFile('thumbnail_image')) {
            $thumbnails = [];
            foreach ($request->file('thumbnail_image') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $new_name = time() . rand(10, 999) . '.' . $extension;
                    $image->move(public_path('/murupp/product/thumbnails'), $new_name);
                    $image_path = "/murupp/product/thumbnails/" . $new_name;
                    $thumbnails[] = $new_name; 
                }
            }
            $product->thumbnail_image = json_encode($thumbnails); 
        }
    
        // Handle gallery image upload
        if ($request->hasFile('gallery_image')) {
            $galleryImages = [];
            foreach ($request->file('gallery_image') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $new_name = time() . rand(10, 999) . '.' . $extension;
                    $image->move(public_path('/murupp/product/gallery'), $new_name);
                    $image_path = "/murupp/product/gallery/" . $new_name;
                    $galleryImages[] = $new_name; 
                }
            }
            $product->gallery_images = json_encode($galleryImages); 
        }
    
        // Handle product print image upload
        if ($request->hasFile('print_image')) {
            $prints = [];
            foreach ($request->file('print_image') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $new_name = time() . rand(10, 999) . '.' . $extension;
                    $image->move(public_path('/murupp/product/prints'), $new_name);
                    $image_path = "/murupp/product/prints/" . $new_name;
                    $prints[] = $new_name; 
                }
            }
            $product->product_prints = json_encode($prints); 
        }
    

        $product->save();

        return redirect()->route('product-details.index')->with('message', 'Product has been successfully added!');
    }
    

    public function edit($id)
    {
        $product_details = ProductDetails::findOrFail($id);
        $categories = ProductCategory::whereNull('deleted_by')->get();
        $fabric_composition = FabricsComposition::whereNull('deleted_by')->get();
        $product_fabric = ProductFabrics::whereNull('deleted_by')->get();
        $collections = MasterCollections::whereNull('deleted_by')->get();
        $product_sizes = ProductSizes::whereNull('deleted_at')->pluck('size', 'id');
        $selected_sizes = json_decode($product_details->sizes, true) ?? [];
        $selectedColors = json_decode($product_details->colors, true); 
        // dd($selectedColors);

         // Decode print_name field from product_details
        $selectedprintname = json_decode($product_details->print_name, true) ?? [];

        $masterPrints = DB::table('master_product_print')
                        ->whereNull('deleted_by')
                        ->pluck('print_name', 'id');
    
        

        // dd($selectedPrintDetails);
        return view('backend.products.product-details.edit', compact('product_details','categories','fabric_composition','product_fabric','collections','product_sizes','selected_sizes','selectedColors','masterPrints'));
    }


    

    public function update(Request $request, $id)
    {
        $request->validate([
            'style_code' => 'required|string|max:255',
            'look_name' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'collection_name' => 'required|exists:master_collections,id',
            'product_category' => 'required|exists:master_product_category,id',
            'fabric_composition' => 'required|exists:master_fabrics_composition,id',
            'product_fabric' => 'required|exists:master_product_fabrics,id',
            'product_price' => 'required|string|min:0',
            'description' => 'required',
            'product_size' => 'required',
            'shipping' => 'required',
            'return' => 'required',
            'colors' => 'nullable',
            'thumbnail_image' => 'nullable|array',
            'thumbnail_image.*' => 'max:2048',
            'gallery_image' => 'nullable|array',
            'gallery_image.*' => 'max:2048',
            'print_image.*' => 'nullable|image|max:2048', 
            'print_name' => 'nullable|array', 
            'print_name.*' => 'exists:master_product_print,id',
            'print_image.*' => 'nullable|image|max:2048', 
        ], [
            'style_code.required' => 'The product style code is required.',
            'look_name.required' => 'The full look name is required.',
            'product_name.required' => 'The product name is required.',
            'collection_name.required' => 'The collection name is required.',
            'product_category.required' => 'The product category is required.',
            'fabric_composition.required' => 'The fabric composition is required.',
            'product_fabric.required' => 'The product fabric is required.',
            'product_price.required' => 'The product price is required.',
            'description.required' => 'The product description is required.',
            'product_size.required' => 'The product Size is required.',
            'shipping.required' => 'The product Shipping details is required.',
            'return.required' => 'The product return details is required.',
            'thumbnail_image.array' => 'The thumbnail image must be an array.',
            'thumbnail_image.*.max' => 'Each thumbnail image must be less than 2MB.',
            'gallery_image.*.max' => 'Each gallery image must be less than 2MB.',
            'print_image.*.max' => 'Each print image must be less than 2MB.',
            'print_image.*.max' => 'Each print image must be less than 2MB.',
            'print_name.*.exists' => 'Selected print name is invalid.',
        ]);
        
        $product = ProductDetails::findOrFail($id);

        $colors = $request->colors ?? [];

        $product->colors = json_encode($colors);
        $product->print_name = json_encode($request->print_name);
        $product->style_code = $request->style_code;
        $product->look_name = $request->look_name;
        $product->product_name = $request->product_name;
        $product->category_id = $request->product_category;
        $product->fabric_composition_id = $request->fabric_composition;
        $product->collection_id = $request->collection_name;
        $product->product_fabric_id = $request->product_fabric;
        $product->product_price = $request->product_price;
        $product->description = $request->description;
        $product->shipping = $request->shipping;
        $product->return = $request->return;
        $product->sizes = json_encode($request->product_size);
        $product->modified_at = Carbon::now();
        $product->modified_by = Auth::user()->id;
    

        $existingThumbnails = $request->input('existing_thumbnail_images', []);  
        if ($request->hasFile('thumbnail_image')) {
            foreach ($request->file('thumbnail_image') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $new_name = time() . rand(10, 999) . '.' . $extension;
                    $image->move(public_path('/murupp/product/thumbnails'), $new_name);
                    $existingThumbnails[] = $new_name;  
                }
            }
        }
    
        $product->thumbnail_image = json_encode($existingThumbnails);
    
        $existingGalleryImages = $request->input('existing_gallery_images', []);  
        if ($request->hasFile('gallery_image')) {

            foreach ($request->file('gallery_image') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $new_name = time() . rand(10, 999) . '.' . $extension;
                    $image->move(public_path('/murupp/product/gallery'), $new_name);
                    $existingGalleryImages[] = $new_name;  
                }
            }
        }
        $product->gallery_images = json_encode($existingGalleryImages);

        
        $existingPrintImages = $request->input('existing_prints', []);  
        if ($request->hasFile('print_image')) {

            foreach ($request->file('print_image') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $new_name = time() . rand(10, 999) . '.' . $extension;
                    $image->move(public_path('/murupp/product/prints'), $new_name);
                    $existingPrintImages[] = $new_name;  
                }
            }
        }

        $product->product_prints = json_encode($existingPrintImages);
    
        $product->save();

        return redirect()->route('product-details.index')->with('message', 'Product has been successfully updated!');
    }
    

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ProductDetails::findOrFail($id);
            $industries->update($data);

            return redirect()->route('product-details.index')->with('message', 'Product details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

    
    

}