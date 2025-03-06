<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use Carbon\Carbon;
use App\Models\User;
use App\Models\OrderDetail;


class OrderTrackingController extends Controller
{

    public function index()
    {
        $data = OrderDetail::all();
        return view('backend.tracking.index', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:order_details,order_id',
            'order_status' => 'required',
            'delivery_date' => 'required|date',
            'remarks' => 'required|string|max:500',
        ], [
            'order_id.required' => 'Order ID is required.',
            'order_id.exists' => 'The selected Order ID does not exist in our records.',
            'order_status.required' => 'Please select an order status.',
            'delivery_date.required' => 'Please provide a tentative delivery date.',
            'delivery_date.date' => 'Invalid date format. Please select a valid date.',
            'remarks.required' => 'Remarks field is required.',
            'remarks.string' => 'Remarks should be a valid text.',
            'remarks.max' => 'Remarks should not exceed 500 characters.',
        ]);
    
        try {
    
            $order = OrderDetail::where('order_id', $request->order_id)->first();
    
            if (!$order) {
                return redirect()->back()->with('error', 'Order not found!');
            }
    
            $order->order_status = $request->order_status;
            $order->delivery_date = $request->delivery_date;
            $order->order_remarks = $request->remarks;
            $order->status_updated_at  = Carbon::now();
            $order->status_updated_by  = Auth::check() ? Auth::id() : null;
    
            $order->save();
    
    
            return redirect()->back()->with('message', 'Status updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }
    
    

}