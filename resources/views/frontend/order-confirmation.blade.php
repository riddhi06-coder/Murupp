<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>
	   

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
                        <p class="text-center">Your order has been successfully placed. A confirmation email has been sent to <a href="mailto:johndoe@example.com">johndoe@example.com.</a></p>
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
                        <div class="tf-page-cart-checkout-1">
                            <div class="d-flex align-items-center justify-content-between mb_15">
                            <div class="fs-18">Order Id</div>
                            <p>#123456</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb_15">
                            <div class="fs-18">Product</div>
                            <p>SAA Tiered Midi Dress</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb_15">
                            <div class="fs-18">Quantity</div>
                            <p>2</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb_15">
                            <div class="fs-18">Size/Color</div>
                            <p>M / Red</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb_15">
                            <div class="fs-18">Print Option</div>
                            <p>Front & Back Print</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb_15">
                            <div class="fs-18">Price</div>
                            <p><i class="fa fa-inr" aria-hidden="true"></i> 17,000 INR </p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb_15">
                            <div class="fs-18">Total</div>
                            <p><i class="fa fa-inr" aria-hidden="true"></i> 18,000 INR </p>
                        </div>
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