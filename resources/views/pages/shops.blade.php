@php
    $route = route('shops');
    
    // Check if any filters are active
    $hasActiveFilters = request('category') || request('ratings') || request('priceMin') || request('priceMax') || request('filter_products') || request('search');
    
    // Get current filter values
    $currentCategory = request('category');
    $currentRating = request('ratings');
    $currentPriceMin = request('priceMin', 0);
    $currentPriceMax = request('priceMax', 1000);
    $currentFilterProducts = request('filter_products', 'most-sold');
@endphp

@section('title', 'All Shops | Afrikartt E-commerce')
@section('meta_description',
    'Browse all shops on Afrikartt E-commerce. Find top-rated vendors, trending stores, and the
    best deals in one place.')
@section('meta_keywords', 'shops, vendors, ecommerce, online stores, Afrikartt')
@section('meta_og')
    <meta property="og:title" content="All Shops | Afrikartt E-commerce">
    <meta property="og:description"
        content="Browse all shops on Afrikartt E-commerce. Find top-rated vendors, trending stores, and the best deals in one place.">
    <meta property="og:image" content="{{ asset('assets/logo/logo007.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
@endsection
@section('meta_twitter')
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="All Shops | Afrikartt E-commerce">
    <meta name="twitter:description"
        content="Browse all shops on Afrikartt E-commerce. Find top-rated vendors, trending stores, and the best deals in one place.">
    <meta name="twitter:image" content="{{ asset('assets/logo/logo007.png') }}">
@endsection
@section('canonical_url', route('shops'))



@extends('layouts.app')

@section('content')
    <main>
        <x-app.header />
        <section class="modern-shops-container">
            <div class="container">
                <div class="checkout-hero mb-4 position-relative">
                    <h2 class="fw-bold mb-1 text-light">Explore Our Shops</h2>
                    <p class="mb-0">Browse your favorite stores and enjoy fast, secure delivery on every order.</p>

                    <div
                        class="checkout-hero-steps d-none d-md-flex position-absolute end-0 top-0 h-100 align-items-center pe-4">
                        <a href="{{ route('homepage') }}"><span class="badge bg-light text-primary me-2">Home</span></a>
                        <span class="badge bg-light text-primary me-2">Shops</span>
                    </div>
                </div>
                <div class="row">
                    <!-- Modern Filter Sidebar -->
                    <aside class="col-md-3 col-sm-12">
                        <div class="modern-filter-sidebar">
                            <div class="filter-header">
                                <h2 class="filter-title">
                                    <i class="fas fa-filter"></i>
                                    Filters
                                </h2>
                                @if($hasActiveFilters)
                                    <a href="{{ route('shops') }}" class="clear-filters-btn" style="color: #ffffff">
                                        <i class="fas fa-times"></i>
                                        Clear All
                                    </a>
                                @endif
                            </div>
                            <!-- Price Range Filter -->
                            <div class="filter-section">
                                <h3 class="filter-section-title">
                                    <i class="fas fa-dollar-sign"></i>
                                    Price Range
                                </h3>
                                <div class="price-range-container">
                                    <div class="price-range-title">Set your budget</div>
                                    <div id="price-slider" class="price-slider"></div>
                                    <div id="price-display" class="price-display">
                                        <span>Min: <span id="minPriceDisplay">${{ $currentPriceMin }}</span></span>
                                        <span>Max: <span id="maxPriceDisplay">${{ $currentPriceMax }}</span></span>
                                    </div>
                                </div>
                            </div>
                            <!-- Categories Filter -->
                            <div class="filter-section">
                                <h3 class="filter-section-title">
                                    <i class="fas fa-tags"></i>
                                    Categories
                                </h3>
                                <ul class="category-list">
                                    @foreach ($categories as $category)
                                        <li class="category-item">
                                            <a href="javascript:void(0)" 
                                               class="category-link {{ $currentCategory == $category->slug ? 'active' : '' }}"
                                               onclick='updateSearchParams("category","{{ $category->slug }}","{{ $route }}")'>
                                                <span>{{ $category->name }}</span>
                                                <span class="category-badge">{{ $category->products->count() }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Rating Filter -->
                            <div class="filter-section">
                                <h3 class="filter-section-title">
                                    <i class="fas fa-star"></i>
                                    Rating
                                </h3>
                                <div class="rating-container">
                                    <form class="rating" id="ratingForm">
                                        <div class="rating-option">
                                            <input type="checkbox" value="5"
                                                {{ $currentRating == 5 ? 'checked' : '' }}>
                                            <span class="rating-checkmark"></span>
                                            <div class="rating-stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span class="rating-text">5</span>
                                        </div>
                                        <div class="rating-option">
                                            <input type="checkbox" value="4"
                                                {{ $currentRating == 4 ? 'checked' : '' }}>
                                            <span class="rating-checkmark"></span>
                                            <div class="rating-stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <span class="rating-text">4</span>
                                        </div>
                                        <div class="rating-option">
                                            <input type="checkbox" value="3"
                                                {{ $currentRating == 3 ? 'checked' : '' }}>
                                            <span class="rating-checkmark"></span>
                                            <div class="rating-stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <span class="rating-text">3</span>
                                        </div>
                                        <div class="rating-option">
                                            <input type="checkbox" value="2"
                                                {{ $currentRating == 2 ? 'checked' : '' }}>
                                            <span class="rating-checkmark"></span>
                                            <div class="rating-stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <span class="rating-text">2</span>
                                        </div>
                                        <div class="rating-option">
                                            <input type="checkbox" value="1"
                                                {{ $currentRating == 1 ? 'checked' : '' }}>
                                            <span class="rating-checkmark"></span>
                                            <div class="rating-stars">
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <span class="rating-text">1</span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <!-- Main Content Area -->
                    <section class="col-md-9 col-sm-12">
                        <div class="modern-content-area">
                            <!-- Content Header -->
                            <div class="content-header">
                                <div class="search-results">
                                    Results for "<span class="search-term">{{ request()->search ?: 'All Products' }}</span>"
                                </div>
                                <div class="sort-container">
                                    <span class="sort-label">Sort by:</span>
                                    <select name="ec-select" class="sort-select"
                                        onchange='updateSearchParams("filter_products",this.value,"{{ $route }}")'>
                                        <option value="most-sold"
                                            {{ $currentFilterProducts == 'most-sold' ? 'selected' : '' }}>Most Sold
                                        </option>
                                        <option value="price-low-high"
                                            {{ $currentFilterProducts == 'price-low-high' ? 'selected' : '' }}>Price,
                                            low to high</option>
                                        <option value="price-high-low"
                                            {{ $currentFilterProducts == 'price-high-low' ? 'selected' : '' }}>Price,
                                            high to low</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Products Grid -->
                            <div class="shop-pro-content">
                                <div class="shop-pro-inner">
                                    <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-1">
                                        @foreach ($products as $product)
                                        <x-products.product :product="$product" :variant="'green'" :showMultipleCategories="true" />
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('js')

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('assets/frontend-assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>

    <script src="{{ asset('assets/frontend-assets/js/main.js') }}"></script>
    
    <script>
        var shopUrl = "{{ route('shops') }}";
        var currentPriceMin = {{ $currentPriceMin }};
        var currentPriceMax = {{ $currentPriceMax }};

        $(document).ready(function() {
            // Initialize price slider with current values
            $("#price-slider").slider({
                range: true,
                min: 0,
                max: 1000,
                values: [currentPriceMin, currentPriceMax],
                slide: function(event, ui) {
                    $("#minPriceDisplay").text('$' + ui.values[0]);
                    $("#maxPriceDisplay").text('$' + ui.values[1]);
                },
                stop: function(event, ui) {
                    updateSearchParams('', '', shopUrl, ui.values[0], ui.values[1]);
                }
            });

            // Display initial price values
            $("#minPriceDisplay").text('$' + $("#price-slider").slider("values", 0));
            $("#maxPriceDisplay").text('$' + $("#price-slider").slider("values", 1));

            // Rating filter functionality
            $('#ratingForm input[type="checkbox"]').on('change', function() {
                if ($(this).is(':checked')) {
                    updateSearchParams("ratings", $(this).val(), shopUrl);
                } else {
                    removeSearchParam("ratings", shopUrl);
                }
            });
        });

        function updateSearchParams(searchParam, searchValue, route, priceMin, priceMax) {
            var url;
            
            if (window.location.pathname !== "/shops") {
                url = new URL(route);
            } else {
                url = new URL(window.location.href);
            }

            if (searchParam) {
                url.searchParams.set(searchParam, searchValue);
            }

            // Set the price range parameters if provided
            if (priceMin !== undefined) {
                url.searchParams.set('priceMin', priceMin);
            }

            if (priceMax !== undefined) {
                url.searchParams.set('priceMax', priceMax);
            }

            // Preserve existing parameters
            var existingParams = new URLSearchParams(window.location.search);
            existingParams.forEach(function(value, key) {
                if (key !== searchParam && key !== 'priceMin' && key !== 'priceMax') {
                    url.searchParams.set(key, value);
                }
            });

            window.location = url.href;
        }

        function removeSearchParam(searchParam, route) {
            var url;

            if (window.location.pathname !== "/shops") {
                url = new URL(route);
            } else {
                url = new URL(window.location.href);
            }

            var existingParams = new URLSearchParams(window.location.search);
            existingParams.delete(searchParam);

            var newUrl = url.href.split('?')[0] + '?' + existingParams.toString();
            window.location = newUrl;
        }
    </script>
@endsection
