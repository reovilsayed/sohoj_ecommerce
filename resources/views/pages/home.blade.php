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
            background-color: #eaeaea !important;
            cursor: pointer;
            transition: background 0.3s ease;
            border-bottom: 1px solid #eee;
        }

        .hero__categories__all:hover {
            background-color: #f1f1f1;
        }

        /* List styling */
        .hero__categories ul li {
            list-style: none;
        }

        .hero__categories ul li a.category-link {
            display: block;
            padding: 8px 12px;
            font-size: 15px;
            color: #333;
            font-weight: 500;
            border-radius: 6px;
            transition: background 0.2s ease, color 0.2s ease;
            text-decoration: none;
        }

        .hero__categories ul li a.category-link:hover {
            background-color: #eaeaea;
            color: #000;
        }

        /* Scrollbar styling */
        #static-category-list::-webkit-scrollbar {
            width: 6px;
        }

        #static-category-list::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 4px;
        }

        #static-category-list::-webkit-scrollbar-track {
            background-color: transparent;
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
        use App\Models\Order;

        $categories = Cache::remember('header_categories', 3600, function () {
            return Prodcat::whereNull('parent_id')->orderBy('role', 'asc')->with('childrens')->get();
        });

        $shops = Cache::remember('header_shops', 3600, function () {
            return Shop::latest()->get();
        });

        $route = route('shops');
    @endphp
    <x-app.header />
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-3 ps-0">
                <div class="hero__categories rounded-4 shadow-sm overflow-hidden bg-white">
                    <!-- Toggle Header -->
                    <div class="hero__categories__all d-flex align-items-center justify-content-between px-4 py-3 bg-light"
                        onclick="toggleStaticCategory()">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa fa-bars text-dark fs-5"></i>
                            <span class="fw-bold text-dark">All Categories</span>
                        </div>
                        <i class="fa fa-chevron-down text-dark transition" id="static-category-chevron"></i>
                    </div>

                    <!-- Category List -->
                    <div id="static-category-list" style="display: block; max-height: 375px; overflow-y: auto;">
                        <ul class="list-unstyled mb-0 pt-2 px-3">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('vendors', ['category' => $category->slug]) }}"
                                        class="category-link fw-semibold">
                                        {{ $category->name }}
                                    </a>
                                </li>

                                @foreach ($category->childrens as $child)
                                    <li>
                                        <a href="{{ route('vendors', ['category' => $child->slug]) }}"
                                            class="category-link ps-4 text-secondary">
                                            ↳ {{ $child->name }}
                                        </a>
                                    </li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 pe-0">
                <div class="hero-slider-wrapper">
                    <div class="hero-slider" role="region" aria-label="Product carousel">
                        <!-- Slide 1 -->
                        <div class="hero__item set-bg"
                            style="background-image: url('{{asset('assets/slider/fashion1.jpg')}}');"
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
                            style="background-image: url('{{asset('assets/slider/fashion2.jpg')}}');"
                            aria-hidden="true">
                        </div>
                        <div class="hero__item set-bg"
                            style="background-image: url('{{asset('assets/slider/fashion3.jpg')}}');"
                            aria-hidden="true">
                        </div>
                        <div class="hero__item set-bg"
                            style="background-image: url('{{asset('assets/slider/fashion4.jpg')}}');"
                            aria-hidden="true">
                        </div>
                        <div class="hero__item set-bg"
                            style="background-image: url('{{asset('assets/slider/fashion5.jpg')}}');"
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


    <section class="section ec-category-section ">
        <div class="container">
            <div class="">
                <h2 class="related-product-sec-title my-5"> Browse Shops by Categories </h2>
                {{-- <div class="row margin-minus-b-15 margin-minus-t-15">
                <div class="ec-spe-section" data-animation="slideInLeft">
                    <div class="ec-spe-products">
                        @foreach ($prodcats->chunk(6) as $prodcats)
                        <div class="ec_cat_content ec_cat_content_1 me-5 d-flex ">

                            <div class="ec-fs-product">
                                <div class="ec-fs-pro-inner">

                                    <div class="row">
                                        @foreach ($prodcats as $prodcat)
                                        <div class="col-md-2 col-sm-6">
                                            <div class="category-thumbnail border-hover" style="background-color: #f5f5f5;height: 200px;">
                                                <a href="{{ route('shops', ['category' => $prodcat->slug]) }}"><img src="{{ Storage::url($prodcat->logo) }}" class="card-img-top " alt="..."></a>
                                            </div>
                                            <p class="card-title p-3" style="font-size: 15px;text-align:center">
                                                {{ $prodcat->name }}
                                            </p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div> --}}
                <div class="row ">
                    <div class="ec_cat_slider">
                        @foreach ($prodcats as $prodcat)
                            <div class="ec_cat_content">
                                <div class="ec_cat_inner">
                                    <div class="category-thumbnail border-hover"
                                        style="background-color: #f5f5f5;height: 200px;">
                                        <a href="{{ route('shops', ['category' => $prodcat->slug]) }}"><img
                                                style="height: 100%" src="{{ Storage::url($prodcat->logo) }}"
                                                class="card-img-top " alt="..."></a>
                                    </div>
                                    <p class="card-title p-3" style="font-size: 15px;text-align:center">
                                        {{ $prodcat->name }}
                                    </p>
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
    <div class="container border-bottom mb-5"></div>
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
                                            <div class="col-md-9">
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


                            <!-- Product tab area end -->

                            <div class=" d-flex justify-content-center  align-items-center mt-4">
                                <a href="{{ route('vendors') }}" class="btn btn-dark rounded rounded-3 px-5">View More
                                    Shops <i class="fa-solid fa-angle-right ms-2"></i></a>
                            </div>

                        </div>
                    </div>
                </div>


        </section>
    @endif
    <!-- ec Product tab Area End -->

    </div>
    </div>
    </div>
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
