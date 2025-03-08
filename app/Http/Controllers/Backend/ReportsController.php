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
                $data = OrderDetail::select('id', 'name as product_name', 'category', 'stock_available')->get();
                break;

            // case 'customers':
            //     $data = Customer::select('id', 'name as customer_name', 'email', 'total_orders', 'last_purchase')->get();
            //     break;

            // case 'category':
            //     $data = Category::select('id', 'name as category_name', 'total_products', 'total_sales', 'last_updated')->get();
            //     break;

            // case 'product':
            //     $data = Product::select('id', 'name as product_name', 'category', 'total_sales', 'stock_left')->get();
            //     break;

            default:
                return response()->json(['error' => 'Invalid report type'], 400);
        }

        return response()->json($data);
    }

}