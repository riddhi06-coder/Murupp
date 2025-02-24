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
use App\Models\Permission;
use App\Models\UsersPermission;
use App\Models\ProductDetails;


class StockDetailsController extends Controller
{

    public function index()
    {

        $products = ProductDetails::whereNull('deleted_at')->wherenotNull('available_quantity')->select('id', 'product_name', 'available_quantity')->get();
        return view('backend.stock.index', compact('products'));
    }

    public function create(Request $request)
    { 
        $products = ProductDetails::whereNull('deleted_at')->select('id', 'product_name')->get();
        return view('backend.stock.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product' => 'required|exists:product_details,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $product = ProductDetails::findOrFail($request->product);

        $product->available_quantity = $request->quantity;
        $product->save();

        return redirect()->route('stock-details.index')->with('message', 'Stock updated successfully.');
    }

    public function edit($id)
    {
        $product = ProductDetails::findOrFail($id);

        return view('backend.stock.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0'
        ]);

        $product = ProductDetails::findOrFail($id);
        $product->available_quantity = $request->quantity;
        $product->save();

        return redirect()->route('stock-details.index')->with('message', 'Stock updated successfully.');
    }


}