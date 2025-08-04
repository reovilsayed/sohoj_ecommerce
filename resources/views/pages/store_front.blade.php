@extends('layouts.app')
@section('title', $shop->name . ' | Shop on Afrikartt E-commerce')
@section('meta_description',
    Str::limit(
    $shop->description ??
    ($shop->short_description ??
    'Shop ' .
    $shop->name .
    ' on
    Afrikartt E-commerce. Quality products, great deals, and excellent customer service.'),
    160,
    ))
@section('meta_keywords', $shop->name . ', shop, store, ecommerce, online shopping, Afrikartt, ' . $shop->city . ', ' .
    $shop->state)
@section('canonical_url', route('store_front', $shop->slug))
@section('meta_og')
    <meta property="og:title" content="{{ $shop->name }} | Shop on Afrikartt E-commerce">
    <meta property="og:description"
        content="{{ Str::limit($shop->description ?? ($shop->short_description ?? 'Shop ' . $shop->name . ' on Afrikartt E-commerce. Quality products, great deals, and excellent customer service.'), 160) }}">
    <meta property="og:image" content="{{ Storage::url($shop->logo) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
@endsection
@section('meta_twitter')
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $shop->name }} | Shop on Afrikartt E-commerce">
    <meta name="twitter:description"
        content="{{ Str::limit($shop->description ?? ($shop->short_description ?? 'Shop ' . $shop->name . ' on Afrikartt E-commerce. Quality products, great deals, and excellent customer service.'), 160) }}">
    <meta name="twitter:image" content="{{ Storage::url($shop->logo) }}">
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/colors.css') }}">
    <style>
        /* Facebook-inspired Design with Brand Colors */
        :root {
            --fb-blue: var(--primary-color);
            --fb-green: var(--success-color);
            --fb-gray: var(--bg-light);
            --fb-dark: var(--text-dark);
            --fb-text: var(--text-primary);
            --fb-text-secondary: var(--text-muted);
            --fb-border: var(--border-light);
            --fb-hover: var(--bg-lighter);
            --fb-shadow: 0 2px 4px var(--shadow-light);
            --fb-shadow-lg: 0 4px 12px var(--shadow-medium);
            --fb-accent: var(--accent-color);
        }

        body {
            background-color: var(--bg-light);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        /* Cover Photo Section */
        .cover-photo-container {
            position: relative;
            height: 500px;
            background: var(--gradient-primary);
            /* border-radius: 0 0 20px 20px; */
            overflow: hidden;
            margin-bottom: 80px;
        }

        .cover-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.8;
        }

        .cover-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50%;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.3));
        }

        /* Profile Section */
        .profile-section {
            position: relative;
            margin-top: -80px;
            padding: 0 20px;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            box-shadow: var(--fb-shadow-lg);
            padding: 30px;
            margin-bottom: 30px;
        }

        .profile-avatar {
            width: 168px;
            height: 168px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: var(--fb-shadow);
            object-fit: cover;
            margin-top: -120px;
            margin-bottom: 20px;
        }

        .profile-info h1 {
            font-size: 32px;
            font-weight: 700;
            color: var(--fb-text);
            margin-bottom: 8px;
        }

        .profile-subtitle {
            color: var(--fb-text-secondary);
            font-size: 16px;
            margin-bottom: 16px;
        }

        .profile-stats {
            display: flex;
            gap: 24px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--fb-text-secondary);
            font-size: 14px;
        }

        .stat-number {
            font-weight: 600;
            color: var(--fb-text);
        }

        .profile-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn-fb-primary {
            background: var(--btn-primary);
            color: var(--text-light);
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-fb-primary:hover {
            background: var(--btn-primary-hover);
            color: var(--text-light);
        }

        .btn-fb-secondary {
            background: var(--btn-secondary);
            color: var(--text-light);
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-fb-secondary:hover {
            background: var(--btn-secondary-hover);
            color: var(--text-light);
        }

        /* Navigation Tabs */
        .nav-tabs-fb {
            background: var(--bg-secondary);
            border-radius: 12px;
            box-shadow: var(--fb-shadow);
            padding: 8px;
            margin-bottom: 24px;
            display: flex;
            gap: 4px;
        }

        .nav-tab-fb {
            flex: 1;
            padding: 12px 16px;
            border: none;
            background: transparent;
            border-radius: 8px;
            font-weight: 600;
            color: var(--fb-text-secondary);
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
            font-size: 14px;
        }

        .nav-tab-fb.active {
            background: var(--primary-color);
            color: var(--text-light);
        }

        .nav-tab-fb:hover:not(.active) {
            background: var(--bg-lighter);
        }

        /* Content Cards */
        .content-card {
            background: var(--bg-secondary);
            border-radius: 12px;
            box-shadow: var(--fb-shadow);
            margin-bottom: 24px;
            overflow: hidden;
        }

        .card-header-fb {
            padding: 20px;
            border-bottom: 1px solid var(--fb-border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .card-title {
            font-weight: 600;
            color: var(--fb-text);
            margin: 0;
            font-size: 16px;
        }

        .card-subtitle {
            color: var(--fb-text-secondary);
            font-size: 14px;
            margin: 0;
        }

        .card-content {
            padding: 20px;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .product-card-fb {
            background: var(--bg-secondary);
            border-radius: 12px;
            box-shadow: var(--fb-shadow);
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }

        .product-card-fb:hover {
            transform: translateY(-2px);
            box-shadow: var(--fb-shadow-lg);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-info {
            padding: 16px;
        }

        .product-title {
            font-weight: 600;
            color: var(--fb-text);
            margin-bottom: 8px;
            font-size: 16px;
            line-height: 1.4;
        }

        .product-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 8px;
        }

        .product-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 12px;
            color: var(--fb-text-secondary);
        }

        /* Reviews Section */
        .review-card {
            background: var(--bg-secondary);
            border-radius: 12px;
            box-shadow: var(--fb-shadow);
            padding: 20px;
            margin-bottom: 16px;
        }

        .review-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .review-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .review-info h6 {
            margin: 0;
            font-weight: 600;
            color: var(--fb-text);
        }

        .review-date {
            color: var(--fb-text-secondary);
            font-size: 12px;
        }

        .review-content {
            color: var(--fb-text);
            line-height: 1.5;
        }

        /* About Section */
        .about-card {
            background: var(--bg-secondary);
            border-radius: 12px;
            box-shadow: var(--fb-shadow);
            padding: 24px;
            margin-bottom: 24px;
        }

        .about-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--fb-text);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .about-content {
            color: var(--fb-text);
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .about-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 16px;
            margin-top: 20px;
        }

        .stat-card {
            text-align: center;
            padding: 16px;
            background: var(--bg-light);
            border-radius: 8px;
        }

        .stat-icon {
            font-size: 24px;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 12px;
            color: var(--fb-text-secondary);
            margin-bottom: 4px;
        }

        .stat-value {
            font-size: 18px;
            font-weight: 700;
            color: var(--fb-text);
        }

        /* Social Links */
        .social-links {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin: 24px 0;
        }

        .social-link {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            transition: transform 0.2s;
            text-decoration: none;
        }

        .social-link:hover {
            transform: scale(1.1);
            color: white;
        }

        .social-facebook {
            background: var(--primary-color);
        }

        .social-instagram {
            background: var(--gradient-accent);
        }

        .social-twitter {
            background: var(--info-color);
        }

        .social-linkedin {
            background: var(--primary-color);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .cover-photo-container {
                height: 250px;
                margin-bottom: 60px;
            }

            .profile-avatar {
                width: 120px;
                height: 120px;
                margin-top: -80px;
            }

            .profile-info h1 {
                font-size: 24px;
            }

            .profile-actions {
                flex-direction: column;
            }

            .nav-tabs-fb {
                flex-direction: column;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 16px;
            }

            .about-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Loading Animation */
        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }
    </style>
@endsection

@section('content')
    <x-app.header />

    <!-- Cover Photo Section -->
    <div class="cover-photo-container">
        @php
            $bannerPath = $shop->banner;
            $extension = strtolower(pathinfo($bannerPath, PATHINFO_EXTENSION));
            $videoExtensions = ['mp4', 'webm', 'ogg', 'mov', 'avi'];
            $imageExtensions = ['jpeg', 'png', 'webp', 'jpg', 'gif', 'svg', 'svg+xml', 'avif'];
            $isVideo = in_array($extension, $videoExtensions);
            $isImage = in_array($extension, $imageExtensions);
        @endphp

        @if ($bannerPath)
            @if ($isVideo)
                <video src="{{ Storage::url($bannerPath) }}" autoplay muted loop></video>
            @elseif ($isImage)
                <img class="cover-photo" src="{{ Storage::url($bannerPath) }}" alt="{{ $shop->name }} cover photo">
            @else
                <div class="cover-placeholder">Invalid banner format</div>
            @endif
        @else
            <div class="cover-placeholder">No banner available</div>
        @endif

        {{-- <div class="cover-overlay"></div> --}}
    </div>
    {{-- @if ($shop->slug == 'adidas-bd')
        <div class="container mt-4">
            <div class="row">
                <!-- Left Sidebar - Brand Information -->
                <div class="col-md-3">
                    <div class="brand-sidebar">
                        <!-- Brand Logo and Name -->
                        <div class="brand-header text-center mb-4">
                            <img class="brand-logo" src="{{ Storage::url($shop->logo) }}" alt="{{ $shop->name }} logo">
                            <h2 class="brand-name mt-3">{{ $shop->name }}</h2>
                      

                            <p class="brand-tagline text-muted">
                                {{  Illuminate\Support\Str::limit($shop->short_description, 200) }}
                            </p>
                        </div>

                        <!-- Contact Information -->
                        <div class="brand-info-card">
                            <h5 class="info-title"><i class="fas fa-info-circle me-2"></i>Shop Information</h5>
                            <ul class="info-list">
                                <li>
                                    <i class="fas fa-user me-2"></i>
                                    <span>Owner: {{ $shop->user->name }}</span>
                                </li>
                                <li>
                                    <i class="fas fa-building me-2"></i>
                                    <span>Company: {{ $shop->company_name }}</span>
                                </li>
                                <li>
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    <span> {{ $shop->city }}, {{ $shop->state }}</span>
                                </li>
                                <li>
                                    <i class="fas fa-phone me-2"></i>
                                    <span>{{ $shop->phone }}</span>
                                </li>
                                <li>
                                    <i class="fas fa-envelope me-2"></i>
                                    <span>{{ $shop->email }}</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Stats -->
                        <div class="brand-stats-card">
                            <div class="stat-item">
                                <div class="stat-value">{{ number_format(Sohoj::average_rating($shop->ratings), 1) }}</div>
                                <div class="stat-label">Average Rating</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">{{ $shop->orders->count() }}</div>
                                <div class="stat-label">Total Sales</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">{{ $shop->ratings->count() }}</div>
                                <div class="stat-label">Reviews</div>
                            </div>
                        </div>

                        <!-- Follow/Message Buttons -->
                        <div class="brand-actions">
                            @auth
                                <form action="{{ route('follow', $shop) }}" method="post">
                                    @csrf
                                    @php
                                        $follow = auth()->user()->follows($shop);
                                    @endphp
                                    <button class="add-to-cart-btn">
                                        <i class="fas fa-user-plus me-2 py-2 "></i>
                                        {{ $follow ? 'Unfollow Shop' : 'Follow Shop' }}
                                    </button>
                                </form>
                            @else
                                <a class="add-to-cart-btn py-2 text-white" href="{{ route('login') }}">
                                    <i class="fas fa-user-plus me-2"></i>
                                    Follow Shop
                                </a>
                            @endauth

                            <a href="{{ route('massage.create', $shop->id) }}" class="btn btn-block btn-message text-white">
                                <i class="fas fa-envelope me-2"></i>
                                Contact Seller
                            </a>
                        </div>

                        <!-- Social Links -->
                        @if ($shop->facebook || $shop->instagram || $shop->twitter || $shop->linkedin)
                            <div class="brand-social-card">
                                <h5 class="social-title">Follow Us</h5>
                                <div class="social-links">
                                    @if ($shop->facebook)
                                        <a href="{{ $shop->facebook }}" target="_blank" class="social-link">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    @endif
                                    @if ($shop->instagram)
                                        <a href="{{ $shop->instagram }}" target="_blank" class="social-link">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    @endif
                                    @if ($shop->twitter)
                                        <a href="{{ $shop->twitter }}" target="_blank" class="social-link">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    @endif
                                    @if ($shop->linkedin)
                                        <a href="{{ $shop->linkedin }}" target="_blank" class="social-link">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right Content Area -->
                <div class="col-md-9">
                    <!-- Navigation Tabs with Search Box -->
                    <div class="brand-content-tabs">
                        <div class="tabs-header">
                            <ul class="nav nav-tabs" id="shopTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home" type="button" role="tab">
                                        <i class="fas fa-home me-2"></i>Home
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="products-tab" data-bs-toggle="tab"
                                        data-bs-target="#products" type="button" role="tab">
                                        <i class="fas fa-box me-2"></i>Products
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="about-tab" data-bs-toggle="tab" data-bs-target="#about"
                                        type="button" role="tab">
                                        <i class="fas fa-info-circle me-2"></i>About
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                        data-bs-target="#reviews" type="button" role="tab">
                                        <i class="fas fa-star me-2"></i>Reviews
                                    </button>
                                </li>
                            </ul>

                            <!-- Search Box moved to right side -->
                            <div class="search-container">
                                <form action="{{ route('store_front', $shop->slug) }}" method="get"
                                    class="search-form">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Search products...">
                                        <button type="submit" class="btn btn-search">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="tab-content" id="shopTabsContent">
                            <!-- Home Tab -->
                            <div class="tab-pane fade show active" id="home" role="tabpanel">
                                
                                <!-- Featured Products -->
                                @if (count($shop->products()->where('featured', 1)->get()) > 0)
                                    <div class="content-card mb-4">
                                        <div class="card-header">
                                            <h4>Featured Products</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($shop->products()->where('featured', 1)->get() as $product)
                                                    <x-products.product :product="$product" />
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Current Offers -->
                                <div class="content-card">
                                    <div class="card-header">
                                        <h4>Current Offers</h4>
                                    </div>
                                    <div class="card-body">
                                        <x-offer :shop="$shop" />
                                    </div>
                                </div>
                            </div>

                            <!-- Products Tab -->
                            <div class="tab-pane fade" id="products" role="tabpanel">
                                <div class="content-card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4>All Products</h4>
                                        <div class="product-filters">
                                            <select class="form-select form-select-sm">
                                                <option>Sort by</option>
                                                <option>Price: Low to High</option>
                                                <option>Price: High to Low</option>
                                                <option>Newest</option>
                                                <option>Popular</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if (count($shop->products) > 0)
                                            <div class="row">
                                                @foreach ($shop->products as $product)
                                                    <x-products.product :product="$product" />
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-center py-4">
                                                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">No products available</h5>
                                                <p class="text-muted">This shop hasn't added any products yet.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- About Tab -->
                            <div class="tab-pane fade" id="about" role="tabpanel">
                                <div class="content-card mb-4">
                                    <div class="card-header">
                                        <h4>About {{ $shop->name }}</h4>
                                    </div>
                                    <div class="card-body">
                                        {!! $shop->description !!}
                                    </div>
                                </div>

                                @if ($shop->shopPolicy)
                                    <div class="content-card">
                                        <div class="card-header">
                                            <h4>Shop Policies</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="policy-item">
                                                        <div class="policy-icon text-danger">
                                                            <i class="fas fa-ban"></i>
                                                        </div>
                                                        <div class="policy-details">
                                                            <h6>Cancellation Policy</h6>
                                                            <p>{{ $shop->shopPolicy->cancellation }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="policy-item">
                                                        <div class="policy-icon text-warning">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </div>
                                                        <div class="policy-details">
                                                            <h6>Return & Exchange</h6>
                                                            <p>{{ $shop->shopPolicy->return_exchange }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="policy-item">
                                                        <div class="policy-icon text-success">
                                                            <i class="fas fa-credit-card"></i>
                                                        </div>
                                                        <div class="policy-details">
                                                            <h6>Payment Options</h6>
                                                            <p>{{ $shop->shopPolicy->payment_option }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="policy-item">
                                                        <div class="policy-icon text-primary">
                                                            <i class="fas fa-truck"></i>
                                                        </div>
                                                        <div class="policy-details">
                                                            <h6>Delivery Information</h6>
                                                            <p>{{ $shop->shopPolicy->delivery }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Reviews Tab -->
                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="content-card">
                                    <div class="card-header">
                                        <h4>Customer Reviews</h4>
                                        <div class="rating-summary">
                                            <div class="average-rating">
                                                {{ number_format(Sohoj::average_rating($shop->ratings), 1) }}
                                                <input name="rating" type="number"
                                                    value="{{ Sohoj::average_rating($shop->ratings) }}"
                                                    class="rating published_rating" data-size="xs" readonly>
                                            </div>
                                            <div class="total-reviews">{{ $shop->ratings->count() }} reviews</div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if ($shop->ratings()->count() > 0)
                                            @foreach ($shop->ratings as $rating)
                                                <div class="review-item mb-4">
                                                    <div class="review-header">
                                                        <img class="review-avatar"
                                                            src="{{ asset('assets/img/single_product/person.png') }}"
                                                            alt="Reviewer">
                                                        <div class="reviewer-info">
                                                            <h6>{{ $rating->name }}</h6>
                                                            <div class="review-date">
                                                                {{ $rating->created_at->format('M d, Y') }}</div>
                                                        </div>
                                                        <div class="review-rating">
                                                            <input name="rating" type="number"
                                                                value="{{ $rating->rating }}"
                                                                class="rating published_rating" data-size="xs" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="review-content">
                                                        <p>{{ $rating->review }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-center py-4">
                                                <i class="fas fa-star fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">No reviews yet</h5>
                                                <p class="text-muted">Be the first to review this shop!</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* Brand Sidebar Styles */
            .brand-sidebar {
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                padding: 20px;
            }

            .brand-logo {
                width: 120px;
                height: 120px;
                object-fit: contain;
                border-radius: 50%;
                border: 1px solid #eee;
                padding: 5px;
            }

            .brand-name {
                font-size: 1.5rem;
                font-weight: 600;
                color: #333;
            }

            .brand-tagline {
                font-size: 0.9rem;
            }

            .brand-info-card {
                background: #f9f9f9;
                border-radius: 8px;
                padding: 15px;
                margin-bottom: 20px;
            }

            .info-title {
                font-size: 1.1rem;
                margin-bottom: 15px;
                color: #444;
            }

            .info-list {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .info-list li {
                margin-bottom: 10px;
                font-size: 0.9rem;
                color: #555;
            }

            .info-list i {
                width: 20px;
                text-align: center;
            }

            .brand-stats-card {
                display: flex;
                justify-content: space-between;
                background: #fff;
                border: 1px solid #eee;
                border-radius: 8px;
                padding: 15px;
                margin-bottom: 20px;
            }

            .stat-item {
                text-align: center;
            }

            .stat-value {
                font-size: 1.3rem;
                font-weight: 600;
                color: #333;
            }

            .stat-label {
                font-size: 0.8rem;
                color: #777;
            }

            .brand-actions {
                margin-bottom: 20px;
            }

            .btn-follow,
            .btn-message {
                width: 100%;
                margin-bottom: 10px;
                border-radius: 6px;
                /* padding: 10px; */
                font-size: 0.9rem;
            }

            .btn-follow {
                background-color: #f8f9fa;
                border: 1px solid #ddd;
                color: #333;
            }

            .btn-follow:hover {
                background-color: #e9ecef;
            }

            .btn-message {
                background-color: var(--accent-color);
                color: white;
                border-radius: 10px;
                margin-top: 10px;
            }

            .btn-message:hover {
                background-color: var(--accent-color);
            }

            .brand-social-card {
                background: #f9f9f9;
                border-radius: 8px;
                padding: 15px;
            }

            .social-title {
                font-size: 1.1rem;
                margin-bottom: 15px;
                color: #444;
            }

            .social-links {
                display: flex;
                justify-content: center;
                gap: 15px;
            }

            .social-link {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1rem;
                text-decoration: none;
            }

            .social-facebook {
                background-color: #3b5998;
            }

            .social-instagram {
                background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
            }

            .social-twitter {
                background-color: #1da1f2;
            }

            .social-linkedin {
                background-color: #0077b5;
            }

            /* Content Tabs Styles */
            .brand-content-tabs {
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            }

            .tabs-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0 20px;
                border-bottom: 1px solid #eee;
            }

            .nav-tabs {
                border-bottom: none;
            }

            .nav-tabs .nav-link {
                border: none;
                color: #555;
                font-weight: 500;
                padding: 15px 20px;
                border-bottom: 3px solid transparent;
            }

            .nav-tabs .nav-link:hover {
                border-color: transparent;
                color: var(--accent-color) !important;
            }

            .nav-tabs .nav-link.active {
                color: var(--accent-color) !important;
                border-bottom: 3px solid var(--accent-color) !important;
                background: transparent;
            }

            .search-container {
                margin-left: auto;
                padding: 10px 0;
            }

            .search-form {
                width: 250px;
            }

            .search-form .input-group {
                width: 100%;
            }

            .search-form .form-control {
                border-radius: 20px 0 0 20px;
                border-right: none;
                height: 38px;
                font-size: 0.9rem;
            }

            .search-form .btn-search {
                background: var(--accent-color) !important;
                color: white;
                border-radius: 0 20px 20px 0;
                border-left: none;
                height: 45px;
                width: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .tab-content {
                padding: 20px;
            }

            .content-card {
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
                margin-bottom: 20px;
            }

            .card-header {
                padding: 15px 20px;
                border-bottom: 1px solid #eee;
                display: flex;
                align-items: center;
            }

            .card-header h4 {
                margin: 0;
                font-size: 1.2rem;
            }

            .card-body {
                padding: 20px;
            }

            /* Policy Items */
            .policy-item {
                display: flex;
                margin-bottom: 20px;
            }

            .policy-icon {
                font-size: 1.5rem;
                margin-right: 15px;
                width: 40px;
                text-align: center;
            }

            .policy-details h6 {
                font-size: 1rem;
                margin-bottom: 5px;
            }

            .policy-details p {
                font-size: 0.9rem;
                color: #666;
                margin: 0;
            }

            /* Review Items */
            .review-item {
                padding-bottom: 15px;
                border-bottom: 1px solid #eee;
            }

            .review-item:last-child {
                border-bottom: none;
            }

            .review-header {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
            }

            .review-avatar {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                margin-right: 15px;
            }

            .reviewer-info {
                flex-grow: 1;
            }

            .reviewer-info h6 {
                margin: 0;
                font-size: 1rem;
            }

            .review-date {
                font-size: 0.8rem;
                color: #777;
            }

            .review-rating {
                margin-left: 15px;
            }

            .review-content p {
                margin: 0;
                color: #333;
                font-size: 0.95rem;
            }

            .rating-summary {
                display: flex;
                align-items: center;
                margin-left: auto;
            }

            .average-rating {
                font-size: 1.5rem;
                font-weight: 600;
                margin-right: 10px;
                display: flex;
                align-items: center;
            }

            .total-reviews {
                font-size: 0.9rem;
                color: #777;
            }

            /* Responsive adjustments */
            @media (max-width: 992px) {
                .tabs-header {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .search-container {
                    width: 100%;
                    padding: 0 20px 15px;
                }

                .search-form {
                    width: 100%;
                }
            }
        </style>

        <script>
            // Bootstrap tab functionality
            document.addEventListener('DOMContentLoaded', function() {
                var shopTabs = document.getElementById('shopTabs');
                if (shopTabs) {
                    var tab = new bootstrap.Tab(shopTabs.querySelector('.nav-link.active'));
                    tab.show();
                }
            });
        </script> --}}
    @else
        <!-- Profile Section -->
        <div class="profile-section container mt-3">
            <div class="profile-card">
                <div class="text-center">
                    <img class="profile-avatar" src="{{ Storage::url($shop->logo) }}" alt="{{ $shop->name }} logo">

                    <div class="profile-info">
                        <h1>{{ $shop->name }}</h1>

                        <p class="profile-subtitle">{{ $shop->short_description }}</p>
                        <p class="profile-subtitle">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            {{ $shop->city }}, {{ $shop->state }}
                        </p>

                        <div class="profile-stats">
                            <div class="stat-item">
                                <i class="fas fa-star text-warning"></i>
                                <span
                                    class="stat-number">{{ number_format(Sohoj::average_rating($shop->ratings), 1) }}</span>
                                <span>Rating</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-shopping-cart text-success"></i>
                                <span class="stat-number">{{ $shop->orders->count() }}</span>
                                <span>Sales</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-users text-primary"></i>
                                <span class="stat-number">{{ $shop->ratings->count() }}</span>
                                <span>Reviews</span>
                            </div>
                        </div>

                        <div class="profile-actions">
                            @auth
                                <form action="{{ route('follow', $shop) }}" method="post" style="display:inline">
                                    @csrf
                                    @php
                                        $follow = auth()->user()->follows($shop);
                                    @endphp
                                    <button class="btn-fb-primary ">
                                        <i class="fas fa-user-plus"></i>
                                        {{ $follow ? 'Unfollow' : 'Follow' }}
                                    </button>
                                </form>
                            @else
                                <a class="btn-fb-primary" href="{{ route('login') }}">
                                    <i class="fas fa-user-plus"></i>
                                    Follow
                                </a>
                            @endauth

                            <a href="{{ route('massage.create', $shop->id) }}" class="btn-fb-secondary">
                                <i class="fas fa-envelope"></i>
                                Message
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="container">
            <div class="nav-tabs-fb">
                <button class="nav-tab-fb active" onclick="showTab('home')">
                    <i class="fas fa-home me-2"></i>Home
                </button>
                <button class="nav-tab-fb" onclick="showTab('products')">
                    <i class="fas fa-box me-2"></i>Products
                </button>
                <button class="nav-tab-fb" onclick="showTab('about')">
                    <i class="fas fa-info-circle me-2"></i>About
                </button>
                <button class="nav-tab-fb" onclick="showTab('reviews')">
                    <i class="fas fa-star me-2"></i>Reviews
                </button>
            </div>
        </div>

        <!-- Content Sections -->
        <div class="container">
            <!-- Home Tab -->
            <div id="home-tab" class="tab-content">
                <!-- Search Bar -->
                <div class="content-card">
                    <div class="card-content">
                        <form action="{{ route('store_front', $shop->slug) }}" method="get" class="d-flex gap-2">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search products in {{ $shop->name }}..."
                                style="border-radius: 20px; border: 1px solid var(--border-light);">
                            <button type="submit" class="btn-fb-primary"
                                style="border-radius: 20px; background: var(--btn-primary);">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Products Section -->
                @if (count($shop->products) > 0)
                    <div class="content-card">
                        <div class="card-header-fb">
                            <img class="card-avatar" src="{{ Storage::url($shop->logo) }}" alt="{{ $shop->name }}">
                            <div>
                                <h5 class="card-title">{{ $shop->name }}</h5>
                                <p class="card-subtitle">Products</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                @foreach ($shop->products as $product)
                                    <x-products.product :product="$product" />
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Offers Section -->
                <div class="content-card">
                    <div class="card-header-fb">
                        <img class="card-avatar" src="{{ Storage::url($shop->logo) }}" alt="{{ $shop->name }}">
                        <div>
                            <h5 class="card-title">{{ $shop->name }}</h5>
                            <p class="card-subtitle">Current Offers</p>
                        </div>
                    </div>
                    <div class="card-content">
                        <x-offer :shop="$shop" />
                    </div>
                </div>
            </div>

            <!-- Products Tab -->
            <div id="products-tab" class="tab-content" style="display: none;">
                <div class="content-card">
                    <div class="card-header-fb">
                        <img class="card-avatar" src="{{ Storage::url($shop->logo) }}" alt="{{ $shop->name }}">
                        <div>
                            <h5 class="card-title">{{ $shop->name }}</h5>
                            <p class="card-subtitle">All Products</p>
                        </div>
                    </div>
                    <div class="card-content">
                        @if (count($shop->products) > 0)
                            <div class="row">
                                @foreach ($shop->products as $product)
                                    <x-products.product :product="$product" />
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No products available</h5>
                                <p class="text-muted">This shop hasn't added any products yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- About Tab -->
            <div id="about-tab" class="tab-content" style="display: none;">
                <div class="about-card p-3">
                    <h3 class="about-title">
                        <i class="fas fa-info-circle"></i>
                        About {{ $shop->name }}
                    </h3>
                    <div class="about-content">
                        {!! $shop->description !!}
                    </div>

                    <div class="about-stats">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="stat-label">Owner</div>
                            <div class="stat-value">{{ $shop->user->name }}</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="stat-label">Company</div>
                            <div class="stat-value">{{ $shop->company_name }}</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="stat-label">Joined</div>
                            <div class="stat-value">{{ $shop->created_at ? $shop->created_at->format('Y') : '' }}</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="stat-label">Sales</div>
                            <div class="stat-value">{{ $shop->orders->count() }}</div>
                        </div>
                    </div>
                </div>

                @if ($shop->shopPolicy)
                    <div class="content-card p-3">
                        <div class="card-header-fb">
                            <img class="card-avatar" src="{{ Storage::url($shop->logo) }}" alt="{{ $shop->name }}">
                            <div>
                                <h5 class="card-title">{{ $shop->name }}</h5>
                                <p class="card-subtitle">Shop Policy</p>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start mb-3">
                                        <span class="me-3 fs-3 text-danger"><i class="fas fa-ban"></i></span>
                                        <div>
                                            <div class="fw-bold">Cancellation</div>
                                            <div class="text-muted small">{{ $shop->shopPolicy->cancellation }}</div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start mb-3">
                                        <span class="me-3 fs-3 text-warning"><i class="fas fa-exchange-alt"></i></span>
                                        <div>
                                            <div class="fw-bold">Return & Exchange</div>
                                            <div class="text-muted small">{{ $shop->shopPolicy->return_exchange }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start mb-3">
                                        <span class="me-3 fs-3 text-success"><i class="fas fa-credit-card"></i></span>
                                        <div>
                                            <div class="fw-bold">Payment Option</div>
                                            <div class="text-muted small">{{ $shop->shopPolicy->payment_option }}</div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start mb-3">
                                        <span class="me-3 fs-3 text-primary"><i class="fas fa-truck"></i></span>
                                        <div>
                                            <div class="fw-bold">Delivery</div>
                                            <div class="text-muted small">{{ $shop->shopPolicy->delivery }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Social Links -->
                <div class="content-card">
                    <div class="card-header-fb">
                        <img class="card-avatar" src="{{ Storage::url($shop->logo) }}" alt="{{ $shop->name }}">
                        <div>
                            <h5 class="card-title">{{ $shop->name }}</h5>
                            <p class="card-subtitle">Follow Us</p>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="social-links">
                            @if ($shop->facebook)
                                <a href="{{ $shop->facebook }}" target="_blank" class="social-link social-facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            @endif
                            @if ($shop->instagram)
                                <a href="{{ $shop->instagram }}" target="_blank" class="social-link social-instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif
                            @if ($shop->twitter)
                                <a href="{{ $shop->twitter }}" target="_blank" class="social-link social-twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            @endif
                            @if ($shop->linkedin)
                                <a href="{{ $shop->linkedin }}" target="_blank" class="social-link social-linkedin">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Tab -->
            <div id="reviews-tab" class="tab-content" style="display: none;">
                <div class="content-card">
                    <div class="card-header-fb">
                        <img class="card-avatar" src="{{ Storage::url($shop->logo) }}" alt="{{ $shop->name }}">
                        <div>
                            <h5 class="card-title">{{ $shop->name }}</h5>
                            <p class="card-subtitle">Customer Reviews</p>
                        </div>
                    </div>
                    <div class="card-content">
                        @if ($shop->ratings()->count() > 0)
                            @foreach ($shop->ratings as $rating)
                                <div class="review-card">
                                    <div class="review-header">
                                        <img class="review-avatar"
                                            src="{{ asset('assets/img/single_product/person.png') }}" alt="Reviewer">
                                        <div class="review-info">
                                            <h6>{{ $rating->name }}</h6>
                                            <div class="review-date">{{ $rating->created_at->format('M d, Y') }}</div>
                                        </div>
                                        <div class="ms-auto">
                                            <input name="rating" type="number" value="{{ $rating->rating }}"
                                                class="rating published_rating" data-size="sm">
                                        </div>
                                    </div>
                                    <div class="review-content">
                                        {{ $rating->review }}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-star fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No reviews yet</h5>
                                <p class="text-muted">Be the first to review this shop!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Message Modal -->
    <div class="modal fade" id="massageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Send Message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('massage.store', $shop) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" required name="email" id="email"
                                aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="massage">Message</label>
                            <textarea class="form-control" rows="5" name="massage" id="massage"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/frontend-assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/main.js') }}"></script>

    <script>
        // Tab switching functionality
        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.style.display = 'none';
            });

            // Remove active class from all tabs
            document.querySelectorAll('.nav-tab-fb').forEach(tab => {
                tab.classList.remove('active');
            });

            // Show selected tab content
            document.getElementById(tabName + '-tab').style.display = 'block';

            // Add active class to clicked tab
            event.target.classList.add('active');
        }

        // Banner image loading with fallback
        document.addEventListener('DOMContentLoaded', function() {
            const bannerImage = document.querySelector('.cover-photo');

            if (bannerImage) {
                // Set initial placeholder
                bannerImage.src = '{{ asset('placeholder/shop_banner.webp') }}';

                // Try to load the actual banner image
                const actualBannerSrc =
                    '{{ $shop->banner ? Storage::url($shop->banner) : asset('placeholder/shop_banner.webp') }}';

                if (actualBannerSrc && actualBannerSrc !== '{{ asset('placeholder/shop_banner.webp') }}') {
                    const tempImage = new Image();

                    tempImage.onload = function() {
                        // Actual image loaded successfully
                        bannerImage.src = actualBannerSrc;
                        bannerImage.classList.add('loaded');
                    };

                    tempImage.onerror = function() {
                        // Actual image failed to load, keep placeholder
                        bannerImage.classList.add('error');
                        console.log('Banner image failed to load, using placeholder');
                    };

                    // Start loading the actual image
                    tempImage.src = actualBannerSrc;
                } else {
                    // No custom banner, use placeholder
                    bannerImage.classList.add('placeholder');
                }
            }

            // Add loading animation
            bannerImage.addEventListener('load', function() {
                this.style.opacity = '1';
            });
        });
    </script>
@endsection
