<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')

    <style>

        .product-img-container {
            position: relative;
            display: inline-block;
        }

        .image-icons {
            position: absolute;
            top: 8px;
            right: 8px;
            display: flex;
            gap: 10px;
            align-items: center;
            opacity: 1; /* Always visible */
            transition: opacity 0.3s ease-in-out;
        }

        .image-icons span,
        .image-icons a {
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 6px;
            border-radius: 50%;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        /* Hover effect - icons slightly enlarge */
        .image-icons span:hover,
        .image-icons a:hover {
            background: rgba(0, 0, 0, 0.8);
            transform: scale(1.1);
        }

        /* Ensure icons remain visible even when hovering over the product image */
        .product-img-container:hover .image-icons {
            opacity: 1 !important;
            z-index: 1;
        }

    
    </style>

</head>
	   

<body class="preload-wrapper">

        @include('components.frontend.header')


        <!-- page-title -->
         <div class="page-title" style="background-image: url(images/bg/page-title.webp);">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">Your Wishlist</h3>
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
                                Wishlist
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title -->


        <!-- Section product -->
        <section class="flat-spacing">
            <div class="container">
                <div class="wrapper-control-shop">
                    <div class="tf-grid-layout wrapper-shop tf-col-3" id="gridLayout">
                    @if ($products->count() > 0)
                        @foreach ($products as $product)
                            <div class="card-product grid">
                                <div class="card-product-wrapper">
                                    <div class="product-img-container">
                                        <a href="{{ route('product.show', ['slug' => $product->slug]) }}" class="product-img">
                                            @php
                                                $thumbnailImages = json_decode($product->thumbnail_image);
                                            @endphp
                                            @if($thumbnailImages && count($thumbnailImages) > 1)
                                                <img class="img-product" data-src="{{ asset('murupp/product/thumbnails/'.$thumbnailImages[0]) }}" src="{{ asset('murupp/product/thumbnails/'.$thumbnailImages[0]) }}" alt="image-product">
                                                <img class="img-hover" data-src="{{ asset('murupp/product/thumbnails/'.$thumbnailImages[1]) }}" src="{{ asset('murupp/product/thumbnails/'.$thumbnailImages[1]) }}" alt="image-product">
                                            @elseif($thumbnailImages && count($thumbnailImages) > 1)
                                                <img class="img-product" data-src="{{ asset('murupp/product/thumbnails/'.$thumbnailImages[0]) }}" src="{{ asset('murupp/product/thumbnails/'.$thumbnailImages[0]) }}" alt="image-product">
                                            @endif
                                        </a>
                                        <!-- Icons (Cross & Shopping Bag) -->
                                        <div class="image-icons">
                                            <a href="{{ route('cart.add', ['id' => $product->id]) }}" class="nav-icon-item">
                                                <svg class="bag-icon icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z"
                                                        stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                            <span class="close-icon">&#10006;</span> 
                                        </div>
                                </div>
                                </div>
                                <div class="card-product-info">
                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}" class="title link">{{ $product->product_name }}</a>
                                    <span class="price current-price"><i class="fa fa-inr" aria-hidden="true"></i> {{ $product->product_price }}</span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="no-products" style="text-align: center;">
                            <p>No products found.</p>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </section>

        


        @include('components.frontend.footer')


        @include('components.frontend.main-js')

</script>

</body>

</html>