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
                                <a class="link" href="#">Shop by Collection</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                {{ $category->collection_name }}
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
                    <div class="meta-filter-shop">
                        <div id="product-count-grid" class="count-text"></div>
                        <div id="product-count-list" class="count-text"></div>
                        <div id="applied-filters"></div>
                        <button id="remove-all" class="remove-all-filters text-btn-uppercase" style="display: none;">REMOVE ALL <i class="icon icon-close"></i></button>
                    </div>
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
                                            <span class="icon icon-heart "></span>
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


                           <!-- pagination
                        <ul class="wg-pagination justify-content-center">
                            <li><a href="#" class="pagination-item text-button">1</a></li>
                            <li class="active">
                                <div class="pagination-item text-button">2</div>
                            </li>
                            <li><a href="#" class="pagination-item text-button">3</a></li>
                            <li><a href="#" class="pagination-item text-button"><i class="icon-arrRight"></i></a></li>
                        </ul> -->

                    </div>
                        <!-- Filtered Products Section -->
                        <div class="tf-grid-layout wrapper-shop tf-col-3" id="filteredResults"></div>
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

                    <div class="widget-facet facet-categories">
                        <h6 class="facet-title">Shop by Category</h6>
                        <ul class="facet-content">
                            @foreach ($categories as $cat)
                                <li>
                                    <label class="category-label">
                                        <input type="checkbox" name="categories[]" value="{{ $cat->slug }}" class="category-checkbox">
                                        <a href="{{ url('/category/' . $cat->slug) }}" class="categories-item {{ $cat->id == $category->id ? 'active' : '' }}">
                                            {{ $cat->category_name }} <span class="count-cate">({{ $cat->product_count }})</span>
                                        </a>
                                    </label>
                                </li>
                            @endforeach
                        </ul>

                    </div>
         
                    <!-- Price Filter -->
                    <div class="widget-facet facet-price">
                        <h6 class="facet-title">Price</h6>
                        <div class="price-val-range" id="price-value-range" data-min="{{ $priceRange->min_price }}" data-max="{{ $priceRange->max_price }}"></div>
                        
                        <div id="price-slider"></div><br> <!-- Slider Container -->

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
                    <button id="apply-filters" class="tf-btn  btn-reset mb-2">Apply Filters</button>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!------ for price slider dynamic range---->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let priceSlider = document.getElementById("price-slider");

        let minPrice = parseInt(document.getElementById("price-value-range").dataset.min) || 0;
        let maxPrice = parseInt(document.getElementById("price-value-range").dataset.max) || 10000; // Default max price

        noUiSlider.create(priceSlider, {
            start: [minPrice, maxPrice],
            connect: true,
            step: 1,
            range: {
                min: minPrice,
                max: maxPrice,
            },
            format: {
                from: function (value) {
                    return parseInt(value);
                },
                to: function (value) {
                    return parseInt(value);
                },
            },
        });

        // Update min & max price values when the slider is moved
        priceSlider.noUiSlider.on("update", function (values) {
            document.getElementById("price-min-value").innerText = `₹${values[0]}`;
            document.getElementById("price-max-value").innerText = `₹${values[1]}`;
        });

        // Trigger filtering on change (when user stops moving the slider)
        priceSlider.noUiSlider.on("change", function (values) {
            let min = values[0];
            let max = values[1];

            filterProducts(min, max);
        });

        function filterProducts(min, max) {
            fetch(`/filter-products?min_price=${min}&max_price=${max}`)
                .then(response => response.json())
                .then(data => {
                    console.log("Filtered Products:", data.filteredProducts);
                    // You can update the product list dynamically here
                })
                .catch(error => console.error("Error:", error));
        }
    });
</script>

<!------ Ajax for filetered results fetching----> 
<script>
    $(document).ready(function () {
        $('#apply-filters').click(function () {
            let minPrice = $('#price-min-value').text().trim().replace('₹', '');
            let maxPrice = $('#price-max-value').text().trim().replace('₹', '');
            let sizes = [];

            $('.size-check.selected').each(function () {
                sizes.push($(this).text().trim());
            });

            let availability = $('input[name="availability"]:checked').attr('id');
            let categoryId = $('#category-id').val();

            let selectedCategories = [];
            $('.category-checkbox:checked').each(function () {
                selectedCategories.push($(this).val());// Get the slug value
            });

            // Extract slug from the URL (last segment of pathname)
            let currentUrl = window.location.pathname;
            let slug = currentUrl.split('/').pop();

            $.ajax({
                url: "{{ route('changes.filter') }}",
                method: "GET",
                data: {
                    categories: selectedCategories,
                    slug: slug, // Passing slug to the controller
                    min_price: minPrice,
                    max_price: maxPrice,
                    sizes: sizes,
                    availability: availability
                },
                success: function (response) {
                    let pathParts = window.location.pathname.split("/").filter(part => part !== "");
                    let projectDirectory = pathParts.length > 0 ? "/" + pathParts[0] : "";

                    let baseUrl = window.location.origin + "/" + window.location.pathname.split("/")[1];


                    let filteredProductsHTML = '';

                    if (response.filteredProducts.length > 0) {
                        response.filteredProducts.forEach(product => {
                            let productImages = JSON.parse(product.thumbnail_image || '[]');
                            let imgSrc1 = productImages.length > 0 ? `${baseUrl}/murupp/product/thumbnails/${productImages[0]}` : 'default-image.jpg';
                            let imgSrc2 = productImages.length > 1 ? `${baseUrl}/murupp/product/thumbnails/${productImages[1]}` : imgSrc1;

                            filteredProductsHTML += `
                                <div class="card-product grid">
                                    <div class="card-product-wrapper">
                                        <a href="/product-detail/${product.slug}" class="product-img">
                                            <img class="img-product" src="${imgSrc1}" alt="image-product">
                                            <img class="img-hover" src="${imgSrc2}" alt="image-product">
                                        </a>
                                        <div class="list-product-btn">
                                            <a href="javascript:void(0);" onclick="addToWishlist(${product.id}, this)" class="box-icon wishlist btn-icon-action">
                                                <span class="icon icon-heart"></span>
                                                <span class="tooltip">Wishlist</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-product-info">
                                        <a href="/product-detail/${product.slug}" class="title link">${product.product_name}</a>
                                        <span class="price current-price"><i class="fa fa-inr" aria-hidden="true"></i> INR ${product.product_price}</span>
                                    </div>
                                </div>
                            `;
                        });
                    } 
                    else {
                        filteredProductsHTML = '<p>No products found.</p>';
                    }

                    // Display filtered products
                    $('#filteredResults').html(filteredProductsHTML);
                    $('#gridLayout').hide();
                    $('#filteredResults').show();

                    // Update applied filters
                    let appliedFiltersHTML = '';
                    if (response.appliedFilters.length > 0) {
                        appliedFiltersHTML = response.appliedFilters.map(filter => 
                            `<span class="filter-tag">${filter} <i class="icon icon-close remove-filter"></i></span>`
                        ).join('');
                        $('#remove-all').show();
                    } else {
                        $('#remove-all').hide();
                    }

                    $('#applied-filters').html(appliedFiltersHTML);

                    // Close the offcanvas
                    let filterOffcanvas = document.getElementById('filterShop');
                    let bsOffcanvas = bootstrap.Offcanvas.getInstance(filterOffcanvas);
                    if (bsOffcanvas) {
                        bsOffcanvas.hide();
                    } else {
                        let newOffcanvas = new bootstrap.Offcanvas(filterOffcanvas);
                        newOffcanvas.hide();
                    }
                }
            });
        });

        // Handle size selection
        $('.size-check').click(function () {
            $(this).toggleClass('selected');
        });

        // Remove specific filters
        $(document).on('click', '.remove-filter', function () {
            $(this).parent().remove();
            // $('#apply-filters').click(); // Reapply filters
        });

        // // Reset filters
        $('#reset-filter, #remove-all').click(function () {
            location.reload();
        });
    });
</script>


</body>

</html>