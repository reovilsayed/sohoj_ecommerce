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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
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
                                $items = Cart::Content();
                            @endphp
                            @foreach ($items as $item)
                                <div class="d-flex align-items-center mb-5">
                                    <img src="{{ Storage::url($item->model->image) }}" alt="{{ $item->name }}" style="width:48px;height:48px;object-fit:cover;border-radius:6px;border:1px solid #eee;margin-right:12px;">
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold" style="font-size:1rem;">{{ $item->name }}</div>
                                        <div class="text-muted small">
                                            @if($item->options && isset($item->options['variation']))
                                                <span>Variation: {{ $item->options['variation'] }}</span>
                                            @endif
                                            <span class="ms-2">Qty: {{ $item->qty }}</span>
                                        </div>
                                    </div>
                                    <div class="fw-bold ms-2" style="white-space:nowrap;">{{ Sohoj::price($item->price * $item->qty) }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="checkout-summary-list">

                            <div class="border border-lg-1 p-1">
                                <span>Items({{ Cart::count() }}):</span>
                                <span>{{ Sohoj::price(Cart::subtotal()) }}</span>
                            </div>
                            
                            
                            <div class="border border-lg-1 p-1">
                                <span>Discount:</span>
                                <span>{{ Sohoj::price(Sohoj::discount()) }}</span>
                            </div>
                            <div class="border border-lg-1 p-1">
                                <span>Shipping:</span>
                                <span><small class="text-danger">This step need to be completed</small></span>
                            </div>
                        </div>
                        <div class="checkout-summary-total d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Order Total:</span>
                            <span class="fw-bold">{{ Sohoj::price(Sohoj::newTotal()) }}</span>
                        </div>
                    </div>
                </aside>
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0 rounded-4 p-0 overflow-hidden">
                        <div class="card-body p-0">
                            <form action="{{ route('checkout.storeBillingAndShippingInformation') }}" method="POST" id="multiStepCheckoutForm">
                                @csrf
                                <div class="tab-content p-4" id="checkoutStepsContent">
                                    <!-- Step 2: Shipping -->
                                    <div class="tab-pane fade show active" id="step2" role="tabpanel"
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

                                                <div class="col-md-6 mt-2">
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

                                                
                                                </div>


                                               

                                              
                                                <div class="col-md-6 mt-2">
                                                    <label for="country" class="form-label">Country</label>
                                                    <select class="form-control" id="country" name="country">
                                                        <option value="">Select Country</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mt-2">
                                                    <label for="state" class="form-label">State</label>
                                                    <select class="form-control" id="state" name="state">
                                                        <option value="">Select State</option>
                                                    </select>
                                                    @error('state')
                                                        <span class="text-danger small position-absolute"
                                                            style="top:100%;left:0;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                
                                              
                                                

                                                <div class="col-md-6 mt-2">
                                                    <label for="city" class="form-label">City</label>
                                                    <select class="form-control" id="city" name="city">
                                                        <option value="">Select City</option>
                                                    </select>
                                                    @error('city')
                                                        <span class="text-danger small position-absolute"
                                                            style="top:100%;left:0;">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mt-2">
                                                    <label for="post_code" class="form-label">Zip Code</label>
                                                    <input type="text" class="form-control" id="post_code"
                                                        name="post_code"
                                                        value="{{ old('post_code', Auth()->user() ? Auth()->user()->post_code : '') }}"
                                                        placeholder="Post Code">
                                                    @error('post_code')
                                                        <span class="text-danger small position-absolute"
                                                            style="top:100%;left:0;">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-5">Continue to Payment</button>
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
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

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
        document.addEventListener('DOMContentLoaded', async function() {
            const addressInput = document.getElementById('address_1');
            const latitudeInput = document.getElementById('latitude');
            const longitudeInput = document.getElementById('longitude');
            const stateCodeInput = document.getElementById('state_code');
            const countryCodeInput = document.getElementById('country_code');
            const citySelect = document.getElementById('city');
            const stateSelect = document.getElementById('state');
            const countrySelect = document.getElementById('country');

            // Initialize Choices.js for searchable selects
            const countryChoices = new Choices(countrySelect, { searchEnabled: true, shouldSort: true, itemSelectText: '' });
            const stateChoices   = new Choices(stateSelect,   { searchEnabled: true, shouldSort: true, itemSelectText: '' });
            const cityChoices    = new Choices(citySelect,    { searchEnabled: true, shouldSort: true, itemSelectText: '' });
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
                const locality = getComponent(components, 'locality', 'long_name')
                    || getComponent(components, 'postal_town', 'long_name')
                    || getComponent(components, 'sublocality_level_1', 'long_name');
                const adminAreaLong = getComponent(components, 'administrative_area_level_1', 'long_name');
                const adminAreaShort = getComponent(components, 'administrative_area_level_1', 'short_name');
                const postalCode = getComponent(components, 'postal_code', 'short_name');
                const countryShort = getComponent(components, 'country', 'short_name');

                const addressLine = [streetNumber, route].filter(Boolean).join(' ');

                if (addressLine) addressInput.value = addressLine;
                if (citySelect) setSelected(citySelect, locality);
                if (stateSelect) setSelected(stateSelect, adminAreaLong || adminAreaShort);
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

            // Helpers
            function clearOptions(selectEl, placeholder = 'Select') {
                const instance = selectEl === countrySelect ? countryChoices : selectEl === stateSelect ? stateChoices : cityChoices;
                instance.clearStore();
                instance.setChoices([{ value: '', label: placeholder, selected: true }], 'value', 'label', true);
            }

            function setSelected(selectEl, label) {
                const instance = selectEl === countrySelect ? countryChoices : selectEl === stateSelect ? stateChoices : cityChoices;
                const found = instance._store.choices.find(c => c.label === label);
                if (found) instance.setChoiceByValue(found.value);
            }

            async function fetchJson(url) {
                const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
                if (!res.ok) throw new Error('Network error');
                return res.json();
            }

            function populateSelect(selectEl, data, placeholder) {
                const instance = selectEl === countrySelect ? countryChoices : selectEl === stateSelect ? stateChoices : cityChoices;
                const choices = [{ value: '', label: placeholder, selected: true }];
                for (const [id, name] of Object.entries(data)) {
                    choices.push({ value: id, label: name });
                }
                instance.setChoices(choices, 'value', 'label', true);
            }

            // Load countries
            try {
                const countries = await fetchJson('/api/geo/countries');
                populateSelect(countrySelect, countries, 'Select Country');
            } catch (e) { /* ignore */ }

            // On country change -> load states
            countrySelect.addEventListener('change', async function() {
                const countryId = this.value;
                clearOptions(stateSelect, 'Select State');
                clearOptions(citySelect, 'Select City');
                if (!countryId) return;
                try {
                    const states = await fetchJson('/api/geo/states/' + encodeURIComponent(countryId));
                    populateSelect(stateSelect, states, 'Select State');
                } catch (e) { /* ignore */ }
            });

            // On state change -> load cities
            stateSelect.addEventListener('change', async function() {
                const stateId = this.value;
                const countryId = countrySelect.value;
                clearOptions(citySelect, 'Select City');
                if (!countryId || !stateId) return;
                try {
                    const cities = await fetchJson('/api/geo/cities/' + encodeURIComponent(countryId) + '/' + encodeURIComponent(stateId));
                    populateSelect(citySelect, cities, 'Select City');
                } catch (e) { /* ignore */ }
            });
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
