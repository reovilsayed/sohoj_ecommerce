@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/responsive.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/demo2.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/shops.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/demo3.css') }}" />
    <style>
        @media screen and (max-width:768px) {

            .category-thumbnail {
                height: auto !important;
            }
        }

        .border-hover:hover {
            border: 1px solid black;
        }

        .border-hover {
            border-radius: 10px;
        }







        .hero-slider-wrapper {
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(141, 110, 99, 0.08);
        }

        .hero-slider {
            display: flex;
            overflow: hidden;
            scroll-snap-type: x mandatory;
        }

        .hero__item {
            flex: 0 0 100%;
            min-height: 300px;
            height: 60vw;
            max-height: 431px;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            padding: 0 5%;
            scroll-snap-align: start;
            transition: transform 0.5s ease-in-out;
        }

        .hero__text {
            max-width: 600px;
        }

        .hero__text span {
            font-size: 14px;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 4px;
            color: #7fad39;
        }

        .hero__text h2 {
            font-size: clamp(28px, 5vw, 46px);
            color: #252525;
            line-height: 1.2;
            font-weight: 700;
            margin: 10px 0;
        }

        .hero__text p {
            margin-bottom: 35px;
            font-size: 16px;
            color: #666;
        }

        .primary-btn {
            display: inline-block;
            font-size: 14px;
            padding: 10px 28px;
            color: #ffffff;
            text-transform: uppercase;
            font-weight: 700;
            background: #7fad39;
            border-radius: 4px;
            letter-spacing: 1px;
            transition: background 0.3s ease;
            text-decoration: none;
        }

        .primary-btn:hover,
        .primary-btn:focus {
            background: #689f38;
            outline: 2px solid #fff;
            outline-offset: 2px;
        }

        .slider-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }

        .slider-dots .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .slider-dots .dot.active {
            background: #7fad39;
        }

        @media (min-width: 768px) {
            .hero__item {
                padding-left: 75px;
            }

        }





        /* Header */
        .hero__categories__all {
            background: linear-gradient(135deg, #3bb77e 0%, #2d9d6b 100%) !important;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .hero__categories__all::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .hero__categories__all:hover::before {
            left: 100%;
        }

        .hero__categories__all:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(59, 183, 126, 0.3);
        }

        .category-icon-wrapper {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .category-toggle-icon {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .category-toggle-icon:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        /* Category List Styling */
        .category-list-wrapper {
            background: #f8f9fa;
        }

        .category-item {
            transition: all 0.3s ease;
        }

        .category-link {
            background: white;
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .category-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(59, 183, 126, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .category-link:hover::before {
            left: 100%;
        }

        .category-link:hover {
            background: #f8f9fa;
            border-color: #3bb77e;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(59, 183, 126, 0.15);
        }

        .category-link:hover .fas.fa-chevron-right {
            transform: translateX(3px);
            color: #3bb77e !important;
        }

        .category-icon {
            background: linear-gradient(135deg, #3bb77e, #2d9d6b);
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white !important;
            font-size: 12px;
        }

        .category-sub-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 16px;
            height: 16px;
        }

        .category-sub-icon .fas.fa-circle {
            color: #6c757d !important;
        }

        /* Scrollbar styling */
        #static-category-list::-webkit-scrollbar {
            width: 6px;
        }

        #static-category-list::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #3bb77e, #2d9d6b);
            border-radius: 4px;
        }

        #static-category-list::-webkit-scrollbar-track {
            background-color: #f1f1f1;
            border-radius: 4px;
        }

        /* Animation for chevron */
        .transition {
            transition: all 0.3s ease;
        }

        /* Hover effects for category items */
        .category-item:hover .category-icon {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(59, 183, 126, 0.3);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero__categories {
                margin-bottom: 1rem;
            }

            .category-link {
                padding: 0.75rem !important;
            }

            .category-icon {
                width: 28px;
                height: 28px;
                font-size: 10px;
            }
        }

        /* New Category Cards Design */
        .category-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3bb77e, #2d9d6b, #1a7a4a);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .category-card:hover::before {
            transform: scaleX(1);
        }

        .category-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            border-color: #3bb77e;
        }

        .category-card-inner {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .category-image-wrapper {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .category-image {
            position: relative;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .category-img {
            /* width: 100%; */
            height: 100% !important;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .category-card:hover .category-img {
            transform: scale(1.1);
        }

        .category-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(59, 183, 126, 0.9), rgba(45, 157, 107, 0.9));
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.3s ease;
        }

        .category-card:hover .category-overlay {
            opacity: 1;
        }

        .category-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .category-icon i {
            color: white;
            font-size: 20px;
        }

        /* Category Badge */
        .category-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 2;
        }

        .category-badge .badge {
            background: linear-gradient(135deg, #3bb77e, #2d9d6b) !important;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            font-weight: 600;
            font-size: 0.75rem;
        }

        /* Category Stats */
        .category-stats {
            position: absolute;
            top: 15px;
            right: 15px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            z-index: 2;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 6px 12px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #2c3e50;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .stat-item i {
            color: #3bb77e;
            font-size: 0.7rem;
        }

        .category-content {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
        }

        .category-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0;
            line-height: 1.3;
            flex: 1;
        }

        .category-rating {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stars {
            display: flex;
            gap: 2px;
        }

        .stars i {
            color: #ffc107;
            font-size: 0.8rem;
        }

        .rating-text {
            font-size: 0.75rem;
            color: #6c757d;
            font-weight: 500;
        }

        .category-meta {
            margin-bottom: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .shop-count {
            font-size: 0.85rem;
            color: #6c757d;
            display: flex;
            align-items: center;
        }

        .shop-count i {
            color: #3bb77e;
        }

        .product-count {
            font-size: 0.85rem;
            color: #6c757d;
            display: flex;
            align-items: center;
        }

        .product-count i {
            color: #6c757d;
        }

        /* Category Tags */
        .category-tags {
            display: flex;
            gap: 6px;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .tag {
            background: linear-gradient(135deg, #e8f5e8, #d4edda);
            color: #2d9d6b;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            border: 1px solid rgba(45, 157, 107, 0.2);
        }

        .category-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #3bb77e;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            margin-top: auto;
            padding: 12px 16px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 12px;
            border: 1px solid rgba(59, 183, 126, 0.1);
        }

        .category-link:hover {
            color: #2d9d6b;
            background: linear-gradient(135deg, #e8f5e8, #d4edda);
            border-color: #3bb77e;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 183, 126, 0.2);
        }

        .link-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background: #3bb77e;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .link-icon i {
            color: white;
            font-size: 0.7rem;
            transition: transform 0.3s ease;
        }

        .category-link:hover .link-icon {
            background: #2d9d6b;
            transform: scale(1.1);
        }

        .category-link:hover .link-icon i {
            transform: translateX(2px);
        }

        /* Category section responsive */
        @media (max-width: 768px) {
            .category-card {
                margin-bottom: 1rem;
            }

            .category-image {
                height: 150px;
            }

            .category-content {
                padding: 1rem;
            }

            .category-title {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .category-image {
                height: 120px;
            }

            .category-content {
                padding: 0.75rem;
            }

            .category-title {
                font-size: 0.9rem;
            }

            .category-link {
                font-size: 0.8rem;
            }
        }

        /* Category Slider Styles */
        .category-slider-container {
            position: relative;
            margin: 0 auto;
        }

        .category-slider-wrapper {
            position: relative;
            overflow: hidden;
            padding: 20px 0;
        }

        .category-slider {
            display: flex;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            gap: 30px;
        }

        .category-slide {
            flex: 0 0 calc(25% - 22.5px);
            min-width: 280px;
            max-width: 320px;
        }





        /* Responsive Slider */
        @media (max-width: 1200px) {
            .category-slide {
                flex: 0 0 calc(33.333% - 20px);
            }
        }

        @media (max-width: 992px) {
            .category-slide {
                flex: 0 0 calc(50% - 15px);
            }

            .category-slider-container {
                padding: 0 50px;
            }
        }

        @media (max-width: 768px) {
            .category-slide {
                flex: 0 0 calc(100% - 10px);
                min-width: 250px;
            }
        }

        @media (max-width: 576px) {
            .category-slider-wrapper {
                padding: 15px 0;
            }
        }

        /* View More Shops Button Design */
        .view-more-shops-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 1rem;
        }

        .view-more-shops-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 18px 32px;
            background: linear-gradient(135deg, #3bb77e 0%, #2d9d6b 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 32px rgba(59, 183, 126, 0.3);
            border: 2px solid transparent;
            min-width: 280px;
            justify-content: center;
        }

        .view-more-shops-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .view-more-shops-btn:hover::before {
            left: 100%;
        }

        .view-more-shops-btn:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 16px 48px rgba(59, 183, 126, 0.4);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .view-more-shops-btn:active {
            transform: translateY(-2px) scale(1.01);
        }

        .btn-text {
            position: relative;
            z-index: 2;
            font-weight: 700;
        }

        .btn-icon {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .btn-icon i {
            font-size: 14px;
            color: white;
        }

        .view-more-shops-btn:hover .btn-icon {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1) rotate(5deg);
        }

        .btn-arrow {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .btn-arrow i {
            font-size: 12px;
            color: white;
            transition: transform 0.3s ease;
        }

        .view-more-shops-btn:hover .btn-arrow {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.1);
        }

        .view-more-shops-btn:hover .btn-arrow i {
            transform: translateX(3px);
        }

        .btn-shine {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .view-more-shops-btn:hover .btn-shine {
            opacity: 1;
        }

        /* Button responsive design */
        @media (max-width: 768px) {
            .view-more-shops-btn {
                padding: 16px 28px;
                font-size: 1rem;
                min-width: 260px;
                gap: 10px;
            }

            .btn-icon {
                width: 28px;
                height: 28px;
            }

            .btn-icon i {
                font-size: 12px;
            }

            .btn-arrow {
                width: 20px;
                height: 20px;
            }

            .btn-arrow i {
                font-size: 10px;
            }
        }

        @media (max-width: 576px) {
            .view-more-shops-btn {
                padding: 14px 24px;
                font-size: 0.95rem;
                min-width: 240px;
                gap: 8px;
            }

            .btn-text {
                font-size: 0.9rem;
            }
        }

        /* Button animation on page load */
        @keyframes buttonEntrance {
            0% {
                opacity: 0;
                transform: translateY(20px) scale(0.9);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .view-more-shops-btn {
            animation: buttonEntrance 0.6s ease-out;
        }
    </style>
    <livewire:styles />
@endsection

@section('content')

    @php
        // Use Laravel cache for expensive queries
        use Illuminate\Support\Facades\Cache;
        use App\Models\Prodcat;
        use App\Models\Shop;
        $categories = Cache::remember('header_categories', 3600, function () {
            return Prodcat::whereNull('parent_id')->orderBy('role', 'asc')->with('childrens')->get();
        });

        $shops = Cache::remember('header_shops', 3600, function () {
            return Shop::latest()->get();
        });
    @endphp
    <x-app.header />
    <!-- hero section start -->
    <div class="hero">
        <div class="container">
            <div class="row mt-4">
                <div class="col-lg-3 ps-md-0 d-none d-md-block">
                    <div class="hero__categories rounded-4 shadow-lg overflow-hidden bg-white border-0">
                        <!-- Toggle Header -->
                        <div class="hero__categories__all d-flex align-items-center justify-content-between px-4 py-4 bg-gradient-primary"
                            onclick="toggleStaticCategory()">
                            <div class="d-flex align-items-center gap-3">
                                <div class="category-icon-wrapper">
                                    <i class="fas fa-th-large text-white fs-5"></i>
                                </div>
                                <div>
                                    <span class="fw-bold text-white fs-6">All Categories</span>
                                    <div class="text-white-50 small">Browse by category</div>
                                </div>
                            </div>
                            <div class="category-toggle-icon">
                                <i class="fas fa-chevron-down text-white transition" id="static-category-chevron"></i>
                            </div>
                        </div>

                        <!-- Category List -->
                        <div id="static-category-list" style="display: block; max-height: 333px; overflow-y: auto;">
                            <div class="category-list-wrapper p-3">
                                @foreach ($categories as $category)
                                    <div class="category-item mb-2">
                                        <a href="{{ route('shops', ['category' => $category->slug]) }}"
                                            class="category-link d-flex align-items-center justify-content-between p-2 rounded-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="">
                                                    <i class="fas fa-circle text-muted" style="font-size: 6px;"></i>
                                                </div>
                                                <span class="fw-semibold text-dark">{{ $category->name }}</span>
                                            </div>
                                            <i class="fas fa-chevron-right text-muted small"></i>
                                        </a>
                                    </div>

                                    @foreach ($category->childrens as $child)
                                        <div class="category-item mb-1 ms-4">
                                            <a href="{{ route('shops', ['category' => $child->slug]) }}"
                                                class="category-link d-flex align-items-center justify-content-between p-2 rounded-3">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="category-sub-icon">
                                                        <i class="fas fa-circle text-muted" style="font-size: 6px;"></i>
                                                    </div>
                                                    <span class="text-secondary small">{{ $child->name }}</span>
                                                </div>
                                                <i class="fas fa-chevron-right text-muted" style="font-size: 10px;"></i>
                                            </a>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 pe-md-0">
                    <div class="hero-slider-wrapper">
                        <div class="hero-slider" role="region" aria-label="Product carousel">
                            <!-- Slide 1 -->
                            <div class="hero__item set-bg"
                                style="background-image: url('{{ asset('assets/slider/freestocks.jpg') }}');"
                                aria-hidden="false">
                                {{-- <div class="hero__text">
                                    <span>FRUIT FRESH</span>
                                    <h2>Vegetable <br>100% Organic</h2>
                                    <p>Free Pickup and Delivery Available</p>
                                    <a href="#" class="primary-btn">SHOP NOW</a>
                                </div> --}}
                            </div>
                            <!-- Slide 2 -->
                            <div class="hero__item set-bg"
                                style="background-image: url('{{ asset('assets/slider/pexels.jpg') }}');"
                                aria-hidden="true">
                            </div>
                            <div class="hero__item set-bg"
                                style="background-image: url('{{ asset('assets/slider/pexels-gustavo.jpg') }}');"
                                aria-hidden="true">
                            </div>
                            <div class="hero__item set-bg"
                                style="background-image: url('{{ asset('assets/slider/Pokecut_.jpg') }}');"
                                aria-hidden="true">
                            </div>
                            <div class="hero__item set-bg"
                                style="background-image: url('{{ asset('assets/slider/wmremove-1.jpeg') }}');"
                                aria-hidden="true">
                            </div>
                        </div>

                        <!-- Navigation Dots -->
                        <div class="slider-dots">
                            <button class="dot active" aria-label="Slide 1"></button>
                            <button class="dot" aria-label="Slide 2"></button>
                            <button class="dot" aria-label="Slide 3"></button>
                            <button class="dot" aria-label="Slide 4"></button>
                            <button class="dot" aria-label="Slide 5"></button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- hero section end -->


    <!-- Main Slider Start -->
    <div id="carouselExampleIndicators" class="carousel slide container my-2" data-bs-ride="carousel">
        <div class="carousel-indicators" style="justify-content: start;margin-left: 100px;margin-bottom:20px">
            @foreach ($sliders as $key => $slider)
                <button type="button" style="width: 15px;
        height: 15px;
        border-radius: 50%;"
                    data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="active"
                    aria-current="true" aria-label="Slide {{ $slider->id }}">
                </button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($sliders as $slider)
                <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                    <a href="{{ $slider->url }}"><img src="{{ Storage::url($slider->image) }}"
                            class="d-block w-100 img-fluid " style="height: 450px;
                object-fit: cover;"
                            alt="..."></a>
                </div>
            @endforeach

        </div>

    </div>


    <!-- Main Slider End -->

    <!--  category Section Start -->
    <section class="section ec-category-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mb-5">
                        <h2 class="related-product-sec-title mb-3">Browse Shops by Categories</h2>
                        <p class="text-muted fs-6">Discover amazing shops organized by categories</p>
                    </div>
                </div>
            </div>

            <div class="category-slider-container">
                <div class="category-slider-wrapper">
                    <div class="category-slider" id="categorySlider">
                        @foreach ($prodcats as $prodcat)
                            <div class="category-slide">
                                <div class="category-card">
                                    <div class="category-card-inner">
                                        <div class="category-image-wrapper">
                                            <div class="category-image">
                                                <img src="{{ Storage::url($prodcat->logo) }}" alt="{{ $prodcat->name }}"
                                                    class="category-img">
                                                <div class="category-overlay">
                                                    <div class="category-icon">
                                                        <i class="fas fa-shopping-bag"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="category-content">
                                            <div class="category-header">
                                                <h5 class="category-title">{{ $prodcat->name }}</h5>
                                            </div>
                                            <div class="category-meta">
                                                <span class="product-count">
                                                    <i class="fas fa-box me-1"></i>
                                                    {{ $prodcat->Products->count() ?? 0 }} products
                                                </span>
                                            </div>
                                            <a href="{{ route('shops', ['category' => $prodcat->slug]) }}"
                                                class="category-link">
                                                <span>Explore Category</span>
                                                <div class="link-icon">
                                                    <i class="fas fa-arrow-right"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>




                </div>
            </div>
        </div>
    </section>
    <!--category Section End -->

    <!-- Product tab Area Start -->

    <section class="section ec-product-tab section-space-p ">
        <div class="container">
            <div class="row">



                <!-- Product area start -->
                @if ($latest_products->count() > 0)
                    <section class="section ec-new-product">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <div class="section-title">

                                        <h2 id="trending" class="related-product-sec-title"> Trending Products</h2>
                                    </div>
                                    <div class="ec-spe-section data-animation=" slideInLeft">

                                        <div class="ec-spe-products">
                                            @foreach ($latest_products->chunk(6) as $products)
                                                {{-- @dd($products) --}}
                                                <div class="ec-fs-product">
                                                    <div class="ec-fs-pro-inner">

                                                        <div class="row">
                                                            @foreach ($products as $product)
                                                                {{-- @dd($product) --}}
                                                                <x-products.product-1 :product="$product" />
                                                            @endforeach
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- New Product Content -->


                    </section>
                @else
                    <h3 class="text-center text-danger my-5"> Please increase the location to see more products.</h3>
                @endif
                <!-- product area end -->
                <!-- Offer section  -->
                <div class="container">
                    <x-offer2 />
                </div>
                <!-- Offer section end -->
                <!-- Product area start -->
                @if ($bestsaleproducts->count() > 0)
                    <section class="section ec-new-product">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <div class="section-title">

                                        <h2 id="bestSeller" class="related-product-sec-title"> Recommended For You</h2>
                                    </div>
                                    <div class="ec-spe-section  data-animation=" slideInLeft">


                                        <div class="ec-spe-products">
                                            @if ($recommandProducts->count() > 0)
                                                @foreach ($recommandProducts->chunk(6) as $products)
                                                    <div class="ec-fs-product">
                                                        <div class="ec-fs-pro-inner">

                                                            <div class="row">
                                                                @foreach ($products as $product)
                                                                    <x-products.product-1 :product="$product" />
                                                                @endforeach




                                                            </div>

                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                @foreach ($bestsaleproducts->chunk(6) as $products)
                                                    <div class="ec-fs-product">
                                                        <div class="ec-fs-pro-inner">

                                                            <div class="row">
                                                                @foreach ($products as $product)
                                                                    <x-products.product-1 :product="$product" />
                                                                @endforeach

                                                            </div>

                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- New Product Content -->
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </section>
    <!-- ec Product tab Area End -->
    <!-- Explore shop -->
    @if ($latest_shops->count() > 0)
        <section class="section ec-new-product">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-left">
                        <div class="section-title">

                            <h2 class="related-product-sec-title"> Trending Shops</h2>
                        </div>
                        <div class="ec-spe-section  data-animation=" slideInLeft">


                            <div class="ec-spe-products">
                                @foreach ($latest_shops->chunk(4) as $shops)
                                    <div class="ec-fs-product">
                                        <div class="ec-fs-pro-inner">

                                            <div class="row">


                                                @foreach ($shops as $shop)
                                                    <x-shops-card.card-3 :shop="$shop" />
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>



                    </div>
                </div>
                <!-- New Product Content -->

            </div>
        </section>
    @endif
    <!-- New Product end -->
    <!-- Explore shop end -->
    <!-- Product tab Area Start -->
    @if ($latest_shops->count() > 0)
        <section class="section ec-product-tab section-space-p">
            <div class="container">
                <div class="row">
                    <!-- Product area start -->
                    <div class=" col-md-12">
                        <!-- Product tab area start -->
                        <div class="row space-t-50">
                            <!-- <div class="col-md-12">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="section-title">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <h2 class="ec-title">New Products</h2>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </div> -->
                            <h2 class="related-product-sec-title my-5"> Recommended For You</h2>
                        </div>

                        <!-- 1st Product tab start -->
                        <div class="tab-pane fade show active" id="all">
                            <div>
                                @foreach ($latest_shops as $shop)
                                    @if ($shop->products->count())
                                        <div class="row mb-4">
                                            <div class="col-md-3">
                                                <x-shops-card.card-1 :shop="$shop" />
                                            </div>
                                            <div class="col-md-9 mt-4">
                                                <div class="ec-spe-products">
                                                    @foreach ($shop->products->whereNull('parent_id')->chunk(3) as $products)
                                                        {{-- @dd($products) --}}
                                                        {{-- @dd($products) --}}
                                                        <div class="ec-fs-product">
                                                            <div class="ec-fs-pro-inner">

                                                                <div class="row">
                                                                    @php
                                                                        $last = $loop->last;
                                                                        $count = $shop->products->count();
                                                                    @endphp
                                                                    @foreach ($products as $product)
                                                                        <x-products.product-4 :product="$product" />
                                                                    @endforeach

                                                                    @if ($last && $count >= 8)
                                                                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 pro-gl-content d-flex align-items-center"
                                                                            style="margin-bottom: 35px;">
                                                                            <a href="{{ route('store_front', $shop->slug) }}"
                                                                                class="btn btn-dark">View More</a>
                                                                        </div>
                                                                    @endif


                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                    @endif
                                @endforeach
                                {{-- <livewire:shops /> --}}
                            </div>


                            <div class="view-more-shops-container">
                                <a href="{{ route('vendors') }}" class="view-more-shops-btn">
                                    <span class="btn-text" style="color: #ffffff">Explore All Shops</span>
                                    <div class="btn-icon">
                                        <i class="fas fa-store"></i>
                                    </div>
                                    <div class="btn-arrow">
                                        <i class="fas fa-arrow-right"></i>
                                    </div>
                                    <div class="btn-shine"></div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>


        </section>
    @endif
    <!-- ec Product tab Area End -->


    <!-- Product tab area end -->
@endsection
@section('js')
    {{-- <livewire:scripts /> --}}
    <script src="{{ asset('assets/frontend-assets/js/demo-8.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/demo-3.js') }}"></script>

    <script>
        function toggleStaticCategory() {
            const list = document.getElementById('static-category-list');
            const icon = document.getElementById('static-category-chevron');
            const isVisible = list.style.display === 'block';

            list.style.display = isVisible ? 'none' : 'block';
            icon.className = isVisible ? 'fa fa-chevron-down text-dark' : 'fa fa-chevron-up text-dark';
        }

        // Category Slider Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('categorySlider');
            const slides = document.querySelectorAll('.category-slide');

            let currentSlide = 0;
            const slidesPerView = getSlidesPerView();
            const maxSlides = slides.length - slidesPerView;

            function getSlidesPerView() {
                if (window.innerWidth <= 576) return 1;
                if (window.innerWidth <= 768) return 1;
                if (window.innerWidth <= 992) return 2;
                if (window.innerWidth <= 1200) return 3;
                return 4;
            }

            function updateSlider() {
                const slideWidth = slides[0].offsetWidth + 30; // 30px gap
                const translateX = -currentSlide * slideWidth;
                slider.style.transform = `translateX(${translateX}px)`;
            }



            function nextSlide() {
                if (currentSlide < maxSlides) {
                    currentSlide++;
                    updateSlider();
                }
            }

            function prevSlide() {
                if (currentSlide > 0) {
                    currentSlide--;
                    updateSlider();
                }
            }



            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowLeft') {
                    prevSlide();
                } else if (e.key === 'ArrowRight') {
                    nextSlide();
                }
            });

            // Touch/swipe support
            let startX = 0;
            let endX = 0;

            slider.addEventListener('touchstart', function(e) {
                startX = e.touches[0].clientX;
            });

            slider.addEventListener('touchend', function(e) {
                endX = e.changedTouches[0].clientX;
                handleSwipe();
            });

            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = startX - endX;

                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        nextSlide();
                    } else {
                        prevSlide();
                    }
                }
            }

            // Resize handler
            window.addEventListener('resize', function() {
                const newSlidesPerView = getSlidesPerView();
                if (newSlidesPerView !== slidesPerView) {
                    currentSlide = 0;
                    updateSlider();
                }
            });

            // Initialize slider
            updateSlider();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentSlide = 0;
            const slides = document.querySelectorAll('.hero__item');
            const dots = document.querySelectorAll('.slider-dots .dot');
            let slideInterval;
            const slideDuration = 5000;
            const sliderWrapper = document.querySelector('.hero-slider-wrapper');

            function updateSlider() {
                slides.forEach((slide, i) => {
                    slide.style.transform = `translateX(-${currentSlide * 100}%)`;
                    slide.setAttribute('aria-hidden', i !== currentSlide);
                });

                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === currentSlide);
                });
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                updateSlider();
            }

            function goToSlide(index) {
                currentSlide = index;
                updateSlider();
                resetTimer();
            }

            function resetTimer() {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, slideDuration);
            }

            // Initialize dots
            dots.forEach((dot, i) => {
                dot.addEventListener('click', () => goToSlide(i));
            });

            // Pause on hover
            sliderWrapper.addEventListener('mouseenter', () => clearInterval(slideInterval));
            sliderWrapper.addEventListener('mouseleave', resetTimer);

            // Start the slider
            slideInterval = setInterval(nextSlide, slideDuration);
            updateSlider();
        });
    </script>
@endsection
