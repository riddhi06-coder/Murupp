<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

use App\Models\ProductDetails;
use App\Models\OrderDetail;
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


    public function order_confirmation(Request $request)
    {
        $orderId = $request->query('order_id'); 
    
        $order = OrderDetail::where('order_id', $orderId)->first(); 
        // dd($order);
    
        if (!$order) {
            return redirect()->route('frontend.index')->with('error', 'Order not found.');
        }
    
        return view('frontend.order-confirmation', compact('order'));
    }
    
    

    public function sendOtp(Request $request)
    {
        $mobile = $request->mobile;
    
        // Validate mobile number (Indian format)
        if (!preg_match('/^[6-9]\d{9}$/', $mobile)) {
            return response()->json(['success' => false, 'message' => 'Invalid mobile number']);
        }
    
        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);
        
        // Store OTP in session
        Session::put('otp', $otp);
        Session::put('mobile', $mobile);
    
        // SMS Country API credentials from .env
        $apiUrl = env('SMSCOUNTRY_API_URL');
        $apiKey = env('SMSCOUNTRY_API_KEY');
        $apiToken = env('SMSCOUNTRY_API_TOKEN');
        $senderID = env('SMSCOUNTRY_SENDER_ID');
    
        // SMS template with dynamic OTP
        $message = "{$otp} is your Murupp verification code. - Murupp";
    
        // API request
        $response = Http::withHeaders([
            "Authorization" => "Bearer $apiToken",
            "Content-Type" => "application/json"
        ])->post($apiUrl, [
            "Number" => $mobile,
            "Text" => $message,
            "SenderId" => $senderID
        ]);
    
        if ($response->successful()) {
            return response()->json(['success' => true, 'message' => 'OTP sent successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to send OTP.']);
        }
    }


    public function verifyOtp(Request $request)
    {
        $enteredOtp = $request->otp;
        $storedOtp = Session::get('otp');

        if ($enteredOtp == $storedOtp) {
            Session::forget('otp'); 
            return response()->json(['success' => true, 'message' => 'OTP Verified Successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid OTP.']);
        }
    }


}