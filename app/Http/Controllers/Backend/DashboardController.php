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


class DashboardController extends Controller
{

    public function dashboard()
    {
        // Fetch total revenue for each month dynamically
        $monthlyData = OrderDetail::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    
        // Extract months and revenues for chart
        $months = $monthlyData->pluck('month')->map(function ($month) {
            return date("F", mktime(0, 0, 0, $month, 1)); 
        })->toArray();
    
        $revenues = $monthlyData->pluck('total')->toArray();
    
        // Calculate total revenue amount
        $totalRevenueAmount = array_sum($revenues);
    
        return view('backend.dashboard', compact('months', 'revenues', 'totalRevenueAmount'));
    }
    
    
    
    

}