<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use App\Models\ProductDetails;
use App\Models\Carts;
use App\Models\GuestSession;


class CartController extends Controller
{

    // public function add($id, Request $request)
    // {
    //     $product = ProductDetails::find($id);
    
    //     if (!$product) {
    //         return redirect()->back()->with('error', 'Product not found.');
    //     }
    
    //     $userId = Auth::id();
    //     $quantityToAdd = $request->input('quantity');
    //     $selectedColor = $request->input('color1');
    //     $selectedPrint = $request->input('print_option');
    //     $selectedSize = $request->input('size');
    //     $productPrice = (float) str_replace(',', '', $request->input('product_price', '0'));
    //     $productImage = $request->input('product_image', null);
    //     $productImage = str_replace(url('/'), '', $productImage); 

    //     $totalPrice = $productPrice * $quantityToAdd;

    //     $existingCart = Carts::where('user_id', $userId)
    //                         ->where('product_id', $id)
    //                         ->where('colors', $selectedColor)
    //                         ->where('print', $selectedPrint)
    //                         ->where('size', $selectedSize)
    //                         ->first();
    
    //     if ($existingCart) {
    //         $existingCart->increment('quantity', $quantityToAdd);
    //         $existingCart->update([
    //             'product_total_price' => $existingCart->quantity * $productPrice,
    //             'product_image' => $productImage,
    //             'modified_at' => Carbon::now(),
    //             'modified_by' => $userId,
    //         ]);
    //     } else {
    //         // If product is not in cart, create a new entry with selected options
    //         Carts::create([
    //             'user_id' => $userId,
    //             'product_id' => $id,
    //             'quantity' => $quantityToAdd,
    //             'colors' => $selectedColor,
    //             'print' => $selectedPrint,
    //             'size' => $selectedSize,
    //             'product_image' => $productImage,
    //             'product_total_price' => $totalPrice,
    //             'payment_status' => 1,
    //             'inserted_at' => Carbon::now(),
    //             'inserted_by' => $userId,
    //         ]);
    //     }
    
    //     return redirect()->back()->with('message', 'Product added to Cart!');
    // }


    public function add($id, Request $request)
    {
        $product = ProductDetails::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $quantityToAdd = $request->input('quantity', 1);
        $selectedColor = $request->input('color1');
        $selectedPrint = $request->input('print_option');
        $selectedSize = $request->input('size');
        $productPrice = (float) str_replace(',', '', $request->input('product_price', '0'));
        $productImage = str_replace(url('/'), '', $request->input('product_image', null));
        
        $totalPrice = $productPrice * $quantityToAdd;

        if (Auth::check()) {
            // User is logged in
            $userId = Auth::id();
            $sessionId = null;
        } else {
            // Guest user: Generate or fetch session_id
            $sessionId = Session::getId();
            $ipAddress = $request->ip();

            // Check if guest session exists
            $guestSession = GuestSession::where('session_id', $sessionId)->first();

            if (!$guestSession) {
                GuestSession::create([
                    'session_id' => $sessionId,
                    'ip_address' => $ipAddress,
                    'inserted_at' => Carbon::now()
                ]);
            }

            $userId = null; 
        }

        // Check if item exists in cart
        $existingCart = Carts::where(function ($query) use ($userId, $sessionId) {
                                    if ($userId) {
                                        $query->where('user_id', $userId);
                                    } else {
                                        $query->where('session_id', $sessionId);
                                    }
                                })
                                ->where('product_id', $id)
                                ->where('colors', $selectedColor)
                                ->where('print', $selectedPrint)
                                ->where('size', $selectedSize)
                                ->first();

        if ($existingCart) {
            // If product already in cart, update quantity & price
            $existingCart->increment('quantity', $quantityToAdd);
            $existingCart->update([
                'product_total_price' => $existingCart->quantity * $productPrice,
                'product_image' => $productImage,
                'modified_at' => Carbon::now(),
                'modified_by' => $userId,
            ]);
        } else {
            // If product is not in cart, create a new entry
            Carts::create([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'product_id' => $id,
                'quantity' => $quantityToAdd,
                'colors' => $selectedColor,
                'print' => $selectedPrint,
                'size' => $selectedSize,
                'product_image' => $productImage,
                'product_total_price' => $totalPrice,
                'payment_status' => 1,
                'inserted_at' => Carbon::now(),
                'inserted_by' => $userId,
            ]);
        }

        return redirect()->back()->with('message', 'Product added to Cart!');
    }


    public function deleteCartItem(Request $request)
    {
        Log::info("Delete Request Received", $request->all());

        $cartItem = Carts::find($request->cart_item_id);

        if (!$cartItem) {
            Log::error("Cart Item Not Found: " . $request->cart_item_id);
            return response()->json(['success' => false, 'message' => 'Item not found'], 404);
        }

        $cartItem->deleted_at = now();  // Soft delete
        $cartItem->deleted_by = auth()->id();
        $cartItem->save();

        return response()->json(['success' => true, 'message' => 'Item deleted']);
    }



    public function mergeGuestCart()
    {
        if (Auth::check()) {
            $sessionId = Session::getId();
            $userId = Auth::id();

            // Transfer guest cart items to user account
            Carts::where('session_id', $sessionId)->update([
                'user_id' => $userId,
                'session_id' => null
            ]);

            // Remove guest session record
            GuestSession::where('session_id', $sessionId)->delete();
        }
    }

}