@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/plugins/slick.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assetss/responsive.css') }}" />
    <link rel="stylesheet" id="bg-switcher-css" href="{{ asset('assets/frontend-assetss/css/backgrounds/bg-4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/checkout.css') }}">
@endsection
@section('content')
    <x-app.header />
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        {{-- <h2 class="ec-bg-title">Log In</h2> --}}
                        <h2 class="ec-title">Get Started with <span class="text-success">AhroMart</span> </h2>
                        <p class="sub-title mb-3">{{ __('Register as vendor') }}</p>
                        <p class="bg-primary  mx-auto text-white mt-3 py-2"  style="max-width: 622px;">Try AhroMart and Start selling for free</p>
                    </div>
                </div>
                <div class="ec-login-wrapper" style="max-width: 730px;">
                    <div class="ec-login-container" style="border: none">
                        <div class="ec-login-form">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row">
                                    <span class="ec-login-wrap col-md-6">
                                        <label for="name">First Name <span class="text-danger">*</span></label>
                                        <input id="name" type="text" placeholder="First name"
                                            class="form-control bg-light @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </span>

                                    <span class="ec-login-wrap col-md-6">
                                        <label for="l_name">Last Name <span class="text-danger">*</span></label>
                                        <input id="l_name" type="text" placeholder="{{ __('Last Name') }}"
                                            class="form-control bg-light @error('l_name') is-invalid @enderror"
                                            name="l_name" value="{{ old('l_name') }}" required autocomplete="name"
                                            autofocus>

                                        @error('l_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </span>
                                </div>
                                <div class="row">
                                    <span class="ec-login-wrap col-md-12">
                                        <label for="email">Email Address<span class="text-danger">*</span></label>
                                        <input id="email" type="email" placeholder="{{ __('Email Address') }}"
                                            class="form-control bg-light @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                            autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </span>
            
                                </div>
                                
                                <div class="row">
                                    <span class="ec-login-wrap col-md-6">
                                        <label for="password">Password <span class="text-danger">*</span></label>
                                        <input id="password" type="password" placeholder="{{ __('Password') }}"
                                            class="form-control bg-light @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </span>
                                    <span class="ec-login-wrap col-md-6">
                                        <label for="password-confirm">Confirm Password<span
                                                class="text-danger">*</span></label>
                                        <input id="password-confirm" type="password"
                                            placeholder="{{ __('Confirm Password') }}" class="form-control bg-light"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </span>
                                </div>
                                <input type="hidden" value="3" name="role_id">
                                <div class="d-flex">

                                    <input type="checkbox" required class="@error('terms') is-invalid @enderror"
                                        id="terms" style="width: 25px;" value="1" name="terms"
                                        required><a href="{{url('page/policies')}}" style="" target="_banl" class="mt-3 ms-3">I have
                                        read and agree to the <span>Terms &amp; Conditions of
                                            AhroMart</span></a><span class="checked"></span>
                                    @error('terms')
                                        <span class="invalid-feedback " role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span class="ec-login-wrap ec-login-btn">
                                    <div class="col-md-12 ">
                                        <button type="submit" class="btn btn-dark rounded rounded-4">
                                            {{ __('Register') }}
                                        </button>

                                </span>
                                
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
