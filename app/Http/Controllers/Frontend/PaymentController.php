<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
use Session;
use Exception;


class PaymentController extends Controller
{

    public function processPayment(Request $request)
    {
        $api = new \Razorpay\Api\Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $orderData = [
            'receipt'         => 'test_order_' . rand(),
            'amount'          => $request->amount * 100, // Convert to paise
            'currency'        => 'INR',
            'payment_capture' => 1 // Auto capture
        ];

        try {
            $order = $api->order->create($orderData);
            return response()->json([
                'order_id' => $order['id'],
                'razorpay_key' => env('RAZORPAY_KEY'),
                'amount' => $request->amount,
                'currency' => 'INR',
                'mode' => 'test'
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }


    public function verifyPayment(Request $request)
    {
        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    
            $attributes = [
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature
            ];
    
            // Generate the expected signature
            $expectedSignature = hash_hmac(
                'sha256', 
                $request->razorpay_order_id . "|" . $request->razorpay_payment_id, 
                env('RAZORPAY_SECRET')
            );
    
            // Compare expected signature with received signature
            if ($expectedSignature === $request->razorpay_signature) {
                // Payment is verified, update database if needed
                DB::table('payments')->insert([
                    'order_id' => $request->razorpay_order_id,
                    'payment_id' => $request->razorpay_payment_id,
                    'status' => 'success',
                    'created_at' => now()
                ]);
    
                return response()->json(['status' => 'Payment Successful']);
            } else {
                return response()->json(['status' => 'Payment Verification Failed'], 400);
            }
        } catch (\Exception $e) {
            Log::error("Razorpay Verification Error: " . $e->getMessage());
            return response()->json(['status' => 'Payment Verification Error', 'error' => $e->getMessage()], 500);
        }
    }

}