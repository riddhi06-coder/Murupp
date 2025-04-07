<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use Session;
use Exception;
use Carbon\Carbon;

use App\Models\Payment;
use App\Models\OrderDetail;
use App\Models\OrderStatus;


class PaymentController extends Controller
{

    public function processPayment(Request $request) {
        // dd($request);

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

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
                'razorpay_key' => config('services.razorpay.key'),
                'amount'       => $request->amount,
                'currency'     => 'INR',
                'mode'         => 'test'
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    

    public function verifyPayment(Request $request) {
        // dd($request);
        try {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
    
            \Log::info("Received Razorpay Payment Data", $request->all());

             // Check if essential data is present
            if (!$request->has(['razorpay_order_id', 'razorpay_payment_id', 'razorpay_signature'])) {
                \Log::error("Missing Razorpay payment parameters.");
                return response()->json([
                    'status' => 'Payment Verification Error',
                    'error'  => 'Missing Razorpay payment parameters.'
                ], 400);
            }



            $expectedSignature = hash_hmac(
                'sha256',
                $request->razorpay_order_id . "|" . $request->razorpay_payment_id,
                config('services.razorpay.secret')
            );

            // Log signature comparison
            \Log::info("Expected Signature: " . $expectedSignature);
            \Log::info("Received Signature: " . $request->razorpay_signature);

            // Verify signature
            if ($expectedSignature !== $request->razorpay_signature) {
                \Log::error("Signature Mismatch! Possible tampering.");
                return response()->json([
                    'status' => 'Payment Verification Failed',
                    'error'  => 'Invalid Signature'
                ], 403);
            }
            
    
            // If signature matches, proceed with order processing
            $status = 1; // Successful payment
            $orderData = $request->order_data;
        
            $orderData = $request->order_data; 

            if (!empty($orderData) && isset($orderData['cart_items'])) {
                $productIds   = [];
                $productNames = [];
                $quantities   = [];
                $prices       = [];
                $images       = [];
                $sizes        = [];
                $prints        = [];
            
                foreach ($orderData['cart_items'] as $cartItem) {
                    $productIds[]   = (int) ($cartItem['product_id'] ?? 0);
                    $productNames[] = trim($cartItem['product_name']);
                    $quantities[]   = (int) ($cartItem['quantity'] ?? 1);
                    $prices[]       = (int) str_replace(',', '', $cartItem['price']); 
                    $images[]       = $cartItem['image'] ?? null;
                    $sizes[]        = $cartItem['size'] ?? "";
                    $prints[]        = $cartItem['print'] ?? "";
                }
            
                // Debugging Log to check data before inserting
                \Log::info("Order Data Before Insert", [
                    'product_ids' => json_encode($productIds),
                    'product_names' => json_encode($productNames),
                    'quantities' => json_encode($quantities),
                    'prices' => json_encode($prices),
                    'images'        => json_encode($images),
                    'sizes'         => json_encode($sizes),
                    'print'         => json_encode($prints),
                ]);
            
                try {

                    if (Auth::check()) {
                        $user = Auth::user();
                        $updateData = [];
                    
                        if (empty($user->phone) && !empty($orderData['customer_info']['phone'])) {
                            $updateData['phone'] = $orderData['customer_info']['phone'];
                        }
                    
                        if (empty($user->last_name) && !empty($orderData['customer_info']['last_name'])) {
                            $updateData['last_name'] = $orderData['customer_info']['last_name'];
                        }
                    
                        if (!empty($updateData)) {
                            $user->update($updateData);
                            \Log::info("User details updated in users table", $updateData);
                        }
                    }
                    
                    $order = OrderDetail::create([
                        'user_id'       => Auth::check() ? Auth::id() : null,
                        'order_id'       => $request->razorpay_order_id,
                        'payment_id'     => $request->razorpay_payment_id,
                        'customer_name'  => $orderData['customer_info']['first_name'] . ' ' . $orderData['customer_info']['last_name'],
                        'customer_email' => $orderData['customer_info']['email'],
                        'customer_phone' => $orderData['customer_info']['phone'],
                        'street' => $orderData['customer_info']['street'],
                        'city' => $orderData['customer_info']['city'],
                        'state' => $orderData['customer_info']['state'],
                        'postal_code' => $orderData['customer_info']['postal_code'],
                        'country' => $orderData['customer_info']['country'],
                        'billing_address' => $orderData['customer_info']['billing_address'],
                        'shipping_address' => $orderData['customer_info']['shipping_address'],
                        'description' => $orderData['customer_info']['description'],
                        'total_price'    => array_sum($prices),
                        'status'         => $status ?? 'pending', 
                        'product_ids'    => json_encode($productIds, JSON_UNESCAPED_UNICODE),
                        'product_names'  => json_encode($productNames, JSON_UNESCAPED_UNICODE),
                        'quantities'     => json_encode($quantities, JSON_UNESCAPED_UNICODE),
                        'prices'         => json_encode($prices, JSON_UNESCAPED_UNICODE),
                        'images'         => json_encode($images, JSON_UNESCAPED_UNICODE),
                        'sizes'          => json_encode($sizes, JSON_UNESCAPED_UNICODE),
                        'prints'          => json_encode($prints, JSON_UNESCAPED_UNICODE),
                        'created_at'     => Carbon::now(),
                        'created_by'     => Auth::check() ? Auth::id() : null,
                    ]);
            
                    Log::info("Order Inserted Successfully: ", ['order_id' => $order->id]);


                    OrderStatus::create([
                        'user_id'           => Auth::check() ? Auth::id() : null,
                        'order_id'          => $order->order_id,
                        'order_status' => ($status == 2) ? 'Pending' : 'Order Placed',
                        'status_updated_at' => Carbon::now(),
                        'status_updated_by' => Auth::check() ? Auth::id() : null,
                    ]);


                    // Reduce available_quantity in product_details table
                    foreach ($productIds as $index => $productId) {
                        DB::table('product_details')
                            ->where('id', $productId)
                            ->decrement('available_quantity', $quantities[$index]);
                    }

                    if (Auth::check()) {
                        DB::table('carts')
                            ->where('user_id', Auth::id())
                            ->whereIn('product_id', $productIds) 
                            ->delete();
                
                        \Log::info("Cart items deleted for user: " . Auth::id());
                    }


                    // Invoce Generation and sending mail 
                    
                    $invoiceNumber = mt_rand(10000000, 99999999); 
                    $invoiceFileName = 'invoice_' . $invoiceNumber . '.pdf';
                    $pdfDirectory = public_path('/murupp/invoices');
                    
                    // Ensure directory exists
                    if (!File::exists($pdfDirectory)) {
                        File::makeDirectory($pdfDirectory, 0777, true, true);
                    }
                    
                    $pdfPath = $pdfDirectory . '/' . $invoiceFileName;
                    \Log::info("Order Data Before PDF Generation", ['order' => $order]);
                    
                                 
                    // Save invoice number in the database
                    $order->update(['invoice_id' => $invoiceNumber]);

                    // Generate and save PDF
                    $pdf = Pdf::loadView('frontend.invoice_pdf', ['order' => json_decode(json_encode($order), true)]);

                    $pdf->save($pdfPath);
       
                    
                    Log::info("Invoice PDF Generated: " . $invoiceFileName);
                    
                    // Prepare email data
                    $emailData = [
                        'name' => $order->customer_name,
                        'email' => $order->customer_email,
                        'invoice_number' => $invoiceNumber,
                    ];
                    
                    // Send the email
                    Mail::send('frontend.invoice_mail', ['order' => $order], function ($message) use ($order, $pdfPath, $invoiceFileName) {
                        $message->to($order->customer_email)
                                ->subject('Your Invoice - ' . $order->invoice_id)
                                ->attach($pdfPath, [
                                    'as' => $invoiceFileName,
                                    'mime' => 'application/pdf',
                                ]);
                    });
                    
                    Log::info("Invoice Email Sent to: " . $emailData['email']);
                     

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