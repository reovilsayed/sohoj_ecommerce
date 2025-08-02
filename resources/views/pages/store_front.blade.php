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
@extends('layouts.app')
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/frontend-assetss/responsive.css') }}" />
    <link rel="stylesheet" id="bg-switcher-css" href="{{ asset('assets/frontend-assetss/css/backgrounds/bg-4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/shops.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/store_front.css') }}"> --}}
    <style>
        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #e8f5e8, #d4edda) !important;
            color: #01949a !important;
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
    <x-app.header />
    <section class="w-100 bg-light py-4 shadow-sm mb-4">
        <div class="container">
            <div class="row align-items-center g-3">
                <div class="col-md-3 d-flex justify-content-center align-items-center">
                    <a href="">
                        <img class="img-fluid rounded-circle shadow" style="width: 110px; height: 110px; object-fit: cover;"
                            src="{{ Storage::url($shop->logo) }}" alt="{{ $shop->name }} logo">
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm p-3 mb-2 bg-white rounded">
                        <h2 class="text-center mb-1" style="font-size: 26px;">{{ $shop->name }}</h2>
                        <p class="text-center text-muted mb-1">{{ $shop->short_description }}</p>
                        <p class="text-center small text-secondary mb-2">{{ $shop->city }}, {{ $shop->state }}</p>
                        <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                            <span class="badge bg-secondary">Silver Seller</span>
                            <span class="badge bg-success">{{ $shop->orders->count() }} Sold</span>
                            <span class="ms-2">({{ $shop->ratings->count() }} Reviews)</span>
                            <div class="ec-single-rating ms-2">
                                <input value="{{ Sohoj::average_rating($shop->ratings) }}" class="rating published_rating"
                                    data-size="sm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex flex-column align-items-center gap-2">
                    @auth
                        <form action="{{ route('follow', $shop) }}" method="post" style="display:inline">
                            @csrf
                            @php
                                $follow = auth()->user()->follows($shop);
                            @endphp
                            <button class="btn btn-dark rounded-pill px-4 mb-2">
                                <i class="fa fa-user-plus me-2"></i>{{ $follow ? 'Unfollow' : 'Follow' }}
                            </button>
                        </form>
                    @else
                        <a class="btn btn-dark rounded-pill px-4 mb-2" href="{{ route('login') }}">
                            <i class="fa fa-user-plus me-2"></i>Follow
                        </a>
                    @endauth
                    <a href="{{ route('massage.create', $shop->id) }}" data-bs-toggle="tooltip" title="Send Message">
                        <i class="fa-regular fa-envelope fa-2xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="w-100 mb-4">
        <div class="container">
            <a href="">
                <img class="banner img-fluid rounded shadow" 
                     data-src="{{ $shop->banner ? Storage::url($shop->banner) : asset('placeholder/shop_banner.webp') }}"
                     src="{{ asset('placeholder/shop_banner.webp') }}" style="object-fit: cover; width: 100%; height: 300px; border-radius: 8px;"
                     alt="{{ $shop->name }} banner"
                     onload="this.classList.add('loaded')"
                     onerror="this.src='{{ asset('placeholder/shop_banner.webp') }}'; this.classList.add('error')">
            </a>
        </div>
    </section>

    <section>
        <nav class="navbar navbar-expand-lg bg-white shadow-sm rounded mb-3" style="height: 56px;z-index:99">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Home</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('store_front', [$shop->slug, 'shop_products' => 'most-popular']) }}">Popular
                                Items</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="#offer">Promotions</a>
                        </li>
                        {{-- @if ($shop->menuTitle1)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $shop->menuLink1 }}">{{ $shop->menuTitle1 }}</a>
                            </li>
                        @endif
                        @if ($shop->menuTitle2)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $shop->menuLink2 }}">{{ $shop->menuTitle2 }}</a>
                            </li>
                        @endif --}}
                    </ul>
                    <form class="d-flex ms-3" action="{{ route('store_front', $shop->slug) }}" method="get">
                        <input type="text" name="search" class="form-control me-2"
                            placeholder="Search for product?">
                        <button type="submit" class="btn btn-outline-dark"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </nav>
    </section>

    <section class="container mt-4">
        <div class="shop-pro-inner">
            <div class="row ">
                @if (count($shop->products) == !0)
                    @foreach ($shop->products as $product)
                       
                            <x-products.product :product="$product" :variant="'red'" :showMultipleCategories="true" />
                       
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="container mt-2" id="offer">
        <x-offer :shop="$shop" />
    </section>

    <section class="seller-footer mt-5">
        <div class="col-md-12 seller-icon p-4 bg-white rounded shadow-sm">
            <ul class="mb-2 d-flex justify-content-center gap-3" style="width: 100%;">
                <li class="list-inline-item"><a target="_blank" class="hdr-facebook" href="{{ $shop->facebook }}"><i
                            class="ecicon eci-facebook e rounded-circle p-3 d-flex justify-content-center"
                            style="font-size:15px; height:47px; width:45px;"></i></a></li>
                <li class="list-inline-item"><a target="_blank" class="hdr-linkedin" href="{{ $shop->linkedin }}"><i
                            class="ecicon eci-linkedin rounded-circle p-3" style="font-size:15px"></i></a></li>
                <li class="list-inline-item"><a target="_blank" class="hdr-instagram" href="{{ $shop->instagram }}"><i
                            class="ecicon eci-instagram rounded-circle p-3 border" style="font-size:15px;"></i></a></li>
                <li class="list-inline-item"><a target="_blank" class="hdr-twitter" href="{{ $shop->twitter }}"><i
                            class="ecicon eci-twitter rounded-circle p-3 border" style="font-size:15px"></i></a></li>
            </ul>
            <div class="seller-footer mt-4 text-center">
                <h2><strong>About</strong> {{ $shop->name }}</h2>
                <p>{{ $shop->description }}</p>
                <div style="border-top: 1px solid #eeeeee;border-bottom: 1px solid #eeeeee;"></div>
            </div>
            <div class="container flex-wrap">
                <h5 class="my-5" style="margin-left:30px;">Reviews</h5>
                @if ($shop->ratings()->count())
                    @foreach ($shop->ratings as $rating)
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <img src="{{ asset('assets/img/single_product/person.png') }}"
                                    class="rounded-circle me-3" style="width: 50px; height: 50px;" alt="Reviewer avatar">
                                <div>
                                    <h6 class="mb-0">{{ $rating->name }}</h6>
                                    <div>
                                        <input name="rating" type="number" value="{{ $rating->rating }}"
                                            class="rating published_rating" data-size="sm">
                                    </div>
                                    <p class="mb-0 text-muted">{{ $rating->review }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="d-flex justify-content-center text-danger">No reviews</p>
                @endif
                <div class="d-flex justify-content-center align-items-end mb-2"></div>
                <div style="border-top: 1px solid #eeeeee;border-bottom: 1px solid #eeeeee;"></div>
            </div>
            <div class="container my-4">
                <div class="card shadow-sm rounded p-3">
                    <div class="row text-center">
                        <div class="col-6 col-md-3 mb-3 mb-md-0">
                            <div class="mb-1 text-muted small"><i class="fa fa-user-circle me-1"></i>Owner</div>
                            <div class="fw-bold fs-5">{{ $shop->user->name }}</div>
                        </div>
                        <div class="col-6 col-md-3 mb-3 mb-md-0">
                            <div class="mb-1 text-muted small"><i class="fa fa-building me-1"></i>Company</div>
                            <div class="fw-bold fs-5">{{ $shop->company_name }}</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="mb-1 text-muted small"><i class="fa fa-calendar-alt me-1"></i>Joined</div>
                            <div class="fw-bold fs-5">{{ $shop->created_at ? $shop->created_at->format('Y') : '' }}</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="mb-1 text-muted small"><i class="fa fa-shopping-cart me-1"></i>Sales</div>
                            <div class="fw-bold fs-5">{{ $shop->orders->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="container mb-3" style="border: 1px solid #eeeeee"></div> --}}
            @if ($shop->shopPolicy)
                <div class="container my-4">
                    <div class="card shadow-sm rounded p-4">
                        <h4 class="mb-4"><i class="fa fa-info-circle me-2 text-primary"></i>Shop Policy</h4>
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <span class="me-3 fs-3 text-danger"><i class="fa fa-ban"></i></span>
                                    <div>
                                        <div class="fw-bold">Cancellation</div>
                                        <div class="text-muted small">{{ $shop->shopPolicy->cancellation }}</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start mb-3">
                                    <span class="me-3 fs-3 text-warning"><i class="fa fa-exchange-alt"></i></span>
                                    <div>
                                        <div class="fw-bold">Return & Exchange</div>
                                        <div class="text-muted small">{{ $shop->shopPolicy->return_exchange }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="d-flex align-items-start mb-3">
                                    <span class="me-3 fs-3 text-success"><i class="fa fa-credit-card"></i></span>
                                    <div>
                                        <div class="fw-bold">Payment Option</div>
                                        <div class="text-muted small">{{ $shop->shopPolicy->payment_option }}</div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start mb-3">
                                    <span class="me-3 fs-3 text-primary"><i class="fa fa-truck"></i></span>
                                    <div>
                                        <div class="fw-bold">Delivery</div>
                                        <div class="text-muted small">{{ $shop->shopPolicy->delivery }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <span class="text-danger">No Shop Policy Added</span>
            @endif
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="massageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Send Massage</h1>
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
                            <label for="massage">Massage</label>
                            <textarea class="form-control" rows="5" name="massage" id="massage"></textarea>
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Banner image loading with fallback
            const bannerImage = document.querySelector('.banner');
            
            if (bannerImage) {
                // Set initial placeholder
                bannerImage.src = '{{ asset('assets/img/store_front/banner.png') }}';
                
                // Try to load the actual banner image
                const actualBannerSrc = bannerImage.dataset.src;
                
                if (actualBannerSrc && actualBannerSrc !== '{{ asset('assets/img/store_front/banner.png') }}') {
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
