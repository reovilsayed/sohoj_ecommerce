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
        w

        /* Cart Form */
        .cart-form {
            margin: 0;
            display: inline;
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

        /* Product Variations Styling */
        .product-variations-section {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .variations-title {
            color: #2c3e50;
            font-size: 1.2rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #ffc107;
            display: inline-block;
        }

        .variation-card {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .variation-card:hover {
            border-color: #ffc107;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .attribute-item {
            margin-bottom: 5px;
        }

        .color-swatch {
            width: 20px;
            height: 20px;
            border-radius: 3px;
            border: 1px solid #ccc;
            display: inline-block;
            margin-right: 8px;
        }

        .variation-select-btn {
            border-radius: 20px;
            font-size: 0.85rem;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }

        .variation-select-btn:hover {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #000;
        }

        .variation-select-btn.active {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #000;
        }

        .price-tag {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .placeholder-img {
            background: #e9ecef;
            color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .variation-card .row > div {
                margin-bottom: 15px;
            }
            
            .product-variations-section {
                padding: 15px;
            }
            
            .variation-select-btn {
                font-size: 0.75rem;
                padding: 6px 12px;
                margin-bottom: 10px;
            }
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
            
            // Process variations data
            $variations = [];
            if ($product->variations && is_string($product->variations)) {
                $variations = json_decode($product->variations, true) ?? [];
            } elseif ($product->variations && is_array($product->variations)) {
                $variations = $product->variations;
            }
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

                                                {{-- Product Variations Display --}}
                                                @if ($product->is_variable_product && !empty($variations))
                                                    <div class="product-variations-section mt-4 mb-4">
                                                        <h4 class="variations-title mb-3" style="font-weight: 600; color: #2c3e50;">Available Variations</h4>
                                                        
                                                        <div class="variations-container">
                                                            @foreach ($variations as $index => $variation)
                                                                <div class="variation-card border rounded-lg p-3 mb-3" style="border: 1px solid #dee2e6; background: #f8f9fa;">
                                                                    <div class="row align-items-center">
                                                                        {{-- Variation Image --}}
                                                                        <div class="col-md-2 col-sm-3">
                                                                            @if (isset($variation['variant_image']) && $variation['variant_image'])
                                                                                <img src="{{ Storage::url($variation['variant_image']) }}" 
                                                                                     alt="Variation {{ $index + 1 }}" 
                                                                                     class="img-fluid rounded" 
                                                                                     style="width: 80px; height: 80px; object-fit: cover;">
                                                                            @else
                                                                                <div class="placeholder-img d-flex align-items-center justify-content-center rounded" 
                                                                                     style="width: 80px; height: 80px; background: #e9ecef; color: #6c757d;">
                                                                                    <i class="fas fa-image"></i>
                                                                                </div>
                                                                            @endif
                                                                        </div>

                                                                        {{-- Variation Details --}}
                                                                        <div class="col-md-10 col-sm-9">
                                                                            <div class="row">
                                                                                {{-- Attributes --}}
                                                                                <div class="col-md-4">
                                                                                    <h6 class="mb-2" style="font-weight: 600; color: #495057;">Attributes</h6>
                                                                                    @if (isset($variation['attributes']) && is_array($variation['attributes']))
                                                                                        <div class="attributes-list">
                                                                                            @foreach ($variation['attributes'] as $attr)
                                                                                                <div class="attribute-item d-flex align-items-center mb-1">
                                                                                                    <span class="attribute-name me-2" style="font-size: 0.85rem; color: #6c757d;">{{ $attr['attribute'] ?? 'N/A' }}:</span>
                                                                                                    @if (isset($attr['value']) && str_starts_with($attr['value'], '#'))
                                                                                                        <div class="color-swatch me-2" 
                                                                                                             style="width: 20px; height: 20px; background-color: {{ $attr['value'] }}; border: 1px solid #ccc; border-radius: 3px;"></div>
                                                                                                    @endif
                                                                                                    <span class="attribute-value" style="font-size: 0.85rem; font-weight: 500;">{{ $attr['value'] ?? 'N/A' }}</span>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    @endif
                                                                                </div>

                                                                                {{-- Pricing --}}
                                                                                <div class="col-md-3">
                                                                                    <h6 class="mb-2" style="font-weight: 600; color: #495057;">Pricing</h6>
                                                                                    <div class="price-info">
                                                                                        <div class="current-price" style="font-size: 1.1rem; font-weight: 700; color: #28a745;">
                                                                                            ${{ number_format($variation['price'] ?? 0, 2) }}
                                                                                        </div>
                                                                                        @if (isset($variation['compare_at_price']) && $variation['compare_at_price'] > 0 && $variation['compare_at_price'] > $variation['price'])
                                                                                            <div class="compare-price" style="font-size: 0.9rem; color: #6c757d; text-decoration: line-through;">
                                                                                                ${{ number_format($variation['compare_at_price'], 2) }}
                                                                                            </div>
                                                                                        @endif
                                                                                        @if (isset($variation['cost_per_item']) && $variation['cost_per_item'] > 0)
                                                                                            <div class="cost-price" style="font-size: 0.8rem; color: #6c757d;">
                                                                                                Cost: ${{ number_format($variation['cost_per_item'], 2) }}
                                                                                            </div>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>

                                                                                {{-- Stock & Inventory --}}
                                                                                <div class="col-md-3">
                                                                                    <h6 class="mb-2" style="font-weight: 600; color: #495057;">Stock</h6>
                                                                                    <div class="stock-info">
                                                                                        @if (isset($variation['track_quantity']) && $variation['track_quantity'])
                                                                                            <div class="stock-quantity">
                                                                                                <span class="badge {{ ($variation['stock'] ?? 0) > 10 ? 'bg-success' : (($variation['stock'] ?? 0) > 0 ? 'bg-warning' : 'bg-danger') }}">
                                                                                                    {{ $variation['stock'] ?? 0 }} in stock
                                                                                                </span>
                                                                                            </div>
                                                                                        @else
                                                                                            <span class="badge bg-info">Unlimited</span>
                                                                                        @endif
                                                                                        @if (isset($variation['sku']) && $variation['sku'])
                                                                                            <div class="sku-info mt-1" style="font-size: 0.8rem; color: #6c757d;">
                                                                                                SKU: {{ $variation['sku'] }}
                                                                                            </div>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>

                                                                                {{-- Dimensions --}}
                                                                                <div class="col-md-2">
                                                                                    <h6 class="mb-2" style="font-weight: 600; color: #495057;">Dimensions</h6>
                                                                                    <div class="dimensions-info" style="font-size: 0.8rem; color: #6c757d;">
                                                                                        @if (isset($variation['weight']) && $variation['weight'])
                                                                                            <div>Weight: {{ $variation['weight'] }}g</div>
                                                                                        @endif
                                                                                        @if (isset($variation['length'], $variation['width'], $variation['height']))
                                                                                            <div>{{ $variation['length'] }} × {{ $variation['width'] }} × {{ $variation['height'] }} cm</div>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                        {{-- Quick Selection Buttons --}}
                                                        <div class="variation-quick-select mt-3">
                                                            <h6 class="mb-2" style="font-weight: 600; color: #495057;">Quick Select:</h6>
                                                            <div class="btn-group-toggle" data-toggle="buttons">
                                                                @foreach ($variations as $index => $variation)
                                                                    <label class="btn btn-outline-primary btn-sm me-2 mb-2 variation-select-btn" 
                                                                           data-variation="{{ json_encode($variation) }}"
                                                                           data-index="{{ $index }}">
                                                                        <input type="radio" name="selected_variation" value="{{ $index }}">
                                                                        @if (isset($variation['attributes']) && is_array($variation['attributes']))
                                                                            @foreach ($variation['attributes'] as $attr)
                                                                                {{ $attr['attribute'] }}: {{ $attr['value'] }}
                                                                                @if (!$loop->last) | @endif
                                                                            @endforeach
                                                                        @else
                                                                            Variation {{ $index + 1 }}
                                                                        @endif
                                                                        <span class="price-tag ms-2 text-success">${{ number_format($variation['price'] ?? 0, 2) }}</span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
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
                                                            </div>
                                                            <!-- Modal -->
                                                        </div>
                                                        <p>Sku: <span>{{ $product->sku }}</p>
                                                    </div>
                                                </div>

                                            </div>
                                            {{-- @dd($product) --}}
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
                                                            value="{{ $rating->rating }}" class="rating published_rating"
                                                            data-size="sm">
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

                    <div class="row">
                        @foreach ($related_products as $product)
                            <x-products.product :product="$product" :variant="'green'" :showMultipleCategories="true" />
                        @endforeach
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

        // Product Variations Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const variationBtns = document.querySelectorAll('.variation-select-btn');
            const priceElement = document.querySelector('.new-price');
            const oldPriceElement = document.querySelector('.old-price');
            const stockElement = document.querySelector('.stock span');
            
            variationBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    // Remove active class from all buttons
                    variationBtns.forEach(b => b.classList.remove('active'));
                    
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    // Get variation data
                    const variationData = JSON.parse(this.dataset.variation);
                    
                    // Update price
                    if (priceElement && variationData.price) {
                        priceElement.textContent = '$' + parseFloat(variationData.price).toFixed(2);
                    }
                    
                    // Update compare price
                    if (oldPriceElement && variationData.compare_at_price) {
                        if (parseFloat(variationData.compare_at_price) > parseFloat(variationData.price)) {
                            oldPriceElement.textContent = '$' + parseFloat(variationData.compare_at_price).toFixed(2);
                            oldPriceElement.parentElement.style.display = 'inline';
                        } else {
                            oldPriceElement.parentElement.style.display = 'none';
                        }
                    }
                    
                    // Update stock
                    if (stockElement && variationData.stock !== undefined) {
                        if (variationData.track_quantity) {
                            stockElement.textContent = variationData.stock;
                        } else {
                            stockElement.textContent = 'Unlimited';
                        }
                    }
                    
                    // Add visual feedback
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);
                });
            });
            
            // Add hover effects to variation cards
            const variationCards = document.querySelectorAll('.variation-card');
            variationCards.forEach(function(card) {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px)';
                    this.style.boxShadow = '0 6px 12px rgba(0,0,0,0.15)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 2px 4px rgba(0,0,0,0.1)';
                });
            });
        });
    </script>
@endsection
