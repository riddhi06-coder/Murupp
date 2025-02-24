<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use App\Models\ProductDetails;
use App\Models\ProductCategory;
use App\Models\DressesDetails;
use App\Models\ProductSizes;
use App\Models\ProductFabrics;
use App\Models\FabricsComposition;


class ProductController extends Controller
{
    public function show($slug)
    {
        $product = ProductDetails::where('slug', $slug)->whereNull('deleted_at')->firstOrFail();
        $category = ProductCategory::find($product->category_id);
        $imageTitle = optional($category)->image_title ?? '';
    
        // Fetch gallery images
        $galleryImages = json_decode($product->gallery_images, true) ?? [];
    
        // Fetch all size data and structure it for the table
        $sizeCharts = ProductSizes::whereNull('deleted_at')->get()->groupBy('size');
    
        // Fetch fabric name from master_product_fabrics
        $fabric = ProductFabrics::where('id', $product->product_fabric_id)->value('fabrics_name');
    
        // Fetch fabric composition from master_fabrics_composition
        $fabricComposition = FabricsComposition::where('id', $product->fabric_composition_id)->value('composition_name');
    
        // Fetch related products (same category but exclude current product)
        $relatedProducts = ProductDetails::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id) 
            ->whereNull('deleted_at')
            ->take(5) 
            ->get();
    
        // Decode JSON to get the selected size IDs
        $productSizeIds = json_decode($product->sizes, true) ?? [];

        // Fetch matching sizes from ProductSizes table
        $productSizes = ProductSizes::whereIn('id', $productSizeIds)
            ->whereNull('deleted_at')
            ->pluck('size', 'id'); 

        $productColor = json_decode($product->colors, true) ?? [];


        $productprints = json_decode($product->product_prints, true) ?? []; // Image filenames
        $productPrintIds = json_decode($product->print_name, true) ?? []; // Print IDs
        
        // Fetch print names based on IDs
        $productprintsname = [];
        if (!empty($productPrintIds)) {
            $productprintsname = DB::table('master_product_print')
                ->whereIn('id', $productPrintIds)
                ->pluck('print_name', 'id')
                ->toArray();
        }
        
        // Combine prints with names
        $printData = [];
        foreach ($productPrintIds as $index => $id) {
            if (isset($productprintsname[$id]) && isset($productprints[$index])) {
                $printData[] = [
                    'name' => $productprintsname[$id], 
                    'image' => $productprints[$index], 
                ];
            }
        }
 
        return view('frontend.product-detail', compact(
            'product', 'category', 'galleryImages', 'sizeCharts', 'fabric', 'fabricComposition', 'relatedProducts', 'productSizes','productColor','productprints','productprintsname','printData'
        ));
    }
            
    public function send_contact(Request $request)
    {

        $request->validate([
            'name'    => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'], 
            'email'   => 'required|email', 
            'phone'   => 'required|digits:10', 
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ], [
            'name.regex'  => 'The name must not contain special characters or numbers.',
            'phone.digits' => 'The contact number must be exactly 10 digits.',
        ]);
    
        $emailData = [
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'product_name' => $request->product_name ?? 'N/A',
        ];

        Mail::send('frontend.contact-mail', ['emailData' => $emailData], function ($message) use ($request, $emailData) {
            $subject = "Special Request for " . ($emailData['product_name'] ?? 'Product');
            $message->to('riddhi@matrixbricks.com')
                    ->subject($subject);
        });
    
        
        return back()->with('success', 'Your message has been sent successfully!');
    }
    
    

}
