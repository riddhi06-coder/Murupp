
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
                                    <figure class="img-product">
                                        <img src="images/New-Arrivals/1_2_11zon.webp" alt="product">
                                    </figure>
                                    <div class="content">
                                        <div class="badge">In Progress</div>
                                        <h6 class="mt-8 fw-5">Order #17493</h6>
                                    </div>
                                </div>
                                <div class="tf-grid-layout md-col-2 gap-15">
                                    <div class="item">
                                        <div class="text-2 text_black-2">Item</div>
                                        <div class="text-2 mt_4 fw-6">Fashion</div>
                                    </div>
                                    <div class="item">
                                        <div class="text-2 text_black-2">Courier</div>
                                        <div class="text-2 mt_4 fw-6">Ribbed modal T-shirt</div>
                                    </div>
                                    <div class="item">
                                        <div class="text-2 text_black-2">Start Time</div>
                                        <div class="text-2 mt_4 fw-6">04 September 2024, 13:30:23</div>
                                    </div>
                                    <div class="item">
                                        <div class="text-2 text_black-2">Address</div>
                                        <div class="text-2 mt_4 fw-6">1234 Fashion Street, Suite 567, New York</div>
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
                                                    <li>
                                                        <div class="timeline-badge success"></div>
                                                        <div class="timeline-box">
                                                            <a class="timeline-panel" href="javascript:void(0);">
                                                                <div class="text-2 fw-6">Product Shipped</div>
                                                                <span>10/07/2024 4:30pm</span>
                                                            </a>
                                                            <p><strong>Courier Service : </strong>FedEx World Service Center</p>
                                                            <p><strong>Estimated Delivery Date : </strong>12/07/2024</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="timeline-badge success"></div>
                                                        <div class="timeline-box">
                                                            <a class="timeline-panel" href="javascript:void(0);">
                                                                <div class="text-2 fw-6">Product Shipped</div>
                                                                <span>10/07/2024 4:30pm</span>
                                                            </a>
                                                            <p><strong>Tracking Number : </strong>2307-3215-6759</p>
                                                            <p><strong>Warehouse : </strong>T-Shirt 10b</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="timeline-badge"></div>
                                                        <div class="timeline-box">
                                                            <a class="timeline-panel" href="javascript:void(0);">
                                                                <div class="text-2 fw-6">Product Packaging</div>
                                                                <span>12/07/2024 4:34pm</span>
                                                            </a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="timeline-badge"></div>
                                                        <div class="timeline-box">
                                                            <a class="timeline-panel" href="javascript:void(0);">
                                                                <div class="text-2 fw-6">Order Placed</div>
                                                                <span>11/07/2024 2:36pm</span>
                                                            </a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="widget-content-inner">
                                            <div class="order-head">
                                                <figure class="img-product">
                                                    <img src="images/New-Arrivals/1_2_11zon.webp" alt="product">
                                                </figure>
                                                <div class="content">
                                                    <div class="text-2 fw-6">SAA Tiered Midi Dress</div>
                                                    <div class="mt_4"><span class="fw-6">Price :</span> <i class="fa fa-inr" aria-hidden="true"></i> 14,000</div>
                                                    <div class="mt_4"><span class="fw-6">Size :</span> XL</div>
                                                </div>
                                            </div>
                                            <ul>
                                                <li class="d-flex justify-content-between text-2">
                                                    <span>Total Price</span>
                                                    <span class="fw-6">14,000</span>
                                                </li>
    
                                                <li class="d-flex justify-content-between text-2 mt_8">
                                                    <span>Order Total</span>
                                                    <span class="fw-6">24,000</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="widget-content-inner">
                                            <p>Our courier service is dedicated to providing fast, reliable, and secure delivery solutions tailored to meet your needs. Whether you're sending documents, parcels, or larger shipments, our team ensures that your items are handled with the utmost care and delivered on time. With a commitment to customer satisfaction, real-time tracking, and a wide network of routes, we make it easy for you to send and receive packages both locally and internationally. Choose our service for a seamless and efficient delivery experience.</p>
                                        </div>
                                        <div class="widget-content-inner">
                                            <p class="text-2 text-success">Thank you Your order has been received</p>
                                            <ul class="mt_20">
                                                <li>Order Number : <span class="fw-7">#17493</span></li>
                                                <li>Date : <span class="fw-7"> 17/07/2025, 02:34pm</span></li>
                                                <li>Total : <span class="fw-7"><i class="fa fa-inr" aria-hidden="true"></i> 24,0000</span></li>
                                                <li>Payment Methods : <span class="fw-7">Cash on Delivery</span></li>
    
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



</body>

</html>