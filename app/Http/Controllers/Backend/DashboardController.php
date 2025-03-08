<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log; 

use Carbon\Carbon;
use App\Models\User;
use App\Models\OrderDetail;
use App\Models\ProductDetails;
use App\Models\ProductCategory;

class DashboardController extends Controller
{

    public function dashboard()
    {

        //===================================================================================================================


        // for  Total Revenue Fetching.
        $monthlyData = OrderDetail::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    
        $months = $monthlyData->pluck('month')->map(function ($month) {
            return date("F", mktime(0, 0, 0, $month, 1)); 
        })->toArray();
    
        $revenues = $monthlyData->pluck('total')->toArray();
        $totalRevenueAmount_1 = array_sum($revenues);


     //======================================================================================================   

        // For  Total Orders Fetching.
        $monthlyOrders = OrderDetail::selectRaw('MONTH(created_at) as month, COUNT(id) as total_orders')
                        ->groupBy('month')
                        ->orderBy('month')
                        ->get();

        $months = $monthlyOrders->pluck('month')->map(function ($month) {
                                    return date("F", mktime(0, 0, 0, $month, 1)); 
                                })->toArray();

        $orders = $monthlyOrders->pluck('total_orders')->toArray();
        $totalOrderCount = array_sum($orders);



        // 🟢 Fetching Data for Last Year
        $lastYearData = OrderDetail::selectRaw('MONTH(created_at) as month, COUNT(id) as total_orders, SUM(total_price) as total_revenue')
        ->whereYear('created_at', now()->subYear()->year) 
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $months_last_year = $lastYearData->pluck('month')->map(fn($month) => date("F", mktime(0, 0, 0, $month, 1)))->toArray();
        $orders_last_year = $lastYearData->pluck('total_orders')->toArray();
        $revenues_last_year = $lastYearData->pluck('total_revenue')->toArray();

        // 🟡 Fetching Data for Last Month
        $lastMonthData = OrderDetail::selectRaw('DAY(created_at) as day, COUNT(id) as total_orders, SUM(total_price) as total_revenue')
            ->whereMonth('created_at', now()->subMonth()->month) 
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $months_last_month = $lastMonthData->pluck('day')->map(fn($day) => 'Day ' . $day)->toArray();
        $orders_last_month = $lastMonthData->pluck('total_orders')->toArray();
        $revenues_last_month = $lastMonthData->pluck('total_revenue')->toArray();

        // 🔵 Fetching Data for Last Week
        $lastWeekData = OrderDetail::selectRaw('DAYNAME(created_at) as day, COUNT(id) as total_orders, SUM(total_price) as total_revenue')
            ->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
            ->groupBy('day')
            ->orderByRaw("FIELD(day, 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')")
            ->get();

        $days_last_week = $lastWeekData->pluck('day')->toArray();
        $orders_last_week = $lastWeekData->pluck('total_orders')->toArray();
        $revenues_last_week = $lastWeekData->pluck('total_revenue')->toArray();

        // 🔴 Fetching Data for Today (Hourly)
        $todayData = OrderDetail::selectRaw('HOUR(created_at) as hour, COUNT(id) as total_orders, SUM(total_price) as total_revenue')
            ->whereDate('created_at', now()->toDateString()) 
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $hours_today = $todayData->pluck('hour')->map(fn($hour) => $hour . ':00')->toArray();
        $orders_today = $todayData->pluck('total_orders')->toArray();
        $revenues_today = $todayData->pluck('total_revenue')->toArray();


        // 🟢 Fetching Data for Current Year
        $currentYearData = OrderDetail::selectRaw('MONTH(created_at) as month, COUNT(id) as total_orders, SUM(total_price) as total_revenue')
        ->whereYear('created_at', now()->year) 
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $months_current_year = $currentYearData->pluck('month')->map(fn($month) => date("F", mktime(0, 0, 0, $month, 1)))->toArray();
        $orders_current_year = $currentYearData->pluck('total_orders')->toArray();
        $revenues_current_year = $currentYearData->pluck('total_revenue')->toArray();


        //==================================================================================================


        // Fetch revenue grouped by category (Decoding JSON product_id)
        $categoryData = OrderDetail::get()->map(function ($order) {
            if (is_null($order->product_ids) || empty($order->product_ids)) {
                return collect();
            }

            // Decode JSON or explode string
            $productIds = json_decode($order->product_ids, true);
            if (!is_array($productIds)) {
                $productIds = explode(',', trim($order->product_ids, '[]'));
            }

            return ProductDetails::whereIn('id', $productIds)->pluck('category_id');
        })->flatten()->unique();

        // Fetch category names from master_product_category
        $categoryRevenue = [];
        foreach ($categoryData as $categoryId) {
            $categoryName = ProductCategory::where('id', $categoryId)->value('category_name');
            
            if (!$categoryName) {
                continue;
            }

            $totalRevenue = OrderDetail::get()->map(function ($order) use ($categoryId) {
                if (is_null($order->product_ids) || empty($order->product_ids)) {
                    return 0; // Skip empty product_id orders
                }

                $productIds = json_decode($order->product_ids, true);
                if (!is_array($productIds)) {
                    $productIds = explode(',', trim($order->product_ids, '[]'));
                }

                $matchingProducts = ProductDetails::whereIn('id', $productIds)->where('category_id', $categoryId)->pluck('id');

                if ($matchingProducts->isEmpty()) {
                    return 0; 
                }

                // Decode order prices and sum only relevant ones
                $prices = json_decode($order->prices, true);
                if (!is_array($prices)) {
                    $prices = explode(',', trim($order->prices, '[]'));
                }

                $total = 0;
                foreach ($matchingProducts as $index => $productId) {
                    if (isset($prices[$index])) {
                        $total += (float) $prices[$index];
                    }
                }

                return $total;
            })->sum();

            $categoryRevenue[] = [
                'category' => $categoryName,
                'total_revenue' => $totalRevenue
            ];
        }

        // Convert data for the chart
        $categories = collect($categoryRevenue)->pluck('category')->toArray();
        $revenuesByCategory = collect($categoryRevenue)->pluck('total_revenue')->toArray();
        $totalRevenueAmount = array_sum($revenuesByCategory);

  
        //====================================================================================================

        $totalVisitors = User::count();

    
                    

        return view('backend.dashboard', compact(
            'months', 'revenues', 'totalRevenueAmount_1', 'orders', 'totalOrderCount',
            'months_current_year', 'orders_current_year', 'revenues_current_year',  
            'months_last_year', 'orders_last_year', 'revenues_last_year',
            'months_last_month', 'orders_last_month', 'revenues_last_month',
            'days_last_week', 'orders_last_week', 'revenues_last_week',
            'hours_today', 'orders_today', 'revenues_today','categories', 'revenuesByCategory', 'totalRevenueAmount','totalVisitors'
        ));
    }        
    
    
    
    

}