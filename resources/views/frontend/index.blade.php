<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')

</head>
	   

<body class="preload-wrapper">

        @include('components.frontend.header')


        <!-- Slider -->
        <div class="tf-slideshow slider-default default-2 slider-effect-fade">
            <div dir="ltr" class="swiper tf-sw-slideshow" 
                data-preview="1" 
                data-tablet="1" 
                data-mobile="1" 
                data-centered="false" 
                data-space="0" 
                data-space-mb="0" 
                data-loop="true" 
                data-auto-play="true" 
                aria-label="Fashion slideshow">
                <div class="swiper-wrapper">
                    @foreach($banners as $banner)
                    <!-- Slide -->
                    <div class="swiper-slide">
                        <div class="wrap-slider">
                            <img src="{{ asset('murupp/home/banner/' . $banner->banner_images) }}" 
                                alt="{{ $banner->banner_heading }}" 
                                loading="lazy">
                            <div class="box-content">
                                <div class="container">
                                    <div class="content-slider">
                                        <div class="box-title-slider">
                                            <p class="fade-item fade-item-3 body-text-1 subheading text-white">
                                                {{ $banner->banner_heading }}
                                            </p>
                                            <div class="fade-item fade-item-1 heading text-white title-display">
                                                {{ $banner->banner_title }}
                                            </div>
                                        </div>
                                        <div class="fade-item fade-item-3 box-btn-slider">
                                            <a href="{{ route('collection.view', ['slug' => $banner->slug]) }}" class="tf-btn btn-fill btn-white">
                                                <span class="text">Shop Now</span>
                                                <i class="icon icon-arrowUpRight"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Pagination Dots -->
            <div class="wrap-pagination">
                <div class="container">
                    <div class="sw-dots sw-pagination-slider type-circle white-circle-line justify-content-center" 
                        role="navigation" 
                        aria-label="Slideshow navigation">
                    </div>
                </div>
            </div>
        </div>
        <!-- /Slider -->

        <!-- Marquee -->
        <!-- <section class="tf-marquee bg-surface">
            <div class="marquee-wrapper">
                <div class="initial-child-container">
                    <div class="marquee-child-item">
                        <p class="text-btn-uppercase">Free shipping on all orders over $20.00</p>
                    </div>
                    <div class="marquee-child-item">
                        <span class="icon icon-lightning-line"></span>
                    </div>
                    <div class="marquee-child-item">
                        <p class="text-btn-uppercase">Returns are free within 14 days</p>
                    </div>
                    <div class="marquee-child-item">
                        <span class="icon icon-lightning-line"></span>
                    </div>
                    <div class="marquee-child-item">
                        <p class="text-btn-uppercase">Free shipping on all orders over $20.00</p>
                    </div>
                    <div class="marquee-child-item">
                        <span class="icon icon-lightning-line"></span>
                    </div>
                    <div class="marquee-child-item">
                        <p class="text-btn-uppercase">Returns are free within 14 days</p>
                    </div>
                    <div class="marquee-child-item">
                        <span class="icon icon-lightning-line"></span>
                    </div>
                    <div class="marquee-child-item">
                        <p class="text-btn-uppercase">Free shipping on all orders over $20.00</p>
                    </div>
                    <div class="marquee-child-item">
                        <span class="icon icon-lightning-line"></span>
                    </div>
                    <div class="marquee-child-item">
                        <p class="text-btn-uppercase">Returns are free within 14 days</p>
                    </div>
                    <div class="marquee-child-item">
                        <span class="icon icon-lightning-line"></span>
                    </div>
                    <div class="marquee-child-item">
                        <p class="text-btn-uppercase">Free shipping on all orders over $20.00</p>
                    </div>
                    <div class="marquee-child-item">
                        <span class="icon icon-lightning-line"></span>
                    </div>
                    <div class="marquee-child-item">
                        <p class="text-btn-uppercase">Returns are free within 14 days</p>
                    </div>
                    <div class="marquee-child-item">
                        <span class="icon icon-lightning-line"></span>
                    </div>
                    <div class="marquee-child-item">
                        <p class="text-btn-uppercase">Free shipping on all orders over $20.00</p>
                    </div>
                    <div class="marquee-child-item">
                        <span class="icon icon-lightning-line"></span>
                    </div>
                    <div class="marquee-child-item">
                        <p class="text-btn-uppercase">Returns are free within 14 days</p>
                    </div>
                    <div class="marquee-child-item">
                        <span class="icon icon-lightning-line"></span>
                    </div>
                    <div class="marquee-child-item">
                        <p class="text-btn-uppercase">Free shipping on all orders over $20.00</p>
                    </div>
                    <div class="marquee-child-item">
                        <span class="icon icon-lightning-line"></span>
                    </div>
                    <div class="marquee-child-item">
                        <p class="text-btn-uppercase">Returns are free within 14 days</p>
                    </div>
                    <div class="marquee-child-item">
                        <span class="icon icon-lightning-line"></span>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- /Marquee -->


        <!-- Selling -->
        <section class="flat-spacing">
            <div class="container">
                <div class="heading-section-2 wow fadeInUp">
                    <h3 class="heading">New Arrivals</h3>
                    @php
                        $collection = $newArrivals->firstWhere('collection_slug', '!=', null);
                    @endphp

                    @if($collection)
                        <a href="{{ route('collection.view', ['slug' => $collection->collection_slug]) }}" class="btn-line">
                            View All Collection
                        </a>
                    @else
                        <a href="#" class="btn-line">View All Collection</a>
                    @endif


                </div>
                <div dir="ltr" class="swiper tf-sw-recent" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                    <div class="swiper-wrapper">
                    @foreach ($newArrivals as $product)
                        <div class="swiper-slide">
                            <div class="card-product card-product-size wow fadeInUp" data-wow-delay="0s">
                                <div class="card-product-wrapper">
                                    <a href="{{ route('product.show', ['slug' => $product->product_slug]) }}" class="product-img">
                                        <img class="img-product" 
                                            data-src="{{ asset('murupp/home/new-arrivals/' . $product->product_image) }}" 
                                            src="{{ asset('murupp/home/new-arrivals/' . $product->product_image) }}" 
                                            alt="{{ $product->product_name }}">

                                        <img class="img-hover" 
                                            data-src="{{ asset('murupp/home/new-arrivals/' . $product->product_image) }}" 
                                            src="{{ asset('murupp/home/new-arrivals/' . $product->product_image) }}" 
                                            alt="{{ $product->product_name }}">
                                    </a>

                                    <div class="list-product-btn">
                                        <a href="javascript:void(0);" 
                                        class="box-icon wishlist btn-icon-action" 
                                        aria-label="Add to Wishlist"
                                        onclick="addToWishlist({{ $product->product_id }}, this)">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip">Wishlist</span>
                                        </a>
                                    </div>

                                </div>

                                <div class="card-product-info">
                                    <a href="{{ route('product.show', ['slug' => $product->product_slug]) }}" class="title link">
                                        {{ $product->product_name }}
                                    </a>
                                    <span class="price"><i class="fa fa-inr" aria-hidden="true"></i> {{ $product->product_price }} INR</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    </div>
                    <div class="sw-pagination-recent sw-dots type-circle justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Selling -->

        <!-- Banner with text -->
        <section class="flat-spacing about-us-main pt-0">
            <div class="container">
                <div class="row flat-img-with-text-v2 align-items-center">
                    <!-- Image Section -->
                    <div class="col-lg-5 col-md-6">
                    <div class="about-us-features wow fadeInLeft">
                        <img class="lazyload"
                            data-src="{{ asset('murupp/home/collection-details/' . $collectionDetail->image) }}"
                            src="{{ asset('murupp/home/collection-details/default-placeholder.jpg') }}" 
                            alt="{{ $collectionDetail->heading }}" 
                            loading="lazy">
                    </div>

                    </div>
                    <!-- Text Section -->
                    <div class="col-lg-7 col-md-6">
                        <article class="banner-left">
                            <div class="box-title wow fadeInUp">
                                <h3>{{ $collectionDetail->heading }}</h3>
                                <blockquote>
                                    <p>{!! $collectionDetail->description !!}</p>
                                </blockquote>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Banner with text -->

        <!-- Categories -->
        <section class="flat-spacing pt-0">
            <div class="container">
                <div class="heading-section text-center wow fadeInUp">
                    <h3 class="heading">Shop by Categories</h3>
                </div>
                <div class="grid-cls grid-cls-v2">
                    @foreach ($shopCategories as $category)
                        <div class="item{{ $loop->iteration }} collection-position-2 hover-img">
                            <a class="img-style">
                                <img class="lzyload"
                                    data-src="{{ asset('murupp/home/shop_categories/' . $category->product_image) }}" 
                                    src="{{ asset('murupp/home/shop_categories/' . $category->product_image) }}" 
                                    alt="{{ $category->image_title }}">
                            </a>
                            <div class="content">
                                <div class="title-top">
                                    <h4 class="title">
                                        <a href="{{ !empty($category->slug) ? route('product.category', ['slug' => $category->slug]) : '#' }}" 
                                        class="link text-white wow fadeInUp">
                                            {{ $category->category_name }} 
                                        </a>
                                    </h4>
                                </div>
                                <div>
                                    <a href="{{ !empty($category->slug) ? route('product.category', ['slug' => $category->slug]) : '#' }}" 
                                    class="btn-line style-white">Shop Now</a>
                                </div>
                            </div>


                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- /Categories -->

        <!-- Iconbox -->
        <section class="flat-spacing line-top-container">
            <div class="container">
                <div dir="ltr" class="swiper tf-sw-iconbox" data-preview="2" data-tablet="2" data-mobile-sm="2" data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-sm="2" data-pagination-md="3" data-pagination-lg="4">
                    <div class="swiper-wrapper">
                        @foreach ($productPolicies as $policy)
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-2">
                                    @if($policy->policy_image)
                                        <div class="icon-box">
                                            <img src="{{ asset('/murupp/home/product-policies/' . $policy->policy_image) }}" alt="{{ $policy->heading }}" class="img-fluid">
                                        </div>
                                    @else
                                        <div class="icon-box">
                                            <span class="icon icon-return"></span>
                                        </div>
                                    @endif
                                    <div class="content">
                                        <h6>{{ $policy->heading }}</h6>
                                        <p class="text-secondary">{{ $policy->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="sw-pagination-iconbox sw-dots type-circle justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Iconbox -->


        <!-- Testimonial -->
        <!-- <section class="flat-spacing bg-surface">
            <div class="container">
                <div class="heading-section text-center wow fadeInUp">
                    <h3 class="heading">Customer Say!</h3>
                    <p class="subheading">Our customers adore our products, and we constantly aim to delight them.</p>
                </div>
                <div class="swiper tf-sw-testimonial wow fadeInUp" data-wow-delay="0.1s" data-preview="3" data-tablet="2" data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                    <div class="swiper-wrapper">
                        @foreach ($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="testimonial-item style-2 style-3">
                                    <div class="content-top">
                                        <div class="box-icon">
                                            <i class="icon icon-quote"></i>
                                        </div>
                                        <div class="text-title">{{ $testimonial->heading }}</div>
                                        <p class="text-secondary">{!! $testimonial->description !!}</p>
                                    </div>
                                    <div class="box-avt">
                                        <div class="box-rate-author">
                                            <div class="list-star-default">
                                                @for ($i = 0; $i < $testimonial->star_rating; $i++)
                                                    <i class="icon icon-star"></i>
                                                @endfor
                                            </div>
                                            <div class="box-author">
                                                <div class="text-title author">{{ $testimonial->reviewer }}</div>
                                                <svg class="icon" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_15758_14563)">
                                                    <path d="M6.875 11.6255L8.75 13.5005L13.125 9.12549" stroke="#3DAB25" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M10 18.5005C14.1421 18.5005 17.5 15.1426 17.5 11.0005C17.5 6.85835 14.1421 3.50049 10 3.50049C5.85786 3.50049 2.5 6.85835 2.5 11.0005C2.5 15.1426 5.85786 18.5005 10 18.5005Z" stroke="#3DAB25" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </g>
                                                    <defs>
                                                    <clipPath id="clip0_15758_14563">
                                                    <rect width="20" height="20" fill="white" transform="translate(0 0.684082)"/>
                                                    </clipPath>
                                                    </defs>
                                                </svg> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="sw-pagination-testimonial sw-dots type-circle d-flex justify-content-center"></div>
                </div>
            </div>
        </section> -->
        <!-- /Testimonial -->


        <!-- /Iconbox -->
        <section class="flat-spacing pb-0">
            @if($socialMedia)
                <div class="heading-section text-center wow fadeInUp">
                    <h3 class="heading">{{ $socialMedia->section_heading }}</h3>
                    <p class="subheading text-secondary">{{ $socialMedia->section_title }}</p>
                </div>
            @endif
            <script src="https://static.elfsight.com/platform/platform.js" async></script>
            <div class="elfsight-app-8f24f565-abc8-4144-95c9-4922f192f0cf" data-elfsight-app-lazy></div>
        </section>
        <!-- /Iconbox -->


        @include('components.frontend.footer')


    @include('components.frontend.main-js')




</body>

</html>