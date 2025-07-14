@php
    $route = route('shops');
@endphp

@section('title', 'All Vendors & Shops | Sohoj E-commerce')
@section('meta_description', 'Browse all verified vendors and shops on Sohoj E-commerce. Find trusted sellers, quality products, and great deals from our curated list of vendors.')
@section('meta_keywords', 'vendors, shops, sellers, ecommerce, online stores, sohoj, verified vendors')
@section('canonical_url', route('vendors'))
@section('meta_og')
    <meta property="og:title" content="All Vendors & Shops | Sohoj E-commerce">
    <meta property="og:description" content="Browse all verified vendors and shops on Sohoj E-commerce. Find trusted sellers, quality products, and great deals from our curated list of vendors.">
    <meta property="og:image" content="{{ asset('assets/logo/logo007.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
@endsection
@section('meta_twitter')
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="All Vendors & Shops | Sohoj E-commerce">
    <meta name="twitter:description" content="Browse all verified vendors and shops on Sohoj E-commerce. Find trusted sellers, quality products, and great deals from our curated list of vendors.">
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
@endsection
@section('content')
    <x-app.header />
    <div class="container">
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
