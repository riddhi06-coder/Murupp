  <!-- Footer -->
  <footer id="footer" class="footer">
            <div class="footer-wrap">
            <div class="footer-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="footer-infor">
                                <div class="footer-logo">
                                    <a href="{{ route('frontend.index') }}">
                                        <img src="{{ asset('frontend/assets/images/logo/logo.webp') }}" width="144px" height="26px" alt="Murupp Logo">
                                    </a>
                                </div>
                                @php
                                    $footer = \App\Models\Footer::first();
                                @endphp
                                <div class="footer-address">
                                    <p>{!! $footer->about !!}</p>
                                    <!-- <a href="{{ $footer->map_url ?? '#' }}" class="tf-btn-default fw-6" target="_blank">GET DIRECTION<i class="icon-arrowUpRight"></i></a> -->
                                </div>

                                <ul class="footer-info">
                                <li>
                                    <i class="icon-mail"></i>
                                    <p>
                                        <a href="mailto:{{ $footer->email ?? '' }}">{{ $footer->email ?? '' }}</a>
                                    </p>
                                </li>
                                <li>
                                    <i class="icon-phone"></i>
                                    <p>
                                        <a href="tel:+91{{ $footer->contact_number ?? '' }}">+91 {{ $footer->contact_number ?? '' }}</a>
                                    </p>
                                </li>

                                </ul>
                                    @php
                                        // Decode the stored media platform and link arrays
                                        $mediaPlatforms = json_decode($footer->media_platform ?? '[]', true);
                                        $mediaLinks = json_decode($footer->media_link ?? '[]', true);

                                        // Define icons for known platforms
                                        $socialIcons = [
                                            '1' => ['class' => 'social-facebook', 'icon' => 'icon-fb', 'label' => 'Facebook'],
                                            '2' => ['class' => 'social-twitter', 'icon' => 'icon-x', 'label' => 'Twitter'],
                                            '3' => ['class' => 'social-instagram', 'icon' => 'icon-instagram', 'label' => 'Instagram'],
                                            '4' => ['class' => 'social-pinterest', 'icon' => 'icon-pinterest', 'label' => 'Pinterest']
                                        ];
                                    @endphp

                                    <ul class="tf-social-icon">
                                        @foreach($mediaPlatforms as $index => $platformId)
                                            @if(!empty($mediaLinks[$index]) && isset($socialIcons[$platformId])) 
                                                <li>
                                                    <a href="{{ $mediaLinks[$index] }}" class="{{ $socialIcons[$platformId]['class'] }}" aria-label="{{ $socialIcons[$platformId]['label'] }}">
                                                        <i class="icon {{ $socialIcons[$platformId]['icon'] }}"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="footer-menu">
                                <div class="footer-col-block">
                                    <div class="footer-heading text-button footer-heading-mobile">
                                        Information
                                    </div>
                                    <div class="tf-collapse-content">
                                        <ul class="footer-menu-list">
                                            <li class="text-caption-1">
                                                <a href="#" class="footer-menu_item">About Us</a>
                                            </li>
                                            <li class="text-caption-1">
                                                <a href="#" class="footer-menu_item">Contact us</a>
                                            </li>
                                            <li class="text-caption-1">
                                                <a href="{{ route('shipping.delivery') }}" class="footer-menu_item">Shipping & Delivery</a>
                                            </li>
                                            <li class="text-caption-1">
                                                <a href="{{ route('return.refunds') }}" class="footer-menu_item">Return & Refunds</a>
                                            </li>
                                            <li class="text-caption-1">
                                                <a href="{{ route('privacy.policy') }}" class="footer-menu_item">Privacy Policy</a>
                                            </li>
                                            <li class="text-caption-1">
                                                <a href="{{ route('terms.condition') }}" class="footer-menu_item">Terms of Service</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @php
                                    use Illuminate\Support\Facades\DB;
                                    $categories = DB::table('master_product_category')
                                        ->whereNull('deleted_by')
                                        ->orderBy('id', 'asc')
                                        ->get();
                                @endphp

                                <div class="footer-col-block">
                                    <div class="footer-heading text-button footer-heading-mobile">
                                        Category
                                    </div>
                                    <div class="tf-collapse-content">
                                        <ul class="footer-menu-list">
                                            @foreach ($categories as $category)
                                                <li class="text-caption-1">
                                                    <a href="{{ route('product.category', ['slug' => $category->slug]) }}" class="footer-menu_item">
                                                        {{ $category->category_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="footer-col-block">
                                <div class="footer-heading text-button footer-heading-mobile">
                                    Newsletter
                                </div>
                                <div class="tf-collapse-content">
                                    <div class="footer-newsletter">
                                        <p class="text-caption-1">Sign up for our newsletter and get your first purchase</p>
                                        <form id="subscribe-form" action="#" class="form-newsletter subscribe-form" method="post" accept-charset="utf-8" data-mailchimp="true">
                                            <div id="subscribe-content" class="subscribe-content">
                                                <fieldset class="email">
                                                    <input id="subscribe-email" type="email" name="email-form" class="subscribe-email" placeholder="Enter your e-mail" tabindex="0" aria-required="true">
                                                </fieldset>
                                                <div class="button-submit">
                                                    <button id="subscribe-button" class="subscribe-button" type="button" aria-label="Subscribe">
                                                        <i class="icon icon-arrowUpRight"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="subscribe-msg" class="subscribe-msg"></div>
                                        </form>
                                        <!-- <div class="tf-cart-checkbox">
                                            <div class="tf-checkbox-wrapp">
                                                <input class="" type="checkbox" id="footer-Form_agree" name="agree_checkbox">
                                                <div>
                                                    <i class="icon-check"></i>
                                                </div>
                                            </div>
                                            <label class="text-caption-1" for="footer-Form_agree">
                                                By clicking subscribe, you agree to the <a class="fw-6 link" href="#">Terms of Service</a> and <a class="fw-6 link" href="#">Privacy Policy</a>.
                                            </label>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="footer-bottom-wrap">
                                    <div class="left">
                                        <p class="text-caption-1">Copyright © 2025 Murupp. All rights reserved. Designed By <a href="https://www.matrixbricks.com/" target="_bl">Matrix Bricks</a></p>
                                    </div>
                                    <div class="tf-payment">
                                        <p class="text-caption-1">Payment:</p>
                                        <ul>
                                            <li>
                                                <img src="{{ asset('frontend/assets/images/payment/img-1.png') }}" alt="">
                                            </li>
                                            <li>
                                                <img src="{{ asset('frontend/assets/images/payment/img-2.png') }}" alt="">
                                            </li>
                                            <li>
                                                <img src="{{ asset('frontend/assets/images/payment/img-3.png') }}" alt="">
                                            </li>
                                            <li>
                                                <img src="{{ asset('frontend/assets/images/payment/img-4.png') }}" alt="">
                                            </li>
                                            <li>
                                                <img src="{{ asset('frontend/assets/images/payment/img-5.png') }}" alt="">
                                            </li>
                                            <li>
                                                <img src="{{ asset('frontend/assets/images/payment/img-6.png') }}" alt="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /Footer -->

        <a href="https://web.whatsapp.com/" class="float" target="_blank">
            <i class="fab fa-whatsapp my-float"></i>
        </a>

        <!-- Include Notyf CSS & JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.css" type="text/css" media="all">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.js"></script>


         <!-- Wishlist Ajax Funtion -->
        <script>

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

            function addToWishlist(productId, element) {
                $.ajax({
                    url: "{{ route('wishlist.add', '') }}/" + productId,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: productId
                    },
                    success: function(response) {
                        if (response.success) {
                            $(element).find('.icon').removeClass('icon-heart').addClass('icon-heart-filled');
                            $(element).addClass('active');

                            notyf.open({
                                type: 'custom-success',
                                message: response.message
                            });
                        } else {
                            notyf.open({
                                type: 'warning',
                                message: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        notyf.error("Something went wrong. Please try again.");
                    }
                });
            }
        </script>

