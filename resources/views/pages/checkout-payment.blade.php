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
    <meta property="og:image" content="{{ Settings::setting('site_logo') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
@endsection
@section('meta_twitter')
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Checkout | Afrikartt E-commerce">
    <meta name="twitter:description"
        content="Complete your purchase securely on Afrikartt E-commerce. Fast, safe checkout with multiple payment options and order tracking.">
    <meta name="twitter:image" content="{{ Settings::setting('site_logo') }}">
@endsection
@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assetss/responsive.css') }}" />
    <style>
        /* Import centralized color system */
        @import url('{{ asset('assets/css/colors.css') }}');


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

        .payment-card-option input[type="radio"]:checked+.custom-radio-indicator {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px var(--shadow-primary);
        }

        .payment-card-option input[type="radio"]:checked+.custom-radio-indicator::after {
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

        .payment-card-option input[type="radio"]:checked~.payment-card-content {
            /* Highlight the card background and border */
            background: var(--bg-light);
            border-radius: 10px;
            box-shadow: 0 4px 18px var(--shadow-primary);
            /* Optional: scale up a bit */
            transform: scale(1.02);
        }

        .payment-card-option input[type="radio"]:checked~.payment-card-content .payment-title {
            color: var(--accent-color);
        }

        /* Optional: checkmark in the top-right corner of the selected card */
        .payment-card-option input[type="radio"]:checked~.payment-card-content::after {
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
            color: #000;
            margin-top: 2px;
            font-weight: 400;
            line-height: 1.3;
        }
    </style>
@endsection

@section('content')
    @php
        $prices = Cart::subtotalFloat();
        $shipping = Sohoj::shipping();
        $flatCharge = Sohoj::flatCommision($prices);
        $discount = Sohoj::discount();
        $tax = Sohoj::tax();

        $total = $prices + $shipping + $flatCharge - $discount + $tax;
    @endphp
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
                    <span class="badge bg-light text-primary me-2">Shipping</span>
                    <span class="badge bg-light text-primary">Payment</span>
                </div>
            </div>
            <!-- Multi-Step Checkout -->
            <div class="row g-4 flex-lg-row-reverse">
                <aside class="col-lg-4 d-none d-lg-block">
                    <div class="checkout-summary sticky-top" style="top: 32px; z-index: 2;">
                        <div class="checkout-summary-title">Order Summary</div>
                        <div class="checkout-summary-content">
                            @php
                                $items = $order->products;
                            @endphp
                            @foreach ($items as $item)
                            
                                <div class="d-flex align-items-center mb-5">
                                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}"
                                        style="width:48px;height:48px;object-fit:cover;border-radius:6px;border:1px solid #eee;margin-right:12px;">
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold" style="font-size:1rem;">{{ $item->name }}</div>
                                        <div class="text-muted small">
                                            @if ($item->pivot->variation)
                                                <span>Variation: {{ json_decode($item->pivot->variation)->sku }}</span>
                                            @endif
                                            
                                            <span class="ms-2">Qty: {{ $item->pivot->quantity }}</span>
                                        </div>
                                    </div>
                                    <div class="fw-bold ms-2" style="white-space:nowrap;">
                                        {{ Sohoj::price($item->pivot->total_price) }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="checkout-summary-list">

                            <div class="border border-lg-1 p-1">
                                <span>Items({{ $items->sum('pivot.quantity') }}):</span>
                                <span id="summaryItems">{{ Sohoj::price($items->sum('pivot.total_price')) }}</span>
                            </div>


                            <div class="border border-lg-1 p-1">
                                <span>Discount:</span>
                                <span id="summaryDiscount">{{ Sohoj::price($order->discount) }}</span>
                            </div>
                            <div class="border border-lg-1 p-1">
                                <span>Shipping:</span>
                                <span id="summaryShipping"><small class="text-danger">This step need to be completed</small></span>
                            </div>
                        </div>
                        <div class="checkout-summary-total d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Order Total:</span>
                            <span class="fw-bold" id="summaryTotal">{{ Sohoj::price($order->total) }}</span>
                        </div>
                    </div>
                </aside>
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-4 p-0 overflow-hidden">
                        <div class="card-body p-0">
                            <form action="{{ route('checkout.confirmOrder', $order->id) }}" method="POST"
                                id="multiStepCheckoutForm">
 
                                @php
                                     $services = [
                                        '01' => 'Next Day Air',
                                        '02' => '2nd Day Air',
                                        '03' => 'Ground',
                                        '08' => 'UPS Worldwide Expedited',
                                        '12' => '3 Day Select',
                                        '13' => 'Next Day Air Saver',
                                        '14' => 'Next Day Air Early A.M.',
                                        '15' => 'UPS Express',
                                        '22' => 'UPS Standard',
                                        '32' => 'UPS Express Plus',
                                        '33' => 'UPS Express',
                                        '41' => 'UPS Express Early',
                                        '42' => 'UPS Express',
                                        '44' => 'UPS Express Plus',
                                        '54' => 'UPS Express 12:00',
                                        '59' => '2nd Day Air A.M.',
                                        '65' => 'UPS Saver',
                                        '66' => 'UPS Worldwide Express Freight',
                                        '70' => 'UPS Access Point Economy',
                                        '71' => 'UPS Worldwide Express Freight Midday',
                                        '74' => 'UPS Express 12:00',
                                        '82' => 'UPS Today Standard',
                                        '83' => 'UPS Today Dedicated Courier',
                                        '84' => 'UPS Today Intercity',
                                        '85' => 'UPS Today Express',
                                        '86' => 'UPS Today Express Saver',
                                        '96' => 'UPS Worldwide Express Freight',
                                    ];
                                @endphp
                                @csrf
                                <div class="tab-content p-4" id="checkoutStepsContent">
                                    <!-- Step 2: Shipping -->
                                    <div class="tab-pane fade show active" id="step2" role="tabpanel"
                                        aria-labelledby="step2-tab">
                                        <h4 class="fw-semibold mb-3">Select Shipping Rate</h4>
                                        @php
                                            $ratedShipments = data_get($rates, 'RateResponse.RatedShipment', []);
                          
                                            if (isset($ratedShipments['Service'])) {
                                                $ratedShipments = [$ratedShipments];
                                            }
                                        @endphp
                                        <div class="mt-3">
                                            @if (!empty($ratedShipments))
                                                <div class="checkout-card p-3"
                                                    style="background: var(--bg-light); border: 1px solid var(--border-light);">
                                                    <input type="hidden" name="selected_shipping_service"
                                                        id="selected_shipping_service">
                                                    <input type="hidden" name="selected_shipping_amount"
                                                        id="selected_shipping_amount">
                                                    <div class="d-flex flex-column gap-2">
                                                        @foreach ($ratedShipments as $idx => $shipment)
                                                            @php
                                                                $serviceCode = data_get($shipment, 'Service.Code');
                                                                $serviceDesc =
                                                                    data_get($shipment, 'Service.Description') ??
                                                                    'UPS Service ' . $serviceCode;

                                                                $currency =
                                                                    data_get(
                                                                        $shipment,
                                                                        'NegotiatedRateCharges.TotalCharge.CurrencyCode',
                                                                    ) ??
                                                                    (data_get($shipment, 'TotalCharges.CurrencyCode') ??
                                                                        'USD');
                                                                $displayCurrency = $currency === 'USD' ? '$' : $currency;
                                                                $amount =
                                                                    data_get(
                                                                        $shipment,
                                                                        'NegotiatedRateCharges.TotalCharge.MonetaryValue',
                                                                    ) ??
                                                                    data_get($shipment, 'TotalCharges.MonetaryValue');

                                                                    if($order->total > 100){
                                                                       $amount = 0;
                                                                    }
                                                                $days = data_get(
                                                                    $shipment,
                                                                    'GuaranteedDelivery.BusinessDaysInTransit',
                                                                );
                                                                $byTime = data_get(
                                                                    $shipment,
                                                                    'GuaranteedDelivery.DeliveryByTime',
                                                                );
                                                            @endphp
                                                            <label class="payment-card-option"
                                                                style="align-items: flex-start;">
                                                                <input type="radio" name="shipping_rate"
                                                                    class="form-check-input" value="{{ $serviceCode }}"
                                                                    @checked($idx === 0) required>
                                                                <span class="custom-radio-indicator"></span>
                                                                <span class="payment-card-content">
                                                                    <span class="payment-text-wrap">
                                                                        <span class="payment-title">{{ $services[$serviceCode] }}
                                                                            ({{ $serviceCode }})</span>
                                                                        <span class="payment-desc">
                                                                            @if ($days)
                                                                                Est. {{ $days }} business
                                                                                day{{ $days > 1 ? 's' : '' }}
                                                                            @elseif ($byTime)
                                                                                By {{ $byTime }}
                                                                            @else
                                                                                Estimated delivery not available
                                                                            @endif
                                                                        </span>
                                                                    </span>
                                                                    <span class="ms-auto fw-bold">{{ $displayCurrency }}
                                                                        {{ number_format((float) $amount, 2) }}</span>
                                                                </span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                    <small class="text-muted">Shipping carrier: UPS</small>
                                                </div>
                                            @else
                                                <div class="alert alert-warning">No shipping rates available. Please go back
                                                    and verify your address.</div>
                                            @endif
                                        </div>

                                        <h4 class="fw-semibold mb-4 mt-4">Select Payment Method</h4>
                                        <div class="mt-2">
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
                                                        <span class="payment-title">Card Payment</span>
                                                        <span class="payment-desc">Pay with any major credit or
                                                            debit card.</span>
                                                    </span>
                                                </span>
                                            </label>
                                            <div class="mt-4 mb-3 d-flex align-items-center px-3 py-2 rounded-3 shadow-sm"
                                                style="background: var(--bg-light); border: 1px solid var(--border-light);">
                                                <input type="checkbox" required
                                                    class="form-check-input me-2 @error('terms') is-invalid @enderror"
                                                    id="terms" value="1" name="terms"
                                                    style="width: 22px; height: 22px; accent-color: var(--accent-color);">
                                                <label class="form-check-label ms-1" for="terms"
                                                    style="font-size: 1rem;">
                                                    I have read and agree to the
                                                    <a href="{{ url('page/policies') }}" target="_blank"
                                                        class="text-decoration-underline text-primary fw-semibold">
                                                        Terms & Conditions
                                                    </a>
                                                    of Afrikartt E-commerce
                                                </label>
                                                @error('terms')
                                                    <span class="invalid-feedback d-block ms-2">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <button type="submit" class="btn checkout-btn w-auto mt-3 shadow-sm"
                                                style="font-size: 1.1rem;">
                                                <i class="fas fa-shopping-cart me-2"></i> Place Order
                                            </button>
                                        </div>

                                    </div>
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
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
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

    <script>
        const stripe = Stripe("{{ Settings::setting('stripe_key') }}");
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
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addressInput = document.getElementById('address_1');
            const latitudeInput = document.getElementById('latitude');
            const longitudeInput = document.getElementById('longitude');
            const stateCodeInput = document.getElementById('state_code');
            const countryCodeInput = document.getElementById('country_code');
            const cityInput = document.getElementById('city');
            const stateInput = document.getElementById('state');
            const postalCodeInput = document.getElementById('post_code');

            const autocomplete = new google.maps.places.Autocomplete(addressInput, {
                types: ['geocode'],
            });

            function getComponent(components, type, nameType = 'short_name') {
                const comp = components.find(c => c.types.includes(type));
                return comp ? comp[nameType] : '';
            }

            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                if (!place || !place.address_components) {
                    return;
                }

                const components = place.address_components;

                const streetNumber = getComponent(components, 'street_number', 'short_name');
                const route = getComponent(components, 'route', 'long_name');
                const locality = getComponent(components, 'locality', 'long_name') ||
                    getComponent(components, 'postal_town', 'long_name') ||
                    getComponent(components, 'sublocality_level_1', 'long_name');
                const adminAreaLong = getComponent(components, 'administrative_area_level_1', 'long_name');
                const adminAreaShort = getComponent(components, 'administrative_area_level_1',
                    'short_name');
                const postalCode = getComponent(components, 'postal_code', 'short_name');
                const countryShort = getComponent(components, 'country', 'short_name');

                const addressLine = [streetNumber, route].filter(Boolean).join(' ');

                if (addressLine) addressInput.value = addressLine;
                if (cityInput) cityInput.value = locality;
                if (stateInput) stateInput.value = adminAreaLong || adminAreaShort;
                if (postalCodeInput) postalCodeInput.value = postalCode;
                if (stateCodeInput) stateCodeInput.value = adminAreaShort;
                if (countryCodeInput) countryCodeInput.value = countryShort;

                if (place.geometry) {
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();
                    latitudeInput.value = lat;
                    longitudeInput.value = lng;
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
            const serviceInput = document.getElementById('selected_shipping_service');
            const amountInput = document.getElementById('selected_shipping_amount');
            const radios = document.querySelectorAll('input[name="shipping_rate"]');
            const summaryShipping = document.getElementById('summaryShipping');
            const summaryTotal = document.getElementById('summaryTotal');
            const summaryItems = document.getElementById('summaryItems');
            const summaryDiscount = document.getElementById('summaryDiscount');

            function parseMoney(text){
                return Number((text || '').toString().replace(/[^0-9.]/g, '')) || 0;
            }

            const itemsAmount = parseMoney(summaryItems ? summaryItems.textContent : '0');
            const discountAmount = parseMoney(summaryDiscount ? summaryDiscount.textContent : '0');

            function extractAmount(labelEl) {
                const priceEl = labelEl.querySelector('.payment-card-content .fw-bold');
                if (!priceEl) return '';
                const text = priceEl.textContent.trim();
                const match = text.match(/([0-9]+(?:\.[0-9]{1,2})?)/);
                return match ? match[1] : '';
            }

            function extractCurrency(labelEl){
                const priceEl = labelEl.querySelector('.payment-card-content .fw-bold');
                if(!priceEl) return '';
                const text = priceEl.textContent.trim();
                // take non-digit prefix trimmed
                let cur = text.replace(/\s*[0-9].*$/, '').trim();
                if(cur === 'USD') cur = '$';
                return cur || '';F
            }

            function updateHidden() {
                const checked = document.querySelector('input[name="shipping_rate"]:checked');
                if (!checked) return;
                const label = checked.closest('label.payment-card-option');
                if (serviceInput) serviceInput.value = checked.value;
                if (amountInput) amountInput.value = extractAmount(label);

                const currency = extractCurrency(label);
                const shippingAmount = Number(amountInput.value || 0);
                if(summaryShipping){
                    summaryShipping.textContent = (currency ? (currency + ' ') : '') + shippingAmount.toFixed(2);
                }
                if(summaryTotal){
                    const newTotal = itemsAmount - discountAmount + shippingAmount;
                    summaryTotal.textContent = (currency ? (currency + ' ') : '') + newTotal.toFixed(2);
                }
            }

            if (radios.length) {
                radios.forEach(r => r.addEventListener('change', updateHidden));
                updateHidden();
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const step2 = new bootstrap.Tab(document.getElementById('step2-tab'));
            const step3 = new bootstrap.Tab(document.getElementById('step3-tab'));

            const progressBar = document.getElementById('checkoutProgressBar');
            const stepCircles = [
                document.querySelector('.step-circle.step2'),
                document.querySelector('.step-circle.step3')
            ];

            function updateProgress(stepIdx) {
                const percent = [50, 100][stepIdx];
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

            document.getElementById('toStep3').addEventListener('click', function() {
                step3.show();
                updateProgress(1);
            });
            document.getElementById('backToStep2').addEventListener('click', function() {
                step2.show();
                updateProgress(0);
            });

            // Also update on nav click (if user clicks step directly)
            [step2, step3].forEach((tab, idx) => {
                document.getElementById('step' + (idx + 2) + '-tab').addEventListener('shown.bs.tab',
                    function() {
                        updateProgress(idx);
                    });
            });
        });
    </script>
@endsection
