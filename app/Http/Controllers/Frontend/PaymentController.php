<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Session;
use Exception;
use Carbon\Carbon;

use App\Models\Payment;
use App\Models\OrderDetail;


class PaymentController extends Controller
{

    public function processPayment(Request $request) {

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    
        $orderData = [
            'receipt'         => 'test_order_' . rand(),
            'amount'          => intval(str_replace(',', '', $request->amount)) * 100,
            'currency'        => 'INR',
            'payment_capture' => 1 
        ];
    
        try {
            $order = $api->order->create($orderData);
            // dd($order);
            return response()->json([
                'order_id'     => $order['id'],
                'razorpay_key' => env('RAZORPAY_KEY'),
                'amount'       => $request->amount,
                'currency'     => 'INR',
                'mode'         => 'test'
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    

    public function verifyPayment(Request $request) {
        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    
            $expectedSignature = hash_hmac(
                'sha256',
                $request->razorpay_order_id . "|" . $request->razorpay_payment_id,
                env('RAZORPAY_SECRET')
            );
    
            $status = ($expectedSignature === $request->razorpay_signature) ? 1 : 2;
    
            $orderData = $request->order_data; 

            if (!empty($orderData) && isset($orderData['cart_items'])) {
                $productIds   = [];
                $productNames = [];
                $quantities   = [];
                $prices       = [];
            
                foreach ($orderData['cart_items'] as $cartItem) {
                    $productIds[]   = (int) ($cartItem['product_id'] ?? 0);
                    $productNames[] = trim($cartItem['product_name']);
                    $quantities[]   = (int) ($cartItem['quantity'] ?? 1);
                    $prices[]       = (int) str_replace(',', '', $cartItem['price']); 
                }
            
                // Debugging Log to check data before inserting
                \Log::info("Order Data Before Insert", [
                    'product_ids' => json_encode($productIds),
                    'product_names' => json_encode($productNames),
                    'quantities' => json_encode($quantities),
                    'prices' => json_encode($prices),
                ]);
            
                try {
                    $order = OrderDetail::create([
                        'user_id'       => Auth::check() ? Auth::id() : null,
                        'order_id'       => $request->razorpay_order_id,
                        'payment_id'     => $request->razorpay_payment_id,
                        'customer_name'  => $orderData['customer_info']['first_name'] . ' ' . $orderData['customer_info']['last_name'],
                        'customer_email' => $orderData['customer_info']['email'],
                        'customer_phone' => $orderData['customer_info']['phone'],
                        'total_price'    => array_sum($prices),
                        'status'         => $status ?? 'pending', 
                        'product_ids'    => json_encode($productIds, JSON_UNESCAPED_UNICODE),
                        'product_names'  => json_encode($productNames, JSON_UNESCAPED_UNICODE),
                        'quantities'     => json_encode($quantities, JSON_UNESCAPED_UNICODE),
                        'prices'         => json_encode($prices, JSON_UNESCAPED_UNICODE),
                        'address'        => $orderData['address'],
                        'created_at'     => Carbon::now(),
                        'created_by'     => Auth::check() ? Auth::id() : null,
                    ]);
            
                    \Log::info("Order Inserted Successfully: ", ['order_id' => $order->id]);

                    if (Auth::check()) {
                        DB::table('carts')
                            ->where('user_id', Auth::id())
                            ->whereIn('product_id', $productIds) 
                            ->delete();
                
                        \Log::info("Cart items deleted for user: " . Auth::id());
                    }


                } catch (\Exception $e) {
                    \Log::error("Order Insert Error: " . $e->getMessage());
                    dd("Error: " . $e->getMessage());
                }
            }
            
            return response()->json(['status' => $status]);
    
        } catch (\Exception $e) {
            Log::error("Razorpay Verification Error: " . $e->getMessage());
    
            return response()->json([
                'status' => 'Payment Verification Error',
                'error'  => $e->getMessage()
            ], 500);
        }
    }
    
    
    

    

}