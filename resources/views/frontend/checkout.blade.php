<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS for the spinner -->
    <style>
       .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(255, 255, 255, 0.2); 
            border-top: 5px solid #ffffff; 
            border-radius: 50%;
            animation: spin 1.2s cubic-bezier(0.42, 0, 0.58, 1) infinite;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5); 
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        
    </style>

</head>
	   

<body class="preload-wrapper">

        @include('components.frontend.header')


        <!-- page-title -->
        <div class="page-title">
            <div class="container">
                <h3 class="heading text-center">Check Out</h3>
                <ul class="breadcrumbs d-flex align-items-center">
                    <li><a class="link" href="{{ route('frontend.index') }}">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li><a class="link" href="#">Shop</a></li>
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
                            @if(!Auth::check())
                                <div class="wrap" id="auth-section">
                                    <div class="title-login">
                                        <p>Already have an account?</p>
                                        <a href="{{ route('user.login') }}" class="text-button">Login here</a>
                                    </div>
                                    <form id="loginForm" class="login-box">
                                        @csrf
                                        <div class="grid-2">
                                            <input type="email" name="email" placeholder="Your Email" required>
                                            <input type="password" name="password" placeholder="Password" required>
                                        </div>
                                        <button class="tf-btn" type="submit"><span class="text">Register</span></button>
                                    </form>

                                    <div id="loginMessage"></div>
                            
                                </div>
                            @endif


                            <!-- @if(!Auth::check())
                                <div class="wrap otp">
                                    <div class="title-login">
                                        <p>Already have an account?</p>
                                        <a href="{{ route('user.login') }}" class="text-button">Login here</a>
                                    </div>

                                    <form id="otpForm" class="login-box">
                                        @csrf
                                        <div id="otpContainer" class="grid-1">
                                            <input type="tel" name="mobile" id="mobile" placeholder="Enter Mobile Number" required><br><br>
                                            <button type="button" id="sendOtpBtn" class="tf-btn">
                                                <span id="btnText">Send OTP</span>
                                            </button>
                                        </div>

                                        <div id="otpSection" style="display: none;">
                                            <input type="text" name="otp" id="otp" placeholder="Enter OTP" required><br><br>
                                            <button class="tf-btn" type="submit">
                                                <span class="text">Verify OTP</span>
                                            </button>
                                            <button type="button" id="resendOtpBtn" class="tf-btn" style="display: none;">
                                                <span id="resendBtnText">Resend OTP</span>
                                            </button>
                                        </div>
                                    </form>

                                    <div id="otpMessage"></div>
                                </div>
                            @endif -->
                            

                            
                            @php
                                use App\Models\OrderDetail;

                                $user = Auth::user();
                                $order = OrderDetail::where('user_id', $user->id ?? null)->latest()->first();
                            @endphp
                            <div class="wrap">
                                <h5 class="title">Information:</h5>
                                <form class="info-box">
                                    @csrf 
                                    <div class="grid-2">
                                        <input type="hidden" id="full-address" value="{{ $order->address ?? '' }}">

                                        <div>
                                            <input type="text" id="first-name" placeholder="First Name*" 
                                                value="{{ old('first_name', isset($order) && $order->customer_name ? explode(' ', $order->customer_name)[0] : ($user->first_name ?? '')) }}">
                                            <small class="error-message"></small>
                                        </div>
                                        <div>
                                            <input type="text" id="last-name" placeholder="Last Name*" 
                                                value="{{ old('last_name', isset($order) && $order->customer_name ? explode(' ', $order->customer_name)[1] ?? '' : ($user->last_name ?? '')) }}">
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="grid-2">
                                        <div>
                                            <input type="text" id="email" placeholder="Email Address*" 
                                                value="{{ old('email', isset($order) ? $order->customer_email : ($user->email ?? '')) }}">
                                            <small class="error-message"></small>
                                        </div>
                                        <div>
                                            <input type="text" id="phone" placeholder="Phone Number*" 
                                                value="{{ old('phone', isset($order) ? $order->customer_phone : ($user->phone ?? '')) }}">
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="grid-2">
                                        <div>
                                            <input type="text" id="street" placeholder="Street*" 
                                                value="{{ old('street', isset($order) ? $order->street : '') }}">
                                            <small class="error-message"></small>
                                        </div>
                                        <div>
                                            <input type="text" id="city" placeholder="Town/City*" 
                                                value="{{ old('city', isset($order) ? $order->city : '') }}">
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="grid-2">
                                        <div>
                                            <input type="text" id="state" placeholder="State*" 
                                                value="{{ old('state', isset($order) ? $order->state : '') }}">
                                            <small class="error-message"></small>
                                        </div>
                                        <div>
                                            <input type="text" id="postal-code" placeholder="Postal Code*" 
                                                value="{{ old('postal_code', isset($order) ? $order->postal_code : '') }}">
                                            <small class="error-message"></small>
                                        </div>
                                    </div>
                                    <div class="tf-select">
                                        <input type="text" placeholder="Country*" value="India" readonly>
                                    </div>
                                    <fieldset>
                                        <textarea id="billing_address" name="billing_address" placeholder="Billing Address*" required>{{ old('billing_address', isset($order) ? $order->billing_address : '') }}</textarea>
                                        <small class="error-message"></small>
                                    </fieldset>

                                    <fieldset>
                                        <input type="checkbox" id="same_as_billing">
                                        <label for="same_as_billing"><strong>Same as Billing Address</strong></label>
                                    </fieldset>

                                    <fieldset>
                                        <textarea id="shipping_address" name="shipping_address" placeholder="Shipping Address">{{ old('shipping_address', isset($order) ? $order->shipping_address : '') }}</textarea>
                                        <small class="error-message"></small>
                                    </fieldset>

                                    <fieldset>
                                        <textarea id="note" name="note" placeholder="Write note...">{{ old('note', isset($order) ? $order->note : '') }}</textarea>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="wrap">
                                <h5 class="title">Payment Option:</h5>
                                <form class="form-payment">
                                    <div class="payment-box" id="payment-box" >
                                        <div class="payment-item payment-choose-card active">
                                            <label for="credit-card-method" class="payment-header" >
                                                <input type="radio" name="payment-method" class="tf-check-rounded" id="credit-card-method" checked>
                                                <span class="text-title">Online Payment</span>
                                            </label>
                                            <div id="credit-card-payment" class="collapse show" data-bs-parent="#payment-box">
                                                <div class="payment-body">
                                                    <p class="text-secondary">Make your payment directly into our bank account. Your order will not be shipped until the funds have cleared in our account.</p>
                                                </div>  
                                                <div class="list-card d-flex justify-content-center align-items-center gap-3 mt-3">
                                                    <img src="{{ asset('frontend/assets/images/payment/american-express.png') }}" alt="American Express" style="width: 60px; height: 50px; object-fit: contain;">
                                                    <img src="{{ asset('frontend/assets/images/payment/visa.png') }}" alt="Visa" style="width: 60px; height: 50px; object-fit: contain;">
                                                    <img src="{{ asset('frontend/assets/images/payment/Bhim_upi.webp') }}" alt="Bhim UPI" style="width: 80px; height: 50px; object-fit: contain;">
                                                    <img src="{{ asset('frontend/assets/images/payment/gpay-icon.webp') }}" alt="Google Pay" style="width: 100px; height: 50px; object-fit: contain;">
                                                    <img src="{{ asset('frontend/assets/images/payment/mastercard.jpg') }}" alt="Mastercard" style="width: 80px; height: 50px; object-fit: contain;">
                                                    <img src="{{ asset('frontend/assets/images/payment/paypal.png') }}" alt="PayPal" style="width: 80px; height: 50px; object-fit: contain;">
                                                    <img src="{{ asset('frontend/assets/images/payment/phone_pay.webp') }}" alt="PhonePe" style="width: 80px; height: 50px; object-fit: contain;">
                                                </div>

                                            </div><br>
                                        </div>
                                    </div>
                                    <button class="tf-btn btn-reset"  id="payNowButton">Pay Now</button>
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
                                    @forelse ($cartItems as $cartItem)
                                        <div class="item-product">
                                            <a href="{{ route('product.show', $cartItem->slug) }}" class="img-product">
                                            <img src="{{ asset($cartItem->product_image) }}" alt="" class="product-image">

                                            </a>
                                            <div class="content-box d-flex justify-content-between align-items-start">
                                                <div class="info">
                                                    <a href="{{ route('product.show', $cartItem->slug) }}" class="name-product link text-title" data-id="{{ $cartItem->product_id }}">
                                                        {{ $cartItem->product_name }}
                                                    </a>
                                                    <div class="variant text-caption-1 text-secondary mt-1">
                                                        <span class="product-size size">{{ $cartItem->size }}</span>
                                                        @if ($cartItem->colors)
                                                            / <span class="color">{{ $cartItem->colors }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="variant text-caption-1 text-secondary mt-1">
                                                        @if ($cartItem->print)
                                                        <span class="product-print print">Print: {{ $cartItem->print }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="quantity text-caption-1 text-secondary mt-1">
                                                        Quantity: <strong>{{ $cartItem->quantity }}</strong>
                                                    </div>
                                                </div>
                                                
                                                <div class="total-price text-button text-end">
                                                    <span class="price">
                                                        <i class="fa fa-inr" aria-hidden="true"></i> 
                                                        {{ number_format_indian($cartItem->product_total_price) }}
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    @empty
                                        <p class="text-center">No items in your cart.</p>
                                    @endforelse
                                </div>

                                <div class="sec-total-price">
                                    <div class="top">
                                        <div class="item d-flex align-items-center justify-content-between text-button">
                                            <span>Shipping</span>
                                            <span>Free</span>
                                        </div>
                                    </div>
                                    <div class="bottom">
                                        @php
                                            $taxAmount = $total * 0.18; 
                                        @endphp
                                        <h5 class="d-flex justify-content-between">
                                            <span>Total</span>
                                            <span class="total-price-checkout">
                                                <i class="fa fa-inr" aria-hidden="true"></i> {{ number_format_indian($total) }}
                                            </span>
                                        </h5>
                                        <small class="d-flex justify-content-between text-muted">
                                            <span>Including ₹ {{ number_format_indian($taxAmount) }} in taxes</span>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- /Section checkout -->


        <!-- Loader Overlay (Initially Hidden) -->
        <div id="loading-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100vh; background: rgba(0, 0, 0, 0.5); color: black; display: flex; align-items: center; justify-content: center; font-size: 24px; z-index: 9999; flex-direction: column; gap: 20px;">
            <div class="spinner"></div><br><br>
            <!-- <div>Processing...</div> -->
        </div>
      

        @include('components.frontend.footer')

        @include('components.frontend.main-js')

     
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!----- Guest User Login AJax---->
    <script>
        $(document).ready(function () {

            $("#loginForm").submit(function (event) {
                event.preventDefault(); // Prevent page reload

                $.ajax({
                    url: "{{ route('login.authenticate') }}", 
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            $("#loginMessage").html("<p style='color: green;'>" + response.message + "</p>");
                            $("#auth-section").hide(); 

                        } else {
                            $("#loginMessage").html("<p style='color: red;'>" + response.message + "</p>");
                        }
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMsg = "<ul style='color: red;'>";
                        $.each(errors, function (key, value) {
                            errorMsg += "<li>" + value[0] + "</li>";
                        });
                        errorMsg += "</ul>";
                        $("#loginMessage").html(errorMsg);
                    }
                });
            });
        });
    </script>


    <!----- checkput and Payment form details and integration---->
    <script>

        document.getElementById("payNowButton").addEventListener("click", async function (e) {
            e.preventDefault();

            if (!validateForm()) {
                return;
            }

            let orderData = {
                customer_info: {
                    first_name: document.querySelector("input[placeholder='First Name*']").value,
                    last_name: document.querySelector("input[placeholder='Last Name*']").value,
                    email: document.querySelector("input[placeholder='Email Address*']").value,
                    phone: document.querySelector("input[placeholder='Phone Number*']").value,

                    street: document.querySelector("input[placeholder='Street*']").value,
                    city: document.querySelector("input[placeholder='Town/City*']").value,
                    state: document.querySelector("input[placeholder='State*']").value,
                    postal_code: document.querySelector("input[placeholder='Postal Code*']").value,
                    country: "India",
                    billing_address: document.querySelector("textarea#billing_address").value,
                    shipping_address: document.querySelector("textarea#shipping_address").value,
                    description: document.querySelector("textarea#note").value
                },
                cart_items: []
            };

            document.querySelectorAll(".item-product").forEach((item) => {
                let productElement = item.querySelector(".name-product");
                let quantityElement = item.querySelector(".quantity strong");
                let imageElement = item.querySelector(".product-image");
                let sizeElement = item.querySelector(".product-size");
                let printElement = item.querySelector(".product-print");

                orderData.cart_items.push({
                    product_id: productElement.getAttribute("data-id"),
                    product_name: productElement.innerText,
                    quantity: quantityElement ? parseInt(quantityElement.innerText) : 1,
                    price: item.querySelector(".price").innerText.replace("₹", "").trim(),
                    image: imageElement ? imageElement.getAttribute("src") : "",
                    size: sizeElement ? sizeElement.innerText : "N/A",
                    print: printElement ? printElement.innerText.replace("Print: ", "").trim() : "N/A"
                });
            });

            showLoader();

            try {
                let response = await fetch("{{ route('payment.process') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content")
                    },
                    body: JSON.stringify({
                        amount: document.querySelector(".total-price-checkout").innerText.replace("₹", "").trim(),
                        order_data: orderData
                    })
                });

                let data = await response.json();

                let order_id = null;

                if (data.order_id) {
                    order_id = data.order_id;
                    
                    let options = {
                        key: data.razorpay_key,
                        amount: data.amount * 100,
                        currency: "INR",
                        order_id: data.order_id,
                        handler: async function (response) {
                            try {
                                let verifyResponse = await fetch("{{ route('payment.verify') }}", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content")
                                    },
                                    body: JSON.stringify({
                                        razorpay_order_id: response.razorpay_order_id,
                                        razorpay_payment_id: response.razorpay_payment_id,
                                        razorpay_signature: response.razorpay_signature,
                                        order_id: order_id,
                                        order_data: orderData
                                    })
                                });

                                let verifyData = await verifyResponse.json();
                                console.log("Verify Data:", verifyData);

                                if (verifyData.status === 1) {
                                    // window.location.href = "{{ route('thank.you') }}";

                                    // Redirect to Order Confirmation with order data
                                    console.log("Order ID:", order_id);
                                    
                                    let url = "{{ route('order.confirm') }}" + "?order_id=" + order_id;
                                    
                                    window.location.href = url;

                                } else {
                                    alert("Payment verification failed. Please try again.");
                                }
                            } catch (error) {
                                alert("Something went wrong. Please try again.");
                            } finally {
                                hideLoader();
                            }
                        }
                    };

                    let rzp1 = new Razorpay(options);
                    rzp1.open();

                    // Hide loader if payment is failed or popup is closed
                    rzp1.on("payment.failed", function () {
                        hideLoader();
                    });
                } else {
                    alert("Order creation failed. Please try again.");
                    hideLoader();
                }
            } catch (error) {
                alert("An error occurred while processing the payment.");
                hideLoader();
            }
        });

        // Show Loader
        function showLoader() {
            document.getElementById("loading-overlay").style.display = "flex";
        }

        // Hide Loader
        function hideLoader() {
            document.getElementById("loading-overlay").style.display = "none";
        }

        // Ensure loader is hidden on page load
        document.addEventListener("DOMContentLoaded", function () {
            hideLoader();
        });
        

        // Form Validation Function
        function validateForm() {
            let isValid = true;

            function showError(input, message) {
                const errorElement = input.nextElementSibling;
                errorElement.innerText = message;
                errorElement.style.color = "red";
                input.style.borderColor = "red";
            }

            function clearError(input) {
                const errorElement = input.nextElementSibling;
                errorElement.innerText = "";
                input.style.borderColor = "";
            }

            const firstName = document.getElementById("first-name");
            const lastName = document.getElementById("last-name");
            const email = document.getElementById("email");
            const phone = document.getElementById("phone");
            const street = document.getElementById("street");
            const city = document.getElementById("city");
            const state = document.getElementById("state");
            const postalCode = document.getElementById("postal-code");
            const billingAddress = document.getElementById("billing_address");
            const shippingAddress = document.getElementById("shipping_address");

            const nameRegex = /^[A-Za-z\s]+$/;
            if (!nameRegex.test(firstName.value.trim())) {
                showError(firstName, "First Name should only contain letters.");
                isValid = false;
            } else {
                clearError(firstName);
            }

            if (!nameRegex.test(lastName.value.trim())) {
                showError(lastName, "Last Name should only contain letters.");
                isValid = false;
            } else {
                clearError(lastName);
            }

            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(email.value.trim())) {
                showError(email, "Enter a valid Email Address.");
                isValid = false;
            } else {
                clearError(email);
            }

            const phoneRegex = /^\d{10}$/;
            if (!phoneRegex.test(phone.value.trim())) {
                showError(phone, "Phone Number should be exactly 10 digits.");
                isValid = false;
            } else {
                clearError(phone);
            }

            if (street.value.trim() === "") {
                showError(street, "Street is required.");
                isValid = false;
            } else {
                clearError(street);
            }

            if (city.value.trim() === "") {
                showError(city, "Town/City is required.");
                isValid = false;
            } else {
                clearError(city);
            }

            if (state.value.trim() === "") {
                showError(state, "State is required.");
                isValid = false;
            } else {
                clearError(state);
            }

            const postalCodeRegex = /^\d{6}$/;
            if (!postalCodeRegex.test(postalCode.value.trim())) {
                showError(postalCode, "Postal Code must be exactly 6 digits.");
                isValid = false;
            } else {
                clearError(postalCode);
            }


            if (billingAddress.value.trim() === "") {
            showError(billingAddress, "Billing Address is required.");
            isValid = false;
            } else {
                clearError(billingAddress);
            }

            if (!document.getElementById('same_as_billing').checked) {
                if (shippingAddress.value.trim() === "") {
                    showError(shippingAddress, "Shipping Address is required.");
                    isValid = false;
                } else {
                    clearError(shippingAddress);
                }
            }

            return isValid;
        }

    </script>

    <!-----Auto fetch the user details for checkout---->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let address = document.getElementById("full-address").value;
            if (address) {
                let addressParts = address.split(", ");
                
                document.getElementById("street").value = addressParts[0] || "";
                document.getElementById("city").value = addressParts[1] || "";

                let stateAndPostal = addressParts[2]?.split(" - "); // Correct handling of state and postal
                document.getElementById("state").value = stateAndPostal?.[0] || "";
                document.getElementById("postal-code").value = stateAndPostal?.[1] || "";
            }
        });

    </script>

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

    <!-----For Shipping address to be same as billing address---->
    <script>
        document.getElementById('same_as_billing').addEventListener('change', function() {
            let billingAddress = document.getElementById('billing_address').value;
            let shippingAddress = document.getElementById('shipping_address');

            if (this.checked) {
                shippingAddress.value = billingAddress;
                shippingAddress.readOnly = true; // Prevent manual changes
            } else {
                shippingAddress.value = '';
                shippingAddress.readOnly = false;
            }
        });
    </script>

    <!----- OTP Sending verifying with timer---->  
    <script>

        document.getElementById('sendOtpBtn').addEventListener('click', function () {
            sendOtp();
        });

        document.getElementById('resendOtpBtn').addEventListener('click', function () {
            resetForm(); 
        });

        function sendOtp() {
            let mobile = document.getElementById('mobile').value;
            let sendOtpBtn = document.getElementById('sendOtpBtn');
            let btnText = document.getElementById('btnText');
            let mobileInput = document.getElementById('mobile');
            let otpSection = document.getElementById('otpSection');
            let resendOtpBtn = document.getElementById('resendOtpBtn');

            if (mobile.length === 10) {
                fetch("{{ route('send.otp') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ mobile: mobile })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('otpMessage').innerHTML = `<p style="color: ${data.success ? 'green' : 'red'};">${data.message}</p>`;

                    if (data.success) {
                        otpSection.style.display = 'block';   // Show OTP input & verify button
                        sendOtpBtn.style.display = 'none';    // Hide "Send OTP" button
                        mobileInput.style.display = 'none';   // Hide mobile number input
                        resendOtpBtn.style.display = 'inline-block'; // Show "Resend OTP" button

                        startTimer(120, resendOtpBtn, document.getElementById('resendBtnText')); // Start countdown
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('otpMessage').innerHTML = '<p style="color: red;">An error occurred while sending OTP. Please try again.</p>';
                });
            } else {
                document.getElementById('otpMessage').innerHTML = '<p style="color: red;">Enter a valid mobile number</p>';
            }
        }

        function resetForm() {
            let mobileInput = document.getElementById('mobile');
            let sendOtpBtn = document.getElementById('sendOtpBtn');
            let resendOtpBtn = document.getElementById('resendOtpBtn');
            let otpSection = document.getElementById('otpSection');
            let otpInput = document.getElementById('otp');
            
            // Reset fields
            mobileInput.style.display = 'block';  // Show mobile input
            mobileInput.value = '';  // Clear mobile number field
            sendOtpBtn.style.display = 'inline-block'; // Show "Send OTP" button
            resendOtpBtn.style.display = 'none'; // Hide "Resend OTP" button
            otpSection.style.display = 'none';   // Hide OTP input & Verify button
            otpInput.value = ''; // Clear OTP input field
            document.getElementById('otpMessage').innerHTML = ''; // Clear message
        }

        function startTimer(duration, button, btnText) {
            let timeLeft = duration;
            button.disabled = true; // Disable button

            function updateTimer() {
                let minutes = Math.floor(timeLeft / 60);
                let seconds = timeLeft % 60;
                let formattedTime = `Resend OTP in <b>${minutes}:${seconds < 10 ? "0" : ""}${seconds}s</b>`;

                console.log(formattedTime); // Debugging log
                btnText.innerHTML = formattedTime;

                if (timeLeft > 0) {
                    timeLeft--;
                    setTimeout(updateTimer, 1000); // Continue updating
                } else {
                    button.disabled = false;
                    btnText.innerHTML = 'Resend OTP';
                }
            }

            updateTimer();
        }



        document.getElementById('otpForm').addEventListener('submit', function (e) {
            e.preventDefault();

            let mobile = document.getElementById('mobile').value;
            let otp = document.getElementById('otp').value;

            fetch("{{ route('verify.otp') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ mobile: mobile, otp: otp })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('otpMessage').innerHTML = `<p style="color: ${data.success ? 'green' : 'red'};">${data.message}</p>`;
                    if (data.success) {
                        // Hide the OTP section immediately after successful OTP verification
                        document.querySelector('.wrap.otp').style.display = 'none';
                    }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('otpMessage').innerHTML = '<p style="color: red;">An error occurred while verifying OTP. Please try again.</p>';
            });
        });


    </script>


</body>

</html>