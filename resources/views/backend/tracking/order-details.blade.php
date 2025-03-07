<!doctype html>
<html lang="en">
<head>
    @include('components.backend.head')
</head>

<body>
    <!-- Header -->
    @include('components.backend.header')

    <!-- Sidebar -->
    @include('components.backend.sidebar')

    @php
        function number_format_indian($num) {
            $num = round($num);
            $num = (string) $num;
            $len = strlen($num);

            if ($len <= 3) {
                return $num;
            }

            $lastThree = substr($num, -3);
            $remaining = substr($num, 0, -3);
            $remaining = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $remaining);

            return $remaining . ',' . $lastThree;
        }
    @endphp

     <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
               
                  <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Order Details List</li>
                            </ol>
                        </nav>
					</div>

                    <div class="card-header">
                            <h4 class="mb-3">Order ID: <strong>{{ $order->order_id }}</strong></h4>
                    </div>
                             
                    <div class="table-responsive custom-scrollbar">
                        <!-- Order Details Section -->
                        <h4 class="mt-4">Customer Details</h4><br>
                        <table class="table table-bordered mb-5"> <!-- Added mb-5 for spacing -->
                            <tr>
                                <th>Customer Name</th>
                                <td>{{ $order->customer_name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $order->customer_email }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $order->customer_phone }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $order->address }}</td>
                            </tr>
                            <tr>
                                <th>Total Price</th>
                                <td><strong>₹{{ number_format_indian($order->total_price) }}</strong></td>
                            </tr>
                            <tr>
                                <th>Current Status</th>
                                <td>
                                    @if($orderTrackings->order_status == 'Order Placed')
                                        <span class="badge bg-warning">Order Placed</span>
                                    @elseif($orderTrackings->order_status == 'Processing')
                                        <span class="badge bg-primary">Processing</span>
                                    @elseif($orderTrackings->order_status == 'Shipped')
                                        <span class="badge bg-info">Shipped</span>
                                    @elseif($orderTrackings->order_status == 'Delivered')
                                        <span class="badge bg-success">Delivered</span>
                                    @elseif($orderTrackings->order_status == 'Completed')
                                        <span class="badge bg-dark">Completed</span>
                                    @elseif($orderTrackings->order_status == 'Cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($orderTrackings->order_status) }}</span>
                                    @endif
                                </td>

                            </tr>
                        </table>

                        <!-- Ordered Products Section -->
                        <h4 class="mt-4">Products Details</h4><br>
                        <table class="table table-bordered">
                            <thead class="">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Image</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $productNames = json_decode($order->product_names, true) ?? [];
                                    $quantities = json_decode($order->quantities, true) ?? [];
                                    $prices = json_decode($order->prices, true) ?? [];
                                    $sizes = json_decode($order->sizes, true) ?? [];
                                    $images = json_decode($order->images, true) ?? [];
                                    $totalPrice = 0;
                                @endphp

                                @for ($i = 0; $i < count($productNames); $i++)
                                    <!-- @php
                                        $totalPrice += $prices[$i] * $quantities[$i]; // Calculate total price
                                    @endphp -->
                                    <tr>
                                        <td>{{ $productNames[$i] }}</td>
                                        <td>
                                            <img src="{{ asset($images[$i]) }}" width="50" height="50" alt="Product Image">
                                        </td>
                                        <td>{{ $sizes[$i] }}</td>
                                        <td>{{ $quantities[$i] }}</td>
                                        <td><strong>₹{{ number_format_indian($prices[$i]) }}</strong></td>
                                    </tr>
                                @endfor

                                <!-- Total Price Row -->
                                <tr>
                                    <td colspan="4" class="text-end"><strong>Total Price:</strong></td>
                                    <td><strong>₹{{ number_format_indian($order->total_price) }}</strong></td>
                                </tr>
                            </tbody>
                            </table>



                        <!-- Order Tracking Status Section -->
                        <h4 class="mt-5">Order Tracking Status</h4><br>

                        <div class="d-flex justify-content-end">
                            <a href="#" class="btn btn-primary px-5 radius-30 update-status-btn"
                            data-bs-toggle="modal" 
                            data-bs-target="#updateOrderModal"
                            data-order-id="{{ $order->order_id }}"
                            data-order-status="{{ $orderTrackings->order_status ?? '' }}"
                            data-delivery-date="{{ $orderTrackings->delivery_date ?? '' }}">
                                Update Status
                            </a>
                        </div><br>


                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Updated At</th>
                                    <th>Delivery Date</th>
                                    <th>Status</th>
                                    <th>Updated By</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderTracking as $tracking)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($tracking->status_updated_at)->format('d-m-Y H:i:s') }}</td>
                                        <td>{{ $tracking->delivery_date ? \Carbon\Carbon::parse($tracking->delivery_date)->format('d-m-Y') : '-' }}</td>
                                        <td>
                                            @if($tracking->order_status == 'Order Placed')
                                                <span class="badge bg-warning">Order Placed</span>
                                            @elseif($tracking->order_status == 'Processing')
                                                <span class="badge bg-primary">Processing</span>
                                            @elseif($tracking->order_status == 'Shipped')
                                                <span class="badge bg-info">Shipped</span>
                                            @elseif($tracking->order_status == 'Delivered')
                                                <span class="badge bg-success">Delivered</span>
                                            @elseif($tracking->order_status == 'Completed')
                                                <span class="badge bg-dark">Completed</span>
                                            @elseif($tracking->order_status == 'Cancelled')
                                                <span class="badge bg-danger">Cancelled</span>
                                            @else
                                                <span class="badge bg-secondary">{{ ucfirst($tracking->order_status) }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $tracking->updated_by_name ?? '-' }}</td>
                                        <td>{{ $tracking->order_remarks ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div><br><br>
                    <!-- Form Actions -->
                    <div class="col-12 text-end">
                        <a href="{{ route('order-tracking.user', ['id' => Auth::id()]) }}" class="btn btn-danger px-4">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


          <!-- Update Order Modal -->
          <div class="modal fade" id="updateOrderModal" tabindex="-1" aria-labelledby="updateOrderModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateOrderModalLabel">Update Order Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="updateOrderForm" method="POST" action="{{ route('order.update') }}">
                        @csrf
                        <div class="modal-body">

                            <!-- Order ID Field (Readonly) -->
                            <div class="mb-3">
                                <label for="orderId" class="form-label">Order ID <span class="txt-danger">*</span></label>
                                <input type="text" class="form-control" id="orderId" name="order_id" readonly>
                            </div>

                            <!-- Order Status Dropdown -->
                            <div class="mb-3">
                                <label for="orderStatus" class="form-label">Order Status <span class="txt-danger">*</span></label>
                                <select class="form-select" id="orderStatus" name="order_status" required>
                                    <option value=" ">Select Status</option>
                                    <option value="Order Placed">Order Placed</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>

                            <!-- Delivery Date -->
                            <div class="mb-3">
                                <label for="deliveryDate" class="form-label">Tentative Delivery Date</label>
                                <input type="date" class="form-control" id="deliveryDate" name="delivery_date" >
                            </div>

                            <!-- Remarks -->
                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

            <!-- footer start-->
             @include('components.backend.footer')
      </div>
    </div>

    <!-- Scripts -->
    @include('components.backend.main-js')


      <!-----to auto fetch the latest status as per the order id selectdd--->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                console.log("Script Loaded!");

                let updateButtons = document.querySelectorAll(".update-status-btn");
                let orderIdField = document.getElementById("orderId");
                let orderStatusDropdown = document.getElementById("orderStatus");
                let deliveryDateField = document.getElementById("deliveryDate");

                updateButtons.forEach(button => {
                    button.addEventListener("click", function () {
                        let orderId = this.getAttribute("data-order-id");
                        let orderStatus = this.getAttribute("data-order-status");
                        let deliveryDate = this.getAttribute("data-delivery-date");

                        console.log("Selected Order ID:", orderId);
                        console.log("Latest Order Status:", orderStatus);
                        console.log("Delivery Date:", deliveryDate);

                        if (orderIdField) orderIdField.value = orderId;
                        if (orderStatusDropdown) orderStatusDropdown.value = orderStatus;
                        if (deliveryDateField) deliveryDateField.value = deliveryDate;
                    });
                });
            });
        </script>





</body>
</html>
