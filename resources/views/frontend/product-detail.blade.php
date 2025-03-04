<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>
	   

<body class="preload-wrapper">

        @include('components.frontend.header')


        <!-- page-title -->
        <div class="page-title" style="background-image: url(images/bg/page-title.webp);">
            <div class="container">
                <div class="row">
                    <div class="col-12">    
                        <ul class="breadcrumbs d-flex align-items-center">
                            <li>
                                <a class="link" href="{{ route('frontend.index') }}">Home</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                <a class="link" href="#">Shop by Category</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                {{ $category->category_name }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title -->


        <!-- Product_Main -->
        <section class="flat-spacing">
            <div class="tf-main-product section-image-zoom">
                <div class="container">
                    <div class="row">
                        <!-- Product default -->
                        <div class="col-md-6">
                            <div class="tf-product-media-wrap sticky-top">
                                <div class="thumbs-slider">
                                    <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom" data-direction="vertical">
                                        <div class="swiper-wrapper stagger-wrap">
                                            @foreach($galleryImages as $image)
                                            <div class="swiper-slide stagger-item" data-color="gray">
                                                <div class="item">
                                                    <img data-src="{{ asset('murupp/product/gallery/' . $image) }}" 
                                                        src="{{ asset('murupp/product/gallery/' . $image) }}" alt="">
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
                                        <div class="swiper-wrapper">
                                            @foreach($galleryImages as $image)
                                            <div class="swiper-slide" data-color="gray">
                                                <a href="{{ asset('murupp/product/gallery/' . $image) }}" target="_blank" class="item" 
                                                    data-pswp-width="600px" data-pswp-height="800px">
                                                    <img class="tf-image-zoom"  
                                                        data-zoom="{{ asset('murupp/product/gallery/' . $image) }}" 
                                                        data-src="{{ asset('murupp/product/gallery/' . $image) }}" 
                                                        src="{{ asset('murupp/product/gallery/' . $image) }}" alt="">
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <!-- /Product default -->


                        <!-- tf-product-info-list -->
                        <div class="col-md-6">
                            <div class="tf-product-info-wrap position-relative">
                                <div class="tf-zoom-main"></div>
                                <div class="tf-product-info-list other-image-zoom">
                                    <div class="tf-product-info-heading">
                                        <div class="tf-product-info-name">
                                            <h3 class="name">{{ $product->product_name }}</h3>
                                        </div>
                                        <div class="tf-product-info-desc">
                                            <div class="tf-product-info-price">
                                                <h5 class="price-on-sale font-2">
                                                    <i class="fa fa-inr" aria-hidden="true"></i> INR {{ $product->product_price }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>

                                    @if(!empty($productColor) && count($productColor) > 0)
                                        <div class="tf-product-info-choose-option">
                                            <div class="variant-picker-item">
                                                <div class="variant-picker-label mb_12">
                                                    Colors: <span class="text-title" id="selected-color">{{ $productColor[0] ?? 'Select Color' }}</span>
                                                </div>
                                                <div class="variant-picker-values">
                                                    @foreach($productColor as $id => $color)
                                                        <input id="color_{{ $id }}" type="radio" name="color1" value="{{ $color }}" 
                                                            {{ $loop->first ? 'checked' : '' }} onchange="updateSelectedColor(this)">
                                                        <label for="color_{{ $id }}" class="hover-tooltip tooltip-bot radius-60 color-btn {{ $loop->first ? 'active' : '' }}">
                                                            <span class="btn-checkbox" style="background-color: {{ $color }};"></span>
                                                            <span class="tooltip">{{ $color }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <br>

                                    @if(!empty($printData) && count($printData) > 0)
                                    <div class="tf-product-info-choose-option">
                                        <div class="variant-picker-item">
                                            <div class="variant-picker-label mb_12">
                                                Print Options: 
                                                <span class="text-title" id="selected-print">{{ $printData[0]['name'] ?? 'Select Print' }}</span>
                                            </div>
                                            <div class="variant-picker-values">
                                                @foreach ($printData as $index => $print)
                                                    <input id="print_{{ $index }}" type="radio" name="print_option" value="{{ $print['name'] }}" 
                                                        {{ $loop->first ? 'checked' : '' }} onchange="updateSelectedPrint(this)">
                                                    <label for="print_{{ $index }}" class="style-image hover-tooltip tooltip-bot color-btn {{ $loop->first ? 'active' : '' }}">
                                                        <img
                                                            data-src="{{ asset('/murupp/product/prints/' . $print['image']) }}" 
                                                            src="{{ asset('/murupp/product/prints/' . $print['image']) }}" 
                                                            alt="{{ $print['name'] }}">
                                                        <span class="tooltip">{{ $print['name'] }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <br>

                                    @if(!empty($productSizes) && count($productSizes) > 0)
                                        <div class="variant-picker-item">
                                            <div class="d-flex justify-content-between mb_12">
                                                <div class="variant-picker-label">
                                                    Size:
                                                    <span class="text-title variant-picker-label-value" id="selected-size">
                                                        {{ $productSizes[0] ?? 'Select Size' }}
                                                    </span>
                                                </div>
                                                <a href="#size-guide" data-bs-toggle="modal" class="size-guide text-title link">Size Guide</a>
                                            </div>

                                            <div class="variant-picker-values gap12">
                                                @foreach($productSizes as $id => $size)
                                                    <input type="radio" id="size_{{ $id }}" name="size" value="{{ $size }}" 
                                                        {{ $loop->first ? 'checked' : '' }} onchange="updateSelectedSize(this)">
                                                    <label for="size_{{ $id }}" class="style-text size-btn">
                                                        <span class="text-title">{{ $size }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                            <p class="mt-3">
                                                Crafted for you, <a class="contact-link" href="#ask_question" data-bs-toggle="modal">contact us </a> for custom sizing
                                            </p>
                                        </div>
                                    @endif

                                        <br>

                                        <div class="tf-product-info-quantity">
                                            <div class="title mb_12">Quantity:</div>
                                            <div class="wg-quantity">
                                                <span class="btn-quantity btn-decrease">-</span>
                                                <input class="quantity-product" type="text" name="quantity" value="1">
                                                <span class="btn-quantity btn-increase">+</span>
                                            </div>
                                        </div>
                                        <br>
                                        <div>
                                            <div class="tf-product-info-by-btn mb_10">
                                                <!-- <a href="{{ route('cart.add', ['id' => $product->id]) }}" 
                                                    class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 btn-add-to-cart">
                                                    <span>Add to cart</span>
                                                </a> -->

                                                <form id="cartForm" action="{{ route('cart.add', ['id' => $product->id]) }}" method="GET">
                                                    <input type="hidden" name="color1" id="hidden-color" value="{{ $productColor[0] ?? '' }}">
                                                    <input type="hidden" name="print_option" id="hidden-print" value="{{ $printData[0]['name'] ?? '' }}">
                                                    <input type="hidden" name="size" id="hidden-size" value="{{ $productSizes[0] ?? '' }}">
                                                    <input type="hidden" name="quantity" value="1" class="quantity-product">
                                                    <input type="hidden" name="product_price" value="{{ $product->product_price ?? 0 }}">
                                                    <input type="hidden" name="product_image" value="{{ isset($galleryImages[0]) ? asset('murupp/product/gallery/' . $galleryImages[0]) : '' }}">


                                                    <button type="submit" class="btn-style-2 flex-grow-1 text-btn-uppercase fw-6 btn-add-to-cart" style="width: 300px !important;">
                                                        <span>Add to cart</span>
                                                    </button>

                                                    <p id="sizeError" style="color: red; display: none; margin-top: 10px;">Please select a size before adding to cart.</p>
                                                </form>


                                                <a href="javascript:void(0);" onclick="addToWishlist({{ $product->id }}, this)" 
                                                    class="box-icon hover-tooltip text-caption-2 wishlist btn-icon-action">
                                                    <span class="icon icon-heart"></span>
                                                    <span class="tooltip text-caption-2">Wishlist</span>
                                                </a>

                                              
                                            </div>
                                        </div>
                                        <br>

                                        
                                        <ul class="tf-product-info-sku">
                                        
                                            <li>
                                                <p class="text-caption-1">Available:</p>
                                                @if($product->available_quantity > 0)
                                                    <p class="text-caption-1 text-1">Stock</p>
                                                @else
                                                    <p class="text-caption-1 text-1 text-danger">Out of Stock</p>
                                                @endif
                                            </li>

                                            <li>
                                                <p class="text-caption-1">Categories:</p>
                                                <p class="text-caption-1">
                                                    @if(!empty($category))
                                                        <a href="#" class="text-1 link">{{ $category->category_name }}</a>
                                                    @else
                                                        <span class="text-muted">No Category</span>
                                                    @endif
                                                </p>
                                            </li>

                                            <li>
                                                <p class="text-caption-1">Fabric:</p>
                                                <p class="text-caption-1">
                                                    @if(!empty($fabric))
                                                        <a href="#" class="text-1 link">{{ $fabric }}</a>
                                                    @else
                                                        <span class="text-muted">Not Available</span>
                                                    @endif
                                                </p>
                                            </li>

                                            <li>
                                                <p class="text-caption-1">Fabric Composition:</p>
                                                <p class="text-caption-1">
                                                    @if(!empty($fabricComposition))
                                                        <a href="#" class="text-1 link">{{ $fabricComposition }}</a>
                                                    @else
                                                        <span class="text-muted">Not Available</span>
                                                    @endif
                                                </p>
                                            </li><br>

                                        </ul>
                                        <div class="tf-product-info-guranteed">
                                            <div class="text-title">
                                                Guranteed safe checkout:
                                            </div>
                                            <div class="tf-payment">
                                                <a href="#">
                                                    <img src="{{ asset('frontend/assets/images/payment/img-1.png') }}" alt="">
                                                </a>
                                                <a href="#">
                                                    <img src="{{ asset('frontend/assets/images/payment/img-2.png') }}" alt="">
                                                </a>
                                                <a href="#">
                                                    <img src="{{ asset('frontend/assets/images/payment/img-3.png') }}" alt="">
                                                </a>
                                                <a href="#">
                                                    <img src="{{ asset('frontend/assets/images/payment/img-4.png') }}" alt="">
                                                </a>
                                                <a href="#">
                                                    <img src="{{ asset('frontend/assets/images/payment/img-5.png') }}" alt="">
                                                </a>
                                                <a href="#">
                                                    <img src="{{ asset('frontend/assets/images/payment/img-6.png') }}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /tf-product-info-list -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /Product_Main -->



        <!-- Product_Description_Tabs -->
        <section class="">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="widget-tabs style-1">
                            <ul class="widget-menu-tab">
                                <li class="item-title active">
                                    <span class="inner">Description & Care</span>
                                </li>
                                <li class="item-title">
                                    <span class="inner">Shipping Fees & Timeline</span>
                                </li>
                                <li class="item-title">
                                    <span class="inner">Returns & Exchange</span>
                                </li>
                            </ul>
                            <div class="widget-content-tab">
                                <div class="widget-content-inner active">
                                    <div class="tab-description">
                                    <p>{!! $product->description ?? 'No description available.' !!}</p>
                                    </div>
                                </div>
                                
                                <div class="widget-content-inner">
                                    <div class="tab-shipping">
                                        <div>
                                            @php
                                                $shippingLines = array_filter(explode('.', $product->shipping)); // Split into sentences and remove empty values
                                                $firstLine = strtoupper(trim(array_shift($shippingLines))); // Get and remove the first sentence
                                            @endphp

                                            <p class="text-btn-uppercase mb_12"><b>{{ $firstLine }}.</b></p>

                                            @foreach($shippingLines as $line)
                                                <p class="mb_12">{{ trim($line) }}.</p>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                                <div class="widget-content-inner">
                                <div class="tab-policies">
                                    <p class="text-btn-uppercase mb_12"><b>{{ strtoupper(strtok($product->return, '.')) }}.</b></p>
                                    <p class="mb_12 text-secondary">
                                        {{ substr($product->return, strlen(strtok($product->return, '.')) + 1) ?? 'No policies available.' }}
                                        <a href="#">Return & Exchange Policy.</a>
                                    </p>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Product_Description_Tabs -->




        <!-- size-guide -->
        <div class="modal fade modal-size-guide" id="size-guide">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content widget-tabs style-2">
                    <div class="header">
                        <ul class="widget-menu-tab">
                            <li class="item-title active">
                                <span class="inner text-button">Size Guide</span>
                            </li>
                        </ul>
                        <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                    </div>
                    <div class="wrap">
                        <div class="widget-content-tab">
                            <div class="widget-content-inner active">
                                @if($sizeCharts->isNotEmpty())
                                    <table class="tab-sizeguide-table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                @foreach($sizeCharts as $size => $sizeGroup)
                                                    <th>{{ strtoupper($size) }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Bust</td>
                                                @foreach($sizeCharts as $sizeGroup)
                                                    <td>{{ $sizeGroup->first()->bust }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Waist</td>
                                                @foreach($sizeCharts as $sizeGroup)
                                                    <td>{{ $sizeGroup->first()->waist }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <td>Hips</td>
                                                @foreach($sizeCharts as $sizeGroup)
                                                    <td>{{ $sizeGroup->first()->hips }}</td>
                                                @endforeach
                                            </tr>    
                                        </tbody>
                                    </table>
                                @else
                                    <p>No size guide available.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /size-guide -->



        @if($relatedProducts->isNotEmpty())
            <section class="flat-spacing">
                <div class="container">
                    <div class="heading-section text-center wow fadeInUp">
                        <h3 class="heading">Related Products</h3>
                    </div>
                    <div dir="ltr" class="swiper tf-sw-recent" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                        <div class="swiper-wrapper">
                            @foreach($relatedProducts as $related)
                            <div class="swiper-slide">
                                <div class="card-product card-product-size wow fadeInUp" data-wow-delay="0s">
                                    <div class="card-product-wrapper">
                                        <a href="{{ route('product.show', $related->slug) }}" class="product-img">
                                            @php
                                                $images = json_decode($related->thumbnail_image, true) ?? [];
                                                $thumbnail = count($images) > 0 ? asset('/murupp/product/thumbnails/' . $images[0]) : asset('images/default-product.jpg');
                                            @endphp
                                            <img class="img-product" data-src="{{ $thumbnail }}" src="{{ $thumbnail }}" alt="{{ $related->name }}">
                                            <img class="img-hover" data-src="{{ $thumbnail }}" src="{{ $thumbnail }}" alt="{{ $related->name }}">
                                        </a>
                                        <div class="variant-wrap size-list">
                                        @php
                                            // Fetch sizes based on stored size IDs
                                            $sizeIds = json_decode($related->sizes, true) ?? [];
                                            $productSizes = \App\Models\ProductSizes::whereIn('id', $sizeIds)
                                                ->whereNull('deleted_at')
                                                ->pluck('size')
                                                ->toArray();
                                        @endphp

                                        <!-- @if(!empty($productSizes))
                                            <ul class="variant-box">
                                                @foreach($productSizes as $size)
                                                    <li class="size-item">{{ $size }}</li>
                                                @endforeach
                                            </ul>
                                        @endif -->

                                        </div>
                                        <div class="list-product-btn">
                                            <a href="javascript:void(0);" onclick="addToWishlist({{ $related->id }}, this)" class="box-icon wishlist btn-icon-action" aria-label="Add to Wishlist">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Wishlist</span>
                                            </a>
                                        </div>

                                        <!-- <div class="list-btn-main">
                                            <a href="{{ route('cart.add', ['id' => $related->id]) }}" data-bs-toggle="modal" class="btn-main-product">Quick Add</a>
                                        </div> -->
                                    </div>
                                    <div class="card-product-info">
                                        <a href="{{ route('product.show', $related->slug) }}" class="title link">{{ $related->product_name }}</a>
                                        <span class="price"><i class="fa fa-inr" aria-hidden="true"></i> {{ $related->product_price }} INR</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="sw-pagination-recent sw-dots type-circle justify-content-center"></div>
                    </div>
                </div>
            </section>
        @endif



        <!-- modal ask_question -->
        <div class="modal modalCentered fade tf-product-modal modal-part-content" id="ask_question">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="header">
                        <div class="demo-title">Get in Touch</div>
                            <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                        </div>
                        
                        <form id="contactForm" action="{{ route('contact.send') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_name" value="{{ $product->product_name }}">

                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset>
                                        <input type="text" id="name" placeholder="Name *" name="name" required>
                                        <span class="text-danger" id="nameError"></span>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        <input type="email" id="email" placeholder="Email *" name="email" required>
                                        <span class="text-danger" id="emailError"></span>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        <input type="text" id="phone" placeholder="Phone number *" name="phone" required min="10" max="10">
                                        <span class="text-danger" id="phoneError"></span>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset>
                                        <input type="text" id="subject" placeholder="Subject *" name="subject" required>
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <fieldset>
                                        <textarea id="message" name="message" rows="4" placeholder="Message *" required></textarea>
                                        <span class="text-danger" id="messageError"></span>
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn-style-2 w-100"><span class="text">Send</span></button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <!-- </form> -->
                </div>
            </div>
        </div>
        <!-- /modal ask_question -->



        @include('components.frontend.footer')
 
        @include('components.frontend.main-js')

    
        <script src="{{ asset('frontend/assets/js/drift.min.js') }}" defer></script>
        <script type="module" src="{{ asset('frontend/assets/js/model-viewer.min.js') }}"></script>
        <script type="module" src="{{ asset('frontend/assets/js/zoom.js') }}"></script>

        


<!--- for form validation--->
<script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        let isValid = true;

        // Name Validation (Only letters & spaces)
        let name = document.getElementById('name').value.trim();
        let nameRegex = /^[a-zA-Z\s]+$/;
        if (!nameRegex.test(name)) {
            document.getElementById('nameError').innerText = "Name must contain only letters & spaces.";
            isValid = false;
        } else {
            document.getElementById('nameError').innerText = "";
        }

        // Email Validation
        let email = document.getElementById('email').value.trim();
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            document.getElementById('emailError').innerText = "Enter a valid email address.";
            isValid = false;
        } else {
            document.getElementById('emailError').innerText = "";
        }

        // Phone Validation (Exactly 10 digits)
        let phone = document.getElementById('phone').value.trim();
        let phoneRegex = /^[0-9]{10}$/;
        if (!phoneRegex.test(phone)) {
            document.getElementById('phoneError').innerText = "Phone number must be exactly 10 digits.";
            isValid = false;
        } else {
            document.getElementById('phoneError').innerText = "";
        }

        // Message Validation (Required)
        let message = document.getElementById('message').value.trim();
        if (message.length === 0) {
            document.getElementById('messageError').innerText = "Message cannot be empty.";
            isValid = false;
        } else {
            document.getElementById('messageError').innerText = "";
        }

        // Prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
        }
    });
</script>


 <!-- For dynamic size fetching -->       
<script>
    function updateSelectedSize(element) {
        document.getElementById('selected-size').innerText = element.value;
    }
</script>


 <!-- For Product color -->   
<script>
    function updateSelectedColor(element) {
        document.getElementById('selected-color').innerText = element.value;
    }
</script>

<!-- For Add to cart based on the quantity selection -->  
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const decreaseBtn = document.querySelector(".btn-decrease");
        const increaseBtn = document.querySelector(".btn-increase");
        const quantityInput = document.querySelector(".quantity-product");
        const addToCartBtn = document.querySelector(".btn-add-to-cart");

        // Function to update the Add to Cart URL dynamically
        function updateCartUrl() {
            let quantity = parseInt(quantityInput.value) || 1;
            if (quantity < 1) quantity = 1; // Ensure minimum quantity of 1
            
            // Update href dynamically with selected quantity
            let baseUrl = "{{ route('cart.add', ['id' => $product->id]) }}";
            addToCartBtn.setAttribute("href", baseUrl + `?quantity=${quantity}`);
        }

        // Increase quantity
        increaseBtn.addEventListener("click", function () {
            let quantity = parseInt(quantityInput.value) || 1;
            quantityInput.value = quantity;
            updateCartUrl();
        });

        // Decrease quantity (minimum 1)
        decreaseBtn.addEventListener("click", function () {
            let quantity = parseInt(quantityInput.value) || 1;
            if (quantity > 1) {
                quantityInput.value = quantity;
                updateCartUrl();
            }
        });

        // On manual input change
        quantityInput.addEventListener("input", function () {
            updateCartUrl();
        });

        // Initialize URL on page load
        updateCartUrl();
    });
</script>

<!-- For Add to cart based on the quantity selection -->  
<!-- <script>

    
    var notyf = new Notyf({
            duration: 5000, 
            ripple: true, 
            position: {
                x: 'right',
                y: 'top',
            },
            dismissible: true,
            types: [
                {
                    type: 'custom-success',
                    background: 'black',  
                    icon: {
                        className: 'fa fa-check-circle', 
                        tagName: 'i',
                        color: 'white' 
                    }
                }
            ]
    });

    document.addEventListener("DOMContentLoaded", function () {
        const cartForm = document.getElementById("cartForm");
        const addToCartBtn = document.querySelector(".btn-add-to-cart");
        const sizeError = document.getElementById("sizeError");
        const sizeInput = document.getElementById("hidden-size");

        function addToCart(event) {
            event.preventDefault();

            // Ensure size is selected
            if (!sizeInput.value.trim()) {
                sizeError.style.display = "block";
                return;
            } else {
                sizeError.style.display = "none";
            }

            let formData = new FormData(cartForm);
            let url = cartForm.action;

            $.ajax({
                url: url,
                type: "GET",  // Ensuring it matches the route method
                data: new URLSearchParams(formData).toString(),
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        notyf.open({
                            type: 'custom-success',
                            message: response.message
                        }); // Replace with a toast notification if needed
                    } else {
                        notyf.open({
                            type: 'warning',
                            message: response.message
                        });
                    }
                },
                error: function () {
                    notyf.error("Something went wrong. Please try again.");
                }
            });
        }

        addToCartBtn.addEventListener("click", addToCart);
    });

</script> -->


<!--- for print name selected option--->
<script>
    function updateSelectedPrint(input) {
        document.getElementById('selected-print').innerText = input.value;
    }
</script>

<!--- for hidden input fields --->
<script>
    function updateSelectedColor(element) {
        document.getElementById('hidden-color').value = element.value;
        document.getElementById('selected-color').textContent = element.value;
    }

    function updateSelectedPrint(element) {
        document.getElementById('hidden-print').value = element.value;
        document.getElementById('selected-print').textContent = element.value;
    }

    function updateSelectedSize(element) {
        document.getElementById('hidden-size').value = element.value;
        document.getElementById('selected-size').textContent = element.value;
    }

</script>

<!---- to manage the validation before adding to cart--->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let cartForm = document.getElementById("cartForm");
        let sizeInput = document.getElementById("hidden-size");
        let errorMsg = document.getElementById("sizeError");

        if (cartForm) {
            cartForm.addEventListener("submit", function (event) {
                if (!sizeInput || !sizeInput.value.trim()) {
                    errorMsg.style.display = "block";
                    event.preventDefault(); // Prevent form submission
                } else {
                    errorMsg.style.display = "none"; // Hide error if size is selected
                }
            });
        }
    });
</script>


</body>

</html>