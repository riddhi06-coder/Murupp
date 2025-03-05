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

        <!-- Section product -->
        <section class="flat-spacing">
            <div class="container">
                <div class="tf-shop-control">
                    <div class="tf-control-filter">
                        <a href="#filterShop" data-bs-toggle="offcanvas" aria-controls="filterShop" class="tf-btn-filter"><span class="icon icon-filter"></span><span class="text">Filters</span></a>
                    </div>
                    <ul class="tf-control-layout">
                        <li class="tf-view-layout-switch sw-layout-2" data-value-layout="tf-col-2">
                            <div class="item">
                                <svg class="icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="6" cy="6" r="2.5" stroke="#181818"></circle>
                                    <circle cx="14" cy="6" r="2.5" stroke="#181818"></circle>
                                    <circle cx="6" cy="14" r="2.5" stroke="#181818"></circle>
                                    <circle cx="14" cy="14" r="2.5" stroke="#181818"></circle>
                                </svg>
                            </div>
                        </li>
                        <li class="tf-view-layout-switch sw-layout-3 active" data-value-layout="tf-col-3">
                            <div class="item">
                                <svg class="icon" width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="3" cy="6" r="2.5" stroke="#181818" />
                                    <circle cx="11" cy="6" r="2.5" stroke="#181818" />
                                    <circle cx="19" cy="6" r="2.5" stroke="#181818" />
                                    <circle cx="3" cy="14" r="2.5" stroke="#181818" />
                                    <circle cx="11" cy="14" r="2.5" stroke="#181818" />
                                    <circle cx="19" cy="14" r="2.5" stroke="#181818" />
                                </svg>
                            </div>
                        </li>
                        <li class="tf-view-layout-switch sw-layout-4 " data-value-layout="tf-col-4">
                            <div class="item">
                                <svg class="icon" width="30" height="20" viewBox="0 0 30 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="3" cy="6" r="2.5" stroke="#181818" />
                                    <circle cx="11" cy="6" r="2.5" stroke="#181818" />
                                    <circle cx="19" cy="6" r="2.5" stroke="#181818" />
                                    <circle cx="27" cy="6" r="2.5" stroke="#181818" />
                                    <circle cx="3" cy="14" r="2.5" stroke="#181818" />
                                    <circle cx="11" cy="14" r="2.5" stroke="#181818" />
                                    <circle cx="19" cy="14" r="2.5" stroke="#181818" />
                                    <circle cx="27" cy="14" r="2.5" stroke="#181818" />
                                </svg>
                            </div>
                        </li>
                    </ul>
                    
                    <div class="tf-control-sorting">
                        <p class="d-none d-lg-block text-caption-1">Sort by:</p>
                        <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                            <div class="btn-select">
                                <span class="text-sort-value">Best selling</span>
                                <span class="icon icon-arrow-down"></span>
                            </div>
                            <div class="dropdown-menu">
                                <div class="select-item" data-sort-value="best-selling">
                                    <span class="text-value-item">Best selling</span>
                                </div>
                                <div class="select-item" data-sort-value="a-z">
                                    <span class="text-value-item">Alphabetically, A-Z</span>
                                </div>
                                <div class="select-item" data-sort-value="z-a">
                                    <span class="text-value-item">Alphabetically, Z-A</span>
                                </div>
                                <div class="select-item" data-sort-value="price-low-high">
                                    <span class="text-value-item">Price, low to high</span>
                                </div>
                                <div class="select-item" data-sort-value="price-high-low">
                                    <span class="text-value-item">Price, high to low</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="wrapper-control-shop">
                    <!-- <div class="meta-filter-shop">
                        <div id="product-count-grid" class="count-text"></div>
                        <div id="product-count-list" class="count-text"></div>
                        <div id="applied-filters"></div>
                        <button id="remove-all" class="remove-all-filters text-btn-uppercase" style="display: none;">REMOVE ALL <i class="icon icon-close"></i></button>
                    </div> -->
                    <div class="tf-grid-layout wrapper-shop tf-col-3" id="gridLayout">
                        @foreach($products as $product)
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
                                    <!-- <div class="list-product-btn">
                                        <a href="{{ route('wishlist.add', ['id' => $product->id]) }}" class="box-icon wishlist btn-icon-action">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip">Wishlist</span>
                                        </a>
                                    </div> -->

                                    <div class="list-product-btn">
                                        <a href="javascript:void(0);" 
                                        onclick="addToWishlist({{ $product->id }}, this)" 
                                        class="box-icon wishlist btn-icon-action">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip">Wishlist</span>
                                        </a>
                                    </div>

                                    <!-- <div class="list-btn-main">
                                        <a href="{{ route('cart.add', ['id' => $product->id]) }}" class="btn-main-product">Add To cart</a>
                                    </div> -->
                                </div>
                                <div class="card-product-info">
                                    <a href="{{ route('product.show', ['slug' => $product->slug]) }}" class="title link">
                                        {{ $product->product_name }}
                                    </a>
                                    <span class="price current-price"><i class="fa fa-inr" aria-hidden="true"></i> INR {{ $product->product_price }}</span>
                                </div>
                            </div>
                        @endforeach


                           <!-- pagination -->
                        <ul class="wg-pagination justify-content-center">
                            <li><a href="#" class="pagination-item text-button">1</a></li>
                            <li class="active">
                                <div class="pagination-item text-button">2</div>
                            </li>
                            <li><a href="#" class="pagination-item text-button">3</a></li>
                            <li><a href="#" class="pagination-item text-button"><i class="icon-arrRight"></i></a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </section>
        <!-- /Section product -->


        <!-- Filter -->
        <div class="offcanvas offcanvas-start canvas-filter" id="filterShop">
            <div class="canvas-wrapper">
                <div class="canvas-header">
                    <h5>Filters</h5>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
                </div>
                <div class="canvas-body">
                    <!-- Price Filter -->
                    <div class="widget-facet facet-price">
                        <h6 class="facet-title">Price</h6>
                        <div class="price-val-range" id="price-value-range" data-min="{{ $priceRange->min_price }}" data-max="{{ $priceRange->max_price }}"></div>
                        <div class="box-price-product">
                            <div class="box-price-item">
                                <span class="title-price">Min price</span>
                                <div class="price-val" id="price-min-value" data-currency="₹">{{ $priceRange->min_price }}</div>
                            </div>
                            <div class="box-price-item">
                                <span class="title-price">Max price</span>
                                <div class="price-val" id="price-max-value" data-currency="₹">{{ $priceRange->max_price }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Size Filter -->
                    <div class="widget-facet facet-size">
                        <h6 class="facet-title">Size</h6>
                        <div class="facet-size-box size-box">
                            @foreach($sizes as $size)
                                <span class="size-item size-check">{{ $size }}</span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Availability Filter -->
                    <div class="widget-facet facet-fieldset">
                        <h6 class="facet-title">Availability</h6>
                        <div class="box-fieldset-item">
                            <fieldset class="fieldset-item">
                                <input type="radio" name="availability" class="tf-check" id="inStock">
                                <label for="inStock">In stock <span class="count-stock">({{ $inStockCount }})</span></label>
                            </fieldset>
                            <fieldset class="fieldset-item">
                                <input type="radio" name="availability" class="tf-check" id="outStock">
                                <label for="outStock">Out of stock <span class="count-stock">({{ $outStockCount }})</span></label>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="canvas-bottom">
                    <button class="tf-btn  btn-reset mb-2">Apply Filters</button>
                    <button id="reset-filter" class="tf-btn btn-reset">Reset Filters</button>
                </div>
            </div>
        </div>
        <!-- /Filter -->



        @include('components.frontend.footer')


        @include('components.frontend.main-js')

<!-- To manage the dopdown filters of arrainging the data-->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdown = document.querySelector(".tf-dropdown-sort");
        const dropdownMenu = document.querySelector(".dropdown-menu");
        const sortButton = document.querySelector(".btn-select .text-sort-value");
        const sortItems = document.querySelectorAll(".select-item");
        const productContainer = document.getElementById("gridLayout");

        // Toggle dropdown menu visibility
        dropdown.addEventListener("click", function (event) {
            event.stopPropagation();
            dropdownMenu.classList.toggle("show");
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", function (event) {
            if (!dropdown.contains(event.target)) {
                dropdownMenu.classList.remove("show");
            }
        });

        // Function to extract price correctly
        function getPrice(element) {
            let priceText = element.querySelector(".current-price")?.textContent || "";
            let price = priceText.replace(/[^\d.]/g, "").trim(); // Remove non-numeric characters except '.'
            return price ? parseFloat(price) : 0; // Ensure valid number
        }

        // Sorting functionality
        sortItems.forEach(item => {
            item.addEventListener("click", function () {
                const sortValue = this.getAttribute("data-sort-value");
                let products = Array.from(productContainer.children);

                if (sortValue === "a-z") {
                    products.sort((a, b) => 
                        a.querySelector(".title").textContent.trim().localeCompare(
                            b.querySelector(".title").textContent.trim()
                        )
                    );
                } else if (sortValue === "z-a") {
                    products.sort((a, b) => 
                        b.querySelector(".title").textContent.trim().localeCompare(
                            a.querySelector(".title").textContent.trim()
                        )
                    );
                } else if (sortValue === "price-low-high") {
                    products.sort((a, b) => {
                        let priceA = getPrice(a);
                        let priceB = getPrice(b);

                        if (priceA === priceB) {
                            return a.querySelector(".title").textContent.trim().localeCompare(
                                b.querySelector(".title").textContent.trim()
                            );
                        }
                        return priceA - priceB;
                    });
                } else if (sortValue === "price-high-low") {
                    products.sort((a, b) => {
                        let priceA = getPrice(a);
                        let priceB = getPrice(b);

                        if (priceA === priceB) {
                            return a.querySelector(".title").textContent.trim().localeCompare(
                                b.querySelector(".title").textContent.trim()
                            );
                        }
                        return priceB - priceA;
                    });
                }

                // Update the product list
                productContainer.innerHTML = "";
                products.forEach(product => productContainer.appendChild(product));

                // Update the dropdown button text
                sortButton.textContent = this.textContent.trim();

                // Close the dropdown after selection
                dropdownMenu.classList.remove("show");
            });
        });
    });
</script>


<script>

    document.addEventListener("DOMContentLoaded", function () {
        let minPrice = document.getElementById("price-value-range").getAttribute("data-min");
        let maxPrice = document.getElementById("price-value-range").getAttribute("data-max");

        // Example using jQuery UI slider (if needed)
        $("#price-value-range").slider({
            range: true,
            min: parseInt(minPrice),
            max: parseInt(maxPrice),
            values: [parseInt(minPrice), parseInt(maxPrice)],
            slide: function (event, ui) {
                $("#price-min-value").text("₹" + ui.values[0]);
                $("#price-max-value").text("₹" + ui.values[1]);
            }
        });
    });

</script>




</body>

</html>