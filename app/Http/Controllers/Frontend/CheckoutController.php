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
use App\Models\Otp;
use App\Models\User;


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

        if (!preg_match('/^[6-9]\d{9}$/', $mobile)) {
            return response()->json(['success' => false, 'message' => 'Invalid mobile number']);
        }

        $otp = rand(100000, 999999);

        Otp::updateOrCreate(
            ['mobile_no' => $mobile],
            ['otp' => $otp],
            ['inserted_at' => Carbon::now()]
        );

        // API Credentials
        $accountId = env('SMSCOUNTRY_API_KEY'); 
        $apiToken = env('SMSCOUNTRY_API_TOKEN'); 
        $apiUrl = "https://restapi.smscountry.com/v0.1/Accounts/$accountId/SMSes";
        $senderID = env('SMSCOUNTRY_SENDER_ID');

        // Send OTP via API
        $response = Http::withBasicAuth($accountId, $apiToken)
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post($apiUrl, [
                "Text" => "$otp is your Murupp verification code. - Murupp",
                "Number" => $mobile,
                "SenderId" => $senderID,
                "Tool" => "API"
            ]);

        $responseData = $response->json();

        if (isset($responseData['Success']) && strtolower($responseData['Success']) === "true") {
            return response()->json(['success' => true, 'message' => 'OTP sent successfully!']);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP.',
                'error' => $responseData
            ]);
        }
    }



    public function verifyOtp(Request $request)
    {
        $mobile = $request->mobile;
        $enteredOtp = $request->otp;

        $otpRecord = Otp::where('mobile_no', $mobile)->first();

        if ($otpRecord && $otpRecord->otp == $enteredOtp) {
            $otpRecord->delete();

            if (User::where('mobile', $mobile)->exists()) {
                return response()->json(['success' => false, 'message' => 'This mobile number is already registered. Please Login to proceed']);
            }

            User::create([
                'mobile' => $mobile
            ]);

            return response()->json(['success' => true, 'message' => 'OTP Verified Successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid OTP.']);
        }
    }




}