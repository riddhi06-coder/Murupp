<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

use App\Models\ProductDetails;
use App\Models\Carts;


class CheckoutController extends Controller
{

    public function checkout(Request $request)
    {
        $userId = Auth::id();
        $sessionId = Session::getId();
    
        // Fetch cart items
        $cartItems = DB::table('carts')
        ->join('product_details', 'carts.product_id', '=', 'product_details.id')
        ->where(function ($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('carts.user_id', $userId);
            } else {
                $query->where('carts.session_id', $sessionId);
            }
        })
        ->select('carts.*', 'product_details.product_name', 'product_details.slug') 
        ->whereNull('carts.deleted_at')
        ->get();

        // Calculate total price
        $total = $cartItems->sum('product_total_price');
    
        return view('frontend.checkout', compact('cartItems', 'total'));
    }
    
}