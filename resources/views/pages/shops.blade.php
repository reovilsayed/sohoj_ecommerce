@php
    $route = route('shops');
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
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assetss/responsive.css') }}" />
    <link rel="stylesheet" id="bg-switcher-css" href="{{ asset('assets/frontend-assetss/css/backgrounds/bg-4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/shops.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assetss/responsive.css') }}" />
    <link rel="stylesheet" id="bg-switcher-css" href="{{ asset('assets/frontend-assetss/css/backgrounds/bg-4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/shops.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        :root {
            --primary-color: #FF0000;
            /* Button color */
            --secondary-color: #01949a;
            /* Accent color */
            --text-color: #1f2937;
            --light-gray: #f3f4f6;
            --medium-gray: #e5e7eb;
            --dark-gray: #6b7280;
            --white: #ffffff;
            --primary: #01949a;
            --primary-hover: #a1887f;
            --bg: #d7ccc8;
            --card-bg: #ffffff;
            --border-radius: 18px;
            --shadow: 0 8px 32px rgba(141, 110, 99, 0.10);
            --text: #4e342e;
            --muted: #a1887f;
            --danger: #e53935;
            --success: #43a047;
            --accent: #efebe9;
            --step-gradient: linear-gradient(90deg, #8d6e63 0%, #a1887f 100%);
        }

        /* Modern Shops Page Design */
        .modern-shops-container {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }

        .modern-filter-sidebar {
            background: white;
            /* border-radius: 20px; */
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .filter-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f8f9fa;
        }

        .filter-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }

        .clear-filters-btn {
            background: #2c3e50;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .clear-filters-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 183, 126, 0.3);
            color: white !important;
        }

        .filter-section {
            margin-bottom: 2rem;
        }

        .filter-section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-section-title i {
            color: #3bb77e;
        }

        /* Price Range Styling */
        .price-range-container {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .price-range-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .price-slider {
            margin: 1rem 0;
        }

        .price-display {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            border: 1px solid #e9ecef;
            font-weight: 600;
            color: #3bb77e;
        }

        /* Category Filter Styling */
        .category-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .category-item {
            margin-bottom: 0.5rem;
        }

        .category-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
            background: #f8f9fa;
            border-radius: 10px;
            text-decoration: none;
            color: #2c3e50;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .category-link:hover {
            background: linear-gradient(135deg, #e8f5e8, #d4edda);
            border-color: #3bb77e;
            color: #2d9d6b;
            transform: translateX(5px);
        }

        .category-badge {
            background: #2c3e50;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* Rating Filter Styling */
        .rating-container {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 1.5rem;
        }

        /* Improved custom checkbox for rating filter */
        .rating-option {
            position: relative;
            cursor: pointer;
            user-select: none;
            transition: box-shadow 0.2s, background 0.2s;
            box-shadow: 0 1px 4px rgba(59, 183, 126, 0.04);
        }

        .rating-option input[type="checkbox"] {
            opacity: 0;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            margin: 0;
            cursor: pointer;
            z-index: 2;
        }

        .rating-checkmark {
            display: inline-block;
            width: 22px;
            height: 22px;
            border: 2px solid #2c3e50;
            border-radius: 6px;
            background: #fff;
            margin-right: 1rem;
            position: relative;
            transition: border-color 0.2s, background 0.2s;
            vertical-align: middle;
        }

        .rating-option input[type="checkbox"]:checked~.rating-checkmark {
            background: #2c3e50;
            border-color: #2c3e50;
        }

        .rating-checkmark:after {
            content: '';
            position: absolute;
            display: none;
        }

        .rating-option input[type="checkbox"]:checked~.rating-checkmark:after {
            display: block;
        }

        .rating-option .rating-checkmark:after {
            left: 6px;
            top: 2px;
            width: 6px;
            height: 12px;
            border: solid #fff;
            border-width: 0 3px 3px 0;
            border-radius: 1px;
            transform: rotate(45deg);
            content: '';
        }

        .rating-option:hover,
        .rating-option input[type="checkbox"]:focus~.rating-checkmark {
            background: #e8f5e8;
            box-shadow: 0 2px 8px rgba(59, 183, 126, 0.10);
        }

        .rating-option input[type="checkbox"] {
            margin-right: 1rem;
            transform: scale(1.2);
        }

        .rating-stars {
            color: #ffc107;
            margin-right: 1rem;
        }

        .rating-text {
            font-weight: 600;
            color: #2c3e50;
        }

        /* Main Content Area */
        .modern-content-area {
            background: white;
            /* border-radius: 20px; */
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f8f9fa;
        }

        .search-results {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2c3e50;
        }

        .search-term {
            color: #3bb77e;
            font-weight: 800;
        }

        .sort-container {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sort-label {
            font-weight: 600;
            color: #2c3e50;
        }

        .sort-select {
            padding: 0.5rem 1rem;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            background: white;
            font-weight: 600;
            color: #2c3e50;
            transition: all 0.3s ease;
        }

        .sort-select:focus {
            outline: none;
            border-color: #3bb77e;
            box-shadow: 0 0 0 3px rgba(59, 183, 126, 0.1);
        }

        /* Shop Cards Section */
        .shop-section {
            margin-bottom: 3rem;
        }

        .shop-section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .shop-card-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .shop-card-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
        }

        /* View More Button */
        .view-more-container {
            text-align: center;
            margin: 3rem 0;
        }

        .view-more-btn {
            background: linear-gradient(135deg, #3bb77e, #2d9d6b);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 8px 25px rgba(59, 183, 126, 0.3);
        }

        .view-more-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(59, 183, 126, 0.4);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .modern-shops-container {
                padding: 1rem 0;
            }

            .modern-filter-sidebar {
                padding: 1.5rem;
                margin-bottom: 1rem;
            }

            .modern-content-area {
                padding: 1.5rem;
            }

            .content-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .sort-container {
                width: 100%;
                justify-content: space-between;
            }
        }

        /* Animation for page load */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modern-filter-sidebar,
        .modern-content-area {
            animation: fadeInUp 0.6s ease-out;
        }

        .checkout-hero {
            background: #01949a;
            color: #fff;
            /* border-radius: var(--border-radius); */
            box-shadow: var(--shadow);
            padding: 2rem 2.5rem 1.5rem 2.5rem;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .checkout-hero::after {
            content: '';
            position: absolute;
            right: -60px;
            top: -40px;
            width: 180px;
            height: 180px;
            background: var(--accent);
            opacity: 0.12;
            border-radius: 50%;
            z-index: 0;
        }

        .checkout-hero h2,
        .checkout-hero p,
        .checkout-hero-steps {
            position: relative;
            z-index: 1;
        }
    </style>
@endsection
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
                                <a href="{{ route('shops') }}" class="clear-filters-btn" style="color: #ffffff">
                                    <i class="fas fa-times"></i>
                                    Clear All
                                </a>
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
                                        <span>Min: <span id="minPriceDisplay">$0</span></span>
                                        <span>Max: <span id="maxPriceDisplay">$1000</span></span>
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
                                            <a href="javascript::void(0)" class="category-link"
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
                                                {{ request('ratings') == 5 ? 'checked' : '' }}>
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
                                                {{ request('ratings') == 4 ? 'checked' : '' }}>
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
                                                {{ request('ratings') == 3 ? 'checked' : '' }}>
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
                                                {{ request('ratings') == 2 ? 'checked' : '' }}>
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
                                                {{ request('ratings') == 1 ? 'checked' : '' }}>
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
                                    Results for "<span class="search-term">{{ request()->search }}</span>"
                                </div>
                                <div class="sort-container">
                                    <span class="sort-label">Sort by:</span>
                                    <select name="ec-select" class="sort-select"
                                        onchange='updateSearchParams("filter_products",this.value,"{{ $route }}")'>
                                        <option value="most-sold"
                                            {{ request()->filter_products == 'most-sold' ? 'selected' : '' }}>Most Sold
                                        </option>
                                        <option value="price-low-high"
                                            {{ request()->filter_products == 'price-low-high' ? 'selected' : '' }}>Price,
                                            low to high</option>
                                        <option value="price-high-low"
                                            {{ request()->filter_products == 'price-high-low' ? 'selected' : '' }}>Price,
                                            high to low</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Products Grid -->
                            <div class="shop-pro-content">
                                <div class="shop-pro-inner">
                                    <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-1">
                                        @foreach ($products as $shopId => $items)
                                            @foreach ($items as $product)
                                                <x-products.product :product="$product" :variant="'red'" :showMultipleCategories="true" />
                                            @endforeach
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
@endsection
