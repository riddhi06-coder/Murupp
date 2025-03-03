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
                        @foreach ($products as $product)
                            <div class="card-product grid">
                                <div class="card-product-wrapper">
                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}" class="product-img">
                                        @php
                                            $thumbnailImages = json_decode($product->thumbnail_image);
                                        @endphp
                                        @if($thumbnailImages && count($thumbnailImages) > 1)
                                            <img class="img-product" data-src="{{ asset('murupp/product/thumbnails/'.$thumbnailImages[0]) }}" src="{{ asset('murupp/product/thumbnails/'.$thumbnailImages[0]) }}" alt="image-product">
                                            <img class="img-hover" data-src="{{ asset('murupp/product/thumbnails/'.$thumbnailImages[1]) }}" src="{{ asset('murupp/product/thumbnails/'.$thumbnailImages[1]) }}" alt="image-product">
                                        @elseif($thumbnailImages && count($thumbnailImages) > 0)
                                            <img class="img-product" data-src="{{ asset('murupp/product/thumbnails/'.$thumbnailImages[0]) }}" src="{{ asset('murupp/product/thumbnails/'.$thumbnailImages[0]) }}" alt="image-product">
                                        @endif
                                    </a>
                                </div>
                                <div class="card-product-info">
                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}" class="title link">{{ $product->product_name }}</a>
                                    <span class="price current-price"><i class="fa fa-inr" aria-hidden="true"></i> {{ $product->product_price }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        


        @include('components.frontend.footer')


        @include('components.frontend.main-js')

</script>

</body>

</html>