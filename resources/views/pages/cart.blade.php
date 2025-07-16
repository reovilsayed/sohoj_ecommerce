@section('title', 'Shopping Cart | Sohoj E-commerce')
@section('meta_description', 'Review and manage your shopping cart items on Sohoj E-commerce. Secure checkout, easy quantity updates, and instant price calculations.')
@section('meta_keywords', 'shopping cart, cart, checkout, ecommerce, online shopping, sohoj')
@section('canonical_url', route('cart'))
@section('meta_og')
    <meta property="og:title" content="Shopping Cart | Sohoj E-commerce">
    <meta property="og:description" content="Review and manage your shopping cart items on Sohoj E-commerce. Secure checkout, easy quantity updates, and instant price calculations.">
    <meta property="og:image" content="{{ asset('assets/logo/logo007.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
@endsection
@section('meta_twitter')
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Shopping Cart | Sohoj E-commerce">
    <meta name="twitter:description" content="Review and manage your shopping cart items on Sohoj E-commerce. Secure checkout, easy quantity updates, and instant price calculations.">
    <meta name="twitter:image" content="{{ asset('assets/logo/logo007.png') }}">
@endsection

@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assetss/responsive.css') }}" />
    <link rel="stylesheet" id="bg-switcher-css" href="{{ asset('assets/frontend-assetss/css/backgrounds/bg-4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/shops.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/cart.css') }}"> --}}

    <style>
        :root {
            --primary-color: #2a81c9;
            --secondary-color: #2a81c9;
            --text-color: #1f2937;
            --light-gray: #f3f4f6;
            --medium-gray: #e5e7eb;
            --dark-gray: #6b7280;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            /* box-sizing: border-box; */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        #body {
            background-color: var(--light-gray);
            color: var(--text-color);
            line-height: 1.6;
        }

        .cart-container {
            display: flex;
            gap: 2rem;
            flex-direction: column;
            margin-top: 77px;
        }

        @media (min-width: 992px) {
            .cart-container {
                flex-direction: row;
            }

            .cart-items {
                flex: 2;
            }

            .order-summary {
                flex: 1;
            }
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--medium-gray);
        }

        .cart-title {
            font-size: 1.75rem;
            font-weight: 600;
        }

        .item-count {
            font-size: 1rem;
            color: var(--dark-gray);
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            background-color: var(--white);
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .cart-table thead {
            background-color: var(--light-gray);
        }

        .cart-table th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: var(--text-color);
            text-transform: uppercase;
            font-size: 0.875rem;
            letter-spacing: 0.05em;
        }

        .cart-table td {
            padding: 1.5rem 1rem;
            vertical-align: top;
            border-bottom: 1px solid var(--medium-gray);
        }

        .product-info {
            display: flex;
            gap: 1rem;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 0.25rem;
        }

        .product-details h3 {
            font-size: 1.125rem;
            margin-bottom: 0.25rem;
        }

        .product-details p {
            color: var(--dark-gray);
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .remove-btn {
            color: var(--primary-color);
            background: none;
            border: none;
            font-size: 0.875rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .remove-btn:hover {
            text-decoration: underline;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            border: 1px solid var(--medium-gray);
            background: none;
            border-radius: 0.25rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-input {
            width: 50px;
            height: 30px;
            text-align: center;
            border: 1px solid var(--medium-gray);
            border-radius: 0.25rem;
        }

        .price {
            font-weight: 600;
        }

        .order-summary {
            background-color: var(--white);
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            height: fit-content;
        }

        .summary-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--medium-gray);
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .summary-label {
            color: var(--dark-gray);
        }

        .summary-value {
            font-weight: 600;
        }

        .promo-code {
            margin: 1.5rem 0;
            padding: 1rem 0;
            border-top: 1px dashed var(--medium-gray);
            border-bottom: 1px dashed var(--medium-gray);
        }

        .promo-input {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .promo-input input {
            flex: 1;
            padding: 0.5rem 0.75rem;
            border: 1px solid var(--medium-gray);
            border-radius: 0.25rem;
        }

        .apply-btn {
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            cursor: pointer;
            font-weight: 500;
        }

        .apply-btn:hover {
            background-color: var(--secondary-color);
        }

        .total-row {
            margin: 1.5rem 0;
            padding-top: 1rem;
            border-top: 1px solid var(--medium-gray);
            font-size: 1.125rem;
        }

        .checkout-btn {
            width: 100%;
            padding: 1rem;
            background-color: var(--primary-color);
            color: var(--white);
            border: none;
            border-radius: 0.25rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 1.5rem;
        }

        .checkout-btn:hover {
            background-color: var(--secondary-color);
            color: #ffffff;
        }

        .continue-shopping {
            display: inline-block;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            margin-top: 1rem;
        }

        .continue-shopping:hover {
            text-decoration: underline;
        }
    </style>
@endsection
@section('content')
<main>
    <x-app.header />
    @php
        $items = Cart::Content();

        $groupedItems = $items->groupBy(function ($item) {
            return $item->model->shop_id;
        });
    @endphp
    <section class="cart-section">
        <div class="container mb-5">
            <header class="cart-header">
                <h1 class="cart-title">Shopping Cart</h1>
                <span class="item-count">{{ Cart::count() }} Items</span>
            </header>
            
            <div class="cart-container">
                <div class="cart-items">
                @if (Cart::count() > 0)
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product Details</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Shipping cost</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>
                                        <div class="product-info">
                                            <img src="{{ Storage::url($item->model->image) }}" alt="File 19"
                                                class="product-image">
                                            <div class="product-details">
                                                <h3>{{ $item->name }}</h3>
                                                <p>{{ Str::limit(strip_tags($item->model->short_description), $limit = 50, $end = '...') }}
                                                </p>
                                                <p>
                                                    @if ($item->model->quantity)
                                                        <span class="text-success">In Stok</span>
                                                    @else
                                                        <span class="text-danger">Out of
                                                            stock</span>
                                                    @endif
                                                </p>
                                                <a href="{{ route('cart.destroy', $item->rowId) }}" class="remove-btn"><i
                                                        class="fas fa-trash-alt"></i> Remove</a>

                                                </button>

                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <form action="{{ route('cart.update') }}" method="POST">
                                            @csrf
                                            @if ($item->options['offer'] == 'no_offer')
                                                <div class="quantity-control">
                                                    <input type="hidden" name="rowId" value="{{ $item->rowId }}" />
                                                    <button type="submit" name="action" value="decrease"
                                                        class="quantity-btn">-</button>
                                                    <input type="number" name="qty" value="{{ $item->qty }}"
                                                        min="1" class="quantity-input p-0" readonly>
                                                    <button type="submit" name="action" value="increase"
                                                        class="quantity-btn">+</button>
                                                </div>
                                            @endif
                                        </form>
                                    </td>
                                    @php
                                        $shippingCost = $item->model->shipping_cost ?? 0;
                                        $totalPrice = $item->price * $item->qty + $shippingCost;
                                    @endphp
                                    <td class="price">{{ Sohoj::price($item->price) }}</td>
                                    <td class="price">{{ Sohoj::price($item->model->shipping_cost) }}</td>
                                    <td class="price">{{ Sohoj::price($totalPrice) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div class="order-summary">

                <div class="ec-sidebar-block mt-3 side-bar-box ">
                    <div class="ec-sb-block-content">
                        <div class="ec-cart-summary-bottom">
                            <div class="ec-cart-summary">
                                <div>
                                    <span class="text-left">Total ({{ Cart::content()->count() }}
                                        items)</span>
                                    <span class="text-right">${{ Cart::subtotal() }}</span>
                                </div>
                                @if (!session()->has('discount'))
                                    <div>
                                        <span class="text-left">Coupan Discount</span>
                                        <span class="text-right"><a class="ec-cart-coupan">Apply
                                                Coupan</a></span>
                                    </div>

                                    <div class="ec-cart-coupan-content">
                                        <form class="ec-cart-coupan-form" name="ec-cart-coupan-form" method="POST"
                                            action="{{ route('coupon') }}">
                                            @csrf

                                            <input class="ec-coupan bg-white" type="text" required=""
                                                placeholder="Enter Your Coupan Code" name="coupon_code" value="">
                                            <button class="ec-coupan-btn button btn-dark" type="submit" name="subscribe"
                                                value="">Apply</button>
                                        </form>
                                    </div>
                                @endif
                                @if (session()->has('discount'))
                                    <div class="ec-cart-summary-total">
                                        <span class="text-left">Discount <a href="{{ route('coupon.destroy') }}"
                                                class="text-danger" style="text-decoration: underline">Delete</a></span>
                                        <span class="text-right">{{ Sohoj::price(Sohoj::discount()) }}</span>
                                    </div>
                                @endif
                                <div class="ec-cart-summary-total">
                                    <span class="text-left">Total Shipping</span>
                                    <span class="text-right">{{ Sohoj::price(Sohoj::shipping()) }}</span>
                                </div>
                                <div class="ec-cart-summary-total">
                                    <span class="text-left">Tax</span>
                                    <span class="text-right">{{ Sohoj::price(Sohoj::tax()) }}</span>
                                </div>
                                <div class="ec-cart-summary-total">
                                    <span class="text-left">Total Amount</span>
                                    <span class="text-right">{{ Sohoj::price(Sohoj::newSubtotal()) }}</span>
                                </div>
                                <a href="{{ route('checkout') }}" class="checkout-btn mt-4">Proceed to
                                    Checkout</a>
                            </div>


                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Ec cart page -->


    <!-- New Product Start -->
    <section class="section ec-new-product">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left">
                    <div class="section-title">

                        <h2 class="related-product-sec-title"> Explore Similer Shops</h2>
                    </div>
                    <div class="ec-spe-section  data-animation=" slideInLeft">


                        <div class="ec-spe-products">
                            @foreach ($latest_shops->chunk(4) as $shop)
                                <div class="ec-fs-product">
                                    <div class="ec-fs-pro-inner">

                                        <div class="row">

                                            @foreach ($shop as $shop)
                                                <x-shops-card.card-2 :shop="$shop" />
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
    <!-- New Product end -->
@endsection
@section('js')
    <script src="{{ asset('assets/frontend-assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>

    <script src="{{ asset('assets/frontend-assets/js/main.js') }}"></script>
@endsection
