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
use App\Models\OrderStatus;


class OrderTrackingController extends Controller
{

    public function index()
    {
        $data = OrderStatus::all();

        $uniqueOrders = OrderStatus::select('order_id')->distinct()->get();

        // Fetch latest order status for each order_id
        $latestStatuses = OrderStatus::select('order_id', 'order_status')
                            ->whereIn('id', function ($query) {
                                $query->selectRaw('MAX(id)')->from('order_status_details')->groupBy('order_id');
                            })->get()->keyBy('order_id');

        return view('backend.tracking.index', compact('data','uniqueOrders','latestStatuses'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:order_details,order_id',
            'order_status' => 'required',
            'delivery_date' => 'nullable|date',
            'remarks' => 'nullable|string|max:500',
        ], [
            'order_id.required' => 'Order ID is required.',
            'order_id.exists' => 'The selected Order ID does not exist in our records.',
            'order_status.required' => 'Please select an order status.',
            'delivery_date.date' => 'Invalid date format. Please select a valid date.',
            'remarks.string' => 'Remarks should be a valid text.',
            'remarks.max' => 'Remarks should not exceed 500 characters.',
        ]);
    
        try {
            // Fetch the latest record for the given order_id
            $latestOrder = OrderStatus::where('order_id', $request->order_id)
                ->latest('status_updated_at')
                ->first();
    
            // Check if the latest status is the same as the new one
            if ($latestOrder && $latestOrder->order_status === $request->order_status) {
                return redirect()->back()->with('message', 'Similar Status cannot be updated again!');
            }
    
            // Insert new record with user_id from the latest entry
            OrderStatus::create([
                'user_id'          => $latestOrder ? $latestOrder->user_id : (Auth::check() ? Auth::id() : null),
                'order_id'         => $request->order_id,
                'order_status'     => $request->order_status,
                'delivery_date'    => $request->delivery_date,
                'order_remarks'    => $request->remarks,
                'status_updated_at'=> Carbon::now(),
                'status_updated_by'=> Auth::check() ? Auth::id() : null,
            ]);
    
            return redirect()->back()->with('message', 'Status updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'Something went wrong! ' . $e->getMessage());
        }
    }
    

    

}