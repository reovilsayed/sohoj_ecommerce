@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assetss/responsive.css') }}" />
    <link rel="stylesheet" id="bg-switcher-css" href="{{ asset('assets/frontend-assetss/css/backgrounds/bg-4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/shops.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
        .wishlist-card {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
            border-radius: 12px;
            transition: box-shadow 0.2s;
            border: none;
            background: #fff;
        }

        .wishlist-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
        }

        .wishlist-img {
            width: 90px;
            height: 90px;
            object-fit: contain;
            border-radius: 8px;
            background: #f8f9fa;
        }

        .wishlist-empty {
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .wishlist-actions .btn {
            min-width: 110px;
        }

        @media (max-width: 576px) {
            .wishlist-card {
                flex-direction: column !important;
                align-items: flex-start !important;
                padding: 1rem !important;
            }

            .wishlist-img {
                margin-bottom: 1rem;
            }
        }
    </style>
@endsection
@section('content')
    <x-app.header />
    <div class="container py-4">
        <h2 class="mb-4 text-center fw-bold">My Wishlist</h2>
        @if ($products->count() > 0)
            <div class="row">
                <h5 class="m-4 poppins ">liked Products</h5>
                @foreach ($products as $product)
                    <x-products.wishlist :product="$product" />
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="wishlist-empty my-4">
                        <img src="{{ asset('assets/img/empty-wishlist-new.svg') }}" alt="Empty Wishlist"
                            style="width:320px;">
                        <h4 class="mt-3 mb-2">Your wishlist is empty!</h4>
                        <a href="{{ route('shops') }}" class="btn btn-primary mt-3 mb-0 mb-md-5"
                            style="background: #01949a; color: #ffffff !important;">Continue Shopping</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/frontend-assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/main.js') }}"></script>
@endsection
