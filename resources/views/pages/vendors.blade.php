@php
    $route = route('shops');
@endphp

@section('title', 'All Vendors & Shops | Afrikartt E-commerce')
@section('meta_description',
    'Browse all verified vendors and shops on Afrikartt E-commerce. Find trusted sellers, quality
    products, and great deals from our curated list of vendors.')
@section('meta_keywords', 'vendors, shops, sellers, ecommerce, online stores, Afrikartt, verified vendors')
@section('canonical_url', route('vendors'))
@section('meta_og')
    <meta property="og:title" content="All Vendors & Shops | Afrikartt E-commerce">
    <meta property="og:description"
        content="Browse all verified vendors and shops on Afrikartt E-commerce. Find trusted sellers, quality products, and great deals from our curated list of vendors.">
    <meta property="og:image" content="{{ asset('assets/logo/logo007.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
@endsection
@section('meta_twitter')
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="All Vendors & Shops | Afrikartt E-commerce">
    <meta name="twitter:description"
        content="Browse all verified vendors and shops on Afrikartt E-commerce. Find trusted sellers, quality products, and great deals from our curated list of vendors.">
    <meta name="twitter:image" content="{{ asset('assets/logo/logo007.png') }}">
@endsection

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
    <div class="container">
        <div class="checkout-hero mb-4 mt-4 position-relative">
            <h2 class="fw-bold mb-1 text-light">Trusted Vendors at Your Fingertips</h2>
            <p class="mb-0">Discover top-rated vendors and get your orders delivered quickly and safely.</p>

            <div class="checkout-hero-steps d-none d-md-flex position-absolute end-0 top-0 h-100 align-items-center pe-4">
                <a href="{{ route('homepage') }}"><span class="badge bg-light text-primary me-2">Home</span></a>
                <span class="badge bg-light text-primary me-2">Vendors</span>
            </div>
        </div>
        <div class="row">
            {{-- @dd($shops) --}}
            @foreach ($shops as $shop)
                @if ($shop->status == 1)
                    <div class="col-md-3 col-12 my-5">
                        <x-shops-card.card-1 :shop="$shop" />
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/frontend-assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>

    <script src="{{ asset('assets/frontend-assets/js/main.js') }}"></script>
@endsection
