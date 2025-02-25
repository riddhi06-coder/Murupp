<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>
	   

<body class="preload-wrapper">

        @include('components.frontend.header')


        <!-- page-title -->
        <div class="page-title">
            <div class="container">
                <h3 class="heading text-center">Check Out</h3>
                <ul class="breadcrumbs d-flex align-items-center">
                    <li><a class="link" href="index.html">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li><a class="link" href="shop-default-grid.html">Shop</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li>View Cart</li>
                </ul>
            </div>
        </div>
        <!-- /page-title -->

        
        <!-- Section checkout -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="flat-spacing tf-page-checkout">
                            <div class="wrap">
                                <div class="title-login">
                                    <p>Already have an account?</p>
                                    <a href="login.html" class="text-button">Login here</a>
                                </div>
                                <form class="login-box">
                                    <div class="grid-2">
                                        <input type="text" placeholder="Your name/Email">
                                        <input type="password" placeholder="Password">
                                    </div>
                                    <button class="tf-btn" type="submit"><span class="text">Login</span></button>
                                </form>
                            </div>
                            <div class="wrap">
                                <h5 class="title">Information</h5>
                                <form class="info-box">
                                    <div class="grid-2">
                                        <input type="text" placeholder="First Name*">
                                        <input type="text" placeholder="Last Name*">
                                    </div>
                                    <div class="grid-2">
                                        <input type="text" placeholder="Email Address*">
                                        <input type="text" placeholder="Phone Number*">
                                    </div>
                                    <div class="tf-select">
                                        <select class="text-title" name="address[country]" data-default="">
                                            <option selected value="Choose Country/Region" data-provinces="[]">Choose Country/Region</option>
                                            <option value="United States">United States</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Czech Republic">Czechia</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Vietnam">Vietnam</option>
                                        </select>
                                    </div>
                                    <div class="grid-2">
                                        <input type="text" placeholder="Town/City*">
                                        <input type="text" placeholder="Street,...">
                                    </div>
                                    <div class="grid-2">
                                        <div class="tf-select">
                                            <select class="text-title">
                                                <option selected value="Choose State">Choose State</option>
                                                <option value="California">California</option>
                                                <option value="Alabama">Alabam</option>
                                                <option value="Alaska">Alaska</option>
                                                <option value="Arizona">Arizona</option>
                                                <option value="Arkansas">Arkansas</option>
                                                <option value="Florida">Florida</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Hawaii">Hawaii</option>
                                                <option value="Washington">Washington</option>
                                                <option value="Texas">Texas</option>
                                                <option value="Iowa">Iowa</option>
                                                <option value="Nevada">Nevada</option>
                                                <option value="Illinois">Illinois</option>
                                            </select>
                                        </div>
                                        <input type="text" placeholder="Postal Code*">
                                    </div>
                                    <textarea placeholder="Write note..."></textarea>
                                </form>
                            </div>
                            <div class="wrap">
                                <h5 class="title">Choose payment Option:</h5>
                                <form class="form-payment">
                                    <div class="payment-box" id="payment-box">
                                        <div class="payment-item payment-choose-card active">
                                            <label for="credit-card-method" class="payment-header" data-bs-toggle="collapse" data-bs-target="#credit-card-payment" aria-controls="credit-card-payment">
                                                <input type="radio" name="payment-method" class="tf-check-rounded" id="credit-card-method" checked>
                                                <span class="text-title">Credit Card</span>
                                            </label>
                                            <div id="credit-card-payment" class="collapse show" data-bs-parent="#payment-box">
                                                <div class="payment-body">
                                                    <p class="text-secondary">Make your payment directly into our bank account. Your order will not be shipped until the funds have cleared in our account.</p>
                                                    <div class="input-payment-box">
                                                        <input type="text" placeholder="Name On Card*">
                                                        <div class="ip-card">
                                                            <input type="text" placeholder="Card Numbers*">
                                                            <div class="list-card">
                                                                <img src="images/payment/img-7.png" width="48" height="16" alt="card">
                                                                <img src="images/payment/img-8.png" width="21" height="16" alt="card">
                                                                <img src="images/payment/img-9.png" width="22" height="16" alt="card">
                                                                <img src="images/payment/img-10.png" width="24" height="16" alt="card">
                                                            </div>
                                                        </div>
                                                        <div class="grid-2">
                                                            <input type="date" >
                                                            <input type="text" placeholder="CVV*">
                                                        </div>
                                                    </div>
                                                    <div class="check-save">
                                                        <input type="checkbox" class="tf-check" id="check-card" checked>
                                                        <label for="check-card">Save Card Details</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="payment-item">
                                            <label for="delivery-method" class="payment-header collapsed" data-bs-toggle="collapse" data-bs-target="#delivery-payment" aria-controls="delivery-payment">
                                                <input type="radio" name="payment-method" class="tf-check-rounded" id="delivery-method">
                                                <span class="text-title">Cash on delivery</span>
                                            </label>
                                            <div id="delivery-payment" class="collapse" data-bs-parent="#payment-box"></div>
                                        </div>
                                        <div class="payment-item">
                                            <label for="apple-method" class="payment-header collapsed" data-bs-toggle="collapse" data-bs-target="#apple-payment" aria-controls="apple-payment">
                                                <input type="radio" name="payment-method" class="tf-check-rounded" id="apple-method">
                                                <span class="text-title apple-pay-title"><img src="images/payment/applePay.png" alt="apple"> Apple Pay</span>
                                            </label>
                                            <div id="apple-payment" class="collapse" data-bs-parent="#payment-box"></div>
                                        </div>
                                        <div class="payment-item paypal-item">
                                            <label for="paypal-method" class="payment-header collapsed" data-bs-toggle="collapse" data-bs-target="#paypal-method-payment" aria-controls="paypal-method-payment">
                                                <input type="radio" name="payment-method" class="tf-check-rounded" id="paypal-method">
                                                <span class="paypal-title"><img src="images/payment/paypal.png" alt="apple"></span>
                                            </label>
                                            <div id="paypal-method-payment" class="collapse" data-bs-parent="#payment-box"></div>
                                        </div>
                                    </div>
                                    <button class="tf-btn btn-reset">Payment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-1">
                        <div class="line-separation"></div>
                    </div>
                    <div class="col-xl-5">
                        <div class="flat-spacing flat-sidebar-checkout">
                            <div class="sidebar-checkout-content">
                                <h5 class="title">Shopping Cart</h5>
                                <div class="list-product">
                                    <div class="item-product">
                                        <a href="product-detail.html" class="img-product">
                                            <img src="images/New-Arrivals/3_4_11zon.webp" alt="img-product">
                                        </a>
                                        <div class="content-box">
                                            <div class="info">
                                                <a href="product-detail.html" class="name-product link text-title">RI Bowknot Dress</a>
                                                <div class="variant text-caption-1 text-secondary"><span class="size">XL</span>/<span class="color">Blue</span></div>
                                            </div>
                                            <div class="total-price text-button"><span class="price"><i class="fa fa-inr" aria-hidden="true"></i> 6,000</span></div>
                                        </div>
                                    </div>
                                    <div class="item-product">
                                        <a href="product-detail.html" class="img-product">
                                            <img src="images/New-Arrivals/2_3_11zon.webp" alt="img-product">
                                        </a>
                                        <div class="content-box">
                                            <div class="info">
                                                <a href="product-detail.html" class="name-product link text-title">PUTIT Short Bubble-Hem Dress</a>
                                                <div class="variant text-caption-1 text-secondary"><span class="size">XL</span>/<span class="color">Blue</span></div>
                                            </div>
                                            <div class="total-price text-button"><span class="price"><i class="fa fa-inr" aria-hidden="true"></i> 9,500</span></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="sec-total-price">
                                    <div class="top">
                                        <div class="item d-flex align-items-center justify-content-between text-button">
                                            <span>Shipping</span>
                                            <span>Free</span>
                                        </div>
                                    </div>
                                    <div class="bottom">
                                        <h5 class="d-flex justify-content-between">
                                            <span>Total</span>
                                            <span class="total-price-checkout"><i class="fa fa-inr" aria-hidden="true"></i> 20,000</span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Section checkout -->

        @include('components.frontend.footer')

        @include('components.frontend.main-js')
</body>

</html>