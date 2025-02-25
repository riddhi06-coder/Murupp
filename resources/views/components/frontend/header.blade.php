    <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Scroll Top -->
    <button id="scroll-top">
        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_15741_24194)">
            <path d="M3 11.9175L12 2.91748L21 11.9175H16.5V20.1675C16.5 20.3664 16.421 20.5572 16.2803 20.6978C16.1397 20.8385 15.9489 20.9175 15.75 20.9175H8.25C8.05109 20.9175 7.86032 20.8385 7.71967 20.6978C7.57902 20.5572 7.5 20.3664 7.5 20.1675V11.9175H3Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <defs>
            <clipPath id="clip0_15741_24194">
            <rect width="24" height="24" fill="white" transform="translate(0 0.66748)"/>
            </clipPath>
            </defs>
        </svg> 
    </button>

    <!-- preload -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->

    <div id="wrapper">
        <!-- Header -->
        <header id="header" class="header-default">
            <div class="container">
                <div class="row wrapper-header align-items-center">
                    <div class="col-md-4 col-3 d-xl-none">
                        <a href="#mobileMenu" class="mobile-menu" data-bs-toggle="offcanvas" aria-controls="mobileMenu" aria-label="Open mobile menu">
                            <i class="icon icon-categories"></i>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{ route('frontend.index') }}" class="logo-header">
                            <img src="{{ asset('frontend/assets/images/logo/logo.webp') }}" width="144px" height="26px" alt="Murupp Logo" class="logo">
                        </a>
                    </div>
                    <div class="col-xl-6 d-none d-xl-block">
                        <nav class="box-navigation text-center">
                            <ul class="box-nav-ul d-flex align-items-center justify-content-center">

                                <li class="menu-item"><a href="#" class="item-link">About Us</a></li>
                                @php
                                    $collections = DB::table('master_collections')->whereNull('deleted_by')->orderBy('id', 'asc')->get();
                                @endphp

                                <li class="menu-item position-relative">
                                    <a href="#" class="item-link" aria-expanded="false">Shop by Collection
                                        <i class="icon icon-arrow-down"></i>
                                    </a>
                                    <div class="sub-menu submenu-default" aria-hidden="true">
                                        <ul class="menu-list">
                                            @foreach ($collections as $collection)
                                                <li>
                                                    <a href="{{ route('collection.view', ['slug' => $collection->slug]) }}" class="menu-link-text">
                                                        {{ $collection->collection_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>

                                @php
                                    use Illuminate\Support\Facades\DB;
                                    $categories = DB::table('master_product_category')->whereNull('deleted_by')->orderBy('id','asc')->get();
                                @endphp

                                <li class="menu-item position-relative">
                                    <a href="#" class="item-link" aria-expanded="false">
                                        Shop by Category <i class="icon icon-arrow-down"></i>
                                    </a>
                                    <div class="sub-menu submenu-default" aria-hidden="true">
                                        <ul class="menu-list">
                                            @foreach ($categories as $category)
                                                <li>
                                                    <a href="{{ route('product.category', ['slug' => $category->slug]) }}" class="menu-link-text">
                                                        {{ $category->category_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-xl-3 col-md-4 col-3">
                        <ul class="nav-icon d-flex justify-content-end align-items-center">
                            <li class="nav-search"><a href="#search" data-bs-toggle="modal" class="nav-icon-item" aria-label="Search">
                                <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>    
                            </a></li>
                            <li class="nav-account" aria-label="Login">
                                <a href="#" class="nav-icon-item" >
                                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <div class="dropdown-account dropdown-login" >
                                    <div class="sub-top">
                                        <a href="#" class="tf-btn btn-reset">Login</a>
                                        <p class="text-center text-secondary-2">Don’t have an account? <a href="#">Register</a></p>
                                    </div>
                                    <div class="sub-bot">
                                        <span class="body-text-">Support</span>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-wishlist" aria-label="wishlist"><a href="wish-list.html" class="nav-icon-item">
                                <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.8401 4.60987C20.3294 4.09888 19.7229 3.69352 19.0555 3.41696C18.388 3.14039 17.6726 2.99805 16.9501 2.99805C16.2276 2.99805 15.5122 3.14039 14.8448 3.41696C14.1773 3.69352 13.5709 4.09888 13.0601 4.60987L12.0001 5.66987L10.9401 4.60987C9.90843 3.57818 8.50915 2.99858 7.05012 2.99858C5.59109 2.99858 4.19181 3.57818 3.16012 4.60987C2.12843 5.64156 1.54883 7.04084 1.54883 8.49987C1.54883 9.95891 2.12843 11.3582 3.16012 12.3899L4.22012 13.4499L12.0001 21.2299L19.7801 13.4499L20.8401 12.3899C21.3511 11.8791 21.7565 11.2727 22.033 10.6052C22.3096 9.93777 22.4519 9.22236 22.4519 8.49987C22.4519 7.77738 22.3096 7.06198 22.033 6.39452C21.7565 5.72706 21.3511 5.12063 20.8401 4.60987V4.60987Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>  
                                </a>
                            </li>
                            @php
                                $cartCount = \App\Models\Carts::where('user_id', auth()->id())->whereNull('deleted_by')->count();
                            @endphp

                            <li class="nav-cart" aria-label="Shopping-Cart">
                                <a href="#shoppingCart" data-bs-toggle="modal" class="nav-icon-item">
                                    <svg class="icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z"
                                            stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span class="count-box">{{ $cartCount }}</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- /Header -->



        <!-- shoppingCart -->
        <div class="modal fullRight fade modal-shopping-cart" id="shoppingCart">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="d-flex flex-column flex-grow-1 h-100">
                        <div class="header">
                            <h5 class="title">Shopping Cart</h5>
                            <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                        </div>
                        <div class="wrap">
                            <div class="tf-mini-cart-wrap">
                                <div class="tf-mini-cart-main">
                                    <div class="tf-mini-cart-sroll">
                                        <div class="tf-mini-cart-items">
                                            @php
                                                $cartItems = DB::table('carts')
                                                    ->join('product_details', 'carts.product_id', '=', 'product_details.id')
                                                    ->where('carts.user_id', Auth::id())
                                                    ->select('carts.*', 'product_details.product_name', 'product_details.slug')
                                                    ->whereNull('carts.deleted_at')
                                                    ->get();
                                                
                                                $subtotal = 0;
                                            @endphp

                                            @php
                                                function number_format_indian($num) {
                                                    $num = round($num); // Remove decimal points
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

                                            @forelse($cartItems as $cartItem)
                                                @php
                                                    $subtotal += $cartItem->product_total_price;
                                                @endphp
                                                <div class="tf-mini-cart-item file-delete">
                                                    <div class="tf-mini-cart-image">
                                                        <img data-src="{{ asset($cartItem->product_image) }}" src="{{ asset($cartItem->product_image) }}" alt="">
                                                    </div>
                                                    <div class="tf-mini-cart-info flex-grow-1">
                                                    <div class="mb_12 d-flex align-items-center justify-content-between flex-wrap gap-12">
                                                        <div class="text-title">
                                                            <a href="{{ route('product.show', $cartItem->slug) }}" class="link text-line-clamp-1">
                                                                {{ $cartItem->product_name ?? 'Product Name' }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-12">
                                                            <div class="text-secondary-2">
                                                                {{ $cartItem->size }}{{ $cartItem->colors ? ' / ' . $cartItem->colors : '' }}
                                                            </div>

                                                            <div class="wg-quantity mx-md-auto">
                                                                <span class="btn-quantity btn-decrease" onclick="updateQuantity(this, -1)">-</span>
                                                                <input type="text" class="quantity-product" name="number" value="{{ $cartItem->quantity }}" 
                                                                    data-id="{{ $cartItem->id }}" 
                                                                    data-price="{{ $cartItem->product_total_price / $cartItem->quantity }}" 
                                                                    data-total="{{ $cartItem->product_total_price }}" 
                                                                    oninput="manualUpdate(this)">
                                                                <span class="btn-quantity btn-increase" onclick="updateQuantity(this, 1)">+</span>
                                                            </div>

                                                            <div class="text-button price">
                                                                <i class="fa fa-inr" aria-hidden="true"></i> <span class="item-price">{{ number_format_indian($cartItem->product_total_price) }}</span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                @empty
                                                <div class="text-center py-4">No items found in your cart.</div>
                                            @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-mini-cart-bottom">
                                    <div class="tf-mini-cart-bottom-wrap">
                                        <div class="tf-cart-totals-discounts">
                                            <h5>Subtotal</h5>
                                            <h5 class="tf-totals-total-value">
                                                <i class="fa fa-inr" aria-hidden="true"></i> {{ number_format_indian($subtotal) }}
                                            </h5>
                                        </div>
                                        <div class="tf-cart-checkbox">
                                            <div class="tf-checkbox-wrapp">
                                                <input type="checkbox" id="CartDrawer-Form_agree" name="agree_checkbox">
                                                <div><i class="icon-check"></i></div>
                                            </div>
                                            <label for="CartDrawer-Form_agree">
                                                I agree with 
                                                <a href="#" title="Terms of Service">Terms & Conditions</a>
                                            </label>
                                        </div>
                                        <div class="tf-mini-cart-view-checkout">
                                            <a href="{{ route('checkout.details')}}" class="tf-btn w-100 btn-fill radius-4">
                                                <span class="text">Check Out</span>
                                            </a>
                                        </div>
                                        <div class="text-center">
                                            <a class="link text-btn-uppercase" href="#">Or continue shopping</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /shoppingCart -->

        <!-- search -->
        <div class="modal fade modal-search" id="search">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Search</h5>
                        <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                    </div>
                    <form class="form-search">
                        <fieldset class="text">
                            <input type="text" placeholder="Searching..." class="" name="text" tabindex="0" value="" aria-required="true" required="">
                        </fieldset>
                        <button class="" type="submit">
                            <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M21.35 21.0004L17 16.6504" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /search -->
      

        <!-- mobile menu -->
        <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
            <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
            <div class="mb-canvas-content">
                <div class="mb-body">
                    <div class="mb-content-top">
                        <form class="form-search">
                            <fieldset class="text">
                                <input type="text" placeholder="What are you looking for?" class="" name="text" tabindex="0" value="" aria-required="true" required="">
                            </fieldset>
                            <button class="" type="submit">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#181818" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M20.9984 20.9999L16.6484 16.6499" stroke="#181818" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>                                
                            </button>
                        </form>
                        <ul class="nav-ul-mb" id="wrapper-menu-navigation">

                            <li class="nav-mb-item">
                                <a href="#" class="mb-menu-link">About Us</a>
                            </li>
                            @php
                                $collections = DB::table('master_collections')->whereNull('deleted_by')->orderBy('id', 'asc')->get();
                            @endphp

                            <li class="nav-mb-item">
                                <a href="#dropdown-menu-four" class="collapsed mb-menu-link" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-four">
                                    <span>Shop by Collection</span>
                                    <span class="btn-open-sub"></span>
                                </a>
                                <div id="dropdown-menu-four" class="collapse">
                                    <ul class="sub-nav-menu">
                                        @foreach ($collections as $collection)
                                            <li>
                                                <a href="{{ route('collection.view', ['slug' => $collection->slug]) }}" class="sub-nav-link">
                                                    {{ $collection->collection_name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>

                            @php
                                $categories = DB::table('master_product_category')->whereNull('deleted_by')->orderBy('id','asc')->get();
                            @endphp

                            <li class="nav-mb-item">
                                <a href="#dropdown-menu-four" class="collapsed mb-menu-link" data-bs-toggle="collapse" aria-expanded="false" aria-controls="dropdown-menu-four">
                                    <span>Shop by Category</span>
                                    <span class="btn-open-sub"></span>
                                </a>
                                <div id="dropdown-menu-four" class="collapse">
                                    <ul class="sub-nav-menu">
                                        @foreach ($categories as $category)
                                            <li>
                                                <a href="{{ route('product.category', ['slug' => $category->slug]) }}" class="sub-nav-link">
                                                    {{ $category->category_name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <div class="mb-other-content">
                        <div class="group-icon">
                            <a href="#" class="site-nav-icon">
                                <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.8401 4.60987C20.3294 4.09888 19.7229 3.69352 19.0555 3.41696C18.388 3.14039 17.6726 2.99805 16.9501 2.99805C16.2276 2.99805 15.5122 3.14039 14.8448 3.41696C14.1773 3.69352 13.5709 4.09888 13.0601 4.60987L12.0001 5.66987L10.9401 4.60987C9.90843 3.57818 8.50915 2.99858 7.05012 2.99858C5.59109 2.99858 4.19181 3.57818 3.16012 4.60987C2.12843 5.64156 1.54883 7.04084 1.54883 8.49987C1.54883 9.95891 2.12843 11.3582 3.16012 12.3899L4.22012 13.4499L12.0001 21.2299L19.7801 13.4499L20.8401 12.3899C21.3511 11.8791 21.7565 11.2727 22.033 10.6052C22.3096 9.93777 22.4519 9.22236 22.4519 8.49987C22.4519 7.77738 22.3096 7.06198 22.033 6.39452C21.7565 5.72706 21.3511 5.12063 20.8401 4.60987V4.60987Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Wishlist 
                            </a>
                            
                            <a href="#" class="site-nav-icon">
                                <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>  
                                Login
                            </a>

                        </div>
                        <div class="mb-notice">
                            <a href="#" class="text-need">Need Help?</a>
                        </div>
                        @php
                            $footer = \App\Models\Footer::first();
                        @endphp
                        <div class="mb-contact">
                            <p class="text-caption-1">{!! $footer->about !!}</p>
                            <!-- <a href="#" class="tf-btn-default text-btn-uppercase">GET DIRECTION<i class="icon-arrowUpRight"></i></a> -->
                        </div>
                        <ul class="mb-info">
                            <li>
                                <i class="icon icon-mail"></i>
                                <a href="mailto:{{ $footer->email ?? '' }}">{{ $footer->email ?? '' }}</a>
                            </li>
                            <li>
                                <i class="icon icon-phone"></i>
                                <a href="tel:+91{{ $footer->contact_number ?? '' }}">+91 {{ $footer->contact_number ?? '' }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>       
        </div>
        <!-- /mobile menu -->


    <!--- to manage the price based on the quantity--->
    <script>
        function updateQuantity(element, change) {
            let input = element.parentElement.querySelector(".quantity-product");
            let quantity = parseInt(input.value) + change;
            let unitPrice = parseFloat(input.getAttribute("data-price"));
            let cartItemId = input.getAttribute("data-id"); // Get cart item ID
            let cartElement = input.closest(".tf-mini-cart-item"); // Get cart item element

            if (!cartItemId) {
                console.error("cart_item_id is missing");
                return;
            }

            if (isNaN(quantity) || quantity < 1) {
                removeItemFromCart(cartItemId, cartElement);
                return;
            }

            input.value = quantity;
            let newTotal = unitPrice * quantity;
            input.setAttribute("data-total", newTotal);

            // Update item price
            let priceElement = cartElement.querySelector(".item-price");
            if (priceElement) {
                priceElement.innerText = formatIndianCurrency(newTotal);
            }

            // Update the total price inside the ".text-button.price" div
            let priceContainer = cartElement.querySelector(".text-button.price .item-price");
            if (priceContainer) {
                priceContainer.innerText = formatIndianCurrency(newTotal);
            }

            // Update subtotal
            updateSubtotal();
        }

        function manualUpdate(input) {
            let quantity = parseInt(input.value);
            let unitPrice = parseFloat(input.getAttribute("data-price"));
            let cartItemId = input.getAttribute("data-id"); // Get cart item ID
            let cartElement = input.closest(".tf-mini-cart-item"); // Get cart item element

            if (!cartItemId) {
                console.error("cart_item_id is missing");
                return;
            }

            if (isNaN(quantity) || quantity < 1) {
                removeItemFromCart(cartItemId, cartElement);
                return;
            }

            let newTotal = unitPrice * quantity;
            input.setAttribute("data-total", newTotal);

            // Update item price
            let priceElement = cartElement.querySelector(".item-price");
            if (priceElement) {
                priceElement.innerText = formatIndianCurrency(newTotal);
            }

            // Update the total price inside the ".text-button.price" div
            let priceContainer = cartElement.querySelector(".text-button.price .item-price");
            if (priceContainer) {
                priceContainer.innerText = formatIndianCurrency(newTotal);
            }

            // Update subtotal
            updateSubtotal();
        }

        function updateSubtotal() {
            let items = document.querySelectorAll(".quantity-product");
            let subtotal = 0;

            items.forEach(item => {
                let itemTotal = parseFloat(item.getAttribute("data-total"));
                if (!isNaN(itemTotal)) {
                    subtotal += itemTotal;
                }
            });

            let subtotalElement = document.querySelector(".tf-totals-total-value");

            if (subtotalElement) {
                subtotalElement.innerHTML =
                    '<i class="fa fa-inr" aria-hidden="true"></i> ' + formatIndianCurrency(subtotal);
            } else {
                console.error("Subtotal element not found.");
            }
        }

        function formatIndianCurrency(num) {
            num = Math.round(num).toString();
            let lastThree = num.slice(-3);
            let otherNumbers = num.slice(0, -3);
            if (otherNumbers) {
                lastThree = "," + lastThree;
            }
            return otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
        }

        function removeItemFromCart(cartItemId, cartElement) {
            fetch("{{ route('delete.cart.item') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ cart_item_id: cartItemId })
            })
            .then(response => response.json())
            .then(data => {
                console.log("Item deleted:", data);
                if (data.success) {
                    cartElement.remove(); // Remove item from UI
                    updateSubtotal(); // Recalculate subtotal

                    // Check if cart is empty after removal
                    if (document.querySelectorAll(".tf-mini-cart-item").length === 0) {
                        document.querySelector(".tf-mini-cart-items").innerHTML = `
                            <div class="text-center py-4">No items found in your cart.</div>
                        `;
                    }
                } else {
                    console.error("Failed to delete:", data.message);
                }
            })
            .catch(error => console.error("Error deleting cart item:", error));
        }

    </script>


