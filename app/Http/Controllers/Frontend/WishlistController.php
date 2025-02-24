<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\ProductDetails;
use App\Models\Wishlist;



class WishlistController extends Controller
{

    public function add($id)
    {
        $product = ProductDetails::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $userId = Auth::id();

        $existingWishlist = Wishlist::where('user_id', $userId)
                                    ->where('product_id', $id)
                                    ->first();

        if ($existingWishlist) {
            $existingWishlist->increment('quantity');
            $existingWishlist->update([
                'modified_at' => Carbon::now(),
                'modified_by' => $userId, 
            ]);
            return redirect()->back()->with('message', 'Product added to wishlist');
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $id,
                'quantity' => 1,
                'inserted_at' => Carbon::now(),
                'inserted_by' => $userId,
            ]);

            return redirect()->back()->with('message', 'Product added to wishlist!');
        }
    }
}
