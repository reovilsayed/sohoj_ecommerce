@extends('layouts.app')
@section('css')
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
        <div class="checkout-hero mb-4 position-relative">
            <h2 class="fw-bold mb-1 text-light">Your Wishlist</h2>
            <p class="mb-0">Keep track of your favorite items and purchase them whenever you're ready.</p>

            <div class="checkout-hero-steps d-none d-md-flex position-absolute end-0 top-0 h-100 align-items-center pe-4">
                <a href="{{ route('homepage') }}"><span class="badge bg-light text-primary me-2">Home</span></a>
                <span class="badge bg-light text-primary me-2">wishlist</span>
            </div>
        </div>
        @if ($products->count() > 0)
            <div class="row row-cols-lg-5 cols-12">
                {{-- <h5 class="m-4 poppins ">liked Products</h5> --}}
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
                            style="background: #FF0000; color: #ffffff !important;"><i
                                class="fas fa-shopping-cart me-2"></i> Continue Shopping</a>
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
