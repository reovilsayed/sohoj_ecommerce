
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
    background: linear-gradient(transparent, rgba(0,0,0,0.3));
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

.social-facebook { background: var(--primary-color); }
.social-instagram { background: var(--gradient-accent); }
.social-twitter { background: var(--info-color); }
.social-linkedin { background: var(--primary-color); }

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
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}
</style>
@endsection

@section('content')
<x-app.header />

<!-- Cover Photo Section -->
<div class="cover-photo-container">
    {{-- @if ($shop->banner) --}}
        <img class="cover-photo" 
             src="{{ Storage::url($shop->banner) }}" 
             alt="{{ $shop->name }} cover photo">
        
    {{-- @else
        <video src="{{ Storage::url($shop->banner_video) }}" autoplay muted loop></video>
    @endif --}}
    <div class="cover-overlay"></div>
</div>

<!-- Profile Section -->
<div class="profile-section container mt-3">
    <div class="profile-card">
        <div class="text-center">
            <img class="profile-avatar" 
                 src="{{ Storage::url($shop->logo) }}" 
                 alt="{{ $shop->name }} logo">
            
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
                        <span class="stat-number">{{ number_format(Sohoj::average_rating($shop->ratings), 1) }}</span>
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
                            <button class="btn-fb-primary">
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
                    <button type="submit" class="btn-fb-primary" style="border-radius: 20px; background: var(--btn-primary);">
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
                    @if($shop->facebook)
                    <a href="{{ $shop->facebook }}" target="_blank" class="social-link social-facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    @endif
                    @if($shop->instagram)
                    <a href="{{ $shop->instagram }}" target="_blank" class="social-link social-instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif
                    @if($shop->twitter)
                    <a href="{{ $shop->twitter }}" target="_blank" class="social-link social-twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    @endif
                    @if($shop->linkedin)
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
                                 src="{{ asset('assets/img/single_product/person.png') }}" 
                                 alt="Reviewer">
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
        const actualBannerSrc = '{{ $shop->banner ? Storage::url($shop->banner) : asset('placeholder/shop_banner.webp') }}';
        
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
