<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\DressesDetails;
use App\Models\ProductDetails;
use App\Models\TopsDetails;
use App\Models\BottomsDetails;
use App\Models\CoordsDetails;
use App\Models\JacketsDetails;
use App\Models\ProductSizes;

class CollectionController extends Controller
{

    public function collection_details(Request $request, $slug)
    { 
        // Fetch category ID based on the slug from the URL
        $category = DB::table('master_collections')
            ->whereNull('deleted_by')
            ->where('slug', $slug)
            ->first();
    
        if (!$category) {
            abort(404); 
        }
    
        // Fetch products under the fetched category
        $products = ProductDetails::whereNull('deleted_by')
            ->whereNull('deleted_by')
            ->where('collection_id', $category->id)
            ->orderBy('product_name', 'asc')
            ->get();
    
        // Fetch price range for the category
        $priceRange = ProductDetails::whereNull('deleted_by')
            ->where('category_id', $category->id)
            ->selectRaw('MIN(CAST(REPLACE(product_price, ",", "") AS UNSIGNED)) as min_price, 
                         MAX(CAST(REPLACE(product_price, ",", "") AS UNSIGNED)) as max_price')
            ->first();
    
        // Get available sizes from master_product_size
        $sizes = ProductSizes::whereNull('deleted_by')->pluck('size');
    
        // Get stock availability count
        $inStockCount = ProductDetails::whereNull('deleted_by')
            ->where('category_id', $category->id)
            ->where('available_quantity', '>', 0)
            ->count();
    
        $outStockCount = ProductDetails::whereNull('deleted_by')
            ->where('category_id', $category->id)
            ->where('available_quantity', '=', 0)
            ->count();
    
        return view('frontend.collection-details', compact(
            'category',
            'products', 
            'priceRange', 
            'sizes', 
            'inStockCount', 
            'outStockCount'
        ));
    }
    

    
}