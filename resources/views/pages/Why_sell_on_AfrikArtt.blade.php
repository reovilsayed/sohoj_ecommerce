@extends('layouts.app')
@section('content')
    <x-app.header />

    <!-- Hero Section -->
    <section class="hero-section position-relative min-vh-100 d-flex align-items-center overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="position-absolute w-100 h-100 bg-pattern opacity-25"></div>
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>

        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <!-- Badge -->
                    <div class="hero-badge d-inline-flex align-items-center px-4 py-2 mb-4">
                        <span class="status-dot me-2"></span>
                        Join 10,000+ Active Sellers
                    </div>

                    <!-- Main Heading -->
                    <h1 class="hero-title display-1 fw-black mb-4">
                        Why Sell on
                        <span class="gradient-text position-relative">
                            AfrikArt?
                            <div class="hero-underline"></div>
                        </span>
                    </h1>

                    <!-- Subtitle -->
                    <p class="hero-subtitle fs-3 text-muted mb-5 mx-auto">
                        Transform your passion into profit with Africa's most powerful e-commerce platform.
                        <span class="fw-bold text-orange">Start selling in minutes, not days.</span>
                    </p>

                    <!-- CTA Buttons -->
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                        <a href="{{ route('vendor.create') }}" class="btn-primary-custom btn-lg">
                            <svg class="me-2" width="24" height="24" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Start Selling Today
                        </a>
                        <a href="#features" class="btn-secondary-custom btn-lg">
                            <svg class="me-2" width="24" height="24" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            Watch Demo
                        </a>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="trust-indicators mt-5">
                        <div class="row justify-content-center text-start">
                            <div class="col-auto">
                                <div class="d-flex align-items-center mb-2">
                                    <svg class="text-success me-2" width="20" height="20" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-muted">No setup fees</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="d-flex align-items-center mb-2">
                                    <svg class="text-success me-2" width="20" height="20" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-muted">Free forever plan</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="d-flex align-items-center mb-2">
                                    <svg class="text-success me-2" width="20" height="20" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-muted">24/7 support</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="scroll-indicator position-absolute bottom-0 start-50 translate-middle-x">
                <div class="scroll-arrow"></div>
            </div>

    </section>
    <!-- Improved Hero Call-to-Action & Trust Indicators -->
    <div class="mt-5 d-flex flex-column align-items-center">
        <a href="#features"
            class="d-inline-flex align-items-center gap-2 px-5 py-3 rounded-3xl fw-bold fs-4 border-3 border-warning text-warning bg-white bg-opacity-75 shadow-lg hover:bg-warning hover:text-white transition-all"
            style="backdrop-filter: blur(8px); border-color: var(--orange-500); color: var(--orange-600);">
            <svg class="me-2" width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
            Explore Features
        </a>
        <!-- Trust Indicators -->
        <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 mt-4 animate-fade-in-up">
            <div
                class="d-flex align-items-center text-success bg-white bg-opacity-75 px-3 py-2 rounded-pill shadow-sm fw-medium">
                <svg class="me-2" width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                Free Setup
            </div>
            <div
                class="d-flex align-items-center text-success bg-white bg-opacity-75 px-3 py-2 rounded-pill shadow-sm fw-medium">
                <svg class="me-2" width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                No Monthly Fees
            </div>
            <div
                class="d-flex align-items-center text-success bg-white bg-opacity-75 px-3 py-2 rounded-pill shadow-sm fw-medium">
                <svg class="me-2" width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                24/7 Support
            </div>
        </div>
        <!-- Scroll Indicator -->
        <div class="scroll-indicator position-relative mt-5">
            <div class="scroll-arrow"></div>
        </div>
    </div>


    <!-- Stats Section -->
    <section class="stats-section py-5 bg-white position-relative overflow-hidden">
        <!-- Background Decoration -->
        <div class="position-absolute top-0 start-0 w-100 stats-divider"></div>

        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-dark mb-3">Trusted by thousands worldwide</h2>
                <p class="text-muted fs-5">Join our growing community of successful sellers</p>
            </div>

            <div class="row g-4">
                <!-- Stat 1 -->
                <div class="col-6 col-lg-3">
                    <div class="stat-card stat-card-orange text-center p-4 rounded-4 h-100">
                        <div class="stat-icon-wrapper position-relative mb-4">
                            <div
                                class="stat-icon stat-icon-orange d-flex align-items-center justify-content-center mx-auto">
                                <svg width="40" height="40" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="status-indicator status-green"></div>
                        </div>
                        <div class="display-4 fw-black text-dark mb-2 counter" data-target="10000">0</div>
                        <div class="fs-5 fw-semibold text-dark mb-1">Active Sellers</div>
                        <div class="small text-muted">Growing every day</div>
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="col-6 col-lg-3">
                    <div class="stat-card stat-card-blue text-center p-4 rounded-4 h-100">
                        <div class="stat-icon-wrapper position-relative mb-4">
                            <div class="stat-icon stat-icon-blue d-flex align-items-center justify-content-center mx-auto">
                                <svg width="40" height="40" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div class="status-indicator status-yellow animation-delay-500"></div>
                        </div>
                        <div class="display-4 fw-black text-dark mb-2 counter" data-target="50000">0</div>
                        <div class="fs-5 fw-semibold text-dark mb-1">Products Sold</div>
                        <div class="small text-muted">This month alone</div>
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="col-6 col-lg-3">
                    <div class="stat-card stat-card-green text-center p-4 rounded-4 h-100">
                        <div class="stat-icon-wrapper position-relative mb-4">
                            <div
                                class="stat-icon stat-icon-green d-flex align-items-center justify-content-center mx-auto">
                                <svg width="40" height="40" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="status-indicator status-purple animation-delay-1000"></div>
                        </div>
                        <div class="display-4 fw-black text-dark mb-2 counter" data-target="25">0</div>
                        <div class="fs-5 fw-semibold text-dark mb-1">Countries</div>
                        <div class="small text-muted">Global reach</div>
                    </div>
                </div>

                <!-- Stat 4 -->
                <div class="col-6 col-lg-3">
                    <div class="stat-card stat-card-purple text-center p-4 rounded-4 h-100">
                        <div class="stat-icon-wrapper position-relative mb-4">
                            <div
                                class="stat-icon stat-icon-purple d-flex align-items-center justify-content-center mx-auto">
                                <svg width="40" height="40" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="status-indicator status-red animation-delay-1500"></div>
                        </div>
                        <div class="display-4 fw-black text-dark mb-2">24/7</div>
                        <div class="fs-5 fw-semibold text-dark mb-1">Support</div>
                        <div class="small text-muted">Always here for you</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Features Section -->
    <!-- Main Features Section -->
    <section id="features" class="features-section py-5 position-relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="position-absolute w-100 h-100 opacity-25">
            <div class="floating-blob blob-orange"></div>
            <div class="floating-blob blob-blue"></div>
            <div class="floating-blob blob-purple"></div>
        </div>

        <div class="container position-relative">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-black text-dark mb-4">
                    Why choose
                    <span class="gradient-text">AfrikArt?</span>
                </h2>
                <p class="fs-5 text-muted mx-auto features-subtitle">
                    We provide everything you need to build, grow, and scale your online business successfully with
                    cutting-edge features.
                </p>
            </div>

            <div class="row g-4">
                <!-- Feature 1 -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="feature-card feature-card-orange position-relative h-100">
                        <div class="feature-glow feature-glow-orange"></div>
                        <div class="feature-content p-4 bg-white rounded-4 shadow-lg h-100">
                            <div class="feature-icon-wrapper position-relative mb-4">
                                <div
                                    class="feature-icon feature-icon-orange d-flex align-items-center justify-content-center">
                                    <svg width="32" height="32" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div class="feature-indicator feature-indicator-green"></div>
                            </div>
                            <h3 class="h4 fw-bold text-dark mb-3">Lightning Fast Setup</h3>
                            <p class="text-muted mb-4">
                                Get your store live in minutes, not days. Our streamlined onboarding process gets you
                                selling faster than ever.
                            </p>
                            <div class="feature-cta d-flex align-items-center text-orange">
                                <span class="fw-semibold">Start now</span>
                                <svg class="ms-2 feature-arrow" width="16" height="16" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="feature-card feature-card-blue position-relative h-100">
                        <div class="feature-glow feature-glow-blue"></div>
                        <div class="feature-content p-4 bg-white rounded-4 shadow-lg h-100">
                            <div class="feature-icon-wrapper position-relative mb-4">
                                <div
                                    class="feature-icon feature-icon-blue d-flex align-items-center justify-content-center">
                                    <svg width="32" height="32" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="feature-indicator feature-indicator-yellow animation-delay-500"></div>
                            </div>
                            <h3 class="h4 fw-bold text-dark mb-3">Zero Listing Fees</h3>
                            <p class="text-muted mb-4">
                                List unlimited products with no upfront costs. Pay only when you sell, keeping more money in
                                your pocket.
                            </p>
                            <div class="feature-cta d-flex align-items-center text-blue">
                                <span class="fw-semibold">Learn more</span>
                                <svg class="ms-2 feature-arrow" width="16" height="16" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="feature-card feature-card-green position-relative h-100">
                        <div class="feature-glow feature-glow-green"></div>
                        <div class="feature-content p-4 bg-white rounded-4 shadow-lg h-100">
                            <div class="feature-icon-wrapper position-relative mb-4">
                                <div
                                    class="feature-icon feature-icon-green d-flex align-items-center justify-content-center">
                                    <svg width="32" height="32" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div class="feature-indicator feature-indicator-purple animation-delay-1000"></div>
                            </div>
                            <h3 class="h4 fw-bold text-dark mb-3">Secure Payments</h3>
                            <p class="text-muted mb-4">
                                Get paid safely and on time with our integrated payment system. Multiple payment options for
                                your customers.
                            </p>
                            <div class="feature-cta d-flex align-items-center text-green">
                                <span class="fw-semibold">Explore</span>
                                <svg class="ms-2 feature-arrow" width="16" height="16" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card feature-card-purple position-relative h-100">
                        <div class="feature-glow feature-glow-purple"></div>
                        <div class="feature-content p-4 bg-white rounded-4 shadow-lg h-100">
                            <div class="feature-icon-wrapper position-relative mb-4">
                                <div
                                    class="feature-icon feature-icon-purple d-flex align-items-center justify-content-center">
                                    <svg width="32" height="32" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <div class="feature-indicator feature-indicator-red animation-delay-1500"></div>
                            </div>
                            <h3 class="h4 fw-bold text-dark mb-3">Advanced Analytics</h3>
                            <p class="text-muted mb-4">
                                Track your performance with detailed insights. Make data-driven decisions to grow your
                                business.
                            </p>
                            <div class="feature-cta d-flex align-items-center text-purple">
                                <span class="fw-semibold">View demo</span>
                                <svg class="ms-2 feature-arrow" width="16" height="16" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card feature-card-red position-relative h-100">
                        <div class="feature-glow feature-glow-red"></div>
                        <div class="feature-content p-4 bg-white rounded-4 shadow-lg h-100">
                            <div class="feature-icon-wrapper position-relative mb-4">
                                <div
                                    class="feature-icon feature-icon-red d-flex align-items-center justify-content-center">
                                    <svg width="32" height="32" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div class="feature-indicator feature-indicator-indigo animation-delay-2000"></div>
                            </div>
                            <h3 class="h4 fw-bold text-dark mb-3">24/7 Support</h3>
                            <p class="text-muted mb-4">
                                Get help whenever you need it. Our dedicated support team is always ready to assist you.
                            </p>
                            <div class="feature-cta d-flex align-items-center text-red">
                                <span class="fw-semibold">Get help</span>
                                <svg class="ms-2 feature-arrow" width="16" height="16" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card feature-card-indigo position-relative h-100">
                        <div class="feature-glow feature-glow-indigo"></div>
                        <div class="feature-content p-4 bg-white rounded-4 shadow-lg h-100">
                            <div class="feature-icon-wrapper position-relative mb-4">
                                <div
                                    class="feature-icon feature-icon-indigo d-flex align-items-center justify-content-center">
                                    <svg width="32" height="32" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9" />
                                    </svg>
                                </div>
                                <div class="feature-indicator feature-indicator-teal animation-delay-2500"></div>
                            </div>
                            <h3 class="h4 fw-bold text-dark mb-3">Global Reach</h3>
                            <p class="text-muted mb-4">
                                Reach customers across Africa and beyond. Expand your market with our international shipping
                                options.
                            </p>
                            <div class="feature-cta d-flex align-items-center text-indigo">
                                <span class="fw-semibold">Expand globally</span>
                                <svg class="ms-2 feature-arrow" width="16" height="16" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Stories Section -->
    <section class="testimonials-section py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-dark mb-3">Success Stories</h2>
                <p class="fs-5 text-muted">Hear from sellers who've transformed their businesses with AfrikArt</p>
            </div>

            <div class="row g-4">
                <!-- Testimonial 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card testimonial-card-orange p-4 rounded-4 border h-100">
                        <div class="d-flex align-items-center mb-4">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=60&h=60&fit=crop&crop=face&auto=format"
                                alt="Seller" class="testimonial-avatar me-3">
                            <div>
                                <h4 class="fw-bold text-dark mb-1">Amara Johnson</h4>
                                <p class="text-muted small mb-0">Fashion Designer, Nigeria</p>
                            </div>
                        </div>
                        <p class="text-muted fst-italic lh-relaxed mb-4">
                            "AfrikArt helped me turn my passion for traditional African fashion into a thriving business.
                            I've sold over 500 pieces in just 6 months!"
                        </p>
                        <div class="testimonial-stars d-flex text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card testimonial-card-blue p-4 rounded-4 border h-100">
                        <div class="d-flex align-items-center mb-4">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=60&h=60&fit=crop&crop=face&auto=format"
                                alt="Seller" class="testimonial-avatar me-3">
                            <div>
                                <h4 class="fw-bold text-dark mb-1">Kwame Asante</h4>
                                <p class="text-muted small mb-0">Craft Artist, Ghana</p>
                            </div>
                        </div>
                        <p class="text-muted fst-italic lh-relaxed mb-4">
                            "The platform's ease of use and global reach helped me showcase Ghanaian crafts to the world. My
                            monthly sales have tripled!"
                        </p>
                        <div class="testimonial-stars d-flex text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card testimonial-card-green p-4 rounded-4 border h-100">
                        <div class="d-flex align-items-center mb-4">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=60&h=60&fit=crop&crop=face&auto=format"
                                alt="Seller" class="testimonial-avatar me-3">
                            <div>
                                <h4 class="fw-bold text-dark mb-1">Fatima Al-Rashid</h4>
                                <p class="text-muted small mb-0">Jewelry Designer, Morocco</p>
                            </div>
                        </div>
                        <p class="text-muted fst-italic lh-relaxed mb-4">
                            "The analytics tools helped me understand my customers better. I now create pieces that sell out
                            within hours of listing!"
                        </p>
                        <div class="testimonial-stars d-flex text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-dark mb-3">How It Works</h2>
                <p class="fs-5 text-muted">Start selling in 3 simple steps</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Step 1 -->
                    <div class="how-it-works-step d-flex align-items-center mb-5">
                        <div class="step-number me-4">
                            1
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="h4 fw-bold text-dark mb-2">Sign Up & Verify</h3>
                            <p class="text-muted lh-relaxed mb-0">
                                Create your seller account in minutes. Complete our simple verification process to ensure
                                trust and security.
                            </p>
                        </div>
                        <div class="step-image d-none d-md-block ms-4">
                            <img src="{{ asset('assets/img/login.png') }}" height="150" width="200"
                                alt="Sign Up" class="step-img">
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="how-it-works-step d-flex align-items-center mb-5">
                        <div class="step-number step-number-blue me-4">
                            2
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="h4 fw-bold text-dark mb-2">Set Up Your Store</h3>
                            <p class="text-muted lh-relaxed mb-0">
                                Upload your products, set prices, and customize your store. Our intuitive tools make it easy
                                to showcase your items.
                            </p>
                        </div>
                        <div class="step-image d-none d-md-block ms-4">
                            <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=200&h=150&fit=crop&auto=format"
                                alt="Set Up Store" class="step-img">
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="how-it-works-step d-flex align-items-center">
                        <div class="step-number step-number-green me-4">
                            3
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="h4 fw-bold text-dark mb-2">Start Selling</h3>
                            <p class="text-muted lh-relaxed mb-0">
                                Your store is live! Start receiving orders, manage inventory, and grow your business with
                                our comprehensive seller tools.
                            </p>
                        </div>
                        <div class="step-image d-none d-md-block ms-4">
                            <img src="https://images.unsplash.com/photo-1593642634367-d91a135587b5?w=200&h=150&fit=crop&auto=format"
                                alt="Start Selling" class="step-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-dark mb-3">Simple, Transparent Pricing</h2>
                <p class="fs-5 text-muted">No hidden fees, no monthly subscriptions. Pay only when you sell.</p>
            </div>

            <div class="row justify-content-center g-4">
                <!-- Basic Plan -->
                <div class="col-lg-5">
                    <div class="pricing-card pricing-card-basic h-100 p-4 rounded-4 border position-relative">
                        <div class="text-center mb-4">
                            <h3 class="h3 fw-bold text-dark mb-3">Basic Seller</h3>
                            <div class="display-4 fw-black text-dark mb-2">Free</div>
                            <p class="text-muted">to start</p>
                        </div>
                        <ul class="list-unstyled pricing-features mb-4">
                            <li class="d-flex align-items-center mb-3">
                                <svg class="pricing-check-icon text-success me-3" width="20" height="20" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-muted">List unlimited products</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <svg class="pricing-check-icon text-success me-3" width="20" height="20" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-muted">Basic analytics</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <svg class="pricing-check-icon text-success me-3" width="20" height="20" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-muted">5% commission per sale</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <svg class="pricing-check-icon text-success me-3" width="20" height="20" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-muted">Email support</span>
                            </li>
                        </ul>
                        <a href="{{ route('vendor.create') }}"
                            class="btn-pricing-basic d-block w-100 text-center py-3 rounded-3 fw-semibold text-decoration-none">
                            Get Started Free
                        </a>
                    </div>
                </div>

                <!-- Premium Plan -->
                <div class="col-lg-5">
                    <div class="pricing-card pricing-card-premium h-100 p-4 rounded-4 position-relative overflow-hidden">
                        <div class="pricing-badge position-absolute">
                            Popular
                        </div>
                        <div class="text-center mb-4">
                            <h3 class="h3 fw-bold text-white mb-3">Premium Seller</h3>
                            <div class="display-4 fw-black text-white mb-2">3%</div>
                            <p class="pricing-subtitle">commission per sale</p>
                        </div>
                        <ul class="list-unstyled pricing-features mb-4">
                            <li class="d-flex align-items-center mb-3">
                                <svg class="pricing-check-icon text-white me-3" width="20" height="20" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-white">Everything in Basic</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <svg class="pricing-check-icon text-white me-3" width="20" height="20" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-white">Advanced analytics & insights</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <svg class="pricing-check-icon text-white me-3" width="20" height="20" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-white">Priority customer support</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <svg class="pricing-check-icon text-white me-3" width="20" height="20" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-white">Featured listing opportunities</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <svg class="pricing-check-icon text-white me-3" width="20" height="20" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-white">Marketing tools & promotions</span>
                            </li>
                        </ul>
                        <a href="{{ route('vendor.create') }}"
                            class="btn-pricing-premium d-block w-100 text-center py-3 rounded-3 fw-semibold text-decoration-none">
                            Start Premium Trial
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-dark mb-3">Frequently Asked Questions</h2>
                <p class="fs-5 text-muted">Everything you need to know about selling on AfrikArt</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq-container">
                        <div class="faq-item bg-white rounded-4 p-4 mb-4 border shadow-sm">
                            <h3 class="h5 fw-bold text-dark mb-3">How long does it take to get approved?</h3>
                            <p class="text-muted mb-0 lh-relaxed">Most sellers are approved within 24-48 hours after submitting all required
                                documents. Our team reviews each application to ensure quality and authenticity.</p>
                        </div>

                        <div class="faq-item bg-white rounded-4 p-4 mb-4 border shadow-sm">
                            <h3 class="h5 fw-bold text-dark mb-3">What types of products can I sell?</h3>
                            <p class="text-muted mb-0 lh-relaxed">We welcome a wide range of products including fashion, crafts, electronics,
                                home goods, and more. Check our seller guidelines for prohibited items and category-specific
                                requirements.</p>
                        </div>

                        <div class="faq-item bg-white rounded-4 p-4 mb-4 border shadow-sm">
                            <h3 class="h5 fw-bold text-dark mb-3">How do I get paid?</h3>
                            <p class="text-muted mb-0 lh-relaxed">Payments are processed weekly via bank transfer, mobile money, or PayPal. You
                                can track all your earnings and transaction history in your seller dashboard.</p>
                        </div>

                        <div class="faq-item bg-white rounded-4 p-4 mb-4 border shadow-sm">
                            <h3 class="h5 fw-bold text-dark mb-3">Do you handle shipping?</h3>
                            <p class="text-muted mb-0 lh-relaxed">You can choose to handle shipping yourself or use our fulfillment partners. We
                                provide discounted shipping rates and integrated tracking for better customer experience.</p>
                        </div>

                        <div class="faq-item bg-white rounded-4 p-4 mb-4 border shadow-sm">
                            <h3 class="h5 fw-bold text-dark mb-3">Is there a minimum order requirement?</h3>
                            <p class="text-muted mb-0 lh-relaxed">No minimum order requirements! Whether you sell one item or thousands, you
                                have access to all our seller tools and support resources.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section py-5 position-relative overflow-hidden">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="cta-title display-4 fw-bold text-white mb-4">
                        Ready to Start Your Success Story?
                    </h2>
                    <p class="cta-subtitle fs-5 mb-5 lh-relaxed">
                        Join thousands of successful sellers who have transformed their passion into profit.
                        Your journey to e-commerce success starts here.
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center mb-4">
                        <a href="{{ route('vendor.create') }}"
                            class="btn-cta-primary px-5 py-3 rounded-4 fw-bold fs-5 text-decoration-none">
                            Start Selling Now - It's Free!
                        </a>
                        <a href="{{ route('contact') }}"
                            class="btn-cta-secondary px-5 py-3 rounded-4 fw-semibold fs-5 text-decoration-none">
                            Contact Sales Team
                        </a>
                    </div>
                    <p class="cta-features text-center small mb-0">
                        <span class="d-inline-flex align-items-center me-3">
                            <svg class="me-1" width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            No setup fees
                        </span>
                        <span class="d-inline-flex align-items-center me-3">
                            <svg class="me-1" width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            No monthly charges
                        </span>
                        <span class="d-inline-flex align-items-center">
                            <svg class="me-1" width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Start selling immediately
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap 5 Enhanced Styles -->
    <style>
        /* Root Variables */
        :root {
            --orange-500: #f97316;
            --orange-600: #ea580c;
            --amber-500: #f59e0b;
            --blue-500: #3b82f6;
            --green-500: #10b981;
            --purple-500: #8b5cf6;
            --red-500: #ef4444;
            --yellow-500: #eab308;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #fef3e2 0%, #fef3e2 25%, #fef3c7 50%, #fef08a 100%);
        }

        .hero-badge {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            color: var(--orange-600);
            font-weight: 500;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: var(--green-500);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: 900;
            line-height: 1.1;
            color: #1f2937;
        }

        .gradient-text {
            background: linear-gradient(45deg, var(--orange-500), var(--amber-500), #fbbf24);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            background-size: 300% 300%;
            animation: gradient-shift 3s ease infinite;
        }

        .hero-underline {
            position: absolute;
            bottom: -8px;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(45deg, var(--orange-500), var(--amber-500));
            border-radius: 2px;
            transform: scaleX(0);
            animation: scale-x 1s ease 1s forwards;
        }

        .hero-subtitle {
            color: #374151;
            max-width: 48rem;
        }

        .text-orange {
            color: var(--orange-600) !important;
        }

        .text-blue {
            color: var(--blue-500) !important;
        }

        .text-green {
            color: var(--green-500) !important;
        }

        .text-purple {
            color: var(--purple-500) !important;
        }

        .text-red {
            color: var(--red-500) !important;
        }

        .text-indigo {
            color: #6366f1 !important;
        }

        /* Custom Buttons */
        .btn-primary-custom {
            background: linear-gradient(45deg, var(--orange-500), var(--amber-500));
            border: none;
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 1rem;
            font-weight: 700;
            font-size: 1.1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .btn-primary-custom:hover {
            transform: scale(1.05);
            box-shadow: 0 25px 35px -5px rgba(249, 115, 22, 0.25);
            color: white;
        }

        .btn-secondary-custom {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(249, 115, 22, 0.2);
            color: var(--orange-600);
            padding: 1rem 2.5rem;
            border-radius: 1rem;
            font-weight: 700;
            font-size: 1.1rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-secondary-custom:hover {
            background: white;
            border-color: var(--orange-500);
            color: var(--orange-600);
            transform: translateY(-2px);
        }

        /* Trust Indicators */
        .trust-indicators {
            margin-top: 3rem;
        }

        /* Scroll Indicator */
        .scroll-indicator {
            margin-bottom: 2rem;
        }

        .scroll-arrow {
            width: 24px;
            height: 40px;
            border: 2px solid var(--orange-500);
            border-radius: 20px;
            position: relative;
            animation: bounce 2s infinite;
        }

        .scroll-arrow::before {
            content: '';
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 12px;
            background: var(--orange-500);
            border-radius: 2px;
            animation: scroll-down 2s infinite;
        }

        /* Blobs */
        .blob {
            position: absolute;
            width: 18rem;
            height: 18rem;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.3;
            mix-blend-mode: multiply;
        }

        .blob-1 {
            top: 5rem;
            left: 2.5rem;
            background: linear-gradient(135deg, #fed7aa, #fdba74);
            animation: blob-float 20s ease-in-out infinite;
        }

        .blob-2 {
            top: 10rem;
            right: 5rem;
            background: linear-gradient(135deg, #fdba74, #fbbf24);
            animation: blob-float 20s ease-in-out infinite reverse;
            animation-delay: 2s;
        }

        .blob-3 {
            bottom: -8rem;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, #fbbf24, #fed7aa);
            animation: blob-float 20s ease-in-out infinite;
            animation-delay: 4s;
        }

        /* Stats Section */
        .stats-section {
            padding: 5rem 0;
        }

        .stats-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #fed7aa, transparent);
        }

        .stat-card {
            border: 1px solid;
            transition: all 0.5s ease;
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        .stat-card-orange {
            background: linear-gradient(135deg, #fff7ed, #fed7aa);
            border-color: #fdba74;
        }

        .stat-card-orange:hover {
            border-color: var(--orange-500);
        }

        .stat-card-blue {
            background: linear-gradient(135deg, #eff6ff, #bfdbfe);
            border-color: #93c5fd;
        }

        .stat-card-blue:hover {
            border-color: var(--blue-500);
        }

        .stat-card-green {
            background: linear-gradient(135deg, #ecfdf5, #a7f3d0);
            border-color: #6ee7b7;
        }

        .stat-card-green:hover {
            border-color: var(--green-500);
        }

        .stat-card-purple {
            background: linear-gradient(135deg, #f5f3ff, #c4b5fd);
            border-color: #a78bfa;
        }

        .stat-card-purple:hover {
            border-color: var(--purple-500);
        }

        .stat-icon {
            width: 5rem;
            height: 5rem;
            border-radius: 1rem;
            color: white;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .stat-icon-orange {
            background: linear-gradient(135deg, var(--orange-500), var(--amber-500));
        }

        .stat-icon-blue {
            background: linear-gradient(135deg, var(--blue-500), #0ea5e9);
        }

        .stat-icon-green {
            background: linear-gradient(135deg, var(--green-500), #059669);
        }

        .stat-icon-purple {
            background: linear-gradient(135deg, var(--purple-500), #7c3aed);
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
        }

        .status-indicator {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        .status-green {
            background: var(--green-500);
        }

        .status-yellow {
            background: var(--yellow-500);
        }

        .status-purple {
            background: var(--purple-500);
        }

        .status-red {
            background: var(--red-500);
        }

        /* Animation Delays */
        .animation-delay-500 {
            animation-delay: 0.5s;
        }

        .animation-delay-1000 {
            animation-delay: 1s;
        }

        .animation-delay-1500 {
            animation-delay: 1.5s;
        }

        /* Animations */
        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        @keyframes bounce {

            0%,
            20%,
            53%,
            80%,
            100% {
                transform: translate3d(0, 0, 0);
            }

            40%,
            43% {
                transform: translate3d(0, -8px, 0);
            }

            70% {
                transform: translate3d(0, -4px, 0);
            }

            90% {
                transform: translate3d(0, -2px, 0);
            }
        }

        @keyframes scroll-down {
            0% {
                opacity: 0;
                transform: translateX(-50%) translateY(0);
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: translateX(-50%) translateY(16px);
            }
        }

        @keyframes gradient-shift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes scale-x {
            0% {
                transform: scaleX(0);
            }

            100% {
                transform: scaleX(1);
            }
        }

        @keyframes blob-float {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -30px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 3rem;
            }

            .blob {
                width: 12rem;
                height: 12rem;
            }

            .stat-icon {
                width: 4rem;
                height: 4rem;
            }
        }

        /* Background Pattern */
        .bg-pattern {
            background-image: radial-gradient(circle at 1px 1px, rgba(255, 255, 255, 0.15) 1px, transparent 0);
            background-size: 20px 20px;
        }

        /* Pricing Section */
        .pricing-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 5rem 0;
        }

        .pricing-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .pricing-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .pricing-card-basic {
            background: linear-gradient(135deg, #f9fafb, #e5e7eb);
            border-color: #d1d5db;
        }

        .pricing-card-premium {
            background: linear-gradient(135deg, var(--orange-500), var(--amber-500), #eab308);
            border: none;
        }

        .pricing-badge {
            top: 1rem;
            right: 1rem;
            background: white;
            color: var(--orange-500);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 700;
        }

        .pricing-subtitle {
            color: rgba(255, 255, 255, 0.8);
        }

        .pricing-check-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .btn-pricing-basic {
            background: #e5e7eb;
            color: #374151;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-pricing-basic:hover {
            background: #d1d5db;
            color: #374151;
            transform: translateY(-2px);
        }

        .btn-pricing-premium {
            background: white;
            color: var(--orange-500);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-pricing-premium:hover {
            background: #f9fafb;
            color: var(--orange-500);
            transform: translateY(-2px);
        }

        /* FAQ Section */
        .faq-section {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            padding: 5rem 0;
        }

        .faq-item {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .faq-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 25px -5px rgba(0, 0, 0, 0.1);
            border-color: var(--orange-500);
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--orange-500) 0%, var(--amber-500) 50%, #eab308 100%);
            padding: 5rem 0;
        }

        .cta-title {
            font-size: 3.5rem;
            line-height: 1.1;
        }

        .cta-subtitle {
            color: rgba(255, 255, 255, 0.9);
        }

        .cta-features {
            color: rgba(255, 255, 255, 0.8);
        }

        .btn-cta-primary {
            background: white;
            color: var(--orange-500);
            border: none;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .btn-cta-primary:hover {
            background: #f9fafb;
            color: var(--orange-500);
            transform: scale(1.05);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
        }

        .btn-cta-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
            transition: all 0.3s ease;
        }

        .btn-cta-secondary:hover {
            background: white;
            color: var(--orange-500);
            transform: translateY(-2px);
        }

        /* Additional responsive styles */
        @media (max-width: 768px) {
            .cta-title {
                font-size: 2.5rem;
            }
            
            .pricing-card {
                margin-bottom: 2rem;
            }
        }
    </style>

    <script>
        // Counter animation
        function animateCounters() {
            const counters = document.querySelectorAll('.counter');

            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const increment = target / 100;
                let current = 0;

                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = Math.floor(current).toLocaleString();
                        setTimeout(updateCounter, 30);
                    } else {
                        counter.textContent = target.toLocaleString();
                    }
                };

                updateCounter();
            });
        }

        // Intersection Observer for counter animation
        function setupCounterObserver() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounters();
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.5
            });

            const statsSection = document.querySelector('.stats-section');
            if (statsSection) {
                observer.observe(statsSection);
            }
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            setupCounterObserver();
        });
    </script>
@endsection
