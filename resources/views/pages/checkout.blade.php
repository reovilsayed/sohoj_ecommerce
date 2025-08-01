@section('title', 'Checkout | Afrikartt E-commerce')
@section('meta_description',
    'Complete your purchase securely on Afrikartt E-commerce. Fast, safe checkout with multiple
    payment options and order tracking.')
@section('meta_keywords', 'checkout, payment, order, purchase, ecommerce, online shopping, Afrikartt')
@section('canonical_url', route('checkout'))
@section('meta_og')
    <meta property="og:title" content="Checkout | Afrikartt E-commerce">
    <meta property="og:description"
        content="Complete your purchase securely on Afrikartt E-commerce. Fast, safe checkout with multiple payment options and order tracking.">
    <meta property="og:image" content="{{ asset('assets/logo/logo007.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
@endsection
@section('meta_twitter')
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Checkout | Afrikartt E-commerce">
    <meta name="twitter:description"
        content="Complete your purchase securely on Afrikartt E-commerce. Fast, safe checkout with multiple payment options and order tracking.">
    <meta name="twitter:image" content="{{ asset('assets/logo/logo007.png') }}">
@endsection
@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assetss/responsive.css') }}" />
    <style>
        /* Import centralized color system */
        @import url('{{ asset("assets/css/colors.css") }}');


        .checkout-hero {
            background: var(--accent-color);
            color: var(--text-light);
            /* border-radius: var(--border-radius); */
            box-shadow: var(--shadow-medium);
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
            background: var(--bg-light);
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

        .checkout-card {
            background: var(--bg-secondary);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-medium);
            padding: 2rem 2.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border-light);
        }

        .checkout-table {
            background: var(--bg-secondary);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-medium);
            padding: 1.5rem 1.5rem 0 1.5rem;
        }

        .checkout-table .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 0.5rem;
            font-family: 'Inter', Arial, sans-serif;
            background: transparent;
        }

        .checkout-table .table thead th {
            padding: 1.1rem 1.5rem;
            background: var(--bg-light);
            border: none !important;
            font-weight: 700;
            color: var(--accent-color) !important;
            font-size: 1.05rem;
            letter-spacing: 0.5px;
            border-bottom: none !important;
        }

        .checkout-table .table tbody td {
            background: var(--bg-secondary);
            border: none;
            padding: 1.1rem 1.5rem;
            vertical-align: middle;
            font-size: 1rem;
            color: var(--text-dark);
            border-radius: 8px;
            box-shadow: 0 2px 8px var(--shadow-light);
        }

        .checkout-product-image {
            border-radius: 8px;
            margin-right: 18px;
            box-shadow: 0 2px 8px var(--shadow-light);
            background: var(--bg-light);
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .remove-item {
            color: var(--accent-color);
            transition: 0.2s;
            border-radius: 50%;
            background: var(--bg-light);
            border: 1px solid var(--border-light);
            padding: 8px;
        }

        .remove-item:hover {
            color: var(--error-color);
            background: var(--bg-light);
            border-color: var(--error-color);
        }

        .checkout-summary {
            background: var(--bg-secondary);
            /* border-radius: var(--border-radius); */
            box-shadow: 0 2px 8px var(--shadow-primary);
            padding: 1.5rem 1.5rem 1rem 1.5rem;
            border: 1px solid var(--border-light);
        }

        .checkout-summary-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 1.2rem;
            letter-spacing: 0.5px;
        }

        .checkout-summary-list>div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.7rem;
        }

        .checkout-summary-total {
            border-top: 2px solid var(--border-light);
            padding-top: 1rem;
            margin-top: 1.2rem;
            font-size: 1.2rem;
            color: var(--text-dark);
        }

        .checkout-btn {
            background: var(--accent-color) !important;
            color: var(--text-light) !important;
            font-weight: 600;
            border-radius: 8px;
            box-shadow: 0 2px 8px var(--shadow-primary);
            border: none;
            transition: 0.2s;
        }

        .checkout-btn:hover {
            background: var(--primary-dark) !important;
            color: var(--text-light) !important;
            box-shadow: 0 4px 16px var(--shadow-primary);
        }

        .form-control,
        .form-check-input {
            border-radius: 8px;
            border: 1px solid var(--border-light);
            font-size: 1rem;
            padding: 0.7rem 1rem;
            transition: 0.2s;
        }

        .form-control:focus,
        .form-check-input:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 2px var(--shadow-primary);
        }

        .badge.bg-light.text-black {
            background: var(--bg-light) !important;
            color: var(--accent-color) !important;
            font-weight: 600;
            border-radius: 6px;
            letter-spacing: 0.2px;
        }

        .card {
            box-shadow: 0 2px 8px var(--shadow-light);
        }

        .pay-img {
            width: 38px;
            height: 24px;
            object-fit: contain;
            margin-right: 10px;
        }

        @media (max-width: 991px) {

            .checkout-card,
            .checkout-table,
            .checkout-summary {
                padding: 1rem !important;
            }

            .checkout-hero {
                padding: 1.2rem 1rem;
            }
        }

        @media (max-width: 767px) {

            .checkout-card,
            .checkout-table,
            .checkout-summary {
                padding: 0.5rem !important;
            }

            .checkout-hero {
                padding: 0.7rem 0.5rem;
            }

            .checkout-table .table thead th,
            .checkout-table .table tbody td {
                padding: 0.7rem 0.5rem;
                font-size: 0.95rem;
            }
        }

        .payment-card-option {
            position: relative;
            display: flex;
            align-items: center;
            border: 2px solid var(--border-light);
            border-radius: 12px;
            padding: 1rem;
            cursor: pointer;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s, transform 0.15s;
            background: var(--bg-light);
            margin-bottom: 0.5rem;
            gap: 1rem;
            box-shadow: 0 2px 8px var(--shadow-light);
        }

        .payment-card-option input[type="radio"] {
            opacity: 0;
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 22px;
            height: 22px;
            margin: 0;
            z-index: 2;
            cursor: pointer;
        }

        .custom-radio-indicator {
            width: 22px;
            height: 22px;
            border: 2px solid var(--border-medium);
            border-radius: 50%;
            background: var(--bg-secondary);
            display: inline-block;
            margin-right: 1rem;
            position: relative;
            transition: border-color 0.2s, box-shadow 0.2s;
            flex-shrink: 0;
        }

        .payment-card-option input[type="radio"]:checked + .custom-radio-indicator {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px var(--shadow-primary);
        }

        .payment-card-option input[type="radio"]:checked + .custom-radio-indicator::after {
            content: '';
            display: block;
            width: 12px;
            height: 12px;
            background: var(--accent-color);
            border-radius: 50%;
            position: absolute;
            top: 3px;
            left: 3px;
        }

        .payment-card-option input[type="radio"]:checked ~ .payment-card-content {
            /* Highlight the card background and border */
            background: var(--bg-light);
            border-radius: 10px;
            box-shadow: 0 4px 18px var(--shadow-primary);
            /* Optional: scale up a bit */
            transform: scale(1.02);
        }

        .payment-card-option input[type="radio"]:checked ~ .payment-card-content .payment-title {
            color: var(--accent-color);
        }

        /* Optional: checkmark in the top-right corner of the selected card */
        .payment-card-option input[type="radio"]:checked ~ .payment-card-content::after {
            content: '✔';
            position: absolute;
            top: 12px;
            right: 18px;
            font-size: 1.3rem;
            color: var(--accent-color);
            background: var(--bg-secondary);
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px var(--shadow-primary);
            z-index: 3;
            pointer-events: none;
        }

        .payment-card-option:hover,
        .payment-card-option input[type="radio"]:focus+.custom-radio-indicator {
            border-color: var(--accent-color);
            box-shadow: 0 4px 16px var(--shadow-primary);
        }

        .payment-card-content {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            width: 100%;
        }

        .payment-img-wrap {
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            background: var(--bg-secondary);
            border-radius: 8px;
            box-shadow: 0 2px 8px var(--shadow-light);
        }

        .pay-img {
            width: 44px;
            height: 44px;
            object-fit: contain;
            margin: 0;
            display: block;
        }

        .payment-text-wrap {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 0;
        }

        .payment-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .payment-desc {
            font-size: 0.97rem;
            color: var(--text-secondary);
            margin-top: 2px;
            font-weight: 400;
            line-height: 1.3;
        }
    </style>
@endsection

@section('content')
    <x-app.header />
    <div class="checkout-main-bg py-4">
        @php
            $items = Cart::Content();
            $groupedItems = $items->groupBy(function ($item) {
                return $item->model->shop_id;
            });
        @endphp
        <div class="container">
            <div class="checkout-hero mb-4 position-relative">
                <h2 class="fw-bold mb-1 text-light">Checkout</h2>
                <p class="mb-0">Complete your order and enjoy fast, secure delivery.</p>
                <div
                    class="checkout-hero-steps d-none d-md-flex position-absolute end-0 top-0 h-100 align-items-center pe-4">
                    <span class="badge bg-light text-primary me-2">Cart</span>
                    <span class="badge bg-light text-primary me-2">Shipping</span>
                    <span class="badge bg-light text-primary me-2">Payment</span>
                    <span class="badge bg-light text-primary">Review</span>
                </div>
            </div>
            <!-- Multi-Step Checkout -->
            <div class="row g-4 flex-lg-row-reverse">
                <aside class="col-lg-4 d-none d-lg-block">
                    <div class="checkout-summary sticky-top" style="top: 32px; z-index: 2;">
                        <div class="checkout-summary-title">Order Summary</div>
                        <div class="checkout-summary-list">
                            @php
                         
                                $prices = Cart::subtotal();
                                // dd($prices);
                                $shipping = (float) Sohoj::shipping();
                                $flatCharge = (float) Sohoj::flatCommision($prices);
                                $discount = (float) Sohoj::discount();
                                // $total = $prices + $shipping + $flatCharge - $discount;
                            @endphp
                            <div>
                                <span>Items({{ Cart::count() }}):</span>
                                <span>{{ Sohoj::price($prices) }}</span>
                            </div>
                            <div>
                                <span>Platform fee:</span>
                                <span>{{ Sohoj::price($flatCharge) }}</span>
                            </div>
                            <div>
                                <span>Shipping:</span>
                                <span>{{ Sohoj::price($shipping) }}</span>
                            </div>
                            @if (session()->has('discount'))
                                <div>
                                    <span>Discount:</span>
                                    <span>{{ Sohoj::price(Sohoj::discount()) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="checkout-summary-total d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Order Total:</span>
                            <span class="fw-bold">{{ Sohoj::price(Sohoj::newSubtotal()) }}</span>
                        </div>
                    </div>
                </aside>
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-4 p-0 overflow-hidden">
                        <div class="card-body p-0">
                            <!-- Progress Bar -->
                            <div class="checkout-progress mb-2">
                                <div class="progress" style="height: 5px; background: #eaf0ff;">
                                    <div id="checkoutProgressBar" class="progress-bar bg-primary" role="progressbar"
                                        style="width: 25%; transition: width 0.4s; background-color: #01949a  !important;"
                                        aria-valuenow="1" aria-valuemin="1" aria-valuemax="4"></div>
                                </div>
                            </div>
                            <ul class="nav nav-pills nav-justified step-indicator mb-4" id="checkoutSteps" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="step1-tab" data-bs-toggle="pill"
                                        data-bs-target="#step1" type="button" role="tab" aria-controls="step1"
                                        aria-selected="true">
                                        <span class="step-circle step-check step1">1</span> Cart
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="step2-tab" data-bs-toggle="pill" data-bs-target="#step2"
                                        type="button" role="tab" aria-controls="step2" aria-selected="false">
                                        <span class="step-circle step-check step2">2</span> Shipping
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="step3-tab" data-bs-toggle="pill" data-bs-target="#step3"
                                        type="button" role="tab" aria-controls="step3" aria-selected="false">
                                        <span class="step-circle step-check step3">3</span> Payment
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="step4-tab" data-bs-toggle="pill" data-bs-target="#step4"
                                        type="button" role="tab" aria-controls="step4" aria-selected="false">
                                        <span class="step-circle step-check step4">4</span> Review
                                    </button>
                                </li>
                            </ul>
                            <form action="{{ route('checkout.store') }}" method="POST" id="multiStepCheckoutForm">
                                @csrf
                                <div class="tab-content p-4" id="checkoutStepsContent">
                                    <!-- Step 1: Cart -->
                                    <div class="tab-pane fade show active" id="step1" role="tabpanel"
                                        aria-labelledby="step1-tab">
                                        <h4 class="fw-semibold mb-3">Order Items</h4>
                                        <div class="table-responsive">
                                            <table class="table align-middle">
                                                                                            <thead style="background: var(--bg-light)">
                                                <tr>
                                                    <th class="py-3" style="color: var(--accent-color)">Product</th>
                                                    <th class="py-3" style="color: var(--accent-color)">Qty</th>
                                                    <th class="py-3" style="color: var(--accent-color)">Price</th>
                                                    <th class="py-3" style="color: var(--accent-color)">Shipping</th>
                                                    <th class="py-3" style="color: var(--accent-color)">Total</th>
                                                    <th class="text-center py-3" style="color: var(--accent-color)">Remove</th>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                    @foreach ($items as $item)
                                                        <tr>
                                                            <td class="border-0 d-flex align-items-center">
                                                                <img src="{{ Storage::url($item->model->image) }}"
                                                                    alt="Product"
                                                                    class="checkout-product-image me-2 flex-shrink-0">
                                                                <div>
                                                                    <div class="fw-semibold">{{ $item->name }}</div>
                                                                    <div class="text-muted small">
                                                                        {{ Str::limit(strip_tags($item->model->short_description), 40) }}
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="border-0">
                                                                <span
                                                                    class="badge bg-light text-black">{{ $item->qty }}</span>
                                                            </td>
                                                            <td class="price border-0">{{ Sohoj::price($item->price) }}
                                                            </td>
                                                            <td class="price border-0">
                                                                {{ Sohoj::price($item->model->shipping_cost) }}</td>
                                                            <td class="price border-0">
                                                                {{ Sohoj::price($item->price * $item->qty + ($item->model->shipping_cost ?? 0)) }}
                                                            </td>
                                                            <td class="text-center border-0">
                                                                <a href="{{ route('cart.destroy', $item->rowId) }}"
                                                                    class="remove-item" title="Remove item">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                                        <path fill-rule="evenodd"
                                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                                    </svg>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-flex justify-content-end mt-4">
                                            <button type="button" class="btn checkout-btn px-4" id="toStep2">Next:
                                                Shipping <i class="fa fa-arrow-right ms-2"></i></button>
                                        </div>
                                    </div>
                                    <!-- Step 2: Shipping -->
                                    <div class="tab-pane fade" id="step2" role="tabpanel"
                                        aria-labelledby="step2-tab">
                                        <h4 class="fw-semibold mb-3">Shipping & Contact Info</h4>
                                        <div class="checkout-card mb-4 p-4 shadow-sm border-0 rounded-4"
                                            style="background: var(--bg-light); border: 1px solid var(--border-light);">
                                            <div class="row g-3 align-items-end">
                                                <div class="col-md-6">
                                                    <label for="first_name" class="form-label">First Name</label>
                                                    <input type="text" class="form-control" id="first_name"
                                                        value="{{ old('first_name', Auth()->user() ? Auth()->user()->name : '') }}"
                                                        name="first_name" placeholder="First Name">
                                                    @error('first_name')
                                                        <span class="text-danger small position-absolute"
                                                            style="top:100%;left:0;">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="last_name" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" id="last_name"
                                                        value="{{ old('last_name', Auth()->user() ? Auth()->user()->l_name : '') }}"
                                                        name="last_name" placeholder="Last Name">
                                                    @error('last_name')
                                                        <span class="text-danger small position-absolute"
                                                            style="top:100%;left:0;">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-12 mt-2">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        aria-describedby="email"
                                                        value="{{ old('email', Auth()->user() ? Auth()->user()->email : '') }}"
                                                        name="email" placeholder="Email Address">
                                                    @error('email')
                                                        <span class="text-danger small position-absolute"
                                                            style="top:100%;left:0;">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-12 mt-2 position-relative">
                                                    <label for="address_1" class="form-label">Address</label>
                                                    <input type="text"
                                                        class="form-control @error('address_1') is-invalid @enderror"
                                                        id="address_1" name="address_1" value="{{ old('address_1') }}"
                                                        placeholder="Address Line 1" autocomplete="off">

                                                    @error('address_1')
                                                        <span class="text-danger small position-absolute"
                                                            style="top:100%;left:0;">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror

                                                    <!-- Optional: Capture coordinates -->
                                                    <input type="hidden" name="latitude" id="latitude">
                                                    <input type="hidden" name="longitude" id="longitude">
                                                </div>


                                                <div class="col-md-6 mt-2">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" id="phone"
                                                        value="{{ old('phone', Auth()->user() ? Auth()->user()->phone : '') }}"
                                                        name="phone" placeholder="Phone Number">
                                                    @error('phone')
                                                        <span class="text-danger small position-absolute"
                                                            style="top:100%;left:0;">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="post_code" class="form-label">Post Code</label>
                                                    <input type="text" class="form-control" id="post_code"
                                                        name="post_code"
                                                        value="{{ old('post_code', Auth()->user() ? Auth()->user()->post_code : '') }}"
                                                        placeholder="Post Code">
                                                    @error('post_code')
                                                        <span class="text-danger small position-absolute"
                                                            style="top:100%;left:0;">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="state" class="form-label">State</label>
                                                    <input type="text" class="form-control" id="state"
                                                        name="state"
                                                        value="{{ old('state', Auth()->user() ? Auth()->user()->state : '') }}"
                                                        placeholder="State">
                                                    @error('state')
                                                        <span class="text-danger small position-absolute"
                                                            style="top:100%;left:0;">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="city" class="form-label">City</label>
                                                    <input type="text" class="form-control" id="city"
                                                        name="city"
                                                        value="{{ old('city', Auth()->user() ? Auth()->user()->city : '') }}"
                                                        placeholder="City">
                                                    @error('city')
                                                        <span class="text-danger small position-absolute"
                                                            style="top:100%;left:0;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between mt-4">
                                            <button type="button" class="btn px-4"
                                                style="background: var(--accent-color); color: var(--text-light) !important;"
                                                id="backToStep1"><i class="fa fa-arrow-left me-2"></i>Back</button>
                                            <button type="button" class="btn checkout-btn px-4" id="toStep3">Next:
                                                Payment <i class="fa fa-arrow-right ms-2"></i></button>
                                        </div>
                                        <style>
                                            .checkout-card .form-floating>label>i {
                                                position: absolute;
                                                left: 1.1rem;
                                                top: 50%;
                                                transform: translateY(-50%);
                                                pointer-events: none;
                                            }

                                            .checkout-card .form-floating>input {
                                                padding-left: 2.5rem;
                                            }

                                            .address-card {
                                                border: 2px solid #e3eafc;
                                                transition: box-shadow 0.2s, border-color 0.2s;
                                                cursor: pointer;
                                            }

                                            .address-card:hover,
                                            .address-card:focus-within {
                                                border-color: var(--primary);
                                                box-shadow: 0 4px 16px rgba(30, 136, 229, 0.10);
                                            }

                                            .address-card .form-check-input:checked~.address-label {
                                                color: var(--primary);
                                            }

                                            .address-card .form-check-input:checked {
                                                border-color: var(--primary);
                                                background-color: var(--primary);
                                            }

                                            @media (max-width: 767px) {
                                                .checkout-card {
                                                    padding: 0.7rem !important;
                                                }

                                                .address-card {
                                                    padding: 1rem !important;
                                                }
                                            }
                                        </style>
                                    </div>
                                    <!-- Step 3: Payment -->
                                    <div class="tab-pane fade" id="step3" role="tabpanel"
                                        aria-labelledby="step3-tab">
                                        <h4 class="fw-semibold mb-3">Payment Method</h4>
                                        <div class="checkout-card mb-4 p-4 shadow-sm border-0 rounded-4"
                                            style="background: var(--bg-secondary); border: 1px solid var(--border-light);">
                                            <div class="row g-4 align-items-stretch">
                                                <div class="col-md-12 d-flex flex-column gap-3">
                                                    <label class="payment-card-option">
                                                        <input type="radio" name="payment_method" id="cash"
                                                            value="cash" class="form-check-input" required>
                                                        <span class="custom-radio-indicator"></span>
                                                        <span class="payment-card-content">
                                                            <span class="payment-img-wrap">
                                                                <img src="https://img.icons8.com/color/64/000000/us-dollar-circled--v1.png"
                                                                    alt="Dollar" class="pay-img" />
                                                            </span>
                                                            <span class="payment-text-wrap">
                                                                <span class="payment-title">Cash</span>
                                                                <span class="payment-desc">Pay with cash upon
                                                                    delivery.</span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <label class="payment-card-option">
                                                        <input type="radio" name="payment_method" id="paypal"
                                                            value="paypal" class="form-check-input" required>
                                                        <span class="custom-radio-indicator"></span>
                                                        <span class="payment-card-content">
                                                            <span class="payment-img-wrap">
                                                                <img src="https://img.icons8.com/color/64/000000/paypal.png"
                                                                    alt="PayPal" class="pay-img" />
                                                            </span>
                                                            <span class="payment-text-wrap">
                                                                <span class="payment-title">PayPal</span>
                                                                <span class="payment-desc">Pay securely using your PayPal
                                                                    account.</span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <label class="payment-card-option">
                                                        <input type="radio" name="payment_method" id="stripe"
                                                            value="stripe" class="form-check-input" required>
                                                        <span class="custom-radio-indicator"></span>
                                                        <span class="payment-card-content">
                                                            <span class="payment-img-wrap">
                                                                <img src="https://img.icons8.com/color/64/000000/bank-card-back-side.png"
                                                                    alt="Stripe" class="pay-img" />
                                                            </span>
                                                            <span class="payment-text-wrap">
                                                                <span class="payment-title">Stripe</span>
                                                                <span class="payment-desc">Pay with any major credit or
                                                                    debit card.</span>
                                                            </span>
                                                        </span>
                                                    </label>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-4">
                                            <button type="button" class="btn px-4"
                                                style="background: var(--accent-color); color: var(--text-light) !important;"
                                                id="backToStep2"><i class="fa fa-arrow-left me-2"></i>Back</button>
                                            <button type="button" class="btn checkout-btn px-4" id="toStep4">Next:
                                                Review <i class="fa fa-arrow-right ms-2"></i></button>
                                        </div>
                                        <style>
                                            .payment-option .form-check-input:checked~.form-check-label {
                                                color: var(--primary);
                                                font-weight: 600;
                                            }

                                            .pay-img {
                                                width: 100%;
                                                height: 100%;
                                                object-fit: contain;
                                            }

                                            .form-floating>label>i {
                                                position: absolute;
                                                left: 1.1rem;
                                                top: 50%;
                                                transform: translateY(-50%);
                                                pointer-events: none;
                                            }

                                            .form-floating>input {
                                                padding-left: 2.5rem;
                                            }
                                        </style>
                                    </div>
                                    <!-- Step 4: Review -->
                                    <div class="tab-pane fade" id="step4" role="tabpanel"
                                        aria-labelledby="step4-tab">
                                        <h4 class="fw-semibold mb-3">Review & Place Order</h4>
                                        <div class="checkout-summary mb-4">
                                            <div class="checkout-summary-title">Order Summary</div>
                                            <div class="checkout-summary-list">
                                                @php
                                                    $prices = (float) Cart::SubTotal();
                                                    $shipping = (float) Sohoj::shipping();
                                                    $flatCharge = (float) Sohoj::flatCommision($prices);
                                                    $discount = (float) Sohoj::discount();
                                                    $total = $prices + $shipping + $flatCharge - $discount;
                                                @endphp
                                                <div>
                                                    <span>Items({{ Cart::count() }}):</span>
                                                    <span>{{ Sohoj::price($prices) }}</span>
                                                </div>
                                                <div>
                                                    <span>Platform fee:</span>
                                                    <span>{{ Sohoj::price($flatCharge) }}</span>
                                                </div>
                                                <div>
                                                    <span>Shipping:</span>
                                                    <span>{{ Sohoj::price($shipping) }}</span>
                                                </div>
                                                @if (session()->has('discount'))
                                                    <div>
                                                        <span>Discount:</span>
                                                        <span>{{ Sohoj::price(Sohoj::discount()) }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div
                                                class="checkout-summary-total d-flex justify-content-between align-items-center">
                                                <span class="fw-bold">Order Total:</span>
                                                <span class="fw-bold">{{ Sohoj::price($total) }}</span>
                                            </div>
                                        </div>
                                        <div class="form-check mt-3 mb-2">
                                            <input type="checkbox" required
                                                class="form-check-input @error('terms') is-invalid @enderror"
                                                id="terms" value="1" name="terms">
                                            <label class="form-check-label ms-2" for="terms">
                                                I have read and agree to the <a href="{{ url('page/policies') }}"
                                                    target="_blank" class="text-primary">Terms & Conditions</a> of Afrikartt
                                                E-commerce
                                            </label>
                                            @error('terms')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button class="btn checkout-btn w-100 mt-2" type="submit">Place Order</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .checkout-hero-steps {
            font-size: 1rem;
            top: 0.5rem;
        }

        .checkout-summary.sticky-top {
            box-shadow: 0 4px 24px rgba(141, 110, 99, 0.08);
            border: 1px solid #d7ccc8;
        }

        @media (max-width: 991px) {
            .checkout-summary.sticky-top {
                position: static !important;
                box-shadow: none;
                border: none;
            }
        }

        .checkout-progress .progress {
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(74, 107, 255, 0.06);
        }

        .step-indicator .nav-link {
            position: relative;
            background: none;
            color: var(--primary);
            font-weight: 600;
            border: none;
            border-radius: 0;
            padding: 1rem 0.5rem 0.5rem 0.5rem;
            transition: color 0.2s;
        }

        .step-indicator .nav-link.active,
        .step-indicator .nav-link:focus {
            color: var(--text-light);
            background: var(--accent-color);
            border-radius: 8px 8px 0 0;
            box-shadow: 0 2px 8px var(--shadow-primary);
        }

        .step-indicator .step-circle {
            display: inline-block;
            width: 32px;
            height: 32px;
            line-height: 32px;
            border-radius: 50%;
            background: var(--bg-light);
            color: var(--accent-color);
            font-weight: 700;
            margin-right: 8px;
            text-align: center;
            font-size: 1.1rem;
            position: relative;
            transition: background 0.2s, color 0.2s;
        }

        .step-indicator .nav-link.active .step-circle {
            background: var(--text-light);
            color: var(--accent-color);
            border: 2px solid var(--primary-dark);
        }

        .step-indicator .step-circle.completed {
            background: var(--accent-color);
            color: var(--text-light);
            border: 2px solid var(--primary-dark);
        }

        .step-indicator .step-circle.completed::after {
            content: '\2713';
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2em;
            color: var(--text-light);
        }
    </style>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="payment-form" action="{{ route('user.user.card_add') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Card</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input id="card-holder-name" type="hidden" value="{{ auth()->user()->name }}">

                        <div id="card-element"></div>

                        <div class="mt-3 d-flex justify-content-start align-items-center">
                            <input class="form-check-input" name="default_card" type="checkbox" id="gridCheck"
                                style="margin-right: 11px">
                            <label class="form-check-label address-label" for="gridCheck">
                                Make this my default card
                            </label>
                        </div>

                        <!-- IMPORTANT: hidden input for payment method -->
                        <input type="hidden" name="payment_method" id="paymentmethod">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" style="background: var(--accent-color); color: var(--text-light) !important;"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="card-button"
                            data-secret="{{ $intent->client_secret }}">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('user.user.card_add') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input id="card-holder-name" type="hidden" value="{{ auth()->user()->name }}">

                        <div id="card-element"></div>

                        <div class="mt-3 d-flex justify-content-start align-items-center">
                            <input class="form-check-input " style="margin-right: 11px" type="checkbox" id="gridCheck">
                            <label class="form-check-label address-label" for="gridCheck">
                                Make this my default card
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" style="background: var(--accent-color); color: var(--text-light) !important;"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="card-button"
                            data-secret="{{ $intent->client_secret }}">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>

    <script src="{{ asset('assets/frontend-assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/main.js') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>

    {{-- <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (e) => {
            e.preventDefault();

            cardButton.disabled = true;

            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.value
                        }
                    }
                }
            );

            if (error) {
                toastr.error(error.message || 'Something went wrong. Try again later.');
                cardButton.disabled = false;
                return;
            }

            // success: inject payment_method and submit form
            document.getElementById('paymentmethod').value = setupIntent.payment_method;
            toastr.success('Card added');
            document.getElementById('payment-form').submit();
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addressInput = document.getElementById('address_1');
            const latitudeInput = document.getElementById('latitude');
            const longitudeInput = document.getElementById('longitude');

            const autocomplete = new google.maps.places.Autocomplete(addressInput, {
                types: ['geocode'], // or use ['address'] for more specific results
                componentRestrictions: {
                    country: "us"
                } // optional: restrict to US
            });

            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();

                if (place.geometry) {
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();

                    latitudeInput.value = lat;
                    longitudeInput.value = lng;

                    console.log('Address:', place.formatted_address);
                    console.log('Lat:', lat, 'Lng:', lng);
                }
            });

            // Prevent form submission when selecting from suggestions
            addressInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const step1 = new bootstrap.Tab(document.getElementById('step1-tab'));
            const step2 = new bootstrap.Tab(document.getElementById('step2-tab'));
            const step3 = new bootstrap.Tab(document.getElementById('step3-tab'));
            const step4 = new bootstrap.Tab(document.getElementById('step4-tab'));

            const progressBar = document.getElementById('checkoutProgressBar');
            const stepCircles = [
                document.querySelector('.step-circle.step1'),
                document.querySelector('.step-circle.step2'),
                document.querySelector('.step-circle.step3'),
                document.querySelector('.step-circle.step4')
            ];

            function updateProgress(stepIdx) {
                const percent = [25, 50, 75, 100][stepIdx];
                progressBar.style.width = percent + '%';
                progressBar.setAttribute('aria-valuenow', stepIdx + 1);
                // Mark completed steps
                stepCircles.forEach((el, idx) => {
                    if (idx < stepIdx) {
                        el.classList.add('completed');
                        el.innerHTML = '';
                    } else {
                        el.classList.remove('completed');
                        el.innerHTML = (idx + 1).toString();
                    }
                });
            }

            // Initial state
            updateProgress(0);

            document.getElementById('toStep2').addEventListener('click', function() {
                step2.show();
                updateProgress(1);
            });
            document.getElementById('backToStep1').addEventListener('click', function() {
                step1.show();
                updateProgress(0);
            });
            document.getElementById('toStep3').addEventListener('click', function() {
                step3.show();
                updateProgress(2);
            });
            document.getElementById('backToStep2').addEventListener('click', function() {
                step2.show();
                updateProgress(1);
            });
            document.getElementById('toStep4').addEventListener('click', function() {
                step4.show();
                updateProgress(3);
            });

            // Also update on nav click (if user clicks step directly)
            [step1, step2, step3, step4].forEach((tab, idx) => {
                document.getElementById('step' + (idx + 1) + '-tab').addEventListener('shown.bs.tab',
                    function() {
                        updateProgress(idx);
                    });
            });
        });
    </script>
@endsection
