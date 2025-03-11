<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                            @if(!Auth::check())
                                <div class="wrap">
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
                            @php
                                use App\Models\OrderDetail;

                                $user = Auth::user();
                                $order = OrderDetail::where('user_id', $user->id ?? null)->latest()->first();
                            @endphp
                            <div class="wrap">
                                <h5 class="title">Information</h5>
                                <form class="info-box">
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
                                <textarea placeholder="Write note...">{{ old('note', isset($order) ? $order->note : '') }}</textarea>
                            </form>


                            </div>
                            <div class="wrap">
                                <h5 class="title">Choose payment Option:</h5>
                                <form class="form-payment">
                                    <div class="payment-box" id="payment-box">
                                        <div class="payment-item">
                                            <label for="credit-card-method" class="payment-header" >
                                                <input type="radio" name="payment-method" class="tf-check-rounded" id="credit-card-method" checked>
                                                <span class="text-title">Online Payment</span>
                                            </label>
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

        @include('components.frontend.footer')

        @include('components.frontend.main-js')

     
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!----- Guest User Login AJax---->
    <script>
        $(document).ready(function () {
            $("#loginForm").submit(function (event) {
                event.preventDefault(); // Prevent page reload

                $.ajax({
                    url: "{{ route('login.authenticate') }}", // Adjust route accordingly
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            $("#loginMessage").html("<p style='color: green;'>" + response.message + "</p>");
                            window.location.href = response.redirect; 
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
        document.getElementById("payNowButton").addEventListener("click", function(e) {
            e.preventDefault();

            if (!validateForm()) {
                return; 
            }

            let orderData = {
                customer_info: {
                    first_name: document.querySelector("input[placeholder='First Name*']").value,
                    last_name: document.querySelector("input[placeholder='Last Name*']").value,
                    email: document.querySelector("input[placeholder='Email Address*']").value,
                    phone: document.querySelector("input[placeholder='Phone Number*']").value
                },
                address: `${document.getElementById("street").value}, ${document.getElementById("city").value}, ${document.getElementById("state").value} - ${document.getElementById("postal-code").value}, India`,
                cart_items: []
            };

            document.querySelectorAll(".item-product").forEach(item => {
                let productElement = item.querySelector(".name-product"); 
                let quantityElement = item.querySelector(".quantity strong");
                let imageElement = item.querySelector(".product-image");
                let sizeElement = item.querySelector(".product-size");

                orderData.cart_items.push({
                    product_id: productElement.getAttribute("data-id"), 
                    product_name: productElement.innerText,
                    quantity: quantityElement ? parseInt(quantityElement.innerText) : 1,
                    price: item.querySelector(".price").innerText.replace("₹", "").trim(),
                    image: imageElement ? imageElement.getAttribute("src") : "", // Handle missing images
                    size: sizeElement ? sizeElement.innerText : "N/A" // Handle missing size
                });
            });

            fetch("{{ route('payment.process') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content")
                },
                body: JSON.stringify({
                    amount: document.querySelector(".total-price-checkout").innerText.replace("₹", "").trim(),
                    order_data: orderData
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.order_id) {
                    var options = {
                        "key": data.razorpay_key,
                        "amount": data.amount * 100,
                        "currency": "INR",
                        "order_id": data.order_id,
                        "handler": function(response) {
                            fetch("{{ route('payment.verify') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content")
                                },
                                body: JSON.stringify({
                                    razorpay_order_id: response.razorpay_order_id,
                                    razorpay_payment_id: response.razorpay_payment_id,
                                    razorpay_signature: response.razorpay_signature,
                                    order_data: orderData 
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 1) {
                                    window.location.href = "{{ route('thank.you') }}";
                                } else {
                                    alert("Payment verification failed. Please try again.");
                                }
                            });

                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                }
            });
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


</body>

</html>