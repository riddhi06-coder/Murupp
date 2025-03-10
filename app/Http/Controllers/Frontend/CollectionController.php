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


        // Fetch all categories along with product count
        $categories = DB::table('master_product_category')
                    ->whereNull('deleted_by')
                    ->select('id', 'category_name', 'slug')
                    ->get()
                    ->map(function ($cat) {
                        $cat->product_count = ProductDetails::whereNull('deleted_by')
                            ->where('category_id', $cat->id)
                            ->count();
                        return $cat;
                    });
    
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
            'outStockCount', 'categories'
        ));
    }


    public function filterProducts(Request $request)
    {
        // dd($request);
        Log::info('Filter request received', ['request_data' => $request->all()]);
    
        // Get category ID based on slug
        $categoryId = null;
        if ($request->has('slug')) {
            $category = DB::table('master_product_category')
                ->where('slug', $request->slug) 
                ->first();
            
            if ($category) {
                $categoryId = $category->id;
            }
        }
    
        // Base query for filtering products
        $query = DB::table('product_details')
            ->whereNull('product_details.deleted_by')
            ->leftJoin('master_collections', 'product_details.collection_id', '=', 'master_collections.id')
            ->leftJoin('master_product_category', 'product_details.category_id', '=', 'master_product_category.id')
            ->leftJoin('master_fabrics_composition', 'product_details.fabric_composition_id', '=', 'master_fabrics_composition.id')
            ->leftJoin('master_product_fabrics', 'product_details.product_fabric_id', '=', 'master_product_fabrics.id');
    
        // Apply Category Filter
        if (!empty($categoryId)) {
            $query->where('product_details.category_id', $categoryId);
            Log::info('Category filter applied', ['category_id' => $categoryId]);
        }
    
        // Apply Price Filter
        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween(
                DB::raw('CAST(REPLACE(product_details.product_price, ",", "") AS UNSIGNED)'), 
                [$request->min_price, $request->max_price]
            );
            Log::info('Price filter applied', ['min_price' => $request->min_price, 'max_price' => $request->max_price]);
        }
    
        // Apply Size Filter
        if ($request->has('sizes') && !empty($request->sizes)) {
            $sizeIds = DB::table('master_product_size')
                ->whereIn('size', $request->sizes)
                ->pluck('id')
                ->toArray();
    
            if (!empty($sizeIds)) {
                $query->where(function ($q) use ($sizeIds) {
                    foreach ($sizeIds as $sizeId) {
                        $q->orWhereRaw("JSON_CONTAINS(product_details.sizes, ?)", [json_encode((string)$sizeId)]);
                    }
                });
            }
            Log::info('Size filter applied', ['sizes' => $request->sizes, 'matching_size_ids' => $sizeIds]);
        }
    
        // Apply Stock Availability Filter
        if ($request->has('availability')) {
            if ($request->availability == 'inStock') {
                $query->where('product_details.available_quantity', '>', 0);
            } elseif ($request->availability == 'outStock') {
                $query->where('product_details.available_quantity', '=', 0);
            }
            Log::info('Stock availability filter applied', ['availability' => $request->availability]);
        }
    
        // Fetch Filtered Products
        $filteredProducts = $query->select([
            'product_details.*',
            'master_collections.collection_name',
            'master_product_category.category_name',
            'master_fabrics_composition.composition_name',
            'master_product_fabrics.fabrics_name'
        ])->distinct()->get();
    
        Log::info('Filtered products retrieved', ['count' => count($filteredProducts)]);

          // Separate Query for Price Range
        $priceRangeQuery = DB::table('product_details')
            ->whereNull('product_details.deleted_by');
    
        if ($request->has('min_price') && $request->has('max_price')) {
            $priceRangeQuery->whereBetween(
                DB::raw('CAST(REPLACE(product_details.product_price, ",", "") AS UNSIGNED)'), 
                [$request->min_price, $request->max_price]
            );
        }
    
        
        $priceRange = $priceRangeQuery->selectRaw(
            'MIN(CAST(REPLACE(product_price, ",", "") AS UNSIGNED)) as min_price, 
            MAX(CAST(REPLACE(product_price, ",", "") AS UNSIGNED)) as max_price'
        )->first();
    
        Log::info('Price range calculated', ['min_price' => $priceRange->min_price, 'max_price' => $priceRange->max_price]);
    
        // Get available sizes from master_product_size
        $sizes = DB::table('master_product_size')->whereNull('deleted_by')->pluck('size');
        Log::info('Available sizes retrieved', ['sizes' => $sizes]);
    
        // Separate Queries for Stock Availability Count
        $inStockCount = DB::table('product_details')
            ->whereNull('deleted_by')
            ->where('available_quantity', '>', 0)
            ->count();
        Log::info('In-stock products count', ['count' => $inStockCount]);
    
        $outStockCount = DB::table('product_details')
            ->whereNull('deleted_by')
            ->where('available_quantity', '=', 0)
            ->count();
        Log::info('Out-of-stock products count', ['count' => $outStockCount]);
    
        // Prepare applied filters
        $appliedFilters = [];
    
        if ($request->has('min_price') && $request->has('max_price')) {
            $appliedFilters[] = "Price: INR {$request->min_price} - INR {$request->max_price}";
        }
        if ($request->has('sizes') && !empty($request->sizes)) {
            $appliedFilters[] = "Sizes: " . implode(', ', $request->sizes);
        }
        if ($request->has('availability')) {
            $availabilityText = $request->availability == 'inStock' ? 'In Stock' : 'Out of Stock';
            $appliedFilters[] = "Availability: $availabilityText";
        }
    
        Log::info('Applied filters', ['filters' => $appliedFilters]);
    
    
        return response()->json([
            'filteredProducts' => $filteredProducts,
            'priceRange' => $priceRange,
            'sizes' => $sizes,
            'inStockCount' => $inStockCount,
            'outStockCount' => $outStockCount,
            'appliedFilters' => $appliedFilters
        ]);
    }
    

    
}