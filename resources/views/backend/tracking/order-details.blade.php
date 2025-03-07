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
                        <h4 class="mt-4 text-primary">Customer Details</h4><br>
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
                                <td><strong>₹{{ number_format($order->total_price) }}</strong></td>
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
                                @endphp

                                @for ($i = 0; $i < count($productNames); $i++)
                                    <tr>
                                        <td>{{ $productNames[$i] }}</td>
                                        <td>
                                            <img src="{{ asset($images[$i]) }}" width="50" height="50" alt="Product Image">
                                        </td>
                                        <td>{{ $sizes[$i] }}</td>
                                        <td>{{ $quantities[$i] }}</td>
                                        <td><strong>₹{{ number_format($prices[$i], 2) }}</strong></td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>


                        <!-- Order Tracking Status Section -->
                        <h4 class="mt-5">Order Tracking Status</h4><br>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Updated By</th>
                                    <th>Updated At</th>
                                    <th>Delivery Date</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderTracking as $tracking)
                                    <tr>
                                        <td>{{ $tracking->updated_by_name ?? '-' }}</td>
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
                                        <td>{{ $tracking->order_remarks ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


            <!-- footer start-->
             @include('components.backend.footer')
      </div>
    </div>

    <!-- Scripts -->
    @include('components.backend.main-js')



</body>
</html>
