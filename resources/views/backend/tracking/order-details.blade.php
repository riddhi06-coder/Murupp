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
                                <td><strong>₹{{ $order->total_price }}</strong></td>
                            </tr>
                            <tr>
                                <th>Current Status</th>
                                <td>
                                    @if($order->status == 0)
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($order->status == 1)
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <!-- Ordered Products Section -->
                        <h4 class="mt-4 text-primary">Products Details</h4><br>
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Size</th>
                                    <th>Image</th>
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
                                        <td>{{ $quantities[$i] }}</td>
                                        <td><strong>₹{{ $prices[$i] }}</strong></td>
                                        <td>{{ $sizes[$i] }}</td>
                                        <td>
                                            <img src="{{ asset($images[$i]) }}" width="50" height="50" alt="Product Image">
                                        </td>
                                    </tr>
                                @endfor
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
