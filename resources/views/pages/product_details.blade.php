@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assetss/responsive.css') }}" />
    <link rel="stylesheet" id="bg-switcher-css" href="{{ asset('assets/frontend-assetss/css/backgrounds/bg-4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/product_details.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/star-rating.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/shops.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600;700&display=swap');

        /* Optimized CSS with better organization and performance */
        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.05);
            will-change: transform;
            font-family: 'Segoe UI', 'Inter', Arial, sans-serif;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            border-color: #FF0000;
        }

        /* Image Section */
        .product-image-wrapper {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        }

        .product-image {
            position: relative;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
            will-change: transform;
        }

        .product-card:hover .product-img {
            transform: scale(1.1);
        }

        /* Overlay and Actions */
        .product-overlay {
            position: absolute;
            inset: 0;
            background: #c1bebe91;
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.3s ease;
        }

        .product-card:hover .product-overlay {
            opacity: 1;
        }

        .product-actions {
            display: flex;
            gap: 12px;
        }

        .action-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            font-size: 14px;
            will-change: transform;
        }

        .action-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        /* Cart Form */
        .cart-form {
            margin: 0;
            display: inline;
        }

        /* Badges */
        .discount-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
            color: white;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 2;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        /* Content Section */
        .product-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: calc(100% - 250px);
        }

        .product-category {
            margin-bottom: 8px;
        }

        .product-category span {
            background: linear-gradient(135deg, #e8f5e8, #d4edda);
            color: #01949a;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        .product-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 8px;
            line-height: 1.3;
            flex-grow: 1;
            font-family: 'Segoe UI', 'Inter', Arial, sans-serif;
            color: #000 !important;
        }

        .product-title a {
            color: #000 !important;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        /* Rating */
        .product-rating {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 12px;
        }

        .stars {
            display: flex;
            gap: 1px;
        }

        .stars i {
            color: #ddd;
            font-size: 0.8rem;
        }

        .stars i.filled {
            color: #ffc107;
        }

        .rating-count {
            font-size: 0.75rem;
            color: #6c757d;
        }

        /* Price */
        .product-price {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
        }

        .original-price {
            color: #6c757d;
            text-decoration: line-through;
            font-size: 0.85rem;
        }

        .current-price {
            color: #000;
            font-size: 1.2rem;
            font-weight: 700;
        }

        /* Add to Cart Button */
        .add-to-cart-form {
            margin: 0;
        }

        .add-to-cart-btn {
            background: #FF0000 !important;
            color: #fff;
            border: none;
            padding: 7px 12px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            cursor: pointer;
            width: 100%;
            margin-top: auto;
            will-change: transform;
            box-shadow: 0 2px 8px rgba(58, 112, 151, 0.10);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .add-to-cart-btn .spinner {
            display: none;
            margin-right: 8px;
            font-size: 1rem;
            animation: spin 1s linear infinite;
        }

        .add-to-cart-btn.loading .spinner {
            display: inline-block;
        }

        .add-to-cart-btn.loading .btn-text {
            opacity: 0.6;
        }

        .add-to-cart-btn.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        /* @keyframes spin {
                        from { transform: rotate(0deg); }
                        to { transform: rotate(360deg); }
                    } */

        .product-title {
            font-size: 0.9rem;
        }

        .action-btn {
            width: 35px;
            height: 35px;
            font-size: 12px;
        }

        @media (max-width: 576px) {
            .product-image {
                height: 180px;
            }

            .product-content {
                padding: 12px;
            }

            .product-title {
                font-size: 0.85rem;
            }

            .add-to-cart-btn {
                padding: 10px 16px;
                font-size: 0.8rem;
            }
        }

        /* Focus states for accessibility */
        .action-btn:focus,
        .add-to-cart-btn:focus,
        .product-title a:focus {
            outline: 2px solid #01949a;
            outline-offset: 2px;
        }

        /* Loading states */
        .add-to-cart-btn.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .add-to-cart-btn.loading i {
            animation: spin 1s linear infinite;
        }
    </style>
@endsection
@section('canonical_url', route('product_details', $product->slug))
@section('title', $product->name . ' | Afrikartt E-commerce')
@section('meta_description', Str::limit(strip_tags($product->short_description ?? $product->description), 150))
@section('meta_keywords', $product->name . ', ' . ($product->prodcats->pluck('name')->implode(', ') ?? 'product'))
@section('meta_og')
    <meta property="og:title" content="{{ $product->name }} | Afrikartt E-commerce">
    <meta property="og:description"
        content="{{ Str::limit(strip_tags($product->short_description ?? $product->description), 150) }}">
    <meta property="og:image" content="{{ Storage::url($product->image) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="product">
@endsection
@section('meta_twitter')
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $product->name }} | Afrikartt E-commerce">
    <meta name="twitter:description"
        content="{{ Str::limit(strip_tags($product->short_description ?? $product->description), 150) }}">
    <meta name="twitter:image" content="{{ Storage::url($product->image) }}">
@endsection
@section('content')
    <main>
        <x-app.header />
        @php
            if (is_string($product->images)) {
                $images = json_decode($product->images) ?? [];
            } else {
                $images = $product->images ?? [];
            }
            // Pre-calculate values for better performance
            $averageRating = Sohoj::average_rating($product->ratings);
            $ratingCount = $product->ratings->count();
            $currentPrice = $product->sale_price ?? $product->price;
            $originalPrice = $product->price;
            $hasDiscount = $product->sale_price && $product->sale_price < $product->price;
            $discountPercentage = $hasDiscount ? round((($originalPrice - $currentPrice) / $originalPrice) * 100) : 0;
            $fullStars = floor($averageRating);
            $hasHalfStar = $averageRating - $fullStars >= 0.5;
        @endphp

        <!-- Sart Single product -->
        <section class="ec-page-content section-space-p product_details-body">
            <div class="container">
                <div class="row">
                    <div class="ec-pro-rightside ec-common-rightside col-lg-12 col-md-12">

                        <!-- Single product content Start -->
                        <div class="single-pro-block">
                            <div class="single-pro-inner">
                                <div class="row">
                                    <div class="single-pro-img single-pro-img-no-sidebar ">
                                        <div class="single-product-scroll">

                                            <div class="single-product-cover">
                                                <div class="single-slide zoom-image-hover" style="height: 500px">
                                                    <img class="img-responsive"
                                                        style="object-fit: contain;
                                                width: 100%;
                                                height: 100%;"
                                                        src="{{ Storage::url($product->image) }}"
                                                        alt="{{ $product->name }}">
                                                </div>
                                                @if ($images)
                                                    @foreach ($images as $key => $image)
                                                        <div class="single-slide zoom-image-hover" style="height: 500px">
                                                            <img class="img-responsive"
                                                                style="object-fit: cover;
                                                width: 100%;
                                                height: 100%;"
                                                                src="{{ Storage::url($image) }}"
                                                                alt="{{ $product->name }} image {{ $loop->iteration }}">
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>

                                            <div class="single-nav-thumb">
                                                <div class="single-slide" style="">
                                                    <img class="img-responsive" style="object-fit: cover; height:100px"
                                                        src="{{ Storage::url($product->image) }}"
                                                        alt="{{ $product->name }} thumbnail">
                                                </div>
                                                @if ($images)
                                                    @foreach ($images as $key => $image)
                                                        <div class="single-slide">
                                                            <img class="img-responsive" style="height:100px"
                                                                src="{{ Storage::url($image) }}"
                                                                alt="{{ $product->name }} thumbnail {{ $loop->iteration }}">
                                                        </div>
                                                    @endforeach
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-pro-desc single-pro-desc-no-sidebar">
                                        <div class="single-pro-content d-flex flex-column justify-content-between"
                                            style="height:100%">
                                            <div>
                                                <h1 class="ec-single-title mb-2 "
                                                    style="font-family: 'Inter', sans-serif; font-weight: 500">
                                                    {{ $product->name }}
                                                </h1>
                                                <span>Shop:

                                                    <a href="{{ route('store_front', $product->shop->slug) }}">
                                                        {{ $product->shop->name }}</a>
                                                </span>

                                                <div class="ec-single-rating-wrap mt-3">
                                                    <div class="ec-single-rating">
                                                        <input value="{{ Sohoj::average_rating($product->ratings) }}"
                                                            class="rating published_rating" data-size="sm">
                                                    </div>

                                                </div>
                                                <div class="ec-single-desc ">
                                                    <span>{!! $product->short_description !!}</span>
                                                </div>
                                            </div>

                                            <div class="mb-5">
                                                <div class="stock product_details-body">
                                                    <span>Availability: <span
                                                            style="color: #D81919E5">{{ $product->quantity }}</span> in
                                                        Stock
                                                    </span>
                                                </div>

                                                <div class="ec-single-price-stoke">
                                                    <div class="ec-single-price product-price">
                                                        <span
                                                            class="ec-single-ps-title price-currency product_details-body">usd</span>
                                                        <div class="d-flex align-items-center">
                                                            {{-- <span class="new-price product-ammount product_details-body">{{ Sohoj::price($product->sale_price) }}</span>
                                                    <span class="old-price product-ammount product_details-body">{{ Sohoj::price($product->price) }}</span> --}}
                                                            <span class="ec-price d-flex align-items-center">
                                                                <span
                                                                    class="new-price product-ammount product_details-body">{{ Sohoj::price($product->sale_price ?? $product->price) }}</span>
                                                                @if ($product->sale_price)
                                                                    <del><span
                                                                            class="old-price ">{{ Sohoj::price($product->price) }}</span></del>
                                                                @endif

                                                            </span>
                                                            @if ($product->is_offer == true)
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                    data-bs-target="#offerModal"><span class="mx-3">Make
                                                                        an
                                                                        Offer?</span></a>
                                                            @endif
                                                            <!-- Modal  -->
                                                            <div class="modal fade" id="offerModal" tabindex="-1"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5"
                                                                                id="exampleModalLabel">
                                                                                Send Offer</h1>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('offer', $product) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                <div class="form-group">
                                                                                    <label for="email">Price</label>
                                                                                    <input type="text"
                                                                                        class="form-control" required
                                                                                        name="price" id="price"
                                                                                        aria-describedby="emailHelp"
                                                                                        placeholder="Enter price">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="massage">Quantity</label>
                                                                                    <input type="text"
                                                                                        class="form-control" required
                                                                                        name="qty" id="qty"
                                                                                        aria-describedby="emailHelp"
                                                                                        placeholder="Enter Qty">
                                                                                </div>



                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Save
                                                                                changes</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Modal -->


                                                        </div>
                                                        <span>Sku: <span>{{ $product->sku }}</span>

                                                        </span>

                                                    </div>

                                                </div>
                                                <form action="{{ route('cart.boynow') }}" method="POST">
                                                    @csrf
                                                    @if ($product->is_variable_product && count($product->subproductsuser) > 0)
                                                        @foreach ($product->attributes as $attribute)
                                                            <div class="row mt-2 pt-2 w-100 mb-2">
                                                                <div class="form-group col-md-12 pl-0 ">
                                                                    <h5 class="ms-3">
                                                                        {{ str_replace('_', ' ', $attribute->name) }}</h4>
                                                                        <div class="btn-group ms-2" role="group">
                                                                            @foreach ($attribute->value as $value)
                                                                                <input type="radio"
                                                                                    class="btn-check {{ str_replace(' ', '_', $attribute->name) }}"
                                                                                    name="variable_attribute[{{ $attribute->name }}]"
                                                                                    id="{{ str_replace(' ', '_', $value) }}"
                                                                                    value="{{ $value }}" required
                                                                                    onclick="change_variable()">
                                                                                <label class="btn btn-outline-primary"
                                                                                    for="{{ str_replace(' ', '_', $value) }}">{{ str_replace('_', ' ', $value) }}</label>
                                                                            @endforeach
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                    <div class="ec-single-qty align-items-center">

                                                        <div class="ec-single-cart ">

                                                            <div class="ec-single-qty">

                                                                <input type="hidden" class="" name="product_id"
                                                                    value="{{ $product->id }}" />

                                                                <div class="qty-plus-minus">
                                                                    <input class="qty-input qty" type="text"
                                                                        name="quantity" value="1" />
                                                                </div>

                                                                <div class="ec-single-cart ">
                                                                    <button class="btn btn-sm btn-dark" type="submit">Buy
                                                                        Now</button>
                                                                </div>
                                                                <div class="ec-single-cart ">
                                                                    @if (!in_array($product->id, session()->get('wishlist', [])))
                                                                        <a href="{{ route('wishlist.add', ['productId' => $product->id]) }}"
                                                                            class=" btn btn-outline-dark wishlist">Add to
                                                                            wishlist</i></a>
                                                                    @else
                                                                        <a href="{{ route('wishlist.remove', ['productId' => $product->id]) }}"
                                                                            class="btn btn-dark wishlist ">Remove from
                                                                            wishlist</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single product tab start -->
                <div class="ec-single-pro-tab" id="ratings">
                    <div class="ec-single-pro-tab-wrapper">
                        <div class="ec-single-pro-tab-nav d-flex justify-content-center">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link {{ Request()->has('id') ? '' : 'active' }} " data-bs-toggle="tab"
                                        data-bs-target="#ec-spt-nav-details" role="tablist">Detail</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-info"
                                        role="tablist">More Information</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link {{ Request()->has('id') ? ' active' : '' }}" data-bs-toggle="tab"
                                        data-bs-target="#ec-spt-nav-review" role="tablist">Reviews</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content  ec-single-pro-tab-content">
                            <div id="ec-spt-nav-details" class="tab-pane fade show active">
                                <div class="ec-single-pro-tab-desc">
                                    <p>{!! $product->description !!}</p>
                                </div>
                            </div>
                            <div id="ec-spt-nav-info" class="tab-pane fade">
                                <div class="ec-single-pro-tab-moreinfo">
                                    <ul>
                                        <li><span>Weight</span> {{ $product->weight }}g</li>
                                        <li><span>Dimensions</span> {{ $product->dimensions }} cm</li>
                                        <li><span>Shipping Cost</span> {{ Sohoj::price($product->shipping_cost) }}</li>
                                    </ul>
                                </div>
                            </div>

                            <div id="ec-spt-nav-review"
                                class="tab-pane fade {{ Request()->has('id') ? 'show active' : '' }}">
                                <div class="row">
                                    <div class="ec-t-review-wrapper">
                                        @foreach ($product->ratings as $rating)
                                            <div class="ec-t-review-item">
                                                <div class="ec-t-review-avtar">
                                                    <img src="{{ asset('assets/img/single_product/person.png') }}"
                                                        alt="" />
                                                </div>
                                                <div class="ec-t-review-content">
                                                    <div class="ec-t-review-top">
                                                        <div class="ec-t-review-name">{{ $rating->name }}</div>
                                                        <div class="ec-t-review-rating">
                                                            <input name="rating" type="number"
                                                                value="{{ $rating->rating }}"
                                                                class="rating published_rating" data-size="sm">
                                                        </div>
                                                    </div>

                                                    <div class="ec-t-review-bottom">
                                                        <p>
                                                            {{ $rating->review }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                    @php
                                        $user = Auth()->id();
                                        $rating = App\Models\Rating::where('user_id', $user)
                                            ->where('product_id', $product->id)
                                            ->get();

                                    @endphp
                                    @if (Auth::check())
                                        @if ($rating->count() == 0)
                                            <div class="ec-ratting-content">
                                                <h3>Add a Review</h3>
                                                <div class="ec-ratting-form">
                                                    <form action="{{ route('rating', ['product_id' => $product->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="ec-ratting-star">
                                                            <span>Your rating:</span>
                                                            <input value="1" name="rating"
                                                                class="rating product_rating" data-size="xs">
                                                        </div>
                                                        <div class="ec-ratting-input">
                                                            <input name="name" placeholder="Name"
                                                                class="@error('name') is-invalid @enderror"
                                                                placeholder="Your Name" type="text" />
                                                        </div>
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        <div class="ec-ratting-input">
                                                            <input name="email" placeholder="Email*"
                                                                class="@error('email') is-invalid @enderror"
                                                                placeholder="Your Email" type="email" required />
                                                        </div>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                        <div class="ec-ratting-input form-submit">
                                                            <textarea name="review" placeholder="Enter Your Comment"></textarea>
                                                            <button class="btn btn-dark" type="submit"
                                                                value="Submit">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product details description area end -->
        </section>
        <!-- End Single product -->


        <section class="section ec-new-product" style="margin-bottom: 100px">
            <div class="container">
                <div class="row">
                    <div class="section-title">
                        <h2 class="related-product-sec-title">Related products</h2>
                    </div>

                    <!-- Swiper Slider Container -->
                    <div class="swiper related-products-slider">
                        <div class="swiper-wrapper">
                            @foreach ($related_products as $product)
                                <div class="swiper-slide">
                                    <div class="product-card my-2">
                                        {{-- Product Image Section --}}
                                        <div class="product-image-wrapper">
                                            <div class="product-image">
                                                <img src="{{ Storage::url($product->image) }}"
                                                    alt="{{ $product->name }}" class="product-img" loading="lazy">

                                                {{-- Product Actions Overlay --}}
                                                <div class="product-overlay">
                                                    <div class="product-actions">
                                                        <a href="{{ route('product_details', $product->slug) }}"
                                                            class="action-btn" title="Quick View"
                                                            aria-label="View {{ $product->name }} details">
                                                            <i class="fas fa-eye text-light"></i>
                                                        </a>

                                                        <form action="{{ route('cart.store') }}" method="post"
                                                            class="cart-form">
                                                            @csrf
                                                            <input type="hidden" name="quantity" value="1">
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $product->id }}">
                                                            <button class="action-btn" title="Add to Cart" type="submit"
                                                                aria-label="Add {{ $product->name }} to cart">
                                                                <i class="fas fa-shopping-cart"></i>
                                                            </button>
                                                        </form>

                                                        <button class="action-btn compare-btn" title="Compare"
                                                            aria-label="Compare {{ $product->name }}">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                {{-- Discount Badge --}}
                                                @if ($hasDiscount)
                                                    <div class="discount-badge"
                                                        aria-label="{{ $discountPercentage }}% discount">
                                                        <span>-{{ $discountPercentage }}%</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Product Content Section --}}
                                        <div class="product-content">
                                            {{-- Product Category --}}
                                            <div class="product-category">
                                                @foreach ($product->prodcats as $categoryName)
                                                    <span>{{ $categoryName->name }}</span>
                                                @endforeach
                                            </div>

                                            {{-- Product Title --}}
                                            <h3 class="product-title">
                                                <a href="{{ route('product_details', $product->slug) }}"
                                                    aria-label="View {{ $product->name }} details">
                                                    {{ Str::limit($product->name, 35) }}
                                                </a>
                                            </h3>

                                            {{-- Product Rating --}}
                                            <div class="product-rating"
                                                aria-label="Rating: {{ $averageRating }} out of 5 stars">
                                                <div class="stars" role="img"
                                                    aria-label="Rating: {{ $averageRating }} stars">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $fullStars)
                                                            <i class="fas fa-star filled" aria-hidden="true"></i>
                                                        @elseif($i == $fullStars + 1 && $hasHalfStar)
                                                            <i class="fas fa-star-half-alt filled" aria-hidden="true"></i>
                                                        @else
                                                            <i class="fas fa-star" aria-hidden="true"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <span class="rating-count">({{ $ratingCount }})</span>
                                            </div>

                                            {{-- Product Price --}}
                                            <div class="product-price">
                                                @if ($hasDiscount)
                                                    <span class="original-price"
                                                        aria-label="Original price">{{ Sohoj::price($originalPrice) }}</span>
                                                @endif
                                                <span class="current-price"
                                                    aria-label="Current price">{{ Sohoj::price($currentPrice) }}</span>
                                            </div>

                                            {{-- Add to Cart Button --}}
                                            <form action="{{ route('cart.store') }}" method="POST"
                                                class="add-to-cart-form">
                                                @csrf
                                                <input type="hidden" name="quantity" value="1">
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button class="add-to-cart-btn" type="submit"
                                                    aria-label="Add {{ $product->name }} to cart">
                                                    <span class="spinner" style="display:none;margin-right:8px;"><i
                                                            class="fas fa-spinner fa-spin"></i></span>
                                                    <i class="fas fa-shopping-cart me-2" aria-hidden="true"></i>
                                                    <span class="btn-text">Add to Cart</span>
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
@section('js')
    <script src="{{ asset('assets/frontend-assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/slick.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>

    <script src="{{ asset('assets/frontend-assets/js/main.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/star-rating.js') }}"></script>

<script>
    $("#product_rating").rating({
        showCaption: true
    });
    $(".published_rating").rating({
        showCaption: false,
        readonly: true,
    });
</script> --}}


    <!-- Add Swiper JS just before </body> -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" /> --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <script>
        const swiper = new Swiper('.related-products-slider', {
            slidesPerView: 4,
            spaceBetween: 30,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                576: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                992: {
                    slidesPerView: 5,
                },
            },
        });
    </script>
@endsection
