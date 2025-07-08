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
    <section class="ec-page-content section-space-p" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                        <!-- Dark Gray Header -->
                        <div class="py-4 text-center" style="background-color: #373737;">
                            <h2 class="text-white mb-1">Start Selling on <strong>SohjojEcommerce</strong></h2>
                            <p class="text-white-50 mb-0">Join our marketplace and grow your business</p>
                        </div>

                        <div class="card-body p-5">
                            <!-- Promo Banner -->
                            <div class="alert mb-4" style="background-color: #f0f0f0; border-left: 4px solid #373737;">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-gift fs-4 me-3" style="color: #373737;"></i>
                                    <div>
                                        <strong style="color: #373737;">Try SohjojEcommerce Pro for Free!</strong>
                                        <div class="small text-muted">Start selling with zero setup fees</div>
                                    </div>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('vendor.register.store') }}">
                                @csrf

                                <!-- Name Section -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label" style="color: #373737;">First Name <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"
                                                style="background-color: #f0f0f0; color: #373737;"><i
                                                    class="fas fa-user"></i></span>
                                            <input id="name" type="text" placeholder="First name"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus
                                                style="border-color: #ddd;">
                                        </div>
                                        @error('name')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="l_name" class="form-label" style="color: #373737;">Last Name <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"
                                                style="background-color: #f0f0f0; color: #373737;"><i
                                                    class="fas fa-user"></i></span>
                                            <input id="l_name" type="text" placeholder="Last Name"
                                                class="form-control @error('l_name') is-invalid @enderror" name="l_name"
                                                value="{{ old('l_name') }}" required autocomplete="name"
                                                style="border-color: #ddd;">
                                        </div>
                                        @error('l_name')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email Section -->
                                <div class="mb-4">
                                    <label for="email" class="form-label" style="color: #373737;">Email Address <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background-color: #f0f0f0; color: #373737;"><i
                                                class="fas fa-envelope"></i></span>
                                        <input id="email" type="email" placeholder="your@email.com"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email"
                                            style="border-color: #ddd;">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Password Section -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <label for="password" class="form-label" style="color: #373737;">Password <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"
                                                style="background-color: #f0f0f0; color: #373737;"><i
                                                    class="fas fa-lock"></i></span>
                                            <input id="password" type="password" placeholder="Create password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password"
                                                style="border-color: #ddd;">
                                            <button class="btn btn-outline-secondary toggle-password" type="button"
                                                style="border-color: #ddd; color: #373737;">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="form-text text-muted">Minimum 8 characters</div>
                                        @error('password')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password-confirm" class="form-label" style="color: #373737;">Confirm
                                            Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text"
                                                style="background-color: #f0f0f0; color: #373737;"><i
                                                    class="fas fa-lock"></i></span>
                                            <input id="password-confirm" type="password" placeholder="Confirm password"
                                                class="form-control" name="password_confirmation" required
                                                autocomplete="new-password" style="border-color: #ddd;">
                                            <button class="btn btn-outline-secondary toggle-password" type="button"
                                                style="border-color: #ddd; color: #373737;">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Terms Checkbox -->
                                <div class="form-check mb-4">
                                    <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox"
                                        id="terms" name="terms" required style="border-color: #373737;">
                                    <label class="form-check-label ms-2" for="terms" style="color: #373737;">
                                        I agree to the <a href="{{ url('page/policies') }}" target="_blank"
                                            style="color: #373737; text-decoration: underline;">Terms & Conditions</a> and
                                        <a href="#" style="color: #373737; text-decoration: underline;">Privacy
                                            Policy</a>
                                    </label>
                                    @error('terms')
                                        <div class="invalid-feedback d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Attractive Register Button -->
                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-lg rounded-3 fw-bold"
                                        style="background-color: #373737; color: white; border: none;
                                               box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                                               transition: all 0.3s ease;
                                               background-image: linear-gradient(to right, #373737, #505050);">
                                        <i class="fas fa-store me-2"></i> Register as Vendor
                                    </button>
                                </div>

                                <input type="hidden" value="3" name="role_id">

                                <!-- Login Link -->
                                <div class="text-center pt-3">
                                    <p class="mb-0" style="color: #373737;">Already have an account?
                                        <a href="{{ route('login') }}"
                                            style="color: #373737; font-weight: bold; text-decoration: underline;">Sign
                                            In</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Benefits Section -->
                    <div class="row mt-4 g-3">
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <div class="rounded-circle p-3 d-inline-block mb-3"
                                        style="background-color: #f0f0f0; color: #373737;">
                                        <i class="fas fa-rocket fs-3"></i>
                                    </div>
                                    <h5 class="card-title" style="color: #373737;">Easy Setup</h5>
                                    <p class="card-text small text-muted">Get your store running in minutes with our simple
                                        onboarding</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <div class="rounded-circle p-3 d-inline-block mb-3"
                                        style="background-color: #f0f0f0; color: #373737;">
                                        <i class="fas fa-chart-line fs-3"></i>
                                    </div>
                                    <h5 class="card-title" style="color: #373737;">Grow Faster</h5>
                                    <p class="card-text small text-muted">Access millions of customers and powerful
                                        marketing tools</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <div class="rounded-circle p-3 d-inline-block mb-3"
                                        style="background-color: #f0f0f0; color: #373737;">
                                        <i class="fas fa-headset fs-3"></i>
                                    </div>
                                    <h5 class="card-title" style="color: #373737;">24/7 Support</h5>
                                    <p class="card-text small text-muted">Dedicated support team ready to help you succeed
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add this script for password toggle functionality -->
@endsection

@section('js')
    <script src="{{ asset('assets/frontend-assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>

    <script src="{{ asset('assets/frontend-assets/js/main.js') }}"></script>
    <script>
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {
                const input = this.parentNode.querySelector('input');
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
@endsection
