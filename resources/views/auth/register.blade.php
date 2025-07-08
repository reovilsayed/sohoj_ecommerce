@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/style.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/plugins/slick.min.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/frontend-assetss/responsive.css') }}" />
    <link rel="stylesheet" id="bg-switcher-css" href="{{ asset('assets/frontend-assetss/css/backgrounds/bg-4.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/checkout.css') }}"> --}}
    <style>
        .sohoj-brand {
            background-color: #373737;
            color: white;
            border-radius: 25px;
            padding: 10px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            background-image: linear-gradient(to right, #373737, #505050);
            display: inline-block;
        }
    </style>
@endsection
@section('content')
    <x-app.header />
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center mb-4">
                    <div class="section-title">
                        <h1 class="ec-title">Get Started with <span class="sohoj-brand"
                                style="
        background-color: #373737; 
        color: white; 
        border-radius: 25px; 
        padding: 10px 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        background-image: linear-gradient(to right, #373737, #505050);
        display: inline-block;
    ">Sohoj
                                Ecommerce</span></h1>

                        <p class="sub-title mb-3">{{ __('Create your free account') }}</p>
                        <div class="alert alert-primary mx-auto" role="alert" style="max-width: 622px;">
                            Join SohjojEcommerce and start shopping or selling easily.
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-xl-6">
                    <div class="card shadow-sm">
                        <div class="card-body p-4 p-md-5">
                            <form method="POST" action="{{ route('register') }}" novalidate>
                                @csrf

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">First Name <span
                                                class="text-danger">*</span></label>
                                        <input id="name" type="text" placeholder="First name"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="given-name" autofocus>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="l_name" class="form-label">Last Name <span
                                                class="text-danger">*</span></label>
                                        <input id="l_name" type="text" placeholder="Last name"
                                            class="form-control @error('l_name') is-invalid @enderror" name="l_name"
                                            value="{{ old('l_name') }}" required autocomplete="family-name">
                                        @error('l_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address <span
                                            class="text-danger">*</span></label>
                                    <input id="email" type="email" placeholder="Email Address"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Password <span
                                                class="text-danger">*</span></label>
                                        <input id="password" type="password" placeholder="Password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password" minlength="8">
                                        <div class="form-text">Minimum 8 characters</div>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password-confirm" class="form-label">Confirm Password <span
                                                class="text-danger">*</span></label>
                                        <input id="password-confirm" type="password" placeholder="Confirm Password"
                                            class="form-control" name="password_confirmation" required
                                            autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="d-grid gap-3">
                                    <button type="submit" class="btn btn-dark btn-lg rounded-4"
                                        style="background-color: #373737; color: white; border: none;
                                               box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                                               transition: all 0.3s ease;
                                               background-image: linear-gradient(to right, #373737, #505050);">
                                        {{ __('Register') }}
                                    </button>

                                    <div class="text-center mt-2">
                                        <p class="mb-0">Already have an account?
                                            <a class="fw-semibold" style="color: red;" href="{{ route('login') }}">Login
                                                here</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('assets/frontend-assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>

    <script src="{{ asset('assets/frontend-assets/js/main.js') }}"></script>
@endsection
