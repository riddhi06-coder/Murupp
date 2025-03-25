
<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>
	   

<body class="preload-wrapper">

        @include('components.frontend.header')


        
        <!-- page-title -->
        <div class="page-title" style="background-image: url(images/section/page-title.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">My Account</h3>
                        <ul class="breadcrumbs d-flex align-items-center">
                            <li>
                                <a class="link" href="{{ route('frontend.index') }}">Home</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                My Account
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title -->


        <!-- my-account -->
        <section class="flat-spacing">
            <div class="container">
                <div class="my-account-wrap">
                    <div class="wrap-sidebar-account">
                        <div class="sidebar-account">
                            <div class="account-avatar">
                            <div class="image">
                                <img src="{{ $user->image ? asset('uploads/profile_pictures/' . $user->image) : asset('frontend/assets/images/user-account.png') }}" 
                                    alt="Profile Picture">
                            </div>

                                @if(Auth::check())
                                    <h6 class="mb_4">{{ $user->name }} {{ $user->last_name }}</h6>
                                    <div class="body-text-1">{{ $user->email }}</div>
                                @endif
                            </div>
                            <ul class="my-account-nav">
                                <li>
                                    <a href="{{ route('my.account') }}" class="my-account-nav-item">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Account Details
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('my.account.orders') }}" class="my-account-nav-item active">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Your Orders
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.logout') }}" class="my-account-nav-item">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M16 17L21 12L16 7" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M21 12H9" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Logout
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>


                    <div class="my-account-content">
                        <div class="account-order-details">
                            <div class="wd-form-order">
                            <div class="order-head">
                                <div class="content">
                                <div class="">
                                    @php
                                        $latestStatus = $orderStatuses->sortByDesc('status_updated_at')->first();
                                    @endphp

                                    @if($latestStatus)
                                        @if($latestStatus->order_status == 'Order Placed')
                                            <span class="badge bg-warning">Order Placed</span>
                                        @elseif($latestStatus->order_status == 'Processing')
                                            <span class="badge bg-primary">Processing</span>
                                        @elseif($latestStatus->order_status == 'Shipped')
                                            <span class="badge bg-info">Shipped</span>
                                        @elseif($latestStatus->order_status == 'Delivered')
                                            <span class="badge bg-success">Delivered</span>
                                        @elseif($latestStatus->order_status == 'Completed')
                                            <span class="badge bg-dark">Completed</span>
                                        @elseif($latestStatus->order_status == 'Cancelled')
                                            <span class="badge bg-danger">Cancelled</span>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">Pending</span>
                                    @endif
                                </div>

                                    <h6 class="mt-8 fw-5">Order Id: {{ $order->order_id }}</h6>
                                </div>
                            </div>

                            <div class="tf-grid-layout md-col-2 gap-15">
                                <div class="item">
                                    <div class="text-2 text_black-2 fw-6">Customer Name</div>
                                    <div class="text-2 mt_4">{{ $order->customer_name ?? '-' }}</div>
                                </div>
                                <div class="item">
                                    <div class="text-2 text_black-2 fw-6">Customer Email</div>
                                    <div class="text-2 mt_4">{{ $order->customer_email ?? '-' }}</div>
                                </div>
                                <div class="item">
                                    <div class="text-2 text_black-2 fw-6">Customer Phone</div>
                                    <div class="text-2 mt_4">{{ $order->customer_phone ?? '-' }}</div>
                                </div>
                                <div class="item">
                                    <div class="text-2 text_black-2 fw-6">Billing Address</div>
                                    <div class="text-2 mt_4">{{ $order->billing_address ?? '-' }}</div>
                                </div>
                                <div class="item">
                                    <div class="text-2 text_black-2 fw-6">Shipping Address</div>
                                    <div class="text-2 mt_4">{{ $order->shipping_address ?? '-' }}</div>
                                </div>
                            </div>

                                <div class="widget-tabs style-3 widget-order-tab">
                                        <ul class="widget-menu-tab">
                                            <li class="item-title active">
                                                <span class="inner">Order History</span>
                                            </li>
                                            <li class="item-title">
                                                <span class="inner">Item Details</span>
                                            </li>
                                            <li class="item-title">
                                                <span class="inner">Courier</span>
                                            </li>
                                            <li class="item-title">
                                                <span class="inner">Receiver</span>
                                            </li>
                                        </ul>
                                        <div class="widget-content-tab">
                                            <div class="widget-content-inner active">
                                            <div class="widget-timeline">
                                            <ul class="timeline">
                                            @php
                                                $allStatuses = ['Order Placed', 'Processing', 'Shipped', 'Delivered', 'Completed'];
                                                $updatedStatuses = $orderStatuses->pluck('order_status')->toArray();
                                            @endphp

                                            @foreach($allStatuses as $status)
                                                @php
                                                    $statusRecord = $orderStatuses->firstWhere('order_status', $status);
                                                    $isActive = in_array($status, $updatedStatuses);
                                                @endphp

                                                <li>
                                                    <div class="timeline-badge {{ $isActive ? ($status == 'Cancelled' ? 'danger' : 'success') : '' }}"></div>
                                                    <div class="timeline-box">
                                                        <a class="timeline-panel" href="javascript:void(0);">
                                                            <div class="text-2 fw-6">{{ $status }}</div>
                                                            
                                                            @if($isActive)
                                                                <span>{{ \Carbon\Carbon::parse($statusRecord->status_updated_at)->format('d/m/Y h:ia') }}</span>
                                                            @else
                                                                <!-- <span class="text-muted">Pending</span> -->
                                                            @endif
                                                        </a>

                                                        @if($isActive && $status == 'Shipped')
                                                            <p><strong>Estimated Delivery Date : </strong>{{ $statusRecord->delivery_date ? \Carbon\Carbon::parse($statusRecord->delivery_date)->format('d/m/Y') : 'N/A' }}</p>
                                                        @endif

                                                        @if($isActive && $statusRecord->order_remarks)
                                                            <p><strong>Remarks : </strong>{{ $statusRecord->order_remarks }}</p>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach
                                            </ul>
                                            </div>
                                            @if($isCancelled)
                                                <div class="alert alert-danger">
                                                    <strong>Note:</strong> This order has been <strong>Cancelled</strong> and cannot be updated further.
                                                </div>
                                            @endif

                                        </div>


                                        <div class="widget-content-inner">
                                            @php
                                                // Decode the JSON stored in the database
                                                $images = json_decode($order->images, true) ?? [];
                                                $productNames = json_decode($order->product_names, true) ?? [];
                                                $quantities = json_decode($order->quantities, true) ?? [];
                                                $prices = json_decode($order->prices, true) ?? [];
                                                $size = json_decode($order->sizes, true) ?? [];

                                                // Ensure all arrays have the same length
                                                $totalItems = count($productNames);
                                            @endphp

                                            @for ($i = 0; $i < $totalItems; $i++)
                                                <div class="order-head">
                                                <figure class="img-product">
                                                    <img src="{{ $images[$i] ?? asset('default.jpg') }}" alt="product" class="product-image">
                                                </figure>

                                                    <div class="content">
                                                        <div class="text-2 fw-6">{{ $productNames[$i] }}</div>
                                                        <div class="mt_4"><span class="fw-6">Price :</span> <i class="fa fa-inr" aria-hidden="true"></i> {{ number_format_indian($prices[$i] ?? 0) }}</div>
                                                        <div class="mt_4"><span class="fw-6">Size :</span> {{ $size[$i] ?? '' }}</div>
                                                        <div class="mt_4"><span class="fw-6">Quantity :</span> {{ $quantities[$i] ?? '' }}</div>
                                                    </div>
                                                </div>
                                            @endfor
                                            
                                            @php
                                                $pricesArray = json_decode($order->prices, true) ?? [];
                                                $priceValue = !empty($pricesArray) ? (float) $pricesArray[0] : 0;
                                                $totalPrice = is_numeric($order->total_price) ? (float) $order->total_price : 0;
                                            @endphp

                                            <ul>
                                                <li class="d-flex justify-content-between text-2">
                                                    <span>Total Price</span>
                                                    <span class="fw-6">
                                                        <i class="fa fa-inr" aria-hidden="true"></i> {{ number_format_indian($totalPrice) }}
                                                    </span>
                                                </li>
                                                <li class="d-flex justify-content-between text-2">
                                                    <span>Order Total</span>
                                                    <span class="fw-6">
                                                        <i class="fa fa-inr" aria-hidden="true"></i> {{ number_format_indian($totalPrice) }}
                                                    </span>
                                                </li>
                                            </ul>

                                        </div>

                                        <div class="widget-content-inner">
                                            <p>Our courier service is dedicated to providing fast, reliable, and secure delivery solutions tailored to meet your needs. Whether you're sending documents, parcels, or larger shipments, our team ensures that your items are handled with the utmost care and delivered on time. With a commitment to customer satisfaction, real-time tracking, and a wide network of routes, we make it easy for you to send and receive packages both locally and internationally. Choose our service for a seamless and efficient delivery experience.</p>
                                        </div>
                                            <div class="widget-content-inner">
                                                <p class="text-2 text-success">Thank you! Your order has been received</p>
                                                <ul class="mt_20">
                                                    <li>Order Number: <span class="fw-7">{{ $order->order_id ?? 'N/A' }}</span></li>
                                                    <li>Date: <span class="fw-7"> 
                                                        {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y, h:i A') ?? 'N/A' }}
                                                    </span></li>
                                                    <li>Total: <span class="fw-7"><i class="fa fa-inr" aria-hidden="true"></i> {{ number_format_indian($order->total_price ?? 0) }}</span></li>
                                                    <li>Payment Method: <span class="fw-7"> Online Payment</span></li>
                                                </ul>
                                            </div>

    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /my-account -->

        @include('components.frontend.footer')

        @include('components.frontend.main-js')

         <!-----Number format function---->
         <script>
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
        </script>



</body>

</html>