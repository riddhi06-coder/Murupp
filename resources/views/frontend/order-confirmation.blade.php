<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>
	
    <style>
        .tf-page-cart-checkout-1 {
            padding-left: 15px;
            padding-right: 30px;
            padding-top: 7px;
        }
        
        hr {
            margin-bottom: 0px;
        }
    </style>

<body class="preload-wrapper">

        @include('components.frontend.header')


        <!-- /page-title -->
        <div class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">Order Confirmation</h3>
                        <ul class="breadcrumbs d-flex align-items-center">
                            <li>
                                <a class="link" href="{{ route('frontend.index') }}">Home</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                <a class="link" href="#">Shop</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                Order Confirmation
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title -->


        <!-- Order Confirmation -->
        <section class="flat-spacing">
            <div class="container">
                <div class="row justify-content-center">
                    
                    <div class="col-lg-6">
                        <img class="text-center confirm-logo" src="{{ asset('frontend/assets/images/approval-symbol-in-badge.svg') }}"/>
                        <h3 class="heading text-center">Thank You for Your Purchase!</h3>
                        <p class="text-center">
                            Your order has been successfully placed. A confirmation email has been sent to 
                            <a href="mailto:{{ $order->customer_email }}">{{ $order->customer_email }}</a>.
                        </p>

                        <hr>
                        
                        <!-- <h5 class="fw-5 mb_20">Customer Details</h5> -->
                        <!-- <div class="tf-page-cart-checkout-1">
                            <div class="d-flex align-items-center justify-content-between mb_15">
                                <div class="fs-18">Name</div>
                                <p>John Doe</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb_15">
                                <div class="fs-18">Email Id</div>
                                <p>johndoe@example.com</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb_15">
                                <div class="fs-18">Number</div>
                                <p>+1 234 567 890</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb_15">
                                <div class="fs-18">Shipping Address</div>
                                <p>1234 Elm Street, Springfield, USA</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb_15">
                                <div class="fs-18">Billing Address</div>
                                <p>5678 Oak Street, Springfield, USA</p>
                            </div>
                        </div> -->

                        <h5 class="fw-5 mt_20 mb_20">Order Summary</h5>
                        @php
                            // Decode the JSON-encoded fields
                            $productNames = json_decode($order->product_names, true) ?? [];
                            $quantities = json_decode($order->quantities, true) ?? [];
                            $prices = json_decode($order->prices, true) ?? [];
                            $sizes = json_decode($order->sizes, true) ?? [];
                            $prints = json_decode($order->prints, true) ?? [];
                        @endphp

                        <!-- Order ID (Displayed Once) -->
                        <div class="tf-page-cart-checkout-1">
                            <div class="d-flex align-items-center justify-content-between mb_15 mt-5">
                                <div class="fs-18">Order Id</div>
                                <p>#{{ $order->order_id }}</p>
                            </div>
                            <hr>
                        </div>
                       
                        <!-- Loop Through Each Product -->
                        @foreach($productNames as $index => $productName)
                            <div class="tf-page-cart-checkout-1">
                                <div class="d-flex align-items-center justify-content-between mb_15">
                                    <div class="fs-18">Product</div>
                                    <p>{{ $productName ?? 'N/A' }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb_15">
                                    <div class="fs-18">Quantity</div>
                                    <p>{{ $quantities[$index] ?? 'N/A' }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb_15">
                                    <div class="fs-18">Size</div>
                                    <p>{{ $sizes[$index] ?? '-' }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb_15">
                                    <div class="fs-18">Print Option</div>
                                    <p>{{ $prints[$index] ?? 'Front & Back Print' }}</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb_15">
                                    <div class="fs-18">Price</div>
                                    <p>
                                        <i class="fa fa-inr" aria-hidden="true"></i> 
                                        {{ number_format($prices[$index] ?? '-') }} INR
                                    </p>
                                </div>
                                <hr>
                            </div>
                        @endforeach
                        
                       
                        <!-- Total Price (Displayed Once) -->
                        <div class="tf-page-cart-checkout-1">
                            <div class="d-flex align-items-center justify-content-between mb_15">
                                <div class="fs-18">Total</div>
                                <p>
                                    <i class="fa fa-inr" aria-hidden="true"></i> 
                                    {{ number_format($order->total_price ?? 0, 2) }} INR
                                </p>
                                
                            </div>  
                            <hr>                           
                        </div>

                        <div class="text-center mt_20">
                            <a href="{{ route('frontend.index') }}" class="tf-btn btn-fill radius-4"><span class="text">Continue Shopping</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Order Confirmation -->


        @include('components.frontend.footer')

        @include('components.frontend.main-js')


</body>

</html>