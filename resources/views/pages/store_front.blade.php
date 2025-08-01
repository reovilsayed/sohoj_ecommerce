.@section('title', $shop->name . ' | Shop on Afrikartt E-commerce')
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

    {{-- profile Header --}}
    <section class="w-100 py-4 mb-4">
        <div class="container">
            <div class="checkout-hero mb-4 position-relative">
                <h2 class="fw-bold mb-1 text-light">Shop Profile</h2>
                <p class="mb-0">Complete your order and enjoy fast, secure delivery.</p>
                <div
                    class="checkout-hero-steps d-none d-md-flex position-absolute end-0 top-0 h-100 align-items-center pe-4">
                    <a href="{{ route('homepage') }}"><span class="badge bg-light text-primary me-2">Home</span></a>
                    <span class="badge bg-light text-primary me-2">Shop profile</span>
                </div>
            </div>
            <div class="row align-items-center g-3">

                <div class="col-md-12 cols-12">
                    <div class="mb-4">
                        <div class="bg-white rounded shadow-sm border p-4"
                            style="background: linear-gradient(120deg, #e0f7fa 0%, #f8fafc 100%);">
                            <div class="card">
                                <div class="card-header p-0">
                                    @if ($shop && $shop->banner)
                                        <img src="{{ Storage::url($shop->banner) }}" alt="Shop Banner"
                                            class="img-fluid rounded-top"
                                            style="height: 250px; object-fit: cover; width: 100%;">
                                    @else
                                        <img src="{{ asset('assets/img/heaer.jpg') }}" alt="Shop Banner"
                                            class="img-fluid rounded-top"
                                            style="height: 250px; object-fit: cover; width: 100%;">
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mt-4">
                                <div class="d-flex align-items-center">
                                    <div>
                                        @if ($shop && $shop->logo)
                                            <img src="{{ Storage::url($shop->logo) }}" alt="Profile"
                                                class="rounded-circle border border-white shadow"
                                                style="width: 128px; height: 128px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('assets/img/heaer.jpg') }}" alt="Profile"
                                                class="rounded-circle border border-white shadow"
                                                style="width: 128px; height: 128px; object-fit: cover;">
                                        @endif
                                    </div>
                                    <div class="ms-4">
                                        <h1 class="h4 fw-bold text-dark mb-1">{{ $shop->name }}</h1>
                                        <p class="text-muted mb-2">{{ $shop->email }}</p>
                                        <span class="badge bg-primary">
                                            <span class="me-1 d-inline-block rounded-circle bg-light"
                                                style="width: 8px; height: 8px;"></span>
                                            Vendor Profile
                                        </span>
                                    </div>
                                </div>
                                <div class="">
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
                                    <a href="{{ route('massage.create', $shop->id) }}" data-bs-toggle="tooltip"
                                        title="Send Message">
                                        <i class="fa-regular fa-envelope fa-2xl"></i>
                                    </a>
                                </div>
                            </div>

                            <div class=" mt-3">
                                <p class="text-muted mb-1">{{ $shop->short_description }}</p>
                                <p class="small text-secondary mb-2">{{ $shop->city }}, {{ $shop->state }}
                                </p>
                                <div class="mt-3">
                                    <span class="badge bg-secondary">Silver Seller</span>
                                    <span class="badge bg-success">{{ $shop->orders->count() }} Sold</span>
                                    <span class="ms-2">({{ $shop->ratings->count() }} Reviews)</span>
                                    <div class="ec-single-rating ms-2 mt-4">
                                        <input value="{{ Sohoj::average_rating($shop->ratings) }}"
                                            class="rating published_rating" data-size="sm">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- End profile Header --}}

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <section>
                    <nav class="navbar navbar-expand-lg bg-white shadow-sm rounded mb-4"
                        style="min-height: 60px; z-index:99;">
                        <div class="container">
                            <a class="navbar-brand fw-bold" href="{{ route('store_front', $shop->slug) }}"
                                style="color: #01949a;">
                                <i class="fa fa-store me-2"></i>{{ $shop->name }}
                            </a>
                            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#shopNavbar" aria-controls="shopNavbar" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="shopNavbar">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav nav-pills">
                                    <li class="nav-item font-weight-bolder fs-6" style="color: #01949a;">
                                        <a class="nav-link active" href="#">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link font-weight-bolder fs-6" style="color: #01949a;"
                                            href="#offer">Promotions</a>
                                    </li>
                                    {{-- Example for custom menu links --}}
                                    @if ($shop->menuTitle1)
                                        <li class="nav-item">
                                            <a class="nav-link font-weight-bolder fs-6"
                                                href="{{ $shop->menuLink1 }}">{{ $shop->menuTitle1 }}</a>
                                        </li>
                                    @endif
                                    @if ($shop->menuTitle2)
                                        <li class="nav-item">
                                            <a class="nav-link font-weight-bolder fs-6"
                                                href="{{ $shop->menuLink2 }}">{{ $shop->menuTitle2 }}</a>
                                        </li>
                                    @endif
                                </ul>
                                <form class="d-flex ms-lg-3 mt-3 mt-lg-0"
                                    action="{{ route('store_front', $shop->slug) }}" method="get"
                                    style="max-width: 320px; width:100%;">
                                    <input type="text" name="search" class="form-control rounded-0"
                                        placeholder="Search products..." style="background: #f8f9fa;">
                                    <button type="submit" class="btn btn-dark px-3 h-auto"
                                        style="background: #01949a;"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </nav>
                </section>
            </div>
        </div>
    </div>
    <section class="container mt-4">
        <div class="shop-pro-inner">
            <div class="row row-cols-lg-5 cols-2 mt-4 g-4">
                @if (count($shop->products) == !0)
                    @foreach ($shop->products as $product)
                        {{-- <div class="col-md-3 col-lg-2 cols-12"> --}}
                        <x-products.product-2 :product="$product" />
                        {{-- </div> --}}
                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <section class="container mt-5" id="offer">
        <div class="card shadow-lg border-0 rounded-4 mb-4 offer-section-bg"
            style="background: linear-gradient(120deg, #e0f7fa 0%, #f8fafc 100%);">
            <div class="card-body py-5 px-4">
                <div class="d-flex align-items-center mb-4">
                    <span class="me-3 d-flex align-items-center justify-content-center rounded-circle"
                        style="width: 56px; height: 56px; background: #01949a1a;">
                        <i class="fa fa-gift" style="font-size: 2rem; color: #01949a;"></i>
                    </span>
                    <div>
                        <h2 class="h3 fw-bold mb-1" style="color: #01949a;">Special Offers & Promotions</h2>
                        <p class="mb-0 text-muted" style="font-size: 1rem;">Grab the best deals and discounts from
                            {{ $shop->name }}!</p>
                    </div>
                </div>
                <hr class="mb-4" style="border-top: 2px solid #b2dfdb;">
                <div class="row g-4">
                    <div class="col-12">
                        <x-offer :shop="$shop" />
                    </div>
                </div>
            </div>
        </div>
        <style>
            .offer-section-bg {
                box-shadow: 0 8px 32px 0 rgba(1, 148, 154, 0.08), 0 1.5px 4px 0 rgba(0, 0, 0, 0.04);
                border: 1px solid #e0f2f1;
            }

            .offer-card {
                background: #fff;
                border-radius: 1.25rem;
                box-shadow: 0 2px 12px 0 rgba(1, 148, 154, 0.07);
                transition: transform 0.2s;
            }

            .offer-card:hover {
                transform: translateY(-4px) scale(1.02);
                box-shadow: 0 8px 32px 0 rgba(1, 148, 154, 0.13);
            }
        </style>
    </section>

    <section class="seller-footer mt-5">
        <div class="col-md-12 seller-icon p-4 bg-white rounded shadow-sm">
            <div class="d-flex flex-column align-items-center mb-4">
                <ul class="list-inline mb-3 d-flex gap-3 justify-content-center" style="width: 100%;">
                    @if ($shop->facebook)
                        <li class="list-inline-item">
                            <a target="_blank" class="hdr-facebook" href="{{ $shop->facebook }}">
                                <i class="ecicon eci-facebook rounded-circle p-3 d-flex justify-content-center align-items-center"
                                    style="font-size:18px; height:44px; width:44px; background:#e3f2fd; color:#1877f3;"></i>
                            </a>
                        </li>
                    @endif
                    @if ($shop->linkedin)
                        <li class="list-inline-item">
                            <a target="_blank" class="hdr-linkedin" href="{{ $shop->linkedin }}">
                                <i class="ecicon eci-linkedin rounded-circle p-3 d-flex justify-content-center align-items-center"
                                    style="font-size:18px; height:44px; width:44px; background:#e0f7fa; color:#0a66c2;"></i>
                            </a>
                        </li>
                    @endif
                    @if ($shop->instagram)
                        <li class="list-inline-item">
                            <a target="_blank" class="hdr-instagram" href="{{ $shop->instagram }}">
                                <i class="ecicon eci-instagram rounded-circle p-3 d-flex justify-content-center align-items-center"
                                    style="font-size:18px; height:44px; width:44px; background:#fce4ec; color:#e1306c;"></i>
                            </a>
                        </li>
                    @endif
                    @if ($shop->twitter)
                        <li class="list-inline-item">
                            <a target="_blank" class="hdr-twitter" href="{{ $shop->twitter }}">
                                <i class="ecicon eci-twitter rounded-circle p-3 d-flex justify-content-center align-items-center"
                                    style="font-size:18px; height:44px; width:44px; background:#e3f2fd; color:#1da1f2;"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="seller-footer-about text-center mb-4">
                <h2 class="fw-bold mb-2" style="color:#01949a;">About {{ $shop->name }}</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">{{ $shop->description }}</p>
                <hr style="border-top: 1px solid #eeeeee; width: 80%; margin: 2rem auto;">
            </div>
            <div class="container px-0">
                <div class="d-flex align-items-center mb-3">
                    <h5 class="fw-bold mb-0" style="color:#01949a;">Customer Reviews</h5>
                    <span class="ms-2 badge bg-success">{{ $shop->ratings->count() }}</span>
                </div>
                @if ($shop->ratings()->count())
                    <div class="row g-3">
                        @foreach ($shop->ratings as $rating)
                            <div class="col-md-6 mt-3">
                                <div class="card mb-2 shadow-sm border-0 h-100">
                                    <div class="card-body d-flex align-items-start">
                                        <img src="{{ asset('assets/img/single_product/person.png') }}"
                                            class="rounded-circle me-3 border" style="width: 48px; height: 48px;"
                                            alt="Reviewer avatar">
                                        <div>
                                            <h6 class="mb-1 fw-semibold">{{ $rating->name }}</h6>
                                            <div class="mb-1">
                                                <input name="rating" type="number" value="{{ $rating->rating }}"
                                                    class="rating published_rating" data-size="sm" disabled>
                                            </div>
                                            <p class="mb-0 text-secondary small">{{ $rating->review }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-danger my-4">No reviews yet.</p>
                @endif
            </div>

            {{-- <div class="container mb-3" style="border: 1px solid #eeeeee"></div> --}}
            @if ($shop->shopPolicy)
                <div class="container my-5">
                    <div class="card shadow-lg border-0 rounded-4 shop-policy-card">
                        <div class="card-body p-5">
                            <div class="d-flex align-items-center mb-4">
                                <span class="me-3 d-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 56px; height: 56px; background: #01949a1a;">
                                    <i class="fa fa-file-alt" style="font-size: 2rem; color: #01949a;"></i>
                                </span>
                                <div>
                                    <h2 class="h4 fw-bold mb-1" style="color: #01949a;">Shop Policy</h2>
                                    <p class="mb-0 text-muted" style="font-size: 1rem;">Learn about {{ $shop->name }}'s
                                        policies for a smooth shopping experience.</p>
                                </div>
                            </div>
                            <hr class="mb-4" style="border-top: 2px solid #b2dfdb;">
                            <div class="row g-4">
                                <div class="col-md-3">
                                    <div class="card h-100 shadow-sm border-0 policy-card text-center p-3">
                                        <div class="card-body d-flex flex-column align-items-center">
                                            <div class="rounded-circle mb-3 d-flex align-items-center justify-content-center"
                                                style="width:60px; height:60px; background:rgba(220,53,69,0.08);">
                                                <i class="fa fa-ban fs-2 text-danger"></i>
                                            </div>
                                            <div class="fw-bold mb-2">Cancellation Policy</div>
                                            <div class="text-muted small">{{ $shop->shopPolicy->cancellation }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card h-100 shadow-sm border-0 policy-card text-center p-3">
                                        <div class="card-body d-flex flex-column align-items-center">
                                            <div class="rounded-circle mb-3 d-flex align-items-center justify-content-center"
                                                style="width:60px; height:60px; background:rgba(255,193,7,0.08);">
                                                <i class="fa fa-exchange-alt fs-2 text-warning"></i>
                                            </div>
                                            <div class="fw-bold mb-2">Return & Exchange</div>
                                            <div class="text-muted small">{{ $shop->shopPolicy->return_exchange }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card h-100 shadow-sm border-0 policy-card text-center p-3">
                                        <div class="card-body d-flex flex-column align-items-center">
                                            <div class="rounded-circle mb-3 d-flex align-items-center justify-content-center"
                                                style="width:60px; height:60px; background:rgba(25,135,84,0.08);">
                                                <i class="fa fa-credit-card fs-2 text-success"></i>
                                            </div>
                                            <div class="fw-bold mb-2">Payment Options</div>
                                            <div class="text-muted small">{{ $shop->shopPolicy->payment_option }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card h-100 shadow-sm border-0 policy-card text-center p-3">
                                        <div class="card-body d-flex flex-column align-items-center">
                                            <div class="rounded-circle mb-3 d-flex align-items-center justify-content-center"
                                                style="width:60px; height:60px; background:rgba(13,110,253,0.08);">
                                                <i class="fa fa-truck fs-2 text-primary"></i>
                                            </div>
                                            <div class="fw-bold mb-2">Delivery Policy</div>
                                            <div class="text-muted small">{{ $shop->shopPolicy->delivery }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <style>
                                .policy-card {
                                    background: #fff;
                                    border-radius: 1rem;
                                    transition: box-shadow 0.2s, transform 0.2s;
                                }

                                .policy-card:hover {
                                    box-shadow: 0 8px 32px 0 rgba(1, 148, 154, 0.13);
                                    transform: translateY(-2px) scale(1.01);
                                }

                                .policy-card .fa {
                                    opacity: 0.9;
                                }
                            </style>
                        </div>
                    </div>
                    <style>
                        .shop-policy-card {
                            background: linear-gradient(120deg, #e0f7fa 0%, #f8fafc 100%);
                            box-shadow: 0 8px 32px 0 rgba(1, 148, 154, 0.08), 0 1.5px 4px 0 rgba(0, 0, 0, 0.04);
                            border: 1px solid #e0f2f1;
                        }

                        .shop-policy-card .fa {
                            opacity: 0.85;
                        }
                    </style>
                </div>
            @else
                <div class="container my-5">
                    <div class="alert alert-warning text-center">
                        <i class="fa fa-info-circle me-2"></i>No Shop Policy Added
                    </div>
                </div>
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
@endsection
