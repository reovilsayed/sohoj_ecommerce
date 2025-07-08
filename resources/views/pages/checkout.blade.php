@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/style.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/plugins/slick.min.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/frontend-assetss/responsive.css') }}" />
    <link rel="stylesheet" id="bg-switcher-css" href="{{ asset('assets/frontend-assetss/css/backgrounds/bg-4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/checkout.css') }}">

    <style>
        :root {
            --primary-color: #4a6bff;
            --primary-hover: #3a56d4;
            --secondary-color: #f8f9fa;
            --text-color: #333;
            --light-text: #6c757d;
            --border-color: #e0e0e0;
            --error-color: #dc3545;
            --success-color: #28a745;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --border-radius: 8px;
            --transition: all 0.3s ease;
        }

        .shipping-info {
            display: flex;
            gap: 0.75rem;
            font-size: 14px;
            color: var(--light-text);
            padding: 0.75rem;
            background-color: rgba(74, 107, 255, 0.05);
            border-radius: var(--border-radius);
        }

        .ec-page-content {
            background: whitesmoke;
        }

        .cart-container {
            margin: 0 auto;
            /* background-color: white; */
            border-radius: 8px;
            padding: 25px;
        }

        .products-table {
            background-color: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        /* Main Table Styling */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-family: Arial, sans-serif;
        }

        /* Table Header */
        .table thead th {
            padding: 1rem 1.5rem;
            text-align: left;
            background-color: white;
            border-bottom: 2px solid #dee2e6;
            font-weight: bold;
            color: #333;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        /* Product Image */
        .product-image {
            border-radius: 4px;
            margin-right: 15px;
        }

        .remove-item i {
            margin-right: 5px;
            font-size: 12px;
        }

        /* Price Styling */
        .price {
            font-weight: 500;
            color: #333;
        }

        /* Hover Effects */
        .table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .remove-item {
            color: var(--light-text);
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }

        .remove-item:hover {
            color: var(--error-color);
            background-color: rgba(220, 53, 69, 0.1);
        }
    </style>
@endsection
@section('content')
    <x-app.header />
    @php
        $items = Cart::Content();

        $groupedItems = $items->groupBy(function ($item) {
            return $item->model->shop_id;
        });
    @endphp
    <!-- Ec checkout page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cart-container">
                        <h2 class="text-center mb-4 fw-bold">Checkout</h2>
                    </div>
                </div>
            </div>
            <form class="" action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="row justify-content-between">
                    <div class="col-md-12" style="background: white; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);">
                        <h3 class="my-4 fw-bold">Order <span class="text-success">Items</span></h3>
                    </div>
                    <div class="col-lg-8 col-md-12 pe-md-0 products-table">
                        @if (Cart::count() > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product Details</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Shipping cost</th>
                                        <th>Total</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td class="border-0">
                                                {{-- <img src="https://images.pexels.com/photos/3612182/pexels-photo-3612182.jpeg?auto=compress&cs=tinysrgb&w=600"
                                                    alt="File 19" class="product-image"
                                                    style="width: 100px; height: 100px; object-fit: cover;"> --}}
                                                <img src="{{ Storage::url($item->model->image) }}" alt="File 19"
                                                        class="product-image"
                                                        style="width: 100px; height: 100px; object-fit: cover;">
                                            </td>

                                            <td class="border-0">
                                                <div class="item-actions">
                                                    {{-- <form action="{{ route('cart.update') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="rowId"
                                                                value="{{ $item->rowId }}">
                                                            <div class="quantity-selector">
                                                                <button type="submit" name="action" value="decrease"
                                                                    class="qty-btn">−</button>
                                                                <span class="qty-value">{{ $item->qty }}</span>
                                                                <button type="submit" name="action" value="increase"
                                                                    class="qty-btn">+</button>
                                                            </div>
                                                        </form> --}}
                                                    <span class="badge bg-light text-black">{{ $item->qty }}</span>

                                                </div>
                                            </td>
                                            @php
                                                $shippingCost = $item->model->shipping_cost ?? 0;
                                                $totalPrice = $item->price * $item->qty + $shippingCost;
                                            @endphp
                                            <td class="price border-0">{{ Sohoj::price($item->price) }}</td>
                                            <td class="price border-0">{{ Sohoj::price($item->model->shipping_cost) }}</td>
                                            <td class="price border-0">{{ Sohoj::price($totalPrice) }}</td>
                                            <td class="text-center border-0">
                                                <a href="{{ route('cart.destroy', $item->rowId) }}" class="remove-item"
                                                    title="Remove item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" viewBox="0 0 16 16">
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
                        @endif
                    </div>

                    <div class="ec-checkout-rightside  col-lg-4 col-md-12 ps-md-0" style="background: powderblue;">
                        <div class="px-3 py-4">
                            <!-- Sidebar Summary Block -->
                            <div class="ec-sidebar-block mb-4">
                                <div class="ec-sb-title">
                                    <h3 class="fs-4 fw-bold text-center">Order Summary</h3>
                                </div>
                                <div class="ec-sb-block-content">
                                    <div class="ec-checkout-summary">
                                        @php
                                            $prices = (float) Cart::SubTotal();
                                            $shipping = (float) Sohoj::shipping();
                                            $flatCharge = (float) Sohoj::flatCommision($prices);
                                            $discount = (float) Sohoj::discount();

                                            $total = $prices + $shipping + $flatCharge - $discount;
                                        @endphp
                                        <div>
                                            <span class="text-left fw-bolder">Items({{ Cart::count() }}):</span>
                                            <span class="text-right fw-bold">{{ Sohoj::price($prices) }}</span>
                                        </div>
                                        <div>
                                            <span class="text-left fw-bolder">Platform fee:</span>
                                            <span class="text-right fw-bold">{{ Sohoj::price($flatCharge) }}</span>
                                        </div>
                                        <div>
                                            <span class="text-left fw-bolder">Shipping:</span>
                                            <span class="text-right fw-bold">{{ Sohoj::price($shipping) }}</span>
                                        </div>
                                        @if (session()->has('discount'))
                                            <div>
                                                <span class="text-left fw-bolder">Discount:</span>
                                                <span
                                                    class="text-right fw-bold">{{ Sohoj::price(Sohoj::discount()) }}</span>
                                            </div>
                                        @endif


                                        <div class="ec-checkout-summary-total">
                                            <span class="text-left order-title fw-bolder"
                                                style="font-size: 20px !important;">Order
                                                Total:</span>
                                            <span class="text-right fw-bold">
                                                {{ Sohoj::price($total) }}
                                            </span>
                                        </div>
                                        <div class="d-flex">

                                            <input type="checkbox" required class="@error('terms') is-invalid @enderror"
                                                id="terms" style="width: 25px;" value="1" name="terms"
                                                required><a href="{{ url('page/policies') }}" style="" target="_banl"
                                                class="mt-3 ms-3">I have
                                                read and agree to the <span>Terms &amp; Conditions of
                                                    AhroMart</span></a><span class="checked"></span>
                                            @error('terms')
                                                <span class="invalid-feedback " role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 justify-content-center" style="margin-top: 17px; ">
                                            <button class="btn shadow w-100" style="background: antiquewhite;"
                                                type="submit">Place
                                                Order</button>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="shipping-info">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z">
                                    </path>
                                </svg>
                                <p>You can track your shipment and view any applicable import fees deposit before
                                    placing your order. <a href="#" target="_blank">Learn more</a></p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row mt-5" style="background: white">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between">
                            <h3 class="my-4 fw-bold">Personal <span class="text-success">info</span></h3>

                            <div class="d-flex justify-content-center align-items-center">
                                <a href="javascript::void(0);"
                                    class="text-decoration-none py-2 px-3 bg-success text-light" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Add Address
                                </a>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="shop_id" value="">
                    <div class="col-md-3 cols-12">
                        <input type="text" class="form-control mb-2 @error('first_name') is-invalid @enderror"
                            value="{{ Auth()->user() ? Auth()->user()->name : '' }}" name="first_name"
                            placeholder="First Name" id="inputEmail4">
                        @error('first_name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-3 cols-12">
                        <input type="text" placeholder="Last Name"
                            value="{{ Auth()->user() ? Auth()->user()->l_name : old('last_name') }}" name="last_name"
                            class="form-control mb-2 @error('last_name') is-invalid @enderror" id="inputPassword4">
                        @error('last_name')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 cols-12">
                        <input type="email" class="form-control mb-2 @error('email') is-invalid @enderror"
                            value="{{ Auth()->user() ? Auth()->user()->email : '' }}" name="email" id="inputAddress"
                            placeholder="Email">
                        @error('email')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>



                    @if (Auth()->user()->addresses->count() == !0)
                        @foreach (Auth()->user()->addresses as $address)
                            <div class="col-md-4 my-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="form-check d-flex align-items-center">
                                                <input class="form-check-input " style="margin-right: 11px"
                                                    value="{{ $address->id }}" name="prevoius_address" type="checkbox"
                                                    id="gridCheck">
                                                <label class="form-check-label address-label" for="gridCheck">
                                                    {{ $address->post_code }}
                                                    {{ $address->state }}
                                                    <br>{{ $address->city }} ,
                                                    {{ $address->address_1 }}
                                                    {{ $address->address_2 }}
                                                </label>
                                            </div>
                                            <div class="d-flex justify-content-end align-items-center">
                                                <a href="{{ route('user.address-edit', $address->id) }}"
                                                    class="text-success border-right border-3 border-dark pe-2"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="{{ route('user.address.destroy', $address) }}"
                                                    onclick="return confirm('Are you sure you want to delete this Address?');"
                                                    class="remove-item">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                        <path fill-rule="evenodd"
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @error('prevoius_address')
                        <div class="col-md-12">
                            <div class="alert alert-primary" role="alert">
                                <p class="text-danger">{{ $message }}</p>
                            </div>
                        </div>
                    @enderror
                </div>


                <div class="row mt-5" style="background: white">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between">
                            <h3 class="my-4 fw-bold">Enter a <span class="text-success">payment</span> info</h3>

                            <div class="d-flex justify-content-center align-items-center">
                                <a href="javascript::void(0);"
                                    class="text-decoration-none py-2 px-3 bg-success text-light" data-bs-toggle="modal"
                                    data-bs-target="#paymentModal">
                                    Add a new card ?
                                </a>
                            </div>
                        </div>
                    </div>
                    @php
                        $methods = auth()->user()->paymentMethods();
                    @endphp
                    @foreach ($methods as $payment)
                        @if ($methods->count() > 1)
                            <div class="col-md-4 my-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-check d-flex justify-content-between align-items-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <input class="form-check-input " style="margin-right: 11px;"
                                                    type="radio" id="payment" name="payment_method[]"
                                                    value="{{ $payment->id }}">
                                                <div class="">
                                                    <img src="{{ asset('assets/img/visa.jpeg') }}" class="pay-img"
                                                        alt="">
                                                    <label class="form-check-label address-label" for="payment">
                                                        &nbsp;{{ ucwords($payment->card->brand) }} XXXX
                                                        XXXX
                                                        XXXX
                                                        {{ $payment->card->last4 }}
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="">
                                                <a href="{{ route('user.removeCard', ['method' => $payment->id]) }}"
                                                    class="text-danger btn" style="float:right">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" viewBox="0 0 16 16">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                        <path fill-rule="evenodd"
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-md-4 my-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input " style="margin-right: 11px;" type="checkbox"
                                                id="payment" name="payment_method[]" value="{{ $payment->id }}">
                                            <img src="{{ asset('assets/img/visa.jpeg') }}" class="pay-img"
                                                alt="">
                                            <label class="form-check-label address-label" for="payment">
                                                &nbsp;{{ ucwords($payment->card->brand) }} XXXX
                                                XXXX
                                                XXXX
                                                {{ $payment->card->last4 }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <input class=" " type="radio" style="display:none" id="paymentmethod"
                        name="payment_method[]" value="">
                </div>
            </form>
        </div>
    </section>

    <!-- checkout content Start -->
    {{-- <div class="">

        <div class="shipping_add" style="margin-top: 48px">
            <h3 style="font-size: 25px;">Enter a payment info</h3>
        </div>
        <div class="shipping_add_old" style="margin-top: 20px">
            <p style="font-size: 16px;">Select from a previous card</p>

        </div>


        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button h5 text-dark" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Add a new card ?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <input id="card-holder-name" type="hidden" value="{{ auth()->user()->name }}">

                        <!-- Stripe Elements Placeholder -->
                        <div id="card-element"></div>
                        <div class="">


                            <input id="card-holder-name" type="hidden" value="{{ auth()->user()->name }}">

                            <!-- Stripe Elements Placeholder -->
                            <div id="card-element"></div>
                            <div class="row">
                                <div class="col-12 " style="margin-top: 12px">
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input " style="margin-right: 11px" type="checkbox"
                                            id="gridCheck">
                                        <label class="form-check-label address-label" for="gridCheck">
                                            Make this my default card

                                        </label>

                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: 15px; ">
                                    <button class="btn  btn-dark btn-lg rounded shadow" style="border-radius: 10px"
                                        type="button" id="card-button" data-secret="{{ $intent->client_secret }}">Use
                                        this
                                        Card</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="card-button"
                            data-secret="{{ $intent->client_secret }}">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/frontend-assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/main.js') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>

    <script>
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
    </script>
@endsection
