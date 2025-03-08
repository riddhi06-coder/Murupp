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
use App\Models\OrderDetail;
use App\Models\ProductDetails;
use App\Models\ProductCategory;


class ReportsController extends Controller
{
    public function reports()
    {
        return view('backend.reports');
    }

    public function getReportData($reportType)
    {
        switch ($reportType) {
            case 'sales':
                $data = OrderDetail::select('order_id', 'customer_name', 'total_price', 'created_at')
                                    ->get();
                break;

            case 'inventory':
                $data = ProductDetails::select('product_name', 'master_product_category.category_name', 'available_quantity')
                                        ->leftJoin('master_product_category', 'product_details.category_id', '=', 'master_product_category.id')
                                        ->whereNull('product_details.deleted_by')
                                        ->get();
                break;

            case 'customers':
                $data = User::select('users.id', 'users.name as customer_name', 'users.email', 
                                        DB::raw('COUNT(order_details.id) as total_orders'), 
                                        DB::raw('MAX(order_details.created_at) as last_purchase'))
                            ->leftJoin('order_details', 'users.id', '=', 'order_details.user_id') // Assuming 'user_id' is the foreign key in 'order_details'
                            ->groupBy('users.id', 'users.name', 'users.email') // Group by user details to get the aggregate count and max date
                            ->get();
                break;

            case 'category':
                $data = ProductCategory::select(
                    'master_product_category.category_name',
                    // Count total products in category
                    \DB::raw('(
                        SELECT COUNT(*) 
                        FROM product_details
                        WHERE product_details.category_id = master_product_category.id
                    ) AS total_products_in_category'),
                
                    // Count total sales in category
                    \DB::raw('(
                        SELECT COUNT(*) 
                        FROM order_details
                        INNER JOIN product_details ON JSON_CONTAINS(order_details.product_ids, CAST(product_details.id AS CHAR))
                        WHERE product_details.category_id = master_product_category.id
                    ) AS total_sales_in_category')
                )
                ->whereNull('master_product_category.deleted_by')
                ->get();
                
                break;


            case 'product':
                    $data = ProductDetails::select(
                        'product_details.product_name as product_name', 
                        'product_details.category_id', 
                        'master_product_category.category_name', 
                        'product_details.available_quantity',
                        \DB::raw('(
                            SELECT COUNT(*)
                            FROM order_details
                            WHERE JSON_CONTAINS(order_details.product_ids, CAST(product_details.id AS CHAR))
                        ) AS total_sales_count')
                    )
                    ->join('master_product_category', 'product_details.category_id', '=', 'master_product_category.id') 
                    ->whereNull('master_product_category.deleted_by')
                    ->get();
                break;
                
                

            default:
                return response()->json(['error' => 'Invalid report type'], 400);
        }

        return response()->json($data);
    }

}