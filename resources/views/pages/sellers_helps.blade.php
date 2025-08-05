@extends('layouts.app')
@section('content')
    <x-app.header />

    <!-- Hero Section -->
    <section class="help-hero-section position-relative py-5 overflow-hidden">
        <!-- Background Elements -->
        <div class="position-absolute w-100 h-100 bg-pattern opacity-25"></div>
        <div class="help-blob help-blob-1"></div>
        <div class="help-blob help-blob-2"></div>
        <div class="help-blob help-blob-3"></div>
        
        <!-- Floating Icons -->
        <div class="floating-icon floating-icon-1">
            <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
        </div>
        <div class="floating-icon floating-icon-2">
            <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
        </div>
        <div class="floating-icon floating-icon-3">
            <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        
        <div class="container position-relative">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <!-- Badge -->
                    <div class="help-badge d-inline-flex align-items-center px-4 py-2 mb-4 animate-fade-in">
                        <div class="status-pulse me-2"></div>
                        <svg class="me-2" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        24/7 Support Available
                    </div>
                    
                    <!-- Main Heading -->
                    <h1 class="help-title display-3 fw-black mb-4 animate-slide-up">
                        How Can We 
                        <span class="gradient-text position-relative">
                            Help You?
                            <div class="help-underline"></div>
                            <div class="text-sparkle"></div>
                        </span>
                    </h1>
                    
                    <!-- Subtitle -->
                    <p class="help-subtitle fs-4 text-muted mb-5 animate-slide-up animation-delay-300">
                        Find answers, get support, and learn everything you need to succeed as a seller on AfrikArt.
                        <br><span class="text-orange fw-semibold">Your success is our priority.</span>
                    </p>
                    
                    <!-- Enhanced Search Box -->
                    <div class="help-search-container position-relative mb-5 animate-slide-up animation-delay-600">
                        <div class="search-wrapper">
                            <div class="search-box-container position-relative">
                                <div class="search-input-wrapper">
                                    <div class="search-icon-left">
                                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="search-icon">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </div>
                                    <input type="text" class="form-control search-input" placeholder="Search for help topics, guides, or FAQs..." id="helpSearch" autocomplete="off">
                                    <div class="search-actions">
                                        <button class="search-clear-btn d-none" type="button" id="clearSearch" title="Clear search">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                        <div class="search-divider"></div>
                                        <button class="btn search-btn" type="button" id="searchBtn">
                                            <span class="search-text">
                                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                                </svg>
                                                Search
                                            </span>
                                            <div class="search-loading d-none">
                                                <div class="spinner-border spinner-border-sm text-white" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                                <span class="ms-2">Searching...</span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Search Results Dropdown -->
                                <div class="search-dropdown position-absolute w-100 bg-white rounded-3 shadow-lg border d-none" id="searchResults">
                                    <div class="search-dropdown-header p-3 border-bottom bg-light">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="fw-bold text-muted small">SEARCH SUGGESTIONS</span>
                                            <span class="search-results-count badge bg-primary">4 results</span>
                                        </div>
                                    </div>
                                    <div class="search-dropdown-body">
                                        <div class="suggestion-item" data-category="getting-started">
                                            <div class="suggestion-icon">
                                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                                </svg>
                                            </div>
                                            <div class="suggestion-content">
                                                <div class="suggestion-title">Getting started with selling</div>
                                                <div class="suggestion-description">Learn the basics of setting up your seller account</div>
                                            </div>
                                            <div class="suggestion-badge">
                                                <span class="badge bg-success-subtle text-success">Popular</span>
                                            </div>
                                        </div>
                                        
                                        <div class="suggestion-item" data-category="products">
                                            <div class="suggestion-icon">
                                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                </svg>
                                            </div>
                                            <div class="suggestion-content">
                                                <div class="suggestion-title">How to list products</div>
                                                <div class="suggestion-description">Step-by-step guide to creating product listings</div>
                                            </div>
                                            <div class="suggestion-badge">
                                                <span class="badge bg-info-subtle text-info">Guide</span>
                                            </div>
                                        </div>
                                        
                                        <div class="suggestion-item" data-category="payments">
                                            <div class="suggestion-icon">
                                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                                </svg>
                                            </div>
                                            <div class="suggestion-content">
                                                <div class="suggestion-title">Payment processing</div>
                                                <div class="suggestion-description">Understanding fees and payment methods</div>
                                            </div>
                                            <div class="suggestion-badge">
                                                <span class="badge bg-warning-subtle text-warning">Important</span>
                                            </div>
                                        </div>
                                        
                                        <div class="suggestion-item" data-category="shipping">
                                            <div class="suggestion-icon">
                                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                                </svg>
                                            </div>
                                            <div class="suggestion-content">
                                                <div class="suggestion-title">Shipping guidelines</div>
                                                <div class="suggestion-description">Best practices for shipping and delivery</div>
                                            </div>
                                            <div class="suggestion-badge">
                                                <span class="badge bg-primary-subtle text-primary">Guide</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="search-dropdown-footer p-3 border-top bg-light">
                                        <div class="text-center">
                                            <button class="btn btn-outline-primary btn-sm" id="viewAllResults">
                                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                                View all search results
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- No Results State -->
                                    <div class="no-results d-none">
                                        <div class="text-center p-4">
                                            <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-muted mb-3">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33"/>
                                            </svg>
                                            <p class="text-muted mb-2">No results found</p>
                                            <p class="small text-muted">Try different keywords or browse our help categories</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Search Overlay -->
                                <div class="search-overlay position-fixed w-100 h-100 d-none" id="searchOverlay"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Links -->
                    <div class="help-quick-links d-flex flex-wrap justify-content-center gap-3 animate-slide-up animation-delay-900">
                        <span class="badge badge-quick-link">
                            <svg class="me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Getting Started
                        </span>
                        <span class="badge badge-quick-link">
                            <svg class="me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            Product Listing
                        </span>
                        <span class="badge badge-quick-link">
                            <svg class="me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            Payment Issues
                        </span>
                        <span class="badge badge-quick-link">
                            <svg class="me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            Shipping Guide
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Scroll Indicator -->
            <div class="scroll-indicator position-absolute bottom-0 start-50 translate-middle-x">
                <div class="scroll-arrow-help"></div>
                <p class="text-muted small mt-2 mb-0">Explore below</p>
            </div>
        </div>
    </section>

    <!-- Enhanced Help Categories Section -->
    <section class="help-categories-section py-5 bg-white position-relative overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="category-decoration category-decoration-1"></div>
        <div class="category-decoration category-decoration-2"></div>
        <div class="category-decoration category-decoration-3"></div>
        
        <!-- Floating Particles -->
        <div class="floating-particles">
            <div class="particle particle-1"></div>
            <div class="particle particle-2"></div>
            <div class="particle particle-3"></div>
            <div class="particle particle-4"></div>
            <div class="particle particle-5"></div>
        </div>
        
        <div class="container position-relative">
            <!-- Enhanced Header -->
            <div class="text-center mb-5">
                <div class="category-badge d-inline-flex align-items-center px-4 py-2 mb-4 animate-fade-in">
                    <div class="category-status-pulse me-2"></div>
                    <svg class="me-2" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    6 Help Categories Available
                </div>
                
                <h2 class="display-5 fw-black text-dark mb-4 animate-fade-in position-relative">
                    Browse Help Categories
                    <span class="category-title-decoration"></span>
                    <div class="title-sparkles">
                        <span class="sparkle sparkle-1">✨</span>
                        <span class="sparkle sparkle-2">⭐</span>
                        <span class="sparkle sparkle-3">💫</span>
                    </div>
                </h2>
                
                <p class="fs-5 text-muted mb-4 animate-fade-in animation-delay-200 position-relative">
                    Find the information you need quickly and efficiently
                    <br><span class="text-orange fw-semibold">Choose a category to explore detailed guides</span>
                </p>

                <!-- Category Filter Tabs -->
                <div class="category-filters d-flex justify-content-center flex-wrap gap-2 mb-5 animate-slide-up animation-delay-300">
                    <button class="filter-btn active" data-filter="all">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-1">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                        All Categories
                    </button>
                    <button class="filter-btn" data-filter="beginner">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-1">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Beginner
                    </button>
                    <button class="filter-btn" data-filter="intermediate">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-1">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Intermediate
                    </button>
                    <button class="filter-btn" data-filter="advanced">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-1">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                        Advanced
                    </button>
                </div>
            </div>
            
            <!-- Enhanced Categories Grid -->
            <div class="categories-grid">
                <div class="row g-4">
                    <!-- Category 1 - Enhanced -->
                    <div class="col-md-6 col-lg-4" data-category="beginner">
                        <div class="help-category-card h-100 position-relative animate-slide-up animation-delay-100" data-tilt>
                            <!-- Card Background Effects -->
                            <div class="category-glow category-glow-orange"></div>
                            <div class="category-mesh category-mesh-orange"></div>
                            <div class="category-shine"></div>
                            
                            <!-- Card Content -->
                            <div class="category-content p-4 rounded-4 text-center position-relative h-100 d-flex flex-column">
                                <!-- Icon Section -->
                                <div class="category-icon-section mb-4">
                                    <div class="help-category-icon help-category-icon-orange d-flex align-items-center justify-content-center mx-auto position-relative">
                                        <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="category-svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                        <div class="category-pulse"></div>
                                        <div class="icon-ring icon-ring-1"></div>
                                        <div class="icon-ring icon-ring-2"></div>
                                    </div>
                                    <div class="category-level-badge">
                                        <span class="badge bg-success-subtle text-success">Beginner Friendly</span>
                                    </div>
                                </div>
                                
                                <!-- Title & Description -->
                                <div class="category-text mb-4 flex-grow-1">
                                    <h3 class="category-title h4 fw-bold text-dark mb-3">Getting Started</h3>
                                    <p class="category-description text-muted">Learn the basics of setting up your seller account and getting started on AfrikArt marketplace.</p>
                                </div>
                                
                                <!-- Stats & Progress -->
                                <div class="category-stats mb-4">
                                    <div class="stats-row d-flex justify-content-between align-items-center mb-3">
                                        <div class="articles-count">
                                            <span class="count-number fw-bold text-orange">12</span>
                                            <span class="count-label text-muted small">Articles</span>
                                        </div>
                                        <div class="completion-rate">
                                            <span class="rate-number fw-bold text-success">95%</span>
                                            <span class="rate-label text-muted small">Helpful</span>
                                        </div>
                                    </div>
                                    
                                    <div class="category-badges mb-3">
                                        <span class="badge bg-success-subtle text-success me-2">Popular</span>
                                        <span class="badge bg-orange-subtle text-orange">Quick Start</span>
                                    </div>
                                    
                                    <div class="category-progress">
                                        <div class="progress-track">
                                            <div class="progress-bar progress-bar-orange" style="width: 85%"></div>
                                        </div>
                                        <div class="progress-label text-muted small mt-1">85% completion rate</div>
                                    </div>
                                </div>
                                
                                <!-- Action Button -->
                                <div class="category-action mt-auto">
                                    <button class="btn btn-category btn-orange">
                                        <span class="btn-text">Explore Guide</span>
                                        <svg class="btn-arrow" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category 2 - Enhanced -->
                    <div class="col-md-6 col-lg-4" data-category="intermediate">
                        <div class="help-category-card h-100 position-relative animate-slide-up animation-delay-200" data-tilt>
                            <div class="category-glow category-glow-blue"></div>
                            <div class="category-mesh category-mesh-blue"></div>
                            <div class="category-shine"></div>
                            
                            <div class="category-content p-4 rounded-4 text-center position-relative h-100 d-flex flex-column">
                                <div class="category-icon-section mb-4">
                                    <div class="help-category-icon help-category-icon-blue d-flex align-items-center justify-content-center mx-auto position-relative">
                                        <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="category-svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                        <div class="category-pulse"></div>
                                        <div class="icon-ring icon-ring-1"></div>
                                        <div class="icon-ring icon-ring-2"></div>
                                    </div>
                                    <div class="category-level-badge">
                                        <span class="badge bg-info-subtle text-info">Intermediate Level</span>
                                    </div>
                                </div>
                                
                                <div class="category-text mb-4 flex-grow-1">
                                    <h3 class="category-title h4 fw-bold text-dark mb-3">Product Management</h3>
                                    <p class="category-description text-muted">Everything about listing, editing, and managing your products effectively with advanced features.</p>
                                </div>
                                
                                <div class="category-stats mb-4">
                                    <div class="stats-row d-flex justify-content-between align-items-center mb-3">
                                        <div class="articles-count">
                                            <span class="count-number fw-bold text-blue">18</span>
                                            <span class="count-label text-muted small">Articles</span>
                                        </div>
                                        <div class="completion-rate">
                                            <span class="rate-number fw-bold text-success">92%</span>
                                            <span class="rate-label text-muted small">Helpful</span>
                                        </div>
                                    </div>
                                    
                                    <div class="category-badges mb-3">
                                        <span class="badge bg-info-subtle text-info me-2">Updated</span>
                                        <span class="badge bg-blue-subtle text-blue">Comprehensive</span>
                                    </div>
                                    
                                    <div class="category-progress">
                                        <div class="progress-track">
                                            <div class="progress-bar progress-bar-blue" style="width: 78%"></div>
                                        </div>
                                        <div class="progress-label text-muted small mt-1">78% completion rate</div>
                                    </div>
                                </div>
                                
                                <div class="category-action mt-auto">
                                    <button class="btn btn-category btn-blue">
                                        <span class="btn-text">Learn More</span>
                                        <svg class="btn-arrow" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category 3 - Enhanced -->
                    <div class="col-md-6 col-lg-4" data-category="intermediate">
                        <div class="help-category-card h-100 position-relative animate-slide-up animation-delay-300" data-tilt>
                            <div class="category-glow category-glow-green"></div>
                            <div class="category-mesh category-mesh-green"></div>
                            <div class="category-shine"></div>
                            
                            <div class="category-content p-4 rounded-4 text-center position-relative h-100 d-flex flex-column">
                                <div class="category-icon-section mb-4">
                                    <div class="help-category-icon help-category-icon-green d-flex align-items-center justify-content-center mx-auto position-relative">
                                        <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="category-svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                        <div class="category-pulse"></div>
                                        <div class="icon-ring icon-ring-1"></div>
                                        <div class="icon-ring icon-ring-2"></div>
                                    </div>
                                    <div class="category-level-badge">
                                        <span class="badge bg-warning-subtle text-warning">Important Info</span>
                                    </div>
                                </div>
                                
                                <div class="category-text mb-4 flex-grow-1">
                                    <h3 class="category-title h4 fw-bold text-dark mb-3">Payments & Billing</h3>
                                    <p class="category-description text-muted">Understand payment processing, fees, and how to get paid as a seller on our platform.</p>
                                </div>
                                
                                <div class="category-stats mb-4">
                                    <div class="stats-row d-flex justify-content-between align-items-center mb-3">
                                        <div class="articles-count">
                                            <span class="count-number fw-bold text-green">15</span>
                                            <span class="count-label text-muted small">Articles</span>
                                        </div>
                                        <div class="completion-rate">
                                            <span class="rate-number fw-bold text-success">98%</span>
                                            <span class="rate-label text-muted small">Helpful</span>
                                        </div>
                                    </div>
                                    
                                    <div class="category-badges mb-3">
                                        <span class="badge bg-warning-subtle text-warning me-2">Important</span>
                                        <span class="badge bg-green-subtle text-green">Must Read</span>
                                    </div>
                                    
                                    <div class="category-progress">
                                        <div class="progress-track">
                                            <div class="progress-bar progress-bar-green" style="width: 92%"></div>
                                        </div>
                                        <div class="progress-label text-muted small mt-1">92% completion rate</div>
                                    </div>
                                </div>
                                
                                <div class="category-action mt-auto">
                                    <button class="btn btn-category btn-green">
                                        <span class="btn-text">View Details</span>
                                        <svg class="btn-arrow" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category 4 - Enhanced -->
                    <div class="col-md-6 col-lg-4" data-category="intermediate">
                        <div class="help-category-card h-100 position-relative animate-slide-up animation-delay-400" data-tilt>
                            <div class="category-glow category-glow-purple"></div>
                            <div class="category-mesh category-mesh-purple"></div>
                            <div class="category-shine"></div>
                            
                            <div class="category-content p-4 rounded-4 text-center position-relative h-100 d-flex flex-column">
                                <div class="category-icon-section mb-4">
                                    <div class="help-category-icon help-category-icon-purple d-flex align-items-center justify-content-center mx-auto position-relative">
                                        <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="category-svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                        </svg>
                                        <div class="category-pulse"></div>
                                        <div class="icon-ring icon-ring-1"></div>
                                        <div class="icon-ring icon-ring-2"></div>
                                    </div>
                                    <div class="category-level-badge">
                                        <span class="badge bg-primary-subtle text-primary">Essential Guide</span>
                                    </div>
                                </div>
                                
                                <div class="category-text mb-4 flex-grow-1">
                                    <h3 class="category-title h4 fw-bold text-dark mb-3">Orders & Shipping</h3>
                                    <p class="category-description text-muted">Learn how to manage orders, shipping options, and delivery processes efficiently.</p>
                                </div>
                                
                                <div class="category-stats mb-4">
                                    <div class="stats-row d-flex justify-content-between align-items-center mb-3">
                                        <div class="articles-count">
                                            <span class="count-number fw-bold text-purple">22</span>
                                            <span class="count-label text-muted small">Articles</span>
                                        </div>
                                        <div class="completion-rate">
                                            <span class="rate-number fw-bold text-success">89%</span>
                                            <span class="rate-label text-muted small">Helpful</span>
                                        </div>
                                    </div>
                                    
                                    <div class="category-badges mb-3">
                                        <span class="badge bg-primary-subtle text-primary me-2">Comprehensive</span>
                                        <span class="badge bg-purple-subtle text-purple">Detailed</span>
                                    </div>
                                    
                                    <div class="category-progress">
                                        <div class="progress-track">
                                            <div class="progress-bar progress-bar-purple" style="width: 74%"></div>
                                        </div>
                                        <div class="progress-label text-muted small mt-1">74% completion rate</div>
                                    </div>
                                </div>
                                
                                <div class="category-action mt-auto">
                                    <button class="btn btn-category btn-purple">
                                        <span class="btn-text">Start Reading</span>
                                        <svg class="btn-arrow" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category 5 - Enhanced -->
                    <div class="col-md-6 col-lg-4" data-category="advanced">
                        <div class="help-category-card h-100 position-relative animate-slide-up animation-delay-500" data-tilt>
                            <div class="category-glow category-glow-red"></div>
                            <div class="category-mesh category-mesh-red"></div>
                            <div class="category-shine"></div>
                            
                            <div class="category-content p-4 rounded-4 text-center position-relative h-100 d-flex flex-column">
                                <div class="category-icon-section mb-4">
                                    <div class="help-category-icon help-category-icon-red d-flex align-items-center justify-content-center mx-auto position-relative">
                                        <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="category-svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                        <div class="category-pulse"></div>
                                        <div class="icon-ring icon-ring-1"></div>
                                        <div class="icon-ring icon-ring-2"></div>
                                    </div>
                                    <div class="category-level-badge">
                                        <span class="badge bg-danger-subtle text-danger">Advanced Topic</span>
                                    </div>
                                </div>
                                
                                <div class="category-text mb-4 flex-grow-1">
                                    <h3 class="category-title h4 fw-bold text-dark mb-3">Analytics & Reports</h3>
                                    <p class="category-description text-muted">Track your performance and understand your sales data with detailed analytics and insights.</p>
                                </div>
                                
                                <div class="category-stats mb-4">
                                    <div class="stats-row d-flex justify-content-between align-items-center mb-3">
                                        <div class="articles-count">
                                            <span class="count-number fw-bold text-red">10</span>
                                            <span class="count-label text-muted small">Articles</span>
                                        </div>
                                        <div class="completion-rate">
                                            <span class="rate-number fw-bold text-success">94%</span>
                                            <span class="rate-label text-muted small">Helpful</span>
                                        </div>
                                    </div>
                                    
                                    <div class="category-badges mb-3">
                                        <span class="badge bg-danger-subtle text-danger me-2">Advanced</span>
                                        <span class="badge bg-red-subtle text-red">Pro Level</span>
                                    </div>
                                    
                                    <div class="category-progress">
                                        <div class="progress-track">
                                            <div class="progress-bar progress-bar-red" style="width: 68%"></div>
                                        </div>
                                        <div class="progress-label text-muted small mt-1">68% completion rate</div>
                                    </div>
                                </div>
                                
                                <div class="category-action mt-auto">
                                    <button class="btn btn-category btn-red">
                                        <span class="btn-text">Master Analytics</span>
                                        <svg class="btn-arrow" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category 6 - Enhanced -->
                    <div class="col-md-6 col-lg-4" data-category="beginner">
                        <div class="help-category-card h-100 position-relative animate-slide-up animation-delay-600" data-tilt>
                            <div class="category-glow category-glow-indigo"></div>
                            <div class="category-mesh category-mesh-indigo"></div>
                            <div class="category-shine"></div>
                            
                            <div class="category-content p-4 rounded-4 text-center position-relative h-100 d-flex flex-column">
                                <div class="category-icon-section mb-4">
                                    <div class="help-category-icon help-category-icon-indigo d-flex align-items-center justify-content-center mx-auto position-relative">
                                        <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="category-svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <div class="category-pulse"></div>
                                        <div class="icon-ring icon-ring-1"></div>
                                        <div class="icon-ring icon-ring-2"></div>
                                    </div>
                                    <div class="category-level-badge">
                                        <span class="badge bg-secondary-subtle text-secondary">Essential Setup</span>
                                    </div>
                                </div>
                                
                                <div class="category-text mb-4 flex-grow-1">
                                    <h3 class="category-title h4 fw-bold text-dark mb-3">Account & Settings</h3>
                                    <p class="category-description text-muted">Manage your account settings, preferences, and security options for optimal selling experience.</p>
                                </div>
                                
                                <div class="category-stats mb-4">
                                    <div class="stats-row d-flex justify-content-between align-items-center mb-3">
                                        <div class="articles-count">
                                            <span class="count-number fw-bold text-indigo">8</span>
                                            <span class="count-label text-muted small">Articles</span>
                                        </div>
                                        <div class="completion-rate">
                                            <span class="rate-number fw-bold text-success">96%</span>
                                            <span class="rate-label text-muted small">Helpful</span>
                                        </div>
                                    </div>
                                    
                                    <div class="category-badges mb-3">
                                        <span class="badge bg-secondary-subtle text-secondary me-2">Essential</span>
                                        <span class="badge bg-indigo-subtle text-indigo">Quick Setup</span>
                                    </div>
                                    
                                    <div class="category-progress">
                                        <div class="progress-track">
                                            <div class="progress-bar progress-bar-indigo" style="width: 88%"></div>
                                        </div>
                                        <div class="progress-label text-muted small mt-1">88% completion rate</div>
                                    </div>
                                </div>
                                
                                <div class="category-action mt-auto">
                                    <button class="btn btn-category btn-indigo">
                                        <span class="btn-text">Configure Now</span>
                                        <svg class="btn-arrow" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Summary Stats -->
            <div class="category-summary-stats mt-5 pt-4 border-top animate-fade-in animation-delay-700">
                <div class="row text-center g-4">
                    <div class="col-md-3">
                        <div class="stat-card p-3 rounded-3 h-100">
                            <div class="stat-icon mb-2 text-orange">
                                <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div class="stat-number fw-bold text-dark mb-1">85+</div>
                            <div class="stat-label text-muted small">Total Articles</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card p-3 rounded-3 h-100">
                            <div class="stat-icon mb-2 text-blue">
                                <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="stat-number fw-bold text-dark mb-1">94%</div>
                            <div class="stat-label text-muted small">Avg. Helpful Rate</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card p-3 rounded-3 h-100">
                            <div class="stat-icon mb-2 text-green">
                                <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div class="stat-number fw-bold text-dark mb-1">5 min</div>
                            <div class="stat-label text-muted small">Avg. Read Time</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card p-3 rounded-3 h-100">
                            <div class="stat-icon mb-2 text-purple">
                                <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <div class="stat-number fw-bold text-dark mb-1">24/7</div>
                            <div class="stat-label text-muted small">Support Available</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Articles Section -->
    <section class="popular-articles-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-6 fw-bold text-dark mb-3">Popular Articles</h2>
                <p class="fs-5 text-muted">Most viewed help articles by sellers</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="popular-article-card d-flex p-4 rounded-4 h-100">
                        <div class="article-number me-4">
                            <span class="badge badge-number">1</span>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="h5 fw-bold text-dark mb-2">How to create your first product listing</h3>
                            <p class="text-muted mb-3">Step-by-step guide to listing your first product on AfrikArt marketplace.</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-light text-dark me-2">5 min read</span>
                                <span class="text-muted small">1,234 views</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="popular-article-card d-flex p-4 rounded-4 h-100">
                        <div class="article-number me-4">
                            <span class="badge badge-number">2</span>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="h5 fw-bold text-dark mb-2">Understanding payment processing and fees</h3>
                            <p class="text-muted mb-3">Learn about how payments work and what fees are involved in selling.</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-light text-dark me-2">7 min read</span>
                                <span class="text-muted small">987 views</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="popular-article-card d-flex p-4 rounded-4 h-100">
                        <div class="article-number me-4">
                            <span class="badge badge-number">3</span>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="h5 fw-bold text-dark mb-2">Best practices for product photography</h3>
                            <p class="text-muted mb-3">Tips and tricks to take amazing photos that help your products sell better.</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-light text-dark me-2">10 min read</span>
                                <span class="text-muted small">756 views</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="popular-article-card d-flex p-4 rounded-4 h-100">
                        <div class="article-number me-4">
                            <span class="badge badge-number">4</span>
                        </div>
                        <div class="flex-grow-1">
                            <h3 class="h5 fw-bold text-dark mb-2">Managing orders and customer communication</h3>
                            <p class="text-muted mb-3">How to handle orders efficiently and communicate with your customers.</p>
                            <div class="d-flex align-items-center">
                                <span class="badge bg-light text-dark me-2">8 min read</span>
                                <span class="text-muted small">654 views</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="#" class="btn btn-outline-primary btn-lg">View All Articles</a>
            </div>
        </div>
    </section>

    <!-- Contact Support Section -->
    <section class="contact-support-section py-5 bg-white position-relative">
        <!-- Background Decoration -->
        <div class="support-decoration support-decoration-1"></div>
        <div class="support-decoration support-decoration-2"></div>
        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="display-6 fw-bold text-dark mb-4 animate-fade-in">
                        Still Need Help?
                        <span class="help-heart">💝</span>
                    </h2>
                    <p class="fs-5 text-muted mb-5 animate-fade-in animation-delay-200">
                        Our support team is here to help you succeed. 
                        <span class="text-orange fw-semibold">We're just one click away!</span>
                    </p>
                    
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="support-option p-4 rounded-4 h-100 text-center animate-slide-up animation-delay-300">
                                <div class="support-glow support-glow-chat"></div>
                                <div class="support-icon support-icon-chat d-flex align-items-center justify-content-center mx-auto mb-3 position-relative">
                                    <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <div class="support-indicator support-indicator-online"></div>
                                </div>
                                <h3 class="h5 fw-bold text-dark mb-2">Live Chat</h3>
                                <p class="text-muted small mb-3">Chat with our support team in real-time</p>
                                <div class="support-status mb-3">
                                    <span class="badge bg-success-subtle text-success">
                                        <span class="online-dot"></span>
                                        3 agents online
                                    </span>
                                </div>
                                <button class="btn btn-primary-custom btn-sm support-btn" data-bs-toggle="modal" data-bs-target="#chatModal">
                                    <span class="btn-text">Start Chat</span>
                                    <div class="btn-loading d-none">
                                        <div class="spinner-border spinner-border-sm" role="status"></div>
                                    </div>
                                </button>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="support-option p-4 rounded-4 h-100 text-center animate-slide-up animation-delay-400">
                                <div class="support-glow support-glow-email"></div>
                                <div class="support-icon support-icon-email d-flex align-items-center justify-content-center mx-auto mb-3 position-relative">
                                    <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <div class="support-indicator support-indicator-email"></div>
                                </div>
                                <h3 class="h5 fw-bold text-dark mb-2">Email Support</h3>
                                <p class="text-muted small mb-3">Send us an email and we'll respond within 24 hours</p>
                                <div class="support-status mb-3">
                                    <span class="badge bg-info-subtle text-info">
                                        <svg class="me-1" width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        ~2h response time
                                    </span>
                                </div>
                                <button class="btn btn-outline-primary btn-sm support-btn" data-bs-toggle="modal" data-bs-target="#emailModal">
                                    <span class="btn-text">Send Email</span>
                                    <div class="btn-loading d-none">
                                        <div class="spinner-border spinner-border-sm" role="status"></div>
                                    </div>
                                </button>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="support-option p-4 rounded-4 h-100 text-center animate-slide-up animation-delay-500">
                                <div class="support-glow support-glow-phone"></div>
                                <div class="support-icon support-icon-phone d-flex align-items-center justify-content-center mx-auto mb-3 position-relative">
                                    <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <div class="support-indicator support-indicator-phone"></div>
                                </div>
                                <h3 class="h5 fw-bold text-dark mb-2">Phone Support</h3>
                                <p class="text-muted small mb-3">Call us for urgent issues (Mon-Fri, 9AM-6PM)</p>
                                <div class="support-status mb-3">
                                    <span class="badge bg-warning-subtle text-warning">
                                        <svg class="me-1" width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zM8 6a2 2 0 114 0v1H8V6z" clip-rule="evenodd"/>
                                        </svg>
                                        Premium feature
                                    </span>
                                </div>
                                <button class="btn btn-outline-primary btn-sm support-btn" onclick="showPhoneNumber()">
                                    <span class="btn-text">Call Now</span>
                                    <div class="btn-loading d-none">
                                        <div class="spinner-border spinner-border-sm" role="status"></div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Support Stats -->
                    <div class="support-stats mt-5 pt-4 border-top animate-fade-in animation-delay-600">
                        <div class="row text-center g-4">
                            <div class="col-md-3">
                                <div class="stat-number fw-bold text-primary mb-1">98%</div>
                                <div class="stat-label text-muted small">Satisfaction Rate</div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-number fw-bold text-success mb-1">&lt;2h</div>
                                <div class="stat-label text-muted small">Avg Response Time</div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-number fw-bold text-info mb-1">24/7</div>
                                <div class="stat-label text-muted small">Live Chat Available</div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-number fw-bold text-warning mb-1">5★</div>
                                <div class="stat-label text-muted small">Support Rating</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section py-5 position-relative overflow-hidden">
        <!-- Background Elements -->
        <div class="faq-decoration faq-decoration-1"></div>
        <div class="faq-decoration faq-decoration-2"></div>
        <div class="faq-decoration faq-decoration-3"></div>
        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <h2 class="display-6 fw-bold text-dark mb-3 animate-fade-in">
                        Frequently Asked Questions
                        <span class="faq-icon">🤔</span>
                    </h2>
                    <p class="fs-5 text-muted animate-fade-in animation-delay-200">
                        Quick answers to common questions from sellers
                    </p>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="faq-container">
                        <!-- FAQ Item 1 -->
                        <div class="faq-item animate-slide-up animation-delay-100">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false">
                                <div class="faq-icon-wrapper">
                                    <svg class="faq-plus" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <svg class="faq-minus d-none" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"/>
                                    </svg>
                                </div>
                                <h3 class="faq-title">How do I create my first product listing?</h3>
                                <span class="faq-badge">Popular</span>
                            </div>
                            <div class="collapse faq-answer" id="faq1">
                                <div class="faq-content">
                                    <p>Creating your first product listing is easy! Follow these steps:</p>
                                    <ol class="faq-list">
                                        <li>Navigate to your seller dashboard</li>
                                        <li>Click on "Add New Product"</li>
                                        <li>Fill in product details including title, description, and price</li>
                                        <li>Upload high-quality product images</li>
                                        <li>Set your shipping and inventory information</li>
                                        <li>Preview and publish your listing</li>
                                    </ol>
                                    <div class="faq-helpful mt-3">
                                        <span class="text-muted me-3">Was this helpful?</span>
                                        <button class="btn btn-sm btn-outline-success me-2" onclick="markHelpful(this, true)">
                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                                            </svg>
                                            Yes
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="markHelpful(this, false)">
                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.106-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z"/>
                                            </svg>
                                            No
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="faq-item animate-slide-up animation-delay-200">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false">
                                <div class="faq-icon-wrapper">
                                    <svg class="faq-plus" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <svg class="faq-minus d-none" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"/>
                                    </svg>
                                </div>
                                <h3 class="faq-title">What are the seller fees on AfrikArt?</h3>
                                <span class="faq-badge bg-info-subtle text-info">Important</span>
                            </div>
                            <div class="collapse faq-answer" id="faq2">
                                <div class="faq-content">
                                    <p>AfrikArt has a transparent fee structure:</p>
                                    <div class="fee-breakdown">
                                        <div class="fee-item">
                                            <span class="fee-label">Transaction Fee:</span>
                                            <span class="fee-value">2.9% + $0.30</span>
                                        </div>
                                        <div class="fee-item">
                                            <span class="fee-label">Listing Fee:</span>
                                            <span class="fee-value">Free</span>
                                        </div>
                                        <div class="fee-item">
                                            <span class="fee-label">Monthly Fee:</span>
                                            <span class="fee-value">$0</span>
                                        </div>
                                    </div>
                                    <div class="alert alert-info mt-3">
                                        <svg class="me-2" width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                        No hidden fees! You only pay when you make a sale.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="faq-item animate-slide-up animation-delay-300">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false">
                                <div class="faq-icon-wrapper">
                                    <svg class="faq-plus" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <svg class="faq-minus d-none" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"/>
                                    </svg>
                                </div>
                                <h3 class="faq-title">How long does it take to get paid?</h3>
                                <span class="faq-badge bg-success-subtle text-success">Quick Answer</span>
                            </div>
                            <div class="collapse faq-answer" id="faq3">
                                <div class="faq-content">
                                    <div class="payment-timeline">
                                        <div class="timeline-item">
                                            <div class="timeline-icon">1</div>
                                            <div class="timeline-content">
                                                <h4>Order Completion</h4>
                                                <p>Customer receives and confirms the order</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="timeline-icon">2</div>
                                            <div class="timeline-content">
                                                <h4>Processing Period</h4>
                                                <p>2-3 business days for payment processing</p>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="timeline-icon">3</div>
                                            <div class="timeline-content">
                                                <h4>Payment Transfer</h4>
                                                <p>Funds transferred to your linked account</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="faq-item animate-slide-up animation-delay-400">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false">
                                <div class="faq-icon-wrapper">
                                    <svg class="faq-plus" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <svg class="faq-minus d-none" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"/>
                                    </svg>
                                </div>
                                <h3 class="faq-title">Can I sell internationally?</h3>
                                <span class="faq-badge bg-warning-subtle text-warning">New</span>
                            </div>
                            <div class="collapse faq-answer" id="faq4">
                                <div class="faq-content">
                                    <p>Yes! AfrikArt supports international selling with these features:</p>
                                    <div class="feature-grid">
                                        <div class="feature-card">
                                            <svg class="feature-icon" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <h4>Global Shipping</h4>
                                            <p>Ship to 195+ countries</p>
                                        </div>
                                        <div class="feature-card">
                                            <svg class="feature-icon" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                            </svg>
                                            <h4>Multi-Currency</h4>
                                            <p>Accept 20+ currencies</p>
                                        </div>
                                        <div class="feature-card">
                                            <svg class="feature-icon" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                            </svg>
                                            <h4>Customs Support</h4>
                                            <p>Automated customs forms</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 5 -->
                        <div class="faq-item animate-slide-up animation-delay-500">
                            <div class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false">
                                <div class="faq-icon-wrapper">
                                    <svg class="faq-plus" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <svg class="faq-minus d-none" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"/>
                                    </svg>
                                </div>
                                <h3 class="faq-title">How do I handle returns and refunds?</h3>
                                <span class="faq-badge bg-purple-subtle text-purple">Policy</span>
                            </div>
                            <div class="collapse faq-answer" id="faq5">
                                <div class="faq-content">
                                    <p>Our return policy is seller-friendly while protecting buyers:</p>
                                    <div class="policy-steps">
                                        <div class="step-item">
                                            <div class="step-number">1</div>
                                            <div class="step-content">
                                                <h4>Set Your Policy</h4>
                                                <p>Define your return window (7-30 days) and conditions</p>
                                            </div>
                                        </div>
                                        <div class="step-item">
                                            <div class="step-number">2</div>
                                            <div class="step-content">
                                                <h4>Customer Request</h4>
                                                <p>Buyers initiate returns through our platform</p>
                                            </div>
                                        </div>
                                        <div class="step-item">
                                            <div class="step-number">3</div>
                                            <div class="step-content">
                                                <h4>Review & Approve</h4>
                                                <p>You review and decide on each return request</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- FAQ Footer -->
                    <div class="faq-footer text-center mt-5 pt-4 border-top">
                        <h3 class="h5 fw-bold text-dark mb-3">Still have questions?</h3>
                        <p class="text-muted mb-4">Can't find what you're looking for? Our support team is here to help!</p>
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#chatModal">
                                <svg class="me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                Ask Support
                            </button>
                            <a href="#" class="btn btn-outline-primary">
                                <svg class="me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                Browse All Articles
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Resource Center Section -->
    <section class="resource-center-section py-5 bg-light position-relative">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-6 fw-bold text-dark mb-3 animate-fade-in">
                    Seller Resources
                    <span class="resource-icon">📚</span>
                </h2>
                <p class="fs-5 text-muted animate-fade-in animation-delay-200">
                    Tools and guides to help you succeed
                </p>
            </div>
            
            <div class="row g-4">
                <!-- Resource 1 -->
                <div class="col-md-6 col-lg-3">
                    <div class="resource-card h-100 p-4 rounded-4 text-center animate-slide-up animation-delay-100">
                        <div class="resource-icon-wrapper mb-3">
                            <svg class="resource-svg" width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="h5 fw-bold text-dark mb-2">Sales Analytics</h3>
                        <p class="text-muted mb-3">Track your performance with detailed insights</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">View Dashboard</a>
                    </div>
                </div>
                
                <!-- Resource 2 -->
                <div class="col-md-6 col-lg-3">
                    <div class="resource-card h-100 p-4 rounded-4 text-center animate-slide-up animation-delay-200">
                        <div class="resource-icon-wrapper mb-3">
                            <svg class="resource-svg" width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-10 0a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2M9 12h6m-6 4h6m-6-8h.01"/>
                            </svg>
                        </div>
                        <h3 class="h5 fw-bold text-dark mb-2">Seller Handbook</h3>
                        <p class="text-muted mb-3">Complete guide to selling successfully</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Download PDF</a>
                    </div>
                </div>
                
                <!-- Resource 3 -->
                <div class="col-md-6 col-lg-3">
                    <div class="resource-card h-100 p-4 rounded-4 text-center animate-slide-up animation-delay-300">
                        <div class="resource-icon-wrapper mb-3">
                            <svg class="resource-svg" width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="h5 fw-bold text-dark mb-2">Video Tutorials</h3>
                        <p class="text-muted mb-3">Step-by-step video guides</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Watch Now</a>
                    </div>
                </div>
                
                <!-- Resource 4 -->
                <div class="col-md-6 col-lg-3">
                    <div class="resource-card h-100 p-4 rounded-4 text-center animate-slide-up animation-delay-400">
                        <div class="resource-icon-wrapper mb-3">
                            <svg class="resource-svg" width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                            </svg>
                        </div>
                        <h3 class="h5 fw-bold text-dark mb-2">Community Forum</h3>
                        <p class="text-muted mb-3">Connect with other sellers</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Join Community</a>
                    </div>
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
            --indigo-500: #6366f1;
            --cyan-500: #06b6d4;
            --emerald-500: #059669;
            --pink-500: #ec4899;
            --teal-500: #14b8a6;
        }

        /* Hero Section Enhanced */
        .help-hero-section {
            background: linear-gradient(135deg, #fef3e2 0%, #fef3e2 25%, #fef3c7 50%, #fef08a 100%);
            min-height: 80vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .help-badge {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            color: var(--orange-600);
            font-weight: 600;
            box-shadow: 0 8px 32px rgba(249, 115, 22, 0.1);
        }

        .status-pulse {
            width: 8px;
            height: 8px;
            background: var(--green-500);
            border-radius: 50%;
            animation: pulse-glow 2s infinite;
        }

        .help-title {
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
            position: relative;
        }

        .help-underline {
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

        .text-sparkle::after {
            content: '✨';
            position: absolute;
            top: -10px;
            right: -20px;
            font-size: 1.5rem;
            animation: sparkle 2s ease-in-out infinite;
        }

        .help-subtitle {
            color: #374151;
            max-width: 42rem;
            margin: 0 auto;
            line-height: 1.6;
        }

        .text-orange {
            color: var(--orange-600) !important;
        }

        /* Enhanced Search */
        .search-wrapper {
            position: relative;
            max-width: 600px;
            margin: 0 auto;
        }

        .search-box-container {
            background: white;
            border-radius: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 3px solid #f1f5f9;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .search-box-container:focus-within {
            border-color: var(--orange-500);
            box-shadow: 0 25px 50px rgba(249, 115, 22, 0.15);
            transform: translateY(-2px);
        }

        .search-input-wrapper {
            display: flex;
            align-items: center;
            padding: 0.5rem;
            gap: 0.5rem;
        }

        .search-icon-left {
            padding: 1rem;
            color: var(--orange-500);
            transition: transform 0.3s ease;
        }

        .search-box-container:focus-within .search-icon-left {
            transform: scale(1.1);
            color: var(--orange-600);
        }

        .search-input {
            border: none !important;
            box-shadow: none !important;
            padding: 1.2rem 0;
            font-size: 1.1rem;
            background: transparent;
            flex: 1;
        }

        .search-input:focus {
            outline: none;
        }

        .search-input::placeholder {
            color: #9ca3af;
            font-weight: 400;
        }

        .search-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .search-clear-btn {
            background: none;
            border: none;
            color: #6b7280;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-clear-btn:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .search-divider {
            width: 1px;
            height: 24px;
            background: #e5e7eb;
        }

        .search-btn {
            background: linear-gradient(45deg, var(--orange-500), var(--amber-500));
            border: none;
            color: white;
            padding: 1rem 1.5rem;
            font-weight: 600;
            border-radius: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .search-btn:hover {
            transform: scale(1.05);
            color: white;
            box-shadow: 0 10px 20px rgba(249, 115, 22, 0.3);
        }

        .search-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .search-btn:hover::before {
            left: 100%;
        }

        /* Enhanced Search Dropdown */
        .search-dropdown {
            top: calc(100% + 0.5rem);
            z-index: 1050;
            border: 2px solid #f1f5f9;
            max-height: 70vh;
            overflow-y: auto;
            animation: search-dropdown-show 0.3s ease-out;
        }

        .search-dropdown-header {
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .search-results-count {
            font-size: 0.75rem;
            background: var(--orange-500) !important;
        }

        .search-dropdown-body {
            max-height: 400px;
            overflow-y: auto;
        }

        .suggestion-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: all 0.2s ease;
            gap: 1rem;
        }

        .suggestion-item:hover {
            background: linear-gradient(135deg, rgba(249, 115, 22, 0.05), rgba(251, 191, 36, 0.05));
            border-color: var(--orange-500);
        }

        .suggestion-item:last-child {
            border-bottom: none;
        }

        .suggestion-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, rgba(249, 115, 22, 0.1), rgba(251, 191, 36, 0.1));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--orange-500);
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .suggestion-item:hover .suggestion-icon {
            background: linear-gradient(135deg, var(--orange-500), var(--amber-500));
            color: white;
            transform: scale(1.1);
        }

        .suggestion-content {
            flex: 1;
            min-width: 0;
        }

        .suggestion-title {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.25rem;
            font-size: 0.95rem;
        }

        .suggestion-description {
            color: #6b7280;
            font-size: 0.85rem;
            line-height: 1.3;
        }

        .suggestion-badge {
            flex-shrink: 0;
        }

        .search-dropdown-footer {
            position: sticky;
            bottom: 0;
            backdrop-filter: blur(10px);
        }

        .search-overlay {
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.1);
            z-index: 1040;
            backdrop-filter: blur(2px);
        }

        .no-results svg {
            opacity: 0.5;
        }

        /* Search States */
        .search-loading-state .search-input {
            background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%);
            background-size: 200% 100%;
            animation: loading-shimmer 1.5s infinite;
        }

        /* Search Focus Ring */
        .search-input:focus {
            position: relative;
        }

        .search-input:focus::after {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: inherit;
            padding: 2px;
            background: linear-gradient(45deg, var(--orange-500), var(--amber-500));
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: subtract;
        }

        /* Responsive Search */
        @media (max-width: 768px) {
            .search-wrapper {
                max-width: 100%;
            }
            
            .search-input-wrapper {
                padding: 0.25rem;
            }
            
            .search-icon-left {
                padding: 0.75rem;
            }
            
            .search-input {
                padding: 1rem 0;
                font-size: 1rem;
            }
            
            .search-btn {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }
            
            .search-dropdown {
                margin: 0 1rem;
                width: calc(100% - 2rem);
            }
        }

        .btn-primary-custom {
            background: linear-gradient(45deg, var(--orange-500), var(--amber-500));
            border: none;
            color: white;
            padding: 1.2rem 2.5rem;
            font-weight: 700;
            border-radius: 1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary-custom:hover {
            transform: scale(1.05) translateY(-2px);
            color: white;
            box-shadow: 0 15px 25px rgba(249, 115, 22, 0.3);
        }

        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-primary-custom:hover::before {
            left: 100%;
        }

        /* Enhanced Quick Links */
        .badge-quick-link {
            background: rgba(255, 255, 255, 0.95);
            color: var(--orange-600);
            border: 2px solid rgba(249, 115, 22, 0.2);
            padding: 0.8rem 1.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .badge-quick-link:hover {
            background: var(--orange-500);
            color: white;
            border-color: var(--orange-500);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(249, 115, 22, 0.3);
        }

        .badge-quick-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .badge-quick-link:hover::before {
            left: 100%;
        }

        /* Floating Elements */
        .floating-icon {
            position: absolute;
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--orange-500);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .floating-icon-1 {
            top: 15%;
            left: 10%;
            animation: float-1 6s ease-in-out infinite;
        }

        .floating-icon-2 {
            top: 25%;
            right: 15%;
            animation: float-2 8s ease-in-out infinite;
        }

        .floating-icon-3 {
            bottom: 20%;
            left: 8%;
            animation: float-3 7s ease-in-out infinite;
        }

        /* Enhanced Blobs */
        .help-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.4;
            mix-blend-mode: multiply;
        }

        .help-blob-1 {
            top: 2rem;
            left: 1rem;
            width: 18rem;
            height: 18rem;
            background: linear-gradient(135deg, #fed7aa, #fdba74);
            animation: blob-float 20s ease-in-out infinite;
        }

        .help-blob-2 {
            bottom: 2rem;
            right: 1rem;
            width: 22rem;
            height: 22rem;
            background: linear-gradient(135deg, #fdba74, #fbbf24);
            animation: blob-float 20s ease-in-out infinite reverse;
            animation-delay: 2s;
        }

        .help-blob-3 {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 16rem;
            height: 16rem;
            background: linear-gradient(135deg, #fbbf24, #fed7aa);
            animation: blob-float 25s ease-in-out infinite;
            animation-delay: 4s;
        }

        /* Scroll Indicator */
        .scroll-indicator {
            margin-bottom: 2rem;
        }

        .scroll-arrow-help {
            width: 30px;
            height: 50px;
            border: 3px solid var(--orange-500);
            border-radius: 25px;
            position: relative;
            animation: bounce-scroll 2s infinite;
        }

        .scroll-arrow-help::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 6px;
            height: 15px;
            background: var(--orange-500);
            border-radius: 3px;
            animation: scroll-down-help 2s infinite;
        }

        /* Background Pattern */
        .bg-pattern {
            background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.2) 1px, transparent 0);
            background-size: 25px 25px;
        }

        /* Enhanced Help Categories */
        .help-categories-section {
            padding: 6rem 0;
            position: relative;
        }

        .category-decoration {
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.2;
        }

        .category-decoration-1 {
            top: 10%;
            left: 5%;
            background: linear-gradient(135deg, var(--blue-500), var(--cyan-500));
            animation: decoration-float 15s ease-in-out infinite;
        }

        .category-decoration-2 {
            bottom: 10%;
            right: 5%;
            background: linear-gradient(135deg, var(--purple-500), var(--pink-500));
            animation: decoration-float 18s ease-in-out infinite reverse;
        }

        .category-title-decoration {
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(45deg, var(--orange-500), var(--amber-500));
            border-radius: 2px;
        }

        .help-category-card {
            background: white;
            border: 2px solid #f1f5f9;
            transition: all 0.4s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .help-category-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            border-color: var(--orange-500);
        }

        .category-glow {
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border-radius: 2rem;
            filter: blur(20px);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .help-category-card:hover .category-glow {
            opacity: 0.6;
        }

        .category-glow-orange { background: linear-gradient(45deg, var(--orange-500), var(--amber-500)); }
        .category-glow-blue { background: linear-gradient(45deg, var(--blue-500), var(--cyan-500)); }
        .category-glow-green { background: linear-gradient(45deg, var(--green-500), var(--emerald-500)); }
        .category-glow-purple { background: linear-gradient(45deg, var(--purple-500), var(--pink-500)); }
        .category-glow-red { background: linear-gradient(45deg, var(--red-500), var(--pink-500)); }
        .category-glow-indigo { background: linear-gradient(45deg, var(--indigo-500), var(--purple-500)); }

        .help-category-icon {
            width: 6rem;
            height: 6rem;
            border-radius: 1.5rem;
            color: white;
            box-shadow: 0 15px 25px -5px rgba(0, 0, 0, 0.15);
            transition: all 0.4s ease;
            position: relative;
        }

        .help-category-icon-orange { background: linear-gradient(135deg, var(--orange-500), var(--amber-500)); }
        .help-category-icon-blue { background: linear-gradient(135deg, var(--blue-500), var(--cyan-500)); }
        .help-category-icon-green { background: linear-gradient(135deg, var(--green-500), var(--emerald-500)); }
        .help-category-icon-purple { background: linear-gradient(135deg, var(--purple-500), var(--pink-500)); }
        .help-category-icon-red { background: linear-gradient(135deg, var(--red-500), var(--pink-500)); }
        .help-category-icon-indigo { background: linear-gradient(135deg, var(--indigo-500), var(--purple-500)); }

        .help-category-card:hover .help-category-icon {
            transform: scale(1.15) rotate(5deg);
            box-shadow: 0 25px 35px -5px rgba(0, 0, 0, 0.2);
        }

        .category-pulse {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 16px;
            height: 16px;
            background: var(--green-500);
            border-radius: 50%;
            animation: pulse-glow 2s infinite;
        }

        .category-progress {
            width: 100%;
            height: 4px;
            background: #f1f5f9;
            border-radius: 2px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            border-radius: 2px;
            animation: progress-fill 2s ease-out;
        }

        .progress-bar-orange { 
            background: linear-gradient(90deg, var(--orange-500), var(--amber-500)); 
            width: 85%;
        }
        .progress-bar-blue { 
            background: linear-gradient(90deg, var(--blue-500), var(--cyan-500)); 
            width: 92%;
        }
        .progress-bar-green { 
            background: linear-gradient(90deg, var(--green-500), var(--emerald-500)); 
            width: 78%;
        }
        .progress-bar-purple { 
            background: linear-gradient(90deg, var(--purple-500), var(--pink-500)); 
            width: 95%;
        }
        .progress-bar-red { 
            background: linear-gradient(90deg, var(--red-500), var(--pink-500)); 
            width: 65%;
        }
        .progress-bar-indigo { 
            background: linear-gradient(90deg, var(--indigo-500), var(--purple-500)); 
            width: 70%;
        }

        /* Popular Articles Enhanced */
        .popular-articles-section {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            padding: 6rem 0;
            position: relative;
        }

        .popular-article-card {
            background: white;
            border: 2px solid #f1f5f9;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .popular-article-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 30px -5px rgba(0, 0, 0, 0.15);
            border-color: var(--orange-500);
        }

        .popular-article-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(249, 115, 22, 0.05), transparent);
            transition: left 0.6s ease;
        }

        .popular-article-card:hover::before {
            left: 100%;
        }

        .badge-number {
            background: linear-gradient(135deg, var(--orange-500), var(--amber-500));
            color: white;
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.3rem;
            box-shadow: 0 8px 16px rgba(249, 115, 22, 0.3);
            transition: all 0.3s ease;
        }

        .popular-article-card:hover .badge-number {
            transform: scale(1.1);
        }

        /* Enhanced Contact Support */
        .contact-support-section {
            padding: 6rem 0;
            position: relative;
        }

        .support-decoration {
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            filter: blur(50px);
            opacity: 0.3;
        }

        .support-decoration-1 {
            top: 15%;
            left: 8%;
            background: linear-gradient(135deg, var(--green-500), var(--emerald-500));
            animation: decoration-float 12s ease-in-out infinite;
        }

        .support-decoration-2 {
            bottom: 15%;
            right: 8%;
            background: linear-gradient(135deg, var(--blue-500), var(--cyan-500));
            animation: decoration-float 16s ease-in-out infinite reverse;
        }

        .help-heart {
            display: inline-block;
            animation: heart-beat 2s ease-in-out infinite;
        }

        .support-option {
            background: linear-gradient(135deg, #f9fafb, #ffffff);
            border: 2px solid #f1f5f9;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .support-option:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 30px -5px rgba(0, 0, 0, 0.15);
            border-color: var(--orange-500);
        }

        .support-glow {
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border-radius: 1.5rem;
            filter: blur(20px);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .support-option:hover .support-glow {
            opacity: 0.5;
        }

        .support-glow-chat { background: linear-gradient(45deg, var(--blue-500), var(--cyan-500)); }
        .support-glow-email { background: linear-gradient(45deg, var(--green-500), var(--emerald-500)); }
        .support-glow-phone { background: linear-gradient(45deg, var(--purple-500), var(--pink-500)); }

        .support-icon {
            width: 5rem;
            height: 5rem;
            border-radius: 1.5rem;
            color: white;
            transition: all 0.4s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .support-icon-chat { background: linear-gradient(135deg, var(--blue-500), var(--cyan-500)); }
        .support-icon-email { background: linear-gradient(135deg, var(--green-500), var(--emerald-500)); }
        .support-icon-phone { background: linear-gradient(135deg, var(--purple-500), var(--pink-500)); }

        .support-option:hover .support-icon {
            transform: scale(1.15) rotate(-5deg);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.2);
        }

        .support-indicator {
            position: absolute;
            top: -3px;
            right: -3px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 3px solid white;
        }

        .support-indicator-online { 
            background: var(--green-500); 
            animation: pulse-glow 2s infinite;
        }
        .support-indicator-email { 
            background: var(--blue-500); 
            animation: pulse-glow 2s infinite;
        }
        .support-indicator-phone { 
            background: var(--yellow-500); 
            animation: pulse-glow 2s infinite;
        }

        .online-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            background: var(--green-500);
            border-radius: 50%;
            margin-right: 0.5rem;
            animation: pulse-glow 1.5s infinite;
        }

        .support-btn {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .support-btn:hover {
            transform: translateY(-2px);
        }

        .support-stats {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            padding: 2rem;
            border-radius: 1rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
        }

        /* Animation Delays */
        .animation-delay-100 { animation-delay: 0.1s; }
        .animation-delay-200 { animation-delay: 0.2s; }
        .animation-delay-300 { animation-delay: 0.3s; }
        .animation-delay-400 { animation-delay: 0.4s; }
        .animation-delay-500 { animation-delay: 0.5s; }
        .animation-delay-600 { animation-delay: 0.6s; }
        .animation-delay-900 { animation-delay: 0.9s; }

        /* FAQ Section */
        .faq-section {
            background: linear-gradient(135deg, #fef9e7 0%, #fef3c7 50%, #fef9e7 100%);
            padding: 6rem 0;
        }

        .faq-decoration {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.3;
        }

        .faq-decoration-1 {
            top: 10%;
            left: 5%;
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, var(--orange-500), var(--amber-500));
            animation: decoration-float 20s ease-in-out infinite;
        }

        .faq-decoration-2 {
            bottom: 20%;
            right: 8%;
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, var(--blue-500), var(--cyan-500));
            animation: decoration-float 25s ease-in-out infinite reverse;
        }

        .faq-decoration-3 {
            top: 50%;
            left: 20%;
            width: 180px;
            height: 180px;
            background: linear-gradient(135deg, var(--purple-500), var(--pink-500));
            animation: decoration-float 30s ease-in-out infinite;
            animation-delay: 5s;
        }

        .faq-icon {
            display: inline-block;
            animation: faq-wiggle 3s ease-in-out infinite;
            margin-left: 0.5rem;
        }

        .faq-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .faq-item {
            background: white;
            border: 2px solid #f1f5f9;
            border-radius: 1.5rem;
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: all 0.4s ease;
            position: relative;
        }

        .faq-item:hover {
            border-color: var(--orange-500);
            box-shadow: 0 15px 30px rgba(249, 115, 22, 0.1);
            transform: translateY(-2px);
        }

        .faq-question {
            padding: 2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .faq-question:hover {
            background: rgba(249, 115, 22, 0.02);
        }

        .faq-icon-wrapper {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--orange-500), var(--amber-500));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .faq-item:hover .faq-icon-wrapper {
            transform: scale(1.1) rotate(5deg);
        }

        .faq-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
            flex-grow: 1;
        }

        .faq-badge {
            background: var(--green-500);
            color: white;
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .faq-answer {
            border-top: 1px solid #f1f5f9;
        }

        .faq-content {
            padding: 2rem;
            color: #4b5563;
            line-height: 1.6;
        }

        .faq-list {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 1rem;
            border-left: 4px solid var(--orange-500);
        }

        .faq-helpful {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 0.75rem;
        }

        .fee-breakdown {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 1rem;
            margin: 1rem 0;
        }

        .fee-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .fee-item:last-child {
            border-bottom: none;
        }

        .fee-label {
            font-weight: 600;
            color: #374151;
        }

        .fee-value {
            font-weight: 700;
            color: var(--orange-600);
        }

        .payment-timeline {
            margin: 1.5rem 0;
        }

        .timeline-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .timeline-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 20px;
            top: 50px;
            width: 2px;
            height: 30px;
            background: linear-gradient(to bottom, var(--orange-500), var(--amber-500));
        }

        .timeline-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--orange-500), var(--amber-500));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .timeline-content h4 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .feature-card {
            background: white;
            padding: 1.5rem;
            border-radius: 1rem;
            text-center;
            border: 2px solid #f1f5f9;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            border-color: var(--orange-500);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(249, 115, 22, 0.1);
        }

        .feature-icon {
            color: var(--orange-500);
            margin-bottom: 1rem;
        }

        .feature-card h4 {
            font-size: 1rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .policy-steps {
            margin: 1.5rem 0;
        }

        .step-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 1rem;
            border-left: 4px solid var(--orange-500);
        }

        .step-number {
            width: 32px;
            height: 32px;
            background: var(--orange-500);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .step-content h4 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .faq-footer {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            padding: 2rem;
        }

        /* Resource Center Section */
        .resource-center-section {
            padding: 6rem 0;
        }

        .resource-icon {
            display: inline-block;
            animation: resource-bounce 2s ease-in-out infinite;
            margin-left: 0.5rem;
        }

        .resource-card {
            background: white;
            border: 2px solid #f1f5f9;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .resource-card:hover {
            border-color: var(--orange-500);
            transform: translateY(-8px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
        }

        .resource-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(249, 115, 22, 0.05), transparent);
            transition: left 0.6s ease;
        }

        .resource-card:hover::before {
            left: 100%;
        }

        .resource-icon-wrapper {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(249, 115, 22, 0.1), rgba(251, 191, 36, 0.1));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            transition: all 0.4s ease;
        }

        .resource-card:hover .resource-icon-wrapper {
            transform: scale(1.1) rotate(5deg);
            background: linear-gradient(135deg, var(--orange-500), var(--amber-500));
        }

        .resource-svg {
            color: var(--orange-500);
            transition: all 0.4s ease;
        }

        .resource-card:hover .resource-svg {
            color: white;
        }

        /* Collapsed/Expanded states for FAQ */
        .faq-question[aria-expanded="true"] .faq-plus {
            display: none;
        }

        .faq-question[aria-expanded="true"] .faq-minus {
            display: block !important;
        }

        .faq-question[aria-expanded="true"] .faq-icon-wrapper {
            background: linear-gradient(135deg, var(--green-500), var(--emerald-500));
        }

        /* Custom color variations */
        .bg-purple-subtle { background-color: rgba(139, 92, 246, 0.1); }
        .text-purple { color: var(--purple-500); }

        /* Animations */
        @keyframes pulse-glow {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.1); }
        }

        @keyframes gradient-shift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes scale-x {
            0% { transform: scaleX(0); }
            100% { transform: scaleX(1); }
        }

        @keyframes sparkle {
            0%, 100% { transform: scale(1) rotate(0deg); opacity: 1; }
            50% { transform: scale(1.2) rotate(180deg); opacity: 0.8; }
        }

        @keyframes float-1 {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @keyframes float-2 {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(180deg); }
        }

        @keyframes float-3 {
            0%, 100% { transform: translateX(0px); }
            50% { transform: translateX(15px); }
        }

        @keyframes blob-float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -30px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }

        @keyframes bounce-scroll {
            0%, 20%, 53%, 80%, 100% { transform: translate3d(0, 0, 0); }
            40%, 43% { transform: translate3d(0, -10px, 0); }
            70% { transform: translate3d(0, -5px, 0); }
            90% { transform: translate3d(0, -2px, 0); }
        }

        @keyframes scroll-down-help {
            0% { opacity: 0; transform: translateX(-50%) translateY(0); }
            50% { opacity: 1; }
            100% { opacity: 0; transform: translateX(-50%) translateY(20px); }
        }

        @keyframes decoration-float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(20px, -25px) scale(1.05); }
            66% { transform: translate(-15px, 15px) scale(0.95); }
        }

        @keyframes progress-fill {
            0% { width: 0%; }
            100% { width: var(--progress-width, 100%); }
        }

        @keyframes heart-beat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        @keyframes animate-fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes animate-slide-up {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes faq-wiggle {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-5deg); }
            75% { transform: rotate(5deg); }
        }

        @keyframes resource-bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        @keyframes search-dropdown-show {
            0% { 
                opacity: 0; 
                transform: translateY(-10px) scale(0.95); 
            }
            100% { 
                opacity: 1; 
                transform: translateY(0) scale(1); 
            }
        }

        @keyframes loading-shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .animate-fade-in {
            animation: animate-fade-in 0.6s ease-out forwards;
        }

        .animate-slide-up {
            animation: animate-slide-up 0.8s ease-out forwards;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .help-title {
                font-size: 3rem;
            }
            
            .help-blob {
                width: 12rem;
                height: 12rem;
            }
            
            .floating-icon {
                width: 40px;
                height: 40px;
            }
            
            .help-category-icon, .support-icon {
                width: 4rem;
                height: 4rem;
            }
            
            .badge-number {
                width: 2.5rem;
                height: 2.5rem;
                font-size: 1.1rem;
            }
        }
        
        /* Enhanced Help Categories Section */
        .help-categories-section {
            position: relative;
            background: linear-gradient(135deg, #fefefe 0%, #f8fafc 100%);
            overflow: hidden;
        }

        /* Enhanced Category Badge */
        .category-badge {
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(20px);
            border: 2px solid rgba(249, 115, 22, 0.2);
            border-radius: 50px;
            color: var(--orange-600);
            font-weight: 600;
            box-shadow: 0 8px 32px rgba(249, 115, 22, 0.1);
            transition: all 0.3s ease;
        }

        .category-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(249, 115, 22, 0.15);
        }

        .category-status-pulse {
            width: 10px;
            height: 10px;
            background: var(--green-500);
            border-radius: 50%;
            animation: pulse-glow 2s infinite;
            position: relative;
        }

        .category-status-pulse::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border-radius: 50%;
            background: var(--green-500);
            opacity: 0.3;
            animation: ring-expand 2s infinite;
        }

        /* Enhanced Title */
        .category-title-decoration {
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(45deg, var(--orange-500), var(--amber-500));
            border-radius: 2px;
            animation: width-expand 1s ease 1s forwards;
        }

        .title-sparkles {
            position: absolute;
            top: -20px;
            right: -30px;
        }

        .sparkle {
            position: absolute;
            font-size: 1.2rem;
            animation: sparkle-float 3s ease-in-out infinite;
        }

        .sparkle-1 { animation-delay: 0s; }
        .sparkle-2 { animation-delay: 1s; top: 10px; right: 15px; }
        .sparkle-3 { animation-delay: 2s; top: -10px; right: 30px; }

        /* Category Filter Tabs */
        .category-filters {
            margin-bottom: 3rem;
        }

        .filter-btn {
            background: white;
            border: 2px solid #e5e7eb;
            color: #6b7280;
            padding: 0.75rem 1.5rem;
            border-radius: 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .filter-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: left 0.5s ease;
        }

        .filter-btn:hover::before {
            left: 100%;
        }

        .filter-btn:hover {
            border-color: var(--orange-400);
            color: var(--orange-600);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(249, 115, 22, 0.15);
        }

        .filter-btn.active {
            background: linear-gradient(45deg, var(--orange-500), var(--amber-500));
            border-color: var(--orange-500);
            color: white;
            box-shadow: 0 8px 25px rgba(249, 115, 22, 0.3);
        }

        /* Enhanced Category Cards */
        .help-category-card {
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .help-category-card:hover {
            transform: translateY(-15px) rotateX(5deg) rotateY(5deg);
        }

        .category-content {
            background: white;
            border: 2px solid #f1f5f9;
            transition: all 0.4s ease;
            position: relative;
            z-index: 10;
            backdrop-filter: blur(20px);
        }

        .help-category-card:hover .category-content {
            border-color: rgba(249, 115, 22, 0.3);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        /* Enhanced Category Glows */
        .category-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 200px;
            height: 200px;
            border-radius: 50%;
            opacity: 0;
            transition: all 0.4s ease;
            z-index: 1;
        }

        .help-category-card:hover .category-glow {
            opacity: 0.1;
            transform: translate(-50%, -50%) scale(1.5);
        }

        .category-glow-orange { background: radial-gradient(circle, var(--orange-500), transparent); }
        .category-glow-blue { background: radial-gradient(circle, var(--blue-500), transparent); }
        .category-glow-green { background: radial-gradient(circle, var(--green-500), transparent); }
        .category-glow-purple { background: radial-gradient(circle, var(--purple-500), transparent); }
        .category-glow-red { background: radial-gradient(circle, var(--red-500), transparent); }
        .category-glow-indigo { background: radial-gradient(circle, var(--indigo-500), transparent); }

        /* Category Mesh Background */
        .category-mesh {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0;
            transition: all 0.4s ease;
            background-size: 30px 30px;
            background-image: 
                linear-gradient(to right, rgba(255,255,255,0.1) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255,255,255,0.1) 1px, transparent 1px);
            border-radius: 1rem;
        }

        .help-category-card:hover .category-mesh {
            opacity: 0.3;
        }

        /* Category Shine Effect */
        .category-shine {
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: translateX(-100%) translateY(-100%) rotate(45deg);
            transition: transform 0.6s ease;
        }

        .help-category-card:hover .category-shine {
            transform: translateX(100%) translateY(100%) rotate(45deg);
        }

        /* Enhanced Category Icons */
        .category-icon-section {
            position: relative;
        }

        .help-category-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid #f1f5f9;
            transition: all 0.4s ease;
            position: relative;
            background: white;
        }

        .help-category-card:hover .help-category-icon {
            transform: scale(1.1) rotateY(180deg);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .category-svg {
            transition: all 0.4s ease;
        }

        .help-category-card:hover .category-svg {
            transform: scale(1.2);
        }

        /* Enhanced Icon Colors */
        .help-category-icon-orange { border-color: #fed7aa; color: var(--orange-600); }
        .help-category-icon-blue { border-color: #bfdbfe; color: var(--blue-600); }
        .help-category-icon-green { border-color: #bbf7d0; color: var(--green-600); }
        .help-category-icon-purple { border-color: #ddd6fe; color: var(--purple-600); }
        .help-category-icon-red { border-color: #fecaca; color: var(--red-600); }
        .help-category-icon-indigo { border-color: #c7d2fe; color: var(--indigo-600); }

        .help-category-card:hover .help-category-icon-orange { border-color: var(--orange-400); }
        .help-category-card:hover .help-category-icon-blue { border-color: var(--blue-400); }
        .help-category-card:hover .help-category-icon-green { border-color: var(--green-400); }
        .help-category-card:hover .help-category-icon-purple { border-color: var(--purple-400); }
        .help-category-card:hover .help-category-icon-red { border-color: var(--red-400); }
        .help-category-card:hover .help-category-icon-indigo { border-color: var(--indigo-400); }

        /* Icon Rings */
        .icon-ring {
            position: absolute;
            border: 2px solid;
            border-radius: 50%;
            opacity: 0;
            transition: all 0.4s ease;
        }

        .icon-ring-1 {
            top: -15px; left: -15px; right: -15px; bottom: -15px;
            border-color: currentColor;
        }

        .icon-ring-2 {
            top: -25px; left: -25px; right: -25px; bottom: -25px;
            border-color: currentColor;
        }

        .help-category-card:hover .icon-ring-1 {
            opacity: 0.3;
            transform: scale(1.2);
        }

        .help-category-card:hover .icon-ring-2 {
            opacity: 0.1;
            transform: scale(1.4);
        }

        /* Enhanced Category Pulse */
        .category-pulse {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 20px;
            height: 20px;
            background: var(--green-500);
            border-radius: 50%;
            animation: pulse-ring 2s infinite;
        }

        /* Category Level Badges */
        .category-level-badge {
            margin-top: 1rem;
        }

        .category-level-badge .badge {
            font-size: 0.75rem;
            padding: 0.4rem 0.8rem;
            border-radius: 1rem;
        }

        /* Enhanced Category Text */
        .category-title {
            transition: all 0.3s ease;
            position: relative;
        }

        .help-category-card:hover .category-title {
            transform: translateY(-2px);
        }

        .category-description {
            line-height: 1.6;
            transition: all 0.3s ease;
        }

        .help-category-card:hover .category-description {
            color: #374151;
        }

        /* Enhanced Statistics */
        .category-stats {
            background: rgba(248, 250, 252, 0.5);
            border-radius: 1rem;
            padding: 1rem;
            margin: 0 -0.5rem;
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
        }

        .help-category-card:hover .category-stats {
            background: rgba(255, 255, 255, 0.8);
            border-color: rgba(249, 115, 22, 0.2);
        }

        .stats-row {
            gap: 1rem;
        }

        .articles-count, .completion-rate {
            text-align: center;
        }

        .count-number, .rate-number {
            font-size: 1.5rem;
            display: block;
        }

        .count-label, .rate-label {
            font-size: 0.8rem;
            display: block;
            margin-top: 0.2rem;
        }

        /* Color Classes */
        .text-orange { color: var(--orange-600) !important; }
        .text-blue { color: var(--blue-600) !important; }
        .text-green { color: var(--green-600) !important; }
        .text-purple { color: var(--purple-600) !important; }
        .text-red { color: var(--red-600) !important; }
        .text-indigo { color: var(--indigo-600) !important; }

        /* Badge Color Variants */
        .bg-orange-subtle { background-color: #fed7aa; }
        .bg-blue-subtle { background-color: #bfdbfe; }
        .bg-green-subtle { background-color: #bbf7d0; }
        .bg-purple-subtle { background-color: #ddd6fe; }
        .bg-red-subtle { background-color: #fecaca; }
        .bg-indigo-subtle { background-color: #c7d2fe; }

        /* Enhanced Progress Bars */
        .category-progress {
            margin-top: 1rem;
        }

        .progress-track {
            height: 6px;
            background: #e5e7eb;
            border-radius: 3px;
            overflow: hidden;
            position: relative;
        }

        .progress-bar {
            height: 100%;
            border-radius: 3px;
            position: relative;
            transition: all 0.8s ease;
            background-size: 20px 20px;
            background-image: linear-gradient(45deg, rgba(255,255,255,0.2) 25%, transparent 25%, transparent 50%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0.2) 75%, transparent 75%, transparent);
            animation: progress-shine 2s linear infinite;
        }

        .progress-bar-orange { background-color: var(--orange-500); }
        .progress-bar-blue { background-color: var(--blue-500); }
        .progress-bar-green { background-color: var(--green-500); }
        .progress-bar-purple { background-color: var(--purple-500); }
        .progress-bar-red { background-color: var(--red-500); }
        .progress-bar-indigo { background-color: var(--indigo-500); }

        .progress-label {
            margin-top: 0.5rem;
            text-align: center;
        }

        /* Enhanced Action Buttons */
        .btn-category {
            background: linear-gradient(45deg, #6b7280, #9ca3af);
            border: none;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
        }

        .btn-category::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-category:hover::before {
            left: 100%;
        }

        .btn-category:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            color: white;
        }

        .btn-arrow {
            transition: transform 0.3s ease;
        }

        .btn-category:hover .btn-arrow {
            transform: translateX(3px);
        }

        /* Button Color Variants */
        .btn-orange { background: linear-gradient(45deg, var(--orange-500), var(--amber-500)); }
        .btn-blue { background: linear-gradient(45deg, var(--blue-500), var(--cyan-500)); }
        .btn-green { background: linear-gradient(45deg, var(--green-500), var(--emerald-500)); }
        .btn-purple { background: linear-gradient(45deg, var(--purple-500), var(--pink-500)); }
        .btn-red { background: linear-gradient(45deg, var(--red-500), var(--pink-500)); }
        .btn-indigo { background: linear-gradient(45deg, var(--indigo-500), var(--blue-500)); }

        .btn-orange:hover { box-shadow: 0 10px 20px rgba(249, 115, 22, 0.3); }
        .btn-blue:hover { box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3); }
        .btn-green:hover { box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3); }
        .btn-purple:hover { box-shadow: 0 10px 20px rgba(139, 92, 246, 0.3); }
        .btn-red:hover { box-shadow: 0 10px 20px rgba(239, 68, 68, 0.3); }
        .btn-indigo:hover { box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3); }

        /* Category Summary Stats */
        .category-summary-stats {
            background: rgba(248, 250, 252, 0.5);
            border-radius: 1.5rem;
            padding: 2rem 1rem;
            margin-top: 3rem;
        }

        .stat-card {
            background: white;
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
            transition: left 0.5s ease;
        }

        .stat-card:hover::before {
            left: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: rgba(249, 115, 22, 0.2);
        }

        .stat-icon {
            transition: all 0.3s ease;
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.2);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 900;
            color: #1f2937;
        }

        /* Floating Particles */
        .floating-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: var(--orange-400);
            border-radius: 50%;
            opacity: 0.6;
            animation: float-particle 20s infinite linear;
        }

        .particle-1 { left: 10%; animation-delay: 0s; }
        .particle-2 { left: 30%; animation-delay: 4s; }
        .particle-3 { left: 50%; animation-delay: 8s; }
        .particle-4 { left: 70%; animation-delay: 12s; }
        .particle-5 { left: 90%; animation-delay: 16s; }

        /* Enhanced Decorative Elements */
        .category-decoration {
            position: absolute;
            border-radius: 50%;
            opacity: 0.05;
            z-index: 1;
        }

        .category-decoration-1 {
            top: 10%;
            left: -5%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, var(--orange-500), transparent);
            animation: float-decoration 20s ease-in-out infinite;
        }

        .category-decoration-2 {
            bottom: 10%;
            right: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, var(--blue-500), transparent);
            animation: float-decoration 25s ease-in-out infinite reverse;
        }

        .category-decoration-3 {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, var(--purple-500), transparent);
            animation: pulse-decoration 15s ease-in-out infinite;
        }

        /* Enhanced Keyframe Animations */
        @keyframes sparkle-float {
            0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 1; }
            50% { transform: translateY(-10px) rotate(180deg); opacity: 0.7; }
        }

        @keyframes ring-expand {
            0% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.5); opacity: 0.2; }
            100% { transform: scale(2); opacity: 0; }
        }

        @keyframes width-expand {
            0% { width: 0; }
            100% { width: 100px; }
        }

        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 1; }
            50% { transform: scale(1.2); opacity: 0.7; }
            100% { transform: scale(1.6); opacity: 0; }
        }

        @keyframes progress-shine {
            0% { background-position: -20px 0; }
            100% { background-position: 20px 0; }
        }

        @keyframes float-particle {
            0% { transform: translateY(100vh) translateX(0px); opacity: 0; }
            10% { opacity: 0.6; }
            90% { opacity: 0.6; }
            100% { transform: translateY(-100px) translateX(50px); opacity: 0; }
        }

        @keyframes float-decoration {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            33% { transform: translateY(-20px) translateX(10px); }
            66% { transform: translateY(10px) translateX(-10px); }
        }

        @keyframes pulse-decoration {
            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.05; }
            50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.1; }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .help-category-card:hover {
                transform: translateY(-8px);
            }

            .filter-btn {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }

            .category-filters {
                gap: 0.5rem;
            }

            .help-category-icon {
                width: 60px;
                height: 60px;
            }

            .title-sparkles {
                display: none;
            }

            .stat-card {
                margin-bottom: 1rem;
            }
        }
    </style>

    <!-- Enhanced Interactive JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search elements
            const searchInput = document.getElementById('helpSearch');
            const searchBtn = document.getElementById('searchBtn');
            const clearBtn = document.getElementById('clearSearch');
            const searchResults = document.getElementById('searchResults');
            const searchOverlay = document.getElementById('searchOverlay');
            const viewAllBtn = document.getElementById('viewAllResults');
            
            // Search data
            const searchData = [
                {
                    title: 'Getting started with selling',
                    description: 'Learn the basics of setting up your seller account',
                    category: 'getting-started',
                    badge: { text: 'Popular', class: 'bg-success-subtle text-success' },
                    icon: 'M13 10V3L4 14h7v7l9-11h-7z',
                    keywords: ['getting', 'started', 'begin', 'setup', 'account', 'new', 'seller']
                },
                {
                    title: 'How to list products',
                    description: 'Step-by-step guide to creating product listings',
                    category: 'products',
                    badge: { text: 'Guide', class: 'bg-info-subtle text-info' },
                    icon: 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
                    keywords: ['list', 'product', 'listing', 'create', 'add', 'upload', 'inventory']
                },
                {
                    title: 'Payment processing',
                    description: 'Understanding fees and payment methods',
                    category: 'payments',
                    badge: { text: 'Important', class: 'bg-warning-subtle text-warning' },
                    icon: 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z',
                    keywords: ['payment', 'fees', 'money', 'payout', 'transaction', 'billing']
                },
                {
                    title: 'Shipping guidelines',
                    description: 'Best practices for shipping and delivery',
                    category: 'shipping',
                    badge: { text: 'Guide', class: 'bg-primary-subtle text-primary' },
                    icon: 'M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4',
                    keywords: ['shipping', 'delivery', 'ship', 'package', 'fulfillment', 'logistics']
                },
                {
                    title: 'Account settings',
                    description: 'Manage your seller account preferences',
                    category: 'account',
                    badge: { text: 'Settings', class: 'bg-secondary-subtle text-secondary' },
                    icon: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
                    keywords: ['account', 'settings', 'profile', 'preferences', 'manage', 'configure']
                },
                {
                    title: 'Sales analytics',
                    description: 'Understanding your sales data and reports',
                    category: 'analytics',
                    badge: { text: 'Advanced', class: 'bg-purple-subtle text-purple' },
                    icon: 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                    keywords: ['analytics', 'sales', 'data', 'reports', 'statistics', 'performance']
                }
            ];
            
            let searchTimeout;
            let isSearchOpen = false;
            
            // Initialize search
            if (searchInput && searchBtn) {
                // Input event with debouncing
                searchInput.addEventListener('input', function(e) {
                    clearTimeout(searchTimeout);
                    const query = e.target.value.trim();
                    
                    // Show/hide clear button
                    if (query.length > 0) {
                        clearBtn.classList.remove('d-none');
                    } else {
                        clearBtn.classList.add('d-none');
                        hideSearchResults();
                        return;
                    }
                    
                    // Debounce search
                    searchTimeout = setTimeout(() => {
                        if (query.length >= 2) {
                            performSearch(query);
                        } else {
                            hideSearchResults();
                        }
                    }, 300);
                });
                
                // Search button click
                searchBtn.addEventListener('click', function() {
                    const query = searchInput.value.trim();
                    if (query.length > 0) {
                        executeSearch(query);
                    }
                });
                
                // Enter key search
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const query = this.value.trim();
                        if (query.length > 0) {
                            executeSearch(query);
                        }
                    }
                });
                
                // Clear button
                clearBtn.addEventListener('click', function() {
                    searchInput.value = '';
                    clearBtn.classList.add('d-none');
                    hideSearchResults();
                    searchInput.focus();
                });
                
                // Focus/blur events
                searchInput.addEventListener('focus', function() {
                    const query = this.value.trim();
                    if (query.length >= 2) {
                        performSearch(query);
                    }
                });
                
                // Close search on escape
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && isSearchOpen) {
                        hideSearchResults();
                    }
                });
                
                // Overlay click
                searchOverlay.addEventListener('click', function() {
                    hideSearchResults();
                });
                
                // View all results
                viewAllBtn.addEventListener('click', function() {
                    const query = searchInput.value.trim();
                    showNotification(`Showing all results for "${query}"`, 'info');
                    hideSearchResults();
                });
            }
            
            // Search function
            function performSearch(query) {
                const results = searchData.filter(item => {
                    const searchTerm = query.toLowerCase();
                    return item.keywords.some(keyword => keyword.includes(searchTerm)) ||
                           item.title.toLowerCase().includes(searchTerm) ||
                           item.description.toLowerCase().includes(searchTerm);
                });
                
                showSearchResults(results, query);
            }
            
            // Execute search with loading
            function executeSearch(query) {
                const searchText = searchBtn.querySelector('.search-text');
                const searchLoading = searchBtn.querySelector('.search-loading');
                
                searchText.classList.add('d-none');
                searchLoading.classList.remove('d-none');
                
                // Add loading state to input
                searchInput.classList.add('search-loading-state');
                
                setTimeout(() => {
                    searchText.classList.remove('d-none');
                    searchLoading.classList.add('d-none');
                    searchInput.classList.remove('search-loading-state');
                    
                    const results = searchData.filter(item => {
                        const searchTerm = query.toLowerCase();
                        return item.keywords.some(keyword => keyword.includes(searchTerm)) ||
                               item.title.toLowerCase().includes(searchTerm) ||
                               item.description.toLowerCase().includes(searchTerm);
                    });
                    
                    showNotification(`Found ${results.length} result(s) for "${query}"`, 'success');
                    hideSearchResults();
                }, 1500);
            }
            
            // Show search results
            function showSearchResults(results, query) {
                const dropdown = searchResults.querySelector('.search-dropdown-body');
                const countBadge = searchResults.querySelector('.search-results-count');
                const noResults = searchResults.querySelector('.no-results');
                const footer = searchResults.querySelector('.search-dropdown-footer');
                
                if (results.length === 0) {
                    dropdown.classList.add('d-none');
                    footer.classList.add('d-none');
                    noResults.classList.remove('d-none');
                } else {
                    dropdown.classList.remove('d-none');
                    footer.classList.remove('d-none');
                    noResults.classList.add('d-none');
                    
                    // Update count
                    countBadge.textContent = `${results.length} result${results.length !== 1 ? 's' : ''}`;
                    
                    // Render results
                    dropdown.innerHTML = results.map(item => `
                        <div class="suggestion-item" data-category="${item.category}">
                            <div class="suggestion-icon">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${item.icon}"/>
                                </svg>
                            </div>
                            <div class="suggestion-content">
                                <div class="suggestion-title">${highlightText(item.title, query)}</div>
                                <div class="suggestion-description">${highlightText(item.description, query)}</div>
                            </div>
                            <div class="suggestion-badge">
                                <span class="badge ${item.badge.class}">${item.badge.text}</span>
                            </div>
                        </div>
                    `).join('');
                    
                    // Add click handlers to new suggestions
                    dropdown.querySelectorAll('.suggestion-item').forEach(item => {
                        item.addEventListener('click', function() {
                            const title = this.querySelector('.suggestion-title').textContent;
                            searchInput.value = title;
                            hideSearchResults();
                            showNotification(`Selected: ${title}`, 'info');
                        });
                    });
                }
                
                searchResults.classList.remove('d-none');
                searchOverlay.classList.remove('d-none');
                isSearchOpen = true;
            }
            
            // Hide search results
            function hideSearchResults() {
                searchResults.classList.add('d-none');
                searchOverlay.classList.add('d-none');
                isSearchOpen = false;
            }
            
            // Highlight search terms
            function highlightText(text, query) {
                if (!query || query.length < 2) return text;
                const regex = new RegExp(`(${query})`, 'gi');
                return text.replace(regex, '<mark class="bg-warning-subtle">$1</mark>');
            }
            
            // Support button interactions
            document.querySelectorAll('.support-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    simulateLoading(this);
                });
            });
            
            // Quick link interactions
            document.querySelectorAll('.badge-quick-link').forEach(link => {
                link.addEventListener('click', function() {
                    const term = this.textContent.trim();
                    searchInput.value = term;
                    executeSearch(term);
                });
            });

            // Category Filter Functionality
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const filter = this.getAttribute('data-filter');
                    
                    // Update active state
                    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Filter categories
                    const categories = document.querySelectorAll('[data-category]');
                    categories.forEach(category => {
                        const categoryCol = category.closest('.col-md-6, .col-lg-4');
                        if (filter === 'all' || category.getAttribute('data-category') === filter) {
                            categoryCol.style.display = 'block';
                            setTimeout(() => {
                                categoryCol.style.opacity = '1';
                                categoryCol.style.transform = 'translateY(0)';
                            }, 100);
                        } else {
                            categoryCol.style.opacity = '0';
                            categoryCol.style.transform = 'translateY(20px)';
                            setTimeout(() => {
                                categoryCol.style.display = 'none';
                            }, 300);
                        }
                    });
                    
                    // Show notification
                    const filterText = this.textContent.trim();
                    showNotification(`Showing ${filterText} categories`, 'info');
                });
            });

            // Enhanced Category Card Interactions
            document.querySelectorAll('.btn-category').forEach(btn => {
                btn.addEventListener('click', function() {
                    const categoryTitle = this.closest('.help-category-card').querySelector('.category-title').textContent;
                    simulateLoading(this);
                    
                    setTimeout(() => {
                        showNotification(`Opening ${categoryTitle} help section...`, 'success');
                    }, 1500);
                });
            });

            // Add 3D tilt effect to category cards
            document.querySelectorAll('[data-tilt]').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transformStyle = 'preserve-3d';
                });
                
                card.addEventListener('mousemove', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    const rotateX = (y - centerY) / 10;
                    const rotateY = (centerX - x) / 10;
                    
                    this.style.transform = `translateY(-15px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) rotateX(0) rotateY(0)';
                });
            });

            // FAQ interactions
            document.querySelectorAll('.faq-question').forEach(question => {
                question.addEventListener('click', function() {
                    const target = this.getAttribute('data-bs-target');
                    const collapse = document.querySelector(target);
                    const plus = this.querySelector('.faq-plus');
                    const minus = this.querySelector('.faq-minus');
                    
                    // Toggle icons
                    setTimeout(() => {
                        if (collapse && collapse.classList.contains('show')) {
                            if (plus) plus.classList.add('d-none');
                            if (minus) minus.classList.remove('d-none');
                        } else {
                            if (plus) plus.classList.remove('d-none');
                            if (minus) minus.classList.add('d-none');
                        }
                    }, 100);
                });
            });
        });
        
        function simulateLoading(btn) {
            const btnText = btn.querySelector('.btn-text');
            const btnLoading = btn.querySelector('.btn-loading');
            
            if (btnText && btnLoading) {
                btnText.classList.add('d-none');
                btnLoading.classList.remove('d-none');
                
                setTimeout(() => {
                    btnText.classList.remove('d-none');
                    btnLoading.classList.add('d-none');
                    
                    const action = btnText.textContent;
                    showNotification(`${action} initiated successfully!`, 'info');
                }, 1200);
            }
        }
        
        function showPhoneNumber() {
            showNotification('Phone: +1 (555) 123-4567 - Available Mon-Fri, 9AM-6PM', 'info');
        }
        
        function markHelpful(btn, isHelpful) {
            const feedbackText = isHelpful ? 'Thank you for your feedback!' : 'We\'ll work to improve this article.';
            showNotification(feedbackText, isHelpful ? 'success' : 'info');
            
            // Disable both buttons
            const container = btn.closest('.faq-helpful');
            if (container) {
                container.querySelectorAll('button').forEach(button => {
                    button.disabled = true;
                    button.classList.add('opacity-50');
                });
                
                // Show thank you message
                const thankYou = document.createElement('span');
                thankYou.className = 'text-success fw-bold ms-2';
                thankYou.textContent = '✓ Thanks!';
                container.appendChild(thankYou);
            }
        }
        
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; max-width: 400px; animation: slideInRight 0.3s ease-out;';
            notification.innerHTML = `
                <div class="d-flex align-items-center">
                    <svg class="me-2" width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        ${type === 'success' ? '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>' :
                          type === 'info' ? '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>' :
                          '<path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>'}
                    </svg>
                    <span>${message}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 4000);
        }
    </script>
@endsection
