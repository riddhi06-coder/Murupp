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
    // to fetch the user list for order tracking
    public function user_list()
    {
        $user_data = User::all();
        return view('backend.tracking.user-list', compact('user_data'));
    }

    // top fetch the particular order id details for the specific user
    public function userOrders($id)
    {
        $user = User::findOrFail($id); 
    
        // Fetch only the latest status for each order_id belonging to the user
        $data = OrderStatus::whereIn('id', function ($query) use ($id) {
                $query->selectRaw('MAX(id)')
                    ->from('order_status_details')
                    ->whereIn('order_id', function ($subQuery) use ($id) {
                        $subQuery->select('order_id')
                            ->from('order_details')
                            ->where('user_id', $id);
                    })
                    ->groupBy('order_id');
            })
            ->select('order_id', 'order_status', 'status_updated_at')
            ->get();
    
        // ✅ Fetch unique orders belonging to the user
        $uniqueOrders = OrderStatus::select('order_id')
            ->whereIn('order_id', function ($subQuery) use ($id) {
                $subQuery->select('order_id')
                    ->from('order_details')
                    ->where('user_id', $id);
            })
            ->distinct()
            ->get();
    
        // ✅ Fetch latest status for each order_id
        $latestStatuses = $data->keyBy('order_id');  // Index by order_id for quick lookup
    
        return view('backend.tracking.user-orders', compact('data', 'user', 'uniqueOrders', 'latestStatuses'));
    }
    
    // to update the status of the each respetive orders
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

            // Restriction: If the last status is "Cancelled", do not allow updates
            if ($latestOrder && $latestOrder->order_status === 'Cancelled') {
                return redirect()->back()->with('message', 'This order has been cancelled and cannot be updated.');
            }
        
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

    
    public function orderDetails($order_id)
    {
        // Fetch the order details where order_id matches
        $order = OrderDetail::where('order_id', $order_id)->firstOrFail();

        // Fetch the complete order tracking history
        $orderTracking = DB::table('order_status_details')
            ->leftJoin('users', 'order_status_details.status_updated_by', '=', 'users.id') // Join with users
            ->where('order_status_details.order_id', $order_id)
            ->orderBy('order_status_details.status_updated_at', 'asc')
            ->select('order_status_details.*', 'users.name as updated_by_name') // Fetch user name
            ->get();

        // Fetch the latest status update
        $orderTrackings = DB::table('order_status_details')
            ->leftJoin('users', 'order_status_details.status_updated_by', '=', 'users.id') // Join with users
            ->where('order_status_details.order_id', $order_id)
            ->orderBy('order_status_details.status_updated_at', 'desc')
            ->select('order_status_details.*', 'users.name as updated_by_name') // Fetch user name
            ->first(); // Get only the latest status update

        return view('backend.tracking.order-details', compact('order', 'orderTracking', 'orderTrackings'));
    }

    

    



    

}