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
                    <div class="col-md-6 col-lg-4 mb-3" data-category="beginner">
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
                    <div class="col-md-6 col-lg-4 mb-3" data-category="intermediate">
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
                    <div class="col-md-6 col-lg-4 mb-3" data-category="intermediate">
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
                <div class="col-lg-6 mb-3">
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
                
                <div class="col-lg-6 mb-3">
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
                <a href="{{ route('faqs')}}" class="btn btn-lg text-light" style="background: var(--amber-500)">View All Articles</a>
            </div>
        </div>
    </section>

    <!-- Enhanced Contact Support Section -->
    <section class="contact-support-section py-5 bg-gradient-to-br from-gray-50 to-blue-50 position-relative overflow-hidden">
        <!-- Advanced Background Decorations -->
        <div class="support-decoration support-decoration-1"></div>
        <div class="support-decoration support-decoration-2"></div>
        <div class="support-decoration support-decoration-3"></div>
        <div class="support-floating-shapes">
            <div class="floating-shape shape-1"></div>
            <div class="floating-shape shape-2"></div>
            <div class="floating-shape shape-3"></div>
            <div class="floating-shape shape-4"></div>
            <div class="floating-shape shape-5"></div>
        </div>
        
        <!-- Animated Grid Background -->
        <div class="support-grid-background">
            <div class="grid-line grid-line-vertical" style="left: 20%"></div>
            <div class="grid-line grid-line-vertical" style="left: 40%"></div>
            <div class="grid-line grid-line-vertical" style="left: 60%"></div>
            <div class="grid-line grid-line-vertical" style="left: 80%"></div>
            <div class="grid-line grid-line-horizontal" style="top: 20%"></div>
            <div class="grid-line grid-line-horizontal" style="top: 40%"></div>
            <div class="grid-line grid-line-horizontal" style="top: 60%"></div>
            <div class="grid-line grid-line-horizontal" style="top: 80%"></div>
        </div>
        
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <!-- Enhanced Header Section -->
                    <div class="support-header mb-5">
                        <div class="support-badge-wrapper mb-4">
                            <span class="support-main-badge d-inline-flex align-items-center px-4 py-3 animate-fade-in">
                                <div class="support-status-pulse me-3"></div>
                                <svg class="me-2" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <span class="fw-bold">24/7 Premium Support Available</span>
                                <div class="badge-shine"></div>
                            </span>
                        </div>
                        
                        <h2 class="support-title display-4 fw-black mb-4 animate-fade-in position-relative">
                            Still Need Help?
                            <span class="help-heart position-relative">
                                💝
                                <div class="heart-glow"></div>
                            </span>
                            <div class="title-decoration"></div>
                        </h2>
                        
                        <p class="support-subtitle fs-4 text-muted mb-5 animate-fade-in animation-delay-200 position-relative">
                            Our dedicated support team is here to help you succeed every step of the way.
                            <br><span class="text-gradient fw-bold">We're just one click away from solving your problems!</span>
                        </p>
                    </div>
                    
                    <!-- Enhanced Support Options Grid -->
                    <div class="support-options-grid">
                        <div class="row g-4 justify-content-center">
                            <!-- Live Chat Option - Enhanced -->
                            <div class="col-lg-4 col-md-6">
                                <div class="support-option-card support-chat h-100 text-center animate-slide-up animation-delay-300 position-relative" data-tilt>
                                    <!-- Card Effects -->
                                    <div class="card-glow card-glow-chat"></div>
                                    <div class="card-mesh card-mesh-chat"></div>
                                    <div class="card-shine"></div>
                                    <div class="card-border"></div>
                                    
                                    <!-- Card Content -->
                                    <div class="card-content p-5">
                                        <!-- Status Indicator -->
                                        <div class="support-status-indicator mb-3">
                                            <div class="status-dot status-online"></div>
                                            <span class="status-text">Online Now</span>
                                        </div>
                                        
                                        <!-- Icon Section -->
                                        <div class="support-icon-wrapper mb-4 position-relative">
                                            <div class="support-icon support-icon-chat d-flex align-items-center justify-content-center mx-auto position-relative">
                                                <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                                </svg>
                                                <div class="icon-pulse"></div>
                                            </div>
                                            <div class="floating-dots">
                                                <span class="dot dot-1"></span>
                                                <span class="dot dot-2"></span>
                                                <span class="dot dot-3"></span>
                                            </div>
                                        </div>
                                        
                                        <!-- Content -->
                                        <h3 class="support-card-title h4 fw-bold text-dark mb-3">Live Chat Support</h3>
                                        <p class="support-card-description text-muted mb-4">
                                            Get instant help from our expert support team. 
                                            <strong>Average response time: 30 seconds</strong>
                                        </p>
                                        
                                        <!-- Features List -->
                                        <ul class="support-features-list list-unstyled mb-4">
                                            <li class="d-flex align-items-center justify-content-between mb-2">
                                                <svg class="feature-icon me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span class="small text-muted">Instant responses</span>
                                            </li>
                                            <li class="d-flex align-items-center mb-2">
                                                <svg class="feature-icon  justify-content-between me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span class="small text-muted">Screen sharing available</span>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <svg class="feature-icon justify-content-between me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span class="small text-muted">File sharing support</span>
                                            </li>
                                        </ul>
                                        
                                        <!-- Status Badge -->
                                        <div class="support-status-badge mb-4">
                                            <span class="badge bg-success-subtle text-success px-3 py-2">
                                                <span class="online-indicator"></span>
                                                <strong>5 agents online</strong>
                                            </span>
                                        </div>
                                        
                                        <!-- Action Button -->
                                        <button class="btn btn-chat-primary support-btn w-100 position-relative" data-bs-toggle="modal" data-bs-target="#chatModal">
                                            <span class="btn-content">
                                                <svg class="me-2" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                                </svg>
                                                Start Live Chat
                                            </span>
                                            <div class="btn-loading d-none">
                                                <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                                                Connecting...
                                            </div>
                                            <div class="btn-ripple"></div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Email Support Option - Enhanced -->
                            <div class="col-lg-4 col-md-6">
                                <div class="support-option-card support-email h-100 text-center animate-slide-up animation-delay-400 position-relative" data-tilt>
                                    <div class="card-glow card-glow-email"></div>
                                    <div class="card-mesh card-mesh-email"></div>
                                    <div class="card-shine"></div>
                                    <div class="card-border"></div>
                                    
                                    <div class="card-content p-5">
                                        <div class="support-status-indicator mb-3">
                                            <div class="status-dot status-email"></div>
                                            <span class="status-text">Always Available</span>
                                        </div>
                                        
                                        <div class="support-icon-wrapper mb-4 position-relative">
                                            <div class="support-icon support-icon-email d-flex align-items-center justify-content-center mx-auto position-relative">
                                                <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                                <div class="icon-pulse"></div>
                                            </div>
                                            <div class="floating-envelope">
                                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8"/>
                                                </svg>
                                            </div>
                                        </div>
                                        
                                        <h3 class="support-card-title h4 fw-bold text-dark mb-3">Email Support</h3>
                                        <p class="support-card-description text-muted mb-4">
                                            Send detailed inquiries and get comprehensive responses.
                                            <strong>Response within 4 hours</strong>
                                        </p>
                                        
                                        <ul class="support-features-list list-unstyled mb-4">
                                            <li class="d-flex align-items-center mb-2">
                                                <svg class="feature-icon me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span class="small text-muted">Detailed explanations</span>
                                            </li>
                                            <li class="d-flex align-items-center mb-2">
                                                <svg class="feature-icon me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span class="small text-muted">Attachment support</span>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <svg class="feature-icon me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span class="small text-muted">Priority queue available</span>
                                            </li>
                                        </ul>
                                        
                                        <div class="support-status-badge mb-4">
                                            <span class="badge bg-info-subtle text-info px-3 py-2">
                                                <span class="email-indicator"></span>
                                                <strong>Avg 4hr response</strong>
                                            </span>
                                        </div>
                                        
                                        <button class="btn btn-email-primary support-btn w-100 position-relative" data-bs-toggle="modal" data-bs-target="#emailModal">
                                            <span class="btn-content">
                                                <svg class="me-2" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                                Send Email
                                            </span>
                                            <div class="btn-loading d-none">
                                                <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                                                Preparing...
                                            </div>
                                            <div class="btn-ripple"></div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Phone Support Option - Enhanced -->
                            <div class="col-lg-4 col-md-6">
                                <div class="support-option-card support-phone h-100 text-center animate-slide-up animation-delay-500 position-relative" data-tilt>
                                    <div class="card-glow card-glow-phone"></div>
                                    <div class="card-mesh card-mesh-phone"></div>
                                    <div class="card-shine"></div>
                                    <div class="card-border"></div>
                                    
                                    <div class="card-content p-5">
                                        <div class="support-status-indicator mb-3">
                                            <div class="status-dot status-phone"></div>
                                            <span class="status-text">Business Hours</span>
                                        </div>
                                        
                                        <div class="support-icon-wrapper mb-4 position-relative">
                                            <div class="support-icon support-icon-phone d-flex align-items-center justify-content-center mx-auto position-relative">
                                                <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                                <div class="icon-pulse"></div>
                                            </div>
                                            <div class="floating-signal">
                                                <div class="signal-wave signal-wave-1"></div>
                                                <div class="signal-wave signal-wave-2"></div>
                                                <div class="signal-wave signal-wave-3"></div>
                                            </div>
                                        </div>
                                        
                                        <h3 class="support-card-title h4 fw-bold text-dark mb-3">Phone Support</h3>
                                        <p class="support-card-description text-muted mb-4">
                                            Speak directly with our experts for urgent matters.
                                            <strong>Available Mon-Fri, 9AM-6PM EST</strong>
                                        </p>
                                        
                                        <ul class="support-features-list list-unstyled mb-4">
                                            <li class="d-flex align-items-center mb-2">
                                                <svg class="feature-icon me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span class="small text-muted">Direct conversation</span>
                                            </li>
                                            <li class="d-flex align-items-center mb-2">
                                                <svg class="feature-icon me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span class="small text-muted">Complex issue resolution</span>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <svg class="feature-icon me-2" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span class="small text-muted">Escalation support</span>
                                            </li>
                                        </ul>
                                        
                                        <div class="support-status-badge mb-4">
                                            <span class="badge bg-warning-subtle text-warning px-3 py-2">
                                                <span class="phone-indicator"></span>
                                                <strong>Next: 2:30 PM EST</strong>
                                            </span>
                                        </div>
                                        
                                        <button class="btn btn-phone-primary support-btn w-100 position-relative" onclick="showPhoneNumber()">
                                            <span class="btn-content">
                                                <svg class="me-2" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                                Call Now
                                            </span>
                                            <div class="btn-loading d-none">
                                                <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                                                Dialing...
                                            </div>
                                            <div class="btn-ripple"></div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Enhanced Support Statistics -->
                    <div class="support-stats-section mt-5 pt-5 border-top animate-fade-in animation-delay-600">
                        <div class="stats-header text-center mb-4">
                            <h3 class="h5 fw-bold text-dark mb-2">Our Support Performance</h3>
                            <p class="text-muted small">Real-time statistics from our support team</p>
                        </div>
                        
                        <div class="row text-center g-4">
                            <div class="col-md-3 col-6">
                                <div class="stat-card-enhanced h-100 p-4">
                                    <div class="stat-icon-wrapper mb-3">
                                        <div class="stat-icon stat-icon-satisfaction">
                                            <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="stat-number fw-bold text-primary mb-1 position-relative">
                                        <span class="counter" data-target="98">0</span>%
                                        <div class="number-glow"></div>
                                    </div>
                                    <div class="stat-label text-muted small fw-medium">Satisfaction Rate</div>
                                    <div class="stat-trend">
                                        <span class="trend-up">↗ +2.5%</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-6">
                                <div class="stat-card-enhanced h-100 p-4">
                                    <div class="stat-icon-wrapper mb-3">
                                        <div class="stat-icon stat-icon-response">
                                            <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="stat-number fw-bold text-success mb-1 position-relative">
                                        <span class="counter" data-target="2">0</span>h
                                        <div class="number-glow"></div>
                                    </div>
                                    <div class="stat-label text-muted small fw-medium">Avg Response Time</div>
                                    <div class="stat-trend">
                                        <span class="trend-down">↘ -30min</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-6">
                                <div class="stat-card-enhanced h-100 p-4">
                                    <div class="stat-icon-wrapper mb-3">
                                        <div class="stat-icon stat-icon-availability">
                                            <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="stat-number fw-bold text-info mb-1 position-relative">
                                        24/7
                                        <div class="number-glow"></div>
                                    </div>
                                    <div class="stat-label text-muted small fw-medium">Live Chat Available</div>
                                    <div class="stat-trend">
                                        <span class="trend-up">Always Online</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-6">
                                <div class="stat-card-enhanced h-100 p-4">
                                    <div class="stat-icon-wrapper mb-3">
                                        <div class="stat-icon stat-icon-rating">
                                            <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="stat-number fw-bold text-warning mb-1 position-relative">
                                        <span class="counter" data-target="5">0</span>★
                                        <div class="number-glow"></div>
                                    </div>
                                    <div class="stat-label text-muted small fw-medium">Support Rating</div>
                                    <div class="stat-trend">
                                        <span class="trend-up">Excellent</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Floating Action Button for Quick Support -->
        <div class="floating-support-btn d-none d-lg-block">
            <button class="btn-floating" data-bs-toggle="tooltip" data-bs-placement="left" title="Quick Support">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="floating-pulse"></div>
            </button>
        </div>
    </section>

    <!-- Enhanced FAQ Section -->
    <section class="faq-section py-5 position-relative overflow-hidden">
        <!-- Advanced Background Elements -->
        <div class="faq-decoration faq-decoration-1"></div>
        <div class="faq-decoration faq-decoration-2"></div>
        <div class="faq-decoration faq-decoration-3"></div>
        <div class="faq-floating-elements">
            <div class="floating-question floating-question-1">❓</div>
            <div class="floating-question floating-question-2">💡</div>
            <div class="floating-question floating-question-3">🔍</div>
            <div class="floating-question floating-question-4">📋</div>
        </div>
        
        <!-- Animated Pattern Background -->
        <div class="faq-pattern-background">
            <div class="pattern-circle pattern-circle-1"></div>
            <div class="pattern-circle pattern-circle-2"></div>
            <div class="pattern-circle pattern-circle-3"></div>
            <div class="pattern-circle pattern-circle-4"></div>
            <div class="pattern-circle pattern-circle-5"></div>
        </div>
        
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <!-- Enhanced Header -->
                    <div class="faq-header-badge mb-4">
                        <span class="faq-main-badge d-inline-flex align-items-center px-4 py-3 animate-fade-in">
                            <div class="faq-status-pulse me-3"></div>
                            <svg class="me-2" width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="fw-bold">Instant Answers Available</span>
                            <div class="badge-shimmer"></div>
                        </span>
                    </div>
                    
                    <h2 class="faq-title display-4 fw-black text-dark mb-4 animate-fade-in position-relative">
                        Frequently Asked Questions
                        <span class="faq-icon position-relative">
                            🤔
                            <div class="icon-bounce"></div>
                        </span>
                        <div class="faq-title-decoration"></div>
                    </h2>
                    
                    <p class="faq-subtitle fs-4 text-muted mb-5 animate-fade-in animation-delay-200">
                        Get instant answers to the most common seller questions.
                        <br><span class="text-gradient fw-bold">Everything you need to know in one place!</span>
                    </p>
                    
                    <!-- FAQ Search Bar -->
                    <div class="faq-search-container mb-5 animate-slide-up animation-delay-300">
                        <div class="faq-search-wrapper position-relative">
                            <div class="search-icon-faq position-absolute">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" class="faq-search-input form-control" placeholder="Search frequently asked questions..." id="faqSearch">
                            <div class="search-clear-faq position-absolute d-none" id="faqSearchClear">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                        </div>
                        <div class="search-suggestions mt-2">
                            <span class="suggestion-tag" data-search="product listing">Product Listing</span>
                            <span class="suggestion-tag" data-search="payment fees">Payment & Fees</span>
                            <span class="suggestion-tag" data-search="shipping">Shipping</span>
                            <span class="suggestion-tag" data-search="returns">Returns</span>
                        </div>
                    </div>
                    
                    <!-- FAQ Categories Filter -->
                    <div class="faq-categories mb-5 animate-slide-up animation-delay-400">
                        <div class="category-filters d-flex justify-content-center flex-wrap gap-2">
                            <button class="faq-filter-btn active" data-category="all">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                </svg>
                                All Questions
                            </button>
                            <button class="faq-filter-btn" data-category="getting-started">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                Getting Started
                            </button>
                            <button class="faq-filter-btn" data-category="payments">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                                Payments
                            </button>
                            <button class="faq-filter-btn" data-category="shipping">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                                Shipping
                            </button>
                            <button class="faq-filter-btn" data-category="policies">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="me-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                Policies
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- FAQ Container with Enhanced Design -->
                    <div class="faq-container-enhanced">
                        <!-- FAQ Item 1 - Enhanced -->
                        <div class="faq-item-enhanced animate-slide-up animation-delay-100 mb-3" data-category="getting-started">
                            <div class="faq-card">
                                <div class="faq-question-header" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false">
                                    <div class="question-left">
                                        <div class="faq-icon-wrapper-enhanced">
                                            <svg class="faq-plus-enhanced" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            <svg class="faq-minus-enhanced d-none" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"/>
                                            </svg>
                                            <div class="icon-background"></div>
                                        </div>
                                        <h3 class="faq-title-enhanced">How do I create my first product listing?</h3>
                                    </div>
                                    <div class="question-right">
                                        <span class="faq-badge-enhanced faq-badge-popular">
                                            <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20" class="me-1">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            Popular
                                        </span>
                                        <div class="view-count">
                                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20" class="me-1">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                            </svg>
                                            1.2k views
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="collapse faq-answer-enhanced" id="faq1">
                                    <div class="faq-content-enhanced">
                                        <div class="content-header">
                                            <p class="content-intro">Creating your first product listing is simple! Follow our step-by-step guide:</p>
                                        </div>
                                        
                                        <div class="step-by-step-guide">
                                            <div class="step-item-enhanced">
                                                <div class="step-number-enhanced">1</div>
                                                <div class="step-content-enhanced">
                                                    <h4>Navigate to Dashboard</h4>
                                                    <p>Go to your seller dashboard and click "Add New Product"</p>
                                                </div>
                                                <div class="step-icon">
                                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            
                                            <div class="step-item-enhanced">
                                                <div class="step-number-enhanced">2</div>
                                                <div class="step-content-enhanced">
                                                    <h4>Product Details</h4>
                                                    <p>Fill in title, description, price, and category information</p>
                                                </div>
                                                <div class="step-icon">
                                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            
                                            <div class="step-item-enhanced">
                                                <div class="step-number-enhanced">3</div>
                                                <div class="step-content-enhanced">
                                                    <h4>Upload Images</h4>
                                                    <p>Add high-quality photos showcasing your product</p>
                                                </div>
                                                <div class="step-icon">
                                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            
                                            <div class="step-item-enhanced">
                                                <div class="step-number-enhanced">4</div>
                                                <div class="step-content-enhanced">
                                                    <h4>Set Shipping</h4>
                                                    <p>Configure shipping options and inventory settings</p>
                                                </div>
                                                <div class="step-icon">
                                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                                        <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707L16 7.586A1 1 0 0015.414 7H14z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            
                                            <div class="step-item-enhanced">
                                                <div class="step-number-enhanced">5</div>
                                                <div class="step-content-enhanced">
                                                    <h4>Publish Listing</h4>
                                                    <p>Preview and publish your product to start selling</p>
                                                </div>
                                                <div class="step-icon">
                                                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="content-footer">
                                            <div class="pro-tip">
                                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="me-2">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                                </svg>
                                                <strong>Pro Tip:</strong> Use multiple high-quality images and detailed descriptions to increase your sales!
                                            </div>
                                            
                                            <div class="faq-actions">
                                                <div class="helpful-section">
                                                    <span class="helpful-text">Was this helpful?</span>
                                                    <div class="helpful-buttons">
                                                        <button class="btn-helpful btn-helpful-yes" onclick="markHelpful(this, true)">
                                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                                                            </svg>
                                                            <span class="helpful-count">256</span>
                                                        </button>
                                                        <button class="btn-helpful btn-helpful-no" onclick="markHelpful(this, false)">
                                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.106-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z"/>
                                                            </svg>
                                                            <span class="helpful-count">12</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                                <div class="related-links">
                                                    <a href="#" class="related-link">
                                                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                                        </svg>
                                                        Product Listing Guide
                                                    </a>
                                                    <a href="#" class="related-link">
                                                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                        </svg>
                                                        Video Tutorial
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <!-- FAQ Item 2 - Enhanced -->
                        <div class="faq-item-enhanced animate-slide-up animation-delay-200 mb-3" data-category="payments">
                            <div class="faq-card">
                                <div class="faq-question-header" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false">
                                    <div class="question-left">
                                        <div class="faq-icon-wrapper-enhanced">
                                            <svg class="faq-plus-enhanced" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            <svg class="faq-minus-enhanced d-none" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"/>
                                            </svg>
                                            <div class="icon-background"></div>
                                        </div>
                                        <h3 class="faq-title-enhanced">What are the seller fees on AfrikArt?</h3>
                                    </div>
                                    <div class="question-right">
                                        <span class="faq-badge-enhanced faq-badge-important">
                                            <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20" class="me-1">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                            </svg>
                                            Important
                                        </span>
                                        <div class="view-count">
                                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20" class="me-1">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                            </svg>
                                            987 views
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="collapse faq-answer-enhanced" id="faq2">
                                    <div class="faq-content-enhanced">
                                        <div class="content-header">
                                            <p class="content-intro">AfrikArt maintains a transparent and competitive fee structure:</p>
                                        </div>
                                        
                                        <div class="fee-breakdown-enhanced">
                                            <div class="fee-card">
                                                <div class="fee-icon">
                                                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                                    </svg>
                                                </div>
                                                <div class="fee-details">
                                                    <h4 class="fee-title">Transaction Fee</h4>
                                                    <div class="fee-amount">2.9% + $0.30</div>
                                                    <p class="fee-description">Per successful transaction</p>
                                                </div>
                                            </div>
                                            
                                            <div class="fee-card">
                                                <div class="fee-icon">
                                                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                                    </svg>
                                                </div>
                                                <div class="fee-details">
                                                    <h4 class="fee-title">Listing Fee</h4>
                                                    <div class="fee-amount free">FREE</div>
                                                    <p class="fee-description">No cost to list products</p>
                                                </div>
                                            </div>
                                            
                                            <div class="fee-card">
                                                <div class="fee-icon">
                                                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V6a2 2 0 012-2h2a2 2 0 012 2v1m-6 0h6m-6 0l-.757.757a2 2 0 01-1.414.586H4a2 2 0 01-2-2v-4a2 2 0 012-2h2.343a2 2 0 011.414.586L8 7zm0 0v1a2 2 0 002 2h4a2 2 0 002-2V7m-6 0h6"/>
                                                    </svg>
                                                </div>
                                                <div class="fee-details">
                                                    <h4 class="fee-title">Monthly Fee</h4>
                                                    <div class="fee-amount free">$0</div>
                                                    <p class="fee-description">No monthly subscription</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="fee-calculator">
                                            <h4>Fee Calculator</h4>
                                            <div class="calculator-input">
                                                <label>Sale Amount ($)</label>
                                                <input type="number" class="form-control" placeholder="100.00" id="saleAmount">
                                            </div>
                                            <div class="calculator-result">
                                                <div class="result-row">
                                                    <span>Transaction Fee:</span>
                                                    <span id="transactionFee">$3.20</span>
                                                </div>
                                                <div class="result-row total">
                                                    <span>You Receive:</span>
                                                    <span id="youReceive">$96.80</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="content-footer">
                                            <div class="highlight-box">
                                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="me-2">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                <strong>No Hidden Fees:</strong> You only pay when you make a sale. No setup costs, no monthly fees!
                                            </div>
                                            
                                            <div class="faq-actions">
                                                <div class="helpful-section">
                                                    <span class="helpful-text">Was this helpful?</span>
                                                    <div class="helpful-buttons">
                                                        <button class="btn-helpful btn-helpful-yes" onclick="markHelpful(this, true)">
                                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                                                            </svg>
                                                            <span class="helpful-count">198</span>
                                                        </button>
                                                        <button class="btn-helpful btn-helpful-no" onclick="markHelpful(this, false)">
                                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.106-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z"/>
                                                            </svg>
                                                            <span class="helpful-count">8</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 - Enhanced -->
                        <div class="faq-item-enhanced animate-slide-up animation-delay-300 mb-3" data-category="payments">
                            <div class="faq-card">
                                <div class="faq-question-header" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false">
                                    <div class="question-left">
                                        <div class="faq-icon-wrapper-enhanced">
                                            <svg class="faq-plus-enhanced" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            <svg class="faq-minus-enhanced d-none" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"/>
                                            </svg>
                                            <div class="icon-background"></div>
                                        </div>
                                        <h3 class="faq-title-enhanced">How long does it take to get paid?</h3>
                                    </div>
                                    <div class="question-right">
                                        <span class="faq-badge-enhanced faq-badge-quick">
                                            <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20" class="me-1">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                            Quick Answer
                                        </span>
                                        <div class="view-count">
                                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20" class="me-1">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                            </svg>
                                            756 views
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="collapse faq-answer-enhanced" id="faq3">
                                    <div class="faq-content-enhanced">
                                        <div class="content-header">
                                            <p class="content-intro">Payment processing is fast and reliable. Here's the timeline:</p>
                                        </div>
                                        
                                        <div class="payment-timeline-enhanced">
                                            <div class="timeline-item-enhanced">
                                                <div class="timeline-number">1</div>
                                                <div class="timeline-connector"></div>
                                                <div class="timeline-content">
                                                    <div class="timeline-icon">
                                                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    </div>
                                                    <h4>Order Completion</h4>
                                                    <p>Customer receives and confirms the order</p>
                                                    <span class="timeline-badge">Immediate</span>
                                                </div>
                                            </div>
                                            
                                            <div class="timeline-item-enhanced">
                                                <div class="timeline-number">2</div>
                                                <div class="timeline-connector"></div>
                                                <div class="timeline-content">
                                                    <div class="timeline-icon">
                                                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    </div>
                                                    <h4>Processing Period</h4>
                                                    <p>Payment verification and processing</p>
                                                    <span class="timeline-badge">2-3 business days</span>
                                                </div>
                                            </div>
                                            
                                            <div class="timeline-item-enhanced">
                                                <div class="timeline-number">3</div>
                                                <div class="timeline-content">
                                                    <div class="timeline-icon">
                                                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                                        </svg>
                                                    </div>
                                                    <h4>Payment Transfer</h4>
                                                    <p>Funds transferred to your linked account</p>
                                                    <span class="timeline-badge">Same day</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="payment-methods">
                                            <h4>Supported Payment Methods</h4>
                                            <div class="payment-options">
                                                <div class="payment-option">
                                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                                    </svg>
                                                    <span>Bank Transfer</span>
                                                </div>
                                                <div class="payment-option">
                                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                    </svg>
                                                    <span>PayPal</span>
                                                </div>
                                                <div class="payment-option">
                                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                    </svg>
                                                    <span>Stripe</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="content-footer">
                                            <div class="faq-actions">
                                                <div class="helpful-section">
                                                    <span class="helpful-text">Was this helpful?</span>
                                                    <div class="helpful-buttons">
                                                        <button class="btn-helpful btn-helpful-yes" onclick="markHelpful(this, true)">
                                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                                                            </svg>
                                                            <span class="helpful-count">142</span>
                                                        </button>
                                                        <button class="btn-helpful btn-helpful-no" onclick="markHelpful(this, false)">
                                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.106-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z"/>
                                                            </svg>
                                                            <span class="helpful-count">6</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 4 - Enhanced -->
                        <div class="faq-item-enhanced animate-slide-up animation-delay-400 mb-3" data-category="selling">
                            <div class="faq-card">
                                <div class="faq-question-header" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false">
                                    <div class="question-left">
                                        <div class="faq-icon-wrapper-enhanced">
                                            <svg class="faq-plus-enhanced" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            <svg class="faq-minus-enhanced d-none" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"/>
                                            </svg>
                                            <div class="icon-background"></div>
                                        </div>
                                        <h3 class="faq-title-enhanced">Can I sell internationally?</h3>
                                    </div>
                                    <div class="question-right">
                                        <span class="faq-badge-enhanced faq-badge-new">
                                            <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20" class="me-1">
                                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                                            </svg>
                                            New Feature
                                        </span>
                                        <div class="view-count">
                                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20" class="me-1">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                            </svg>
                                            892 views
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="collapse faq-answer-enhanced" id="faq4">
                                    <div class="faq-content-enhanced">
                                        <div class="content-header">
                                            <p class="content-intro">Yes! AfrikArt supports international selling with comprehensive global commerce features:</p>
                                        </div>
                                        
                                        <div class="international-features">
                                            <div class="feature-grid-enhanced">
                                                <div class="feature-card-enhanced highlight">
                                                    <div class="feature-icon">
                                                        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                    </div>
                                                    <h4>Global Reach</h4>
                                                    <div class="feature-stats">
                                                        <span class="stat-number">195+</span>
                                                        <span class="stat-label">Countries</span>
                                                    </div>
                                                    <p>Ship to customers worldwide with integrated shipping solutions</p>
                                                    <div class="feature-badge">Most Popular</div>
                                                </div>
                                                
                                                <div class="feature-card-enhanced">
                                                    <div class="feature-icon">
                                                        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                                        </svg>
                                                    </div>
                                                    <h4>Multi-Currency</h4>
                                                    <div class="feature-stats">
                                                        <span class="stat-number">25+</span>
                                                        <span class="stat-label">Currencies</span>
                                                    </div>
                                                    <p>Accept payments in local currencies with real-time conversion</p>
                                                </div>
                                                
                                                <div class="feature-card-enhanced">
                                                    <div class="feature-icon">
                                                        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                                        </svg>
                                                    </div>
                                                    <h4>Customs Made Easy</h4>
                                                    <div class="feature-stats">
                                                        <span class="stat-number">100%</span>
                                                        <span class="stat-label">Automated</span>
                                                    </div>
                                                    <p>Auto-generated customs forms and duty calculations</p>
                                                </div>
                                                
                                                <div class="feature-card-enhanced">
                                                    <div class="feature-icon">
                                                        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                        </svg>
                                                    </div>
                                                    <h4>Multilingual Support</h4>
                                                    <div class="feature-stats">
                                                        <span class="stat-number">15+</span>
                                                        <span class="stat-label">Languages</span>
                                                    </div>
                                                    <p>Customer support in multiple languages and time zones</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="shipping-zones">
                                            <h4>Popular Shipping Destinations</h4>
                                            <div class="zones-map">
                                                <div class="zone-item">
                                                    <div class="zone-flag">🇺🇸</div>
                                                    <div class="zone-details">
                                                        <h5>United States</h5>
                                                        <span class="zone-time">3-7 days</span>
                                                        <span class="zone-cost">From $12</span>
                                                    </div>
                                                    <div class="zone-volume">High Volume</div>
                                                </div>
                                                <div class="zone-item">
                                                    <div class="zone-flag">🇬🇧</div>
                                                    <div class="zone-details">
                                                        <h5>United Kingdom</h5>
                                                        <span class="zone-time">5-10 days</span>
                                                        <span class="zone-cost">From $15</span>
                                                    </div>
                                                    <div class="zone-volume">High Volume</div>
                                                </div>
                                                <div class="zone-item">
                                                    <div class="zone-flag">🇨🇦</div>
                                                    <div class="zone-details">
                                                        <h5>Canada</h5>
                                                        <span class="zone-time">4-8 days</span>
                                                        <span class="zone-cost">From $14</span>
                                                    </div>
                                                    <div class="zone-volume">Medium Volume</div>
                                                </div>
                                                <div class="zone-item">
                                                    <div class="zone-flag">🇦🇺</div>
                                                    <div class="zone-details">
                                                        <h5>Australia</h5>
                                                        <span class="zone-time">7-14 days</span>
                                                        <span class="zone-cost">From $18</span>
                                                    </div>
                                                    <div class="zone-volume">Growing</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="content-footer">
                                            <div class="quick-setup">
                                                <h5>Quick Setup Guide:</h5>
                                                <div class="setup-steps">
                                                    <div class="setup-step">
                                                        <span class="step-number">1</span>
                                                        <span class="step-text">Enable international shipping in settings</span>
                                                    </div>
                                                    <div class="setup-step">
                                                        <span class="step-number">2</span>
                                                        <span class="step-text">Set shipping rates for different zones</span>
                                                    </div>
                                                    <div class="setup-step">
                                                        <span class="step-number">3</span>
                                                        <span class="step-text">Configure customs information</span>
                                                    </div>
                                                    <div class="setup-step">
                                                        <span class="step-number">4</span>
                                                        <span class="step-text">Start selling globally!</span>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary btn-sm mt-3">
                                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    </svg>
                                                    Configure International Settings
                                                </button>
                                            </div>
                                            
                                            <div class="faq-actions">
                                                <div class="helpful-section">
                                                    <span class="helpful-text">Was this helpful?</span>
                                                    <div class="helpful-buttons">
                                                        <button class="btn-helpful btn-helpful-yes" onclick="markHelpful(this, true)">
                                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                                                            </svg>
                                                            <span class="helpful-count">167</span>
                                                        </button>
                                                        <button class="btn-helpful btn-helpful-no" onclick="markHelpful(this, false)">
                                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.106-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z"/>
                                                            </svg>
                                                            <span class="helpful-count">5</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 5 - Enhanced -->
                        <div class="faq-item-enhanced animate-slide-up animation-delay-500 mb-3" data-category="account">
                            <div class="faq-card">
                                <div class="faq-question-header" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false">
                                    <div class="question-left">
                                        <div class="faq-icon-wrapper-enhanced">
                                            <svg class="faq-plus-enhanced" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            <svg class="faq-minus-enhanced d-none" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"/>
                                            </svg>
                                            <div class="icon-background"></div>
                                        </div>
                                        <h3 class="faq-title-enhanced">How do I handle returns and refunds?</h3>
                                    </div>
                                    <div class="question-right">
                                        <span class="faq-badge-enhanced faq-badge-policy">
                                            <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20" class="me-1">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                            Policy Guide
                                        </span>
                                        <div class="view-count">
                                            <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20" class="me-1">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                            </svg>
                                            723 views
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="collapse faq-answer-enhanced" id="faq5">
                                    <div class="faq-content-enhanced">
                                        <div class="content-header">
                                            <p class="content-intro">Our comprehensive return policy is designed to be fair for both sellers and buyers. Here's your complete guide:</p>
                                        </div>
                                        
                                        <div class="return-policy-overview">
                                            <div class="policy-highlight">
                                                <div class="policy-icon">
                                                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                                    </svg>
                                                </div>
                                                <div class="policy-content">
                                                    <h4>Seller Protection First</h4>
                                                    <p>You have full control over your return policy while AfrikArt provides dispute resolution support</p>
                                                    <div class="policy-badge">Protected Returns</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="return-process-enhanced">
                                            <h4>Step-by-Step Return Process</h4>
                                            <div class="process-flow">
                                                <div class="process-step">
                                                    <div class="step-indicator">
                                                        <div class="step-number">1</div>
                                                        <div class="step-connector"></div>
                                                    </div>
                                                    <div class="step-content">
                                                        <h5>Policy Setup</h5>
                                                        <p>Define your return window (7-30 days) and specific conditions</p>
                                                        <div class="step-options">
                                                            <span class="option-tag">Return Window</span>
                                                            <span class="option-tag">Conditions</span>
                                                            <span class="option-tag">Exceptions</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="process-step">
                                                    <div class="step-indicator">
                                                        <div class="step-number">2</div>
                                                        <div class="step-connector"></div>
                                                    </div>
                                                    <div class="step-content">
                                                        <h5>Customer Initiates</h5>
                                                        <p>Buyers request returns through our secure platform with required information</p>
                                                        <div class="step-requirements">
                                                            <div class="requirement">
                                                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                                </svg>
                                                                Valid reason required
                                                            </div>
                                                            <div class="requirement">
                                                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                                </svg>
                                                                Photo evidence (if applicable)
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="process-step">
                                                    <div class="step-indicator">
                                                        <div class="step-number">3</div>
                                                        <div class="step-connector"></div>
                                                    </div>
                                                    <div class="step-content">
                                                        <h5>Your Decision</h5>
                                                        <p>Review the request and make an informed decision within 48 hours</p>
                                                        <div class="decision-options">
                                                            <div class="decision-card approve">
                                                                <div class="decision-icon">✓</div>
                                                                <h6>Approve Return</h6>
                                                                <p>Provide return shipping address</p>
                                                            </div>
                                                            <div class="decision-card decline">
                                                                <div class="decision-icon">✗</div>
                                                                <h6>Decline Return</h6>
                                                                <p>Provide clear justification</p>
                                                            </div>
                                                            <div class="decision-card negotiate">
                                                                <div class="decision-icon">💬</div>
                                                                <h6>Negotiate</h6>
                                                                <p>Offer partial refund or exchange</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="process-step">
                                                    <div class="step-indicator">
                                                        <div class="step-number">4</div>
                                                    </div>
                                                    <div class="step-content">
                                                        <h5>Completion</h5>
                                                        <p>Once item is returned, inspect and process refund within 2 business days</p>
                                                        <div class="completion-checklist">
                                                            <div class="checklist-item">
                                                                <span class="check-icon">📦</span>
                                                                <span>Inspect returned item</span>
                                                            </div>
                                                            <div class="checklist-item">
                                                                <span class="check-icon">💰</span>
                                                                <span>Process appropriate refund</span>
                                                            </div>
                                                            <div class="checklist-item">
                                                                <span class="check-icon">📧</span>
                                                                <span>Notify customer of completion</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="return-scenarios">
                                            <h4>Common Return Scenarios</h4>
                                            <div class="scenarios-grid">
                                                <div class="scenario-card valid">
                                                    <div class="scenario-status">
                                                        <span class="status-icon">✓</span>
                                                        <span class="status-text">Valid Return</span>
                                                    </div>
                                                    <h5>Item Not as Described</h5>
                                                    <p>Product significantly differs from listing description or photos</p>
                                                    <div class="scenario-action">Full refund + return shipping paid by seller</div>
                                                </div>
                                                
                                                <div class="scenario-card valid">
                                                    <div class="scenario-status">
                                                        <span class="status-icon">✓</span>
                                                        <span class="status-text">Valid Return</span>
                                                    </div>
                                                    <h5>Damaged in Transit</h5>
                                                    <p>Item arrived broken, cracked, or otherwise damaged during shipping</p>
                                                    <div class="scenario-action">Full refund + insurance claim assistance</div>
                                                </div>
                                                
                                                <div class="scenario-card conditional">
                                                    <div class="scenario-status">
                                                        <span class="status-icon">?</span>
                                                        <span class="status-text">Your Choice</span>
                                                    </div>
                                                    <h5>Wrong Size/Color</h5>
                                                    <p>Customer ordered incorrect size or color variant</p>
                                                    <div class="scenario-action">Seller discretion - customer pays return shipping</div>
                                                </div>
                                                
                                                <div class="scenario-card invalid">
                                                    <div class="scenario-status">
                                                        <span class="status-icon">✗</span>
                                                        <span class="status-text">Invalid Return</span>
                                                    </div>
                                                    <h5>Changed Mind</h5>
                                                    <p>Customer simply doesn't want the item anymore (buyer's remorse)</p>
                                                    <div class="scenario-action">Not covered - seller can decline</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="content-footer">
                                            <div class="policy-tips">
                                                <h5>Pro Tips for Return Management:</h5>
                                                <div class="tips-list">
                                                    <div class="tip-item">
                                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                        </svg>
                                                        <span>Set clear return conditions in your listings</span>
                                                    </div>
                                                    <div class="tip-item">
                                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                        </svg>
                                                        <span>Respond to return requests promptly</span>
                                                    </div>
                                                    <div class="tip-item">
                                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                        </svg>
                                                        <span>Good customer service builds repeat business</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="faq-actions">
                                                <div class="helpful-section">
                                                    <span class="helpful-text">Was this helpful?</span>
                                                    <div class="helpful-buttons">
                                                        <button class="btn-helpful btn-helpful-yes" onclick="markHelpful(this, true)">
                                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"/>
                                                            </svg>
                                                            <span class="helpful-count">134</span>
                                                        </button>
                                                        <button class="btn-helpful btn-helpful-no" onclick="markHelpful(this, false)">
                                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.106-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z"/>
                                                            </svg>
                                                            <span class="helpful-count">7</span>
                                                        </button>
                                                    </div>
                                                </div>
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
                            <a href="#" class="btn btn-primary">
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

        /* ===== ENHANCED CONTACT SUPPORT SECTION STYLES ===== */
        
        /* Background Enhancements */
        .contact-support-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 25%, #cbd5e1 50%, #94a3b8 100%);
            position: relative;
        }
        
        .support-floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }
        
        .floating-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: float-random 20s ease-in-out infinite;
        }
        
        .shape-1 {
            width: 80px;
            height: 80px;
            background: var(--orange-500);
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape-2 {
            width: 120px;
            height: 120px;
            background: var(--blue-500);
            top: 20%;
            right: 15%;
            animation-delay: -5s;
        }
        
        .shape-3 {
            width: 60px;
            height: 60px;
            background: var(--green-500);
            bottom: 30%;
            left: 20%;
            animation-delay: -10s;
        }
        
        .shape-4 {
            width: 100px;
            height: 100px;
            background: var(--purple-500);
            bottom: 20%;
            right: 25%;
            animation-delay: -15s;
        }
        
        .shape-5 {
            width: 70px;
            height: 70px;
            background: var(--pink-500);
            top: 50%;
            left: 50%;
            animation-delay: -7s;
        }
        
        /* Grid Background */
        .support-grid-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.03;
            pointer-events: none;
        }
        
        .grid-line {
            position: absolute;
            background: #1e293b;
        }
        
        .grid-line-vertical {
            width: 1px;
            height: 100%;
            animation: grid-pulse-vertical 8s ease-in-out infinite;
        }
        
        .grid-line-horizontal {
            height: 1px;
            width: 100%;
            animation: grid-pulse-horizontal 8s ease-in-out infinite;
        }
        
        /* Header Enhancements */
        .support-main-badge {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 2px solid rgba(249, 115, 22, 0.2);
            border-radius: 50px;
            color: var(--orange-600);
            font-size: 0.95rem;
            box-shadow: 0 10px 40px rgba(249, 115, 22, 0.15);
            position: relative;
            overflow: hidden;
        }
        
        .support-status-pulse {
            width: 10px;
            height: 10px;
            background: var(--green-500);
            border-radius: 50%;
            animation: pulse-glow 2s infinite;
            position: relative;
        }
        
        .support-status-pulse::after {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            border: 2px solid var(--green-500);
            border-radius: 50%;
            animation: pulse-ring 2s infinite;
        }
        
        .badge-shine {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            animation: badge-shine 3s ease-in-out infinite;
        }
        
        .support-title {
            font-size: 3.5rem;
            color: #1e293b;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .help-heart {
            font-size: 2rem;
            animation: heart-beat 2s ease-in-out infinite;
        }
        
        .heart-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40px;
            height: 40px;
            background: radial-gradient(circle, rgba(249, 115, 22, 0.3), transparent);
            border-radius: 50%;
            animation: heart-glow 2s ease-in-out infinite;
        }
        
        .title-decoration {
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(45deg, var(--orange-500), var(--amber-500));
            border-radius: 2px;
            animation: title-decoration-expand 1s ease-out 0.5s forwards;
            transform-origin: center;
            scale: 0;
        }
        
        .text-gradient {
            background: linear-gradient(45deg, var(--orange-500), var(--amber-500), var(--yellow-500));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            background-size: 200% 200%;
            animation: gradient-shift 3s ease infinite;
        }
        
        /* Card Enhancements */
        .support-option-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        
        .support-option-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        }
        
        .card-glow {
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
        }
        
        .card-glow-chat {
            background: radial-gradient(circle, rgba(59, 130, 246, 0.15), transparent);
        }
        
        .card-glow-email {
            background: radial-gradient(circle, rgba(16, 185, 129, 0.15), transparent);
        }
        
        .card-glow-phone {
            background: radial-gradient(circle, rgba(139, 92, 246, 0.15), transparent);
        }
        
        .support-option-card:hover .card-glow {
            opacity: 1;
        }
        
        .card-mesh {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
        }
        
        .card-mesh-chat {
            background: 
                radial-gradient(circle at 20% 20%, rgba(59, 130, 246, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(59, 130, 246, 0.1) 0%, transparent 50%);
        }
        
        .card-mesh-email {
            background: 
                radial-gradient(circle at 30% 70%, rgba(16, 185, 129, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 70% 30%, rgba(16, 185, 129, 0.1) 0%, transparent 50%);
        }
        
        .card-mesh-phone {
            background: 
                radial-gradient(circle at 40% 60%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 60% 40%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
        }
        
        .support-option-card:hover .card-mesh {
            opacity: 1;
        }
        
        .card-shine {
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s ease;
            pointer-events: none;
        }
        
        .support-option-card:hover .card-shine {
            left: 100%;
        }
        
        .card-border {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 24px;
            padding: 1px;
            background: linear-gradient(45deg, rgba(249, 115, 22, 0.3), rgba(59, 130, 246, 0.3), rgba(16, 185, 129, 0.3));
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: subtract;
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        
        .support-option-card:hover .card-border {
            opacity: 1;
        }
        
        /* Status Indicators */
        .support-status-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            animation: status-pulse 2s infinite;
        }
        
        .status-online {
            background: var(--green-500);
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
        }
        
        .status-email {
            background: var(--blue-500);
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
        }
        
        .status-phone {
            background: var(--orange-500);
            box-shadow: 0 0 10px rgba(249, 115, 22, 0.5);
        }
        
        .status-text {
            color: #64748b;
            font-size: 0.75rem;
        }
        
        /* Icon Enhancements */
        .support-icon-wrapper {
            position: relative;
        }
        
        .support-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            color: white;
            transition: all 0.4s ease;
            position: relative;
            z-index: 2;
        }
        
        .support-icon-chat {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }
        
        .support-icon-email {
            background: linear-gradient(135deg, #10b981, #047857);
        }
        
        .support-icon-phone {
            background: linear-gradient(135deg, #8b5cf6, #6d28d9);
        }
        
        .support-option-card:hover .support-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }
        
        .icon-pulse {
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            border: 2px solid currentColor;
            border-radius: 50%;
            opacity: 0.6;
            animation: icon-pulse 2s infinite;
        }
        
        .floating-dots {
            position: absolute;
            top: -20px;
            right: -20px;
        }
        
        .dot {
            position: absolute;
            width: 4px;
            height: 4px;
            background: var(--orange-500);
            border-radius: 50%;
            animation: floating-dots 3s ease-in-out infinite;
        }
        
        .dot-1 { animation-delay: 0s; }
        .dot-2 { animation-delay: 0.5s; left: 10px; }
        .dot-3 { animation-delay: 1s; left: 5px; top: 10px; }
        
        .floating-envelope {
            position: absolute;
            top: -15px;
            right: -15px;
            color: var(--green-500);
            animation: floating-envelope 4s ease-in-out infinite;
        }
        
        .floating-signal {
            position: absolute;
            top: -20px;
            right: -20px;
        }
        
        .signal-wave {
            position: absolute;
            width: 20px;
            height: 20px;
            border: 2px solid var(--purple-500);
            border-radius: 50%;
            animation: signal-wave 2s ease-in-out infinite;
        }
        
        .signal-wave-1 { animation-delay: 0s; }
        .signal-wave-2 { animation-delay: 0.3s; transform: scale(1.2); }
        .signal-wave-3 { animation-delay: 0.6s; transform: scale(1.4); }
        
        /* Features List */
        .support-features-list {
            text-align: left;
            max-width: 200px;
            margin: 0 auto;
        }
        
        .feature-icon {
            color: var(--green-500);
            flex-shrink: 0;
        }
        
        /* Enhanced Buttons */
        .btn-chat-primary {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-email-primary {
            background: linear-gradient(135deg, #10b981, #047857);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-phone-primary {
            background: linear-gradient(135deg, #8b5cf6, #6d28d9);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .support-btn:hover {
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        .btn-ripple {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.3s ease, height 0.3s ease;
        }
        
        .support-btn:active .btn-ripple {
            width: 200px;
            height: 200px;
        }
        
        /* Enhanced Statistics */
        .stat-card-enhanced {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card-enhanced:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .stat-icon-wrapper {
            position: relative;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            transition: all 0.3s ease;
        }
        
        .stat-icon-satisfaction {
            background: linear-gradient(135deg, #3b82f6, #1e40af);
            color: white;
        }
        
        .stat-icon-response {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }
        
        .stat-icon-availability {
            background: linear-gradient(135deg, #06b6d4, #0891b2);
            color: white;
        }
        
        .stat-icon-rating {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }
        
        .stat-card-enhanced:hover .stat-icon {
            transform: scale(1.1) rotate(10deg);
        }
        
        .counter {
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .number-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.2), transparent);
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .stat-card-enhanced:hover .number-glow {
            opacity: 1;
        }
        
        .stat-trend {
            margin-top: 0.5rem;
            font-size: 0.75rem;
        }
        
        .trend-up {
            color: var(--green-500);
        }
        
        .trend-down {
            color: var(--blue-500);
        }
        
        /* Floating Action Button */
        .floating-support-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
        }
        
        .btn-floating {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }
        
        /* Enhanced FAQ Section Styles */
        .faq-section-enhanced {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            position: relative;
            overflow: hidden;
        }
        
        .faq-container {
            position: relative;
            z-index: 2;
        }
        
        .faq-header-enhanced {
            background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
            border-radius: 24px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .faq-pattern-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.03;
            background-image: 
                radial-gradient(circle at 25% 25%, #3b82f6 2px, transparent 2px),
                radial-gradient(circle at 75% 75%, #8b5cf6 2px, transparent 2px);
            background-size: 40px 40px;
            background-position: 0 0, 20px 20px;
        }
        
        .faq-floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
        }
        
        .faq-floating-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: float-gentle 6s ease-in-out infinite;
        }
        
        .faq-floating-shape:nth-child(1) {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #3b82f6, #8b5cf6);
            top: 20%;
            right: 10%;
            animation-delay: -2s;
        }
        
        .faq-floating-shape:nth-child(2) {
            width: 40px;
            height: 40px;
            background: linear-gradient(45deg, #10b981, #3b82f6);
            top: 60%;
            left: 5%;
            animation-delay: -4s;
        }
        
        .faq-floating-shape:nth-child(3) {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #f59e0b, #ef4444);
            bottom: 10%;
            right: 20%;
            animation-delay: -1s;
        }
        
        .faq-title-enhanced {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #1e293b, #3730a3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
            position: relative;
            line-height: 1.2;
        }
        
        .faq-subtitle-enhanced {
            font-size: 1.25rem;
            color: #64748b;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .faq-search-container {
            position: relative;
            max-width: 500px;
            margin: 0 auto 2rem;
        }
        
        .faq-search-wrapper {
            position: relative;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .faq-search-input {
            width: 100%;
            padding: 1rem 1.5rem 1rem 3.5rem;
            border: none;
            outline: none;
            font-size: 1.1rem;
            background: transparent;
        }
        
        .faq-search-icon {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            z-index: 2;
        }
        
        .faq-categories-enhanced {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .faq-category-btn {
            padding: 0.5rem 1.25rem;
            border: 2px solid #e2e8f0;
            background: white;
            color: #64748b;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .faq-category-btn:hover {
            border-color: #3b82f6;
            color: #3b82f6;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.2);
        }
        
        .faq-category-btn.active {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border-color: transparent;
            color: white;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }
        
        .faq-items-enhanced {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .faq-item-enhanced {
            opacity: 0;
            transform: translateY(20px);
        }
        
        .faq-item-enhanced.animate-slide-up {
            animation: slideUpFade 0.6s ease forwards;
        }
        
        .faq-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.4s ease;
            border: 1px solid transparent;
        }
        
        .faq-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
            border-color: #e2e8f0;
        }
        
        .faq-question-header {
            padding: 1.5rem 2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            transition: all 0.3s ease;
            position: relative;
        }
        
        .faq-question-header:hover {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
        
        .question-left {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex: 1;
        }
        
        .question-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .faq-icon-wrapper-enhanced {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .faq-icon-wrapper-enhanced:hover {
            transform: rotate(90deg);
        }
        
        .faq-plus-enhanced,
        .faq-minus-enhanced {
            color: white;
            transition: all 0.3s ease;
        }
        
        .icon-background {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .faq-icon-wrapper-enhanced:hover .icon-background {
            opacity: 1;
        }
        
        .faq-title-enhanced {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
            line-height: 1.4;
        }
        
        .faq-badge-enhanced {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .faq-badge-popular {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }
        
        .faq-badge-important {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }
        
        .faq-badge-quick {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }
        
        .faq-badge-guide {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white;
        }
        
        .faq-badge-new {
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: white;
        }
        
        .faq-badge-policy {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: white;
        }
        
        .view-count {
            font-size: 0.85rem;
            color: #94a3b8;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .faq-answer-enhanced {
            border-top: 1px solid #f1f5f9;
        }
        
        .faq-content-enhanced {
            padding: 2rem;
        }
        
        .content-header {
            margin-bottom: 1.5rem;
        }
        
        .content-intro {
            font-size: 1.1rem;
            color: #475569;
            margin: 0;
            line-height: 1.6;
        }
        
        /* Step-by-step Guide Styles */
        .setup-steps-enhanced {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .setup-step-enhanced {
            display: flex;
            gap: 1rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 16px;
            border-left: 4px solid #3b82f6;
            transition: all 0.3s ease;
        }
        
        .setup-step-enhanced:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .step-number-enhanced {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        
        .step-content-enhanced {
            flex: 1;
        }
        
        .step-title-enhanced {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 0.5rem 0;
        }
        
        .step-description-enhanced {
            color: #64748b;
            margin: 0;
            line-height: 1.5;
        }
        
        .step-tips {
            margin-top: 0.75rem;
            padding: 0.75rem;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 8px;
            border-left: 3px solid #3b82f6;
        }
        
        .step-tip-label {
            font-weight: 600;
            color: #3b82f6;
            font-size: 0.9rem;
        }
        
        .step-tip-text {
            color: #475569;
            font-size: 0.9rem;
            margin: 0.25rem 0 0 0;
        }
        
        /* Fee Breakdown Enhanced Styles */
        .fee-breakdown-enhanced {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin: 1.5rem 0;
        }
        
        .fee-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .fee-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: left 0.5s ease;
        }
        
        .fee-card:hover::before {
            left: 100%;
        }
        
        .fee-card:hover {
            transform: translateY(-5px);
            border-color: #3b82f6;
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.2);
        }
        
        .fee-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
        }
        
        .fee-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 0.5rem 0;
        }
        
        .fee-amount {
            font-size: 1.5rem;
            font-weight: 700;
            color: #3b82f6;
            margin: 0.5rem 0;
        }
        
        .fee-amount.free {
            color: #10b981;
        }
        
        .fee-description {
            color: #64748b;
            font-size: 0.9rem;
            margin: 0;
        }
        
        /* Fee Calculator Styles */
        .fee-calculator {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 16px;
            padding: 1.5rem;
            margin: 1.5rem 0;
        }
        
        .fee-calculator h4 {
            color: #1e293b;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .calculator-input {
            margin-bottom: 1rem;
        }
        
        .calculator-input label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
        
        .calculator-result {
            background: white;
            border-radius: 12px;
            padding: 1rem;
            border: 2px solid #e2e8f0;
        }
        
        .result-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .result-row:last-child {
            border-bottom: none;
        }
        
        .result-row.total {
            font-weight: 600;
            font-size: 1.1rem;
            color: #3b82f6;
            border-top: 2px solid #e2e8f0;
            margin-top: 0.5rem;
            padding-top: 1rem;
        }
        
        /* Payment Timeline Enhanced Styles */
        .payment-timeline-enhanced {
            position: relative;
            margin: 2rem 0;
        }
        
        .timeline-item-enhanced {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 2rem;
            position: relative;
        }
        
        .timeline-item-enhanced:last-child .timeline-connector {
            display: none;
        }
        
        .timeline-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            flex-shrink: 0;
            z-index: 2;
            position: relative;
        }
        
        .timeline-connector {
            position: absolute;
            left: 19px;
            top: 40px;
            width: 2px;
            height: 100%;
            background: linear-gradient(to bottom, #3b82f6, #8b5cf6);
            opacity: 0.3;
        }
        
        .timeline-content {
            flex: 1;
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .timeline-content:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }
        
        .timeline-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: #3b82f6;
        }
        
        .timeline-content h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 0.5rem 0;
        }
        
        .timeline-content p {
            color: #64748b;
            margin: 0 0 0.75rem 0;
            line-height: 1.5;
        }
        
        .timeline-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        /* Payment Methods Styles */
        .payment-methods {
            margin: 2rem 0;
        }
        
        .payment-methods h4 {
            color: #1e293b;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .payment-options {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .payment-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            color: #374151;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .payment-option:hover {
            border-color: #3b82f6;
            color: #3b82f6;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.2);
        }
        
        /* Optimization Checklist Styles */
        .optimization-checklist {
            margin: 2rem 0;
        }
        
        .checklist-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .checklist-header h4 {
            color: #1e293b;
            margin: 0;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        
        .checklist-progress {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .checklist-items {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .checklist-item {
            display: flex;
            gap: 1rem;
            padding: 1.5rem;
            background: white;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .checklist-item.completed {
            border-color: #10b981;
            background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%);
        }
        
        .checklist-item.pending {
            border-color: #f59e0b;
            background: linear-gradient(135deg, #ffffff 0%, #fffbeb 100%);
        }
        
        .checklist-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .item-checkbox {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .checklist-item.completed .item-checkbox {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }
        
        .checkbox-pending {
            width: 16px;
            height: 16px;
            border: 3px solid #f59e0b;
            border-radius: 50%;
            background: white;
        }
        
        .item-content {
            flex: 1;
        }
        
        .item-content h5 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 0.5rem 0;
        }
        
        .item-content p {
            color: #64748b;
            margin: 0 0 0.75rem 0;
            line-height: 1.5;
        }
        
        .item-tip {
            background: rgba(59, 130, 246, 0.1);
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            margin-top: 0.5rem;
        }
        
        .tip-label {
            font-weight: 600;
            color: #3b82f6;
            font-size: 0.85rem;
        }
        
        .item-example {
            background: rgba(16, 185, 129, 0.1);
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            margin-top: 0.5rem;
        }
        
        .example-label {
            font-weight: 600;
            color: #10b981;
            font-size: 0.85rem;
        }
        
        .item-action {
            margin-top: 0.75rem;
        }
        
        /* Optimization Stats Styles */
        .optimization-stats {
            margin: 2rem 0;
        }
        
        .optimization-stats h4 {
            color: #1e293b;
            margin-bottom: 1.5rem;
            font-weight: 600;
            text-align: center;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            border-color: #3b82f6;
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.2);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #10b981;
            display: block;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #64748b;
            font-weight: 500;
        }
        
        /* International Features Styles */
        .international-features {
            margin: 2rem 0;
        }
        
        .feature-grid-enhanced {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        
        .feature-card-enhanced {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .feature-card-enhanced.highlight {
            border-color: #3b82f6;
            background: linear-gradient(135deg, #ffffff 0%, #dbeafe 100%);
        }
        
        .feature-card-enhanced::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: left 0.5s ease;
        }
        
        .feature-card-enhanced:hover::before {
            left: 100%;
        }
        
        .feature-card-enhanced:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
        }
        
        .feature-card-enhanced h4 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 1rem 0;
        }
        
        .feature-stats {
            margin: 1rem 0;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #3b82f6;
            display: block;
            line-height: 1;
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 500;
        }
        
        .feature-card-enhanced p {
            color: #64748b;
            margin: 0 0 1rem 0;
            line-height: 1.5;
        }
        
        .feature-badge {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            position: absolute;
            top: 1rem;
            right: 1rem;
        }
        
        /* Shipping Zones Styles */
        .shipping-zones {
            margin: 2rem 0;
        }
        
        .shipping-zones h4 {
            color: #1e293b;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        
        .zones-map {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1rem;
        }
        
        .zone-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .zone-item:hover {
            border-color: #3b82f6;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.2);
        }
        
        .zone-flag {
            font-size: 2rem;
            flex-shrink: 0;
        }
        
        .zone-details {
            flex: 1;
        }
        
        .zone-details h5 {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 0.5rem 0;
        }
        
        .zone-time,
        .zone-cost {
            display: block;
            font-size: 0.85rem;
            color: #64748b;
        }
        
        .zone-volume {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        /* Return Process Enhanced Styles */
        .return-process-enhanced {
            margin: 2rem 0;
        }
        
        .return-process-enhanced h4 {
            color: #1e293b;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        
        .process-flow {
            position: relative;
        }
        
        .process-step {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            position: relative;
        }
        
        .process-step:last-child .step-connector {
            display: none;
        }
        
        .step-indicator {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-shrink: 0;
        }
        
        .step-number {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1.2rem;
            z-index: 2;
            position: relative;
        }
        
        .step-connector {
            width: 2px;
            height: 100%;
            background: linear-gradient(to bottom, #3b82f6, #8b5cf6);
            opacity: 0.3;
            margin-top: 1rem;
        }
        
        .step-content {
            flex: 1;
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .step-content:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }
        
        .step-content h5 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 0.75rem 0;
        }
        
        .step-content p {
            color: #64748b;
            margin: 0 0 1rem 0;
            line-height: 1.5;
        }
        
        .step-options {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-top: 0.75rem;
        }
        
        .option-tag {
            background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
            color: #475569;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .step-requirements {
            margin-top: 1rem;
        }
        
        .requirement {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            color: #10b981;
            font-size: 0.9rem;
        }
        
        .decision-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .decision-card {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .decision-card.approve {
            border-color: #10b981;
            background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%);
        }
        
        .decision-card.decline {
            border-color: #ef4444;
            background: linear-gradient(135deg, #ffffff 0%, #fef2f2 100%);
        }
        
        .decision-card.negotiate {
            border-color: #f59e0b;
            background: linear-gradient(135deg, #ffffff 0%, #fffbeb 100%);
        }
        
        .decision-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .decision-icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .decision-card h6 {
            font-size: 0.9rem;
            font-weight: 600;
            margin: 0 0 0.5rem 0;
        }
        
        .decision-card p {
            font-size: 0.8rem;
            color: #64748b;
            margin: 0;
        }
        
        .completion-checklist {
            margin-top: 1rem;
        }
        
        .checklist-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
            padding: 0.5rem;
            background: rgba(59, 130, 246, 0.05);
            border-radius: 8px;
        }
        
        .check-icon {
            font-size: 1.2rem;
        }
        
        /* Return Scenarios Styles */
        .return-scenarios {
            margin: 2rem 0;
        }
        
        .return-scenarios h4 {
            color: #1e293b;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        
        .scenarios-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1rem;
        }
        
        .scenario-card {
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .scenario-card.valid {
            border-color: #10b981;
            background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%);
        }
        
        .scenario-card.conditional {
            border-color: #f59e0b;
            background: linear-gradient(135deg, #ffffff 0%, #fffbeb 100%);
        }
        
        .scenario-card.invalid {
            border-color: #ef4444;
            background: linear-gradient(135deg, #ffffff 0%, #fef2f2 100%);
        }
        
        .scenario-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .scenario-status {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .status-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .scenario-card.valid .status-icon {
            background: #10b981;
            color: white;
        }
        
        .scenario-card.conditional .status-icon {
            background: #f59e0b;
            color: white;
        }
        
        .scenario-card.invalid .status-icon {
            background: #ef4444;
            color: white;
        }
        
        .status-text {
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .scenario-card.valid .status-text {
            color: #10b981;
        }
        
        .scenario-card.conditional .status-text {
            color: #f59e0b;
        }
        
        .scenario-card.invalid .status-text {
            color: #ef4444;
        }
        
        .scenario-card h5 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 0.75rem 0;
        }
        
        .scenario-card p {
            color: #64748b;
            margin: 0 0 1rem 0;
            line-height: 1.5;
        }
        
        .scenario-action {
            background: rgba(0, 0, 0, 0.05);
            padding: 0.75rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #374151;
        }
        
        /* Content Footer Styles */
        .content-footer {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 2px solid #f1f5f9;
        }
        
        .highlight-box {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border: 2px solid #3b82f6;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            color: #1e40af;
        }
        
        .related-links {
            margin-bottom: 1.5rem;
        }
        
        .related-links h5 {
            color: #1e293b;
            margin-bottom: 0.75rem;
            font-weight: 600;
        }
        
        .related-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            color: #3b82f6;
            text-decoration: none;
            margin-right: 0.75rem;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .related-link:hover {
            border-color: #3b82f6;
            background: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.2);
        }
        
        .quick-actions {
            margin-bottom: 1.5rem;
        }
        
        .quick-actions h5 {
            color: #1e293b;
            margin-bottom: 0.75rem;
            font-weight: 600;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }
        
        .quick-setup {
            margin-bottom: 1.5rem;
        }
        
        .quick-setup h5 {
            color: #1e293b;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .setup-steps {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .setup-step {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            padding: 0.5rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .setup-step:last-child {
            margin-bottom: 0;
        }
        
        .setup-step .step-number {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
            flex-shrink: 0;
        }
        
        .setup-step .step-text {
            color: #374151;
            font-size: 0.9rem;
        }
        
        .policy-tips {
            margin-bottom: 1.5rem;
        }
        
        .policy-tips h5 {
            color: #1e293b;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .tips-list {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .tip-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: rgba(59, 130, 246, 0.05);
            border-radius: 8px;
            color: #374151;
            font-size: 0.9rem;
        }
        
        /* FAQ Actions Styles */
        .faq-actions {
            border-top: 1px solid #f1f5f9;
            padding-top: 1.5rem;
        }
        
        .helpful-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }
        
        .helpful-text {
            color: #64748b;
            font-weight: 500;
        }
        
        .helpful-buttons {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-helpful {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border: 2px solid #e2e8f0;
            background: white;
            border-radius: 8px;
            color: #64748b;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        
        .btn-helpful:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .btn-helpful-yes:hover {
            border-color: #10b981;
            color: #10b981;
            background: #f0fdf4;
        }
        
        .btn-helpful-no:hover {
            border-color: #ef4444;
            color: #ef4444;
            background: #fef2f2;
        }
        
        .helpful-count {
            font-weight: 600;
        }
        
        /* Enhanced Animations */
        @keyframes slideUpFade {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes float-gentle {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }
        
        /* Animation Delays */
        .animation-delay-100 { animation-delay: 0.1s; }
        .animation-delay-200 { animation-delay: 0.2s; }
        .animation-delay-300 { animation-delay: 0.3s; }
        .animation-delay-400 { animation-delay: 0.4s; }
        .animation-delay-500 { animation-delay: 0.5s; }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .faq-title-enhanced {
                font-size: 2.5rem;
            }
            
            .faq-categories-enhanced {
                justify-content: flex-start;
                overflow-x: auto;
                padding-bottom: 0.5rem;
            }
            
            .faq-category-btn {
                white-space: nowrap;
            }
            
            .question-right {
                flex-direction: column;
                align-items: flex-end;
                gap: 0.5rem;
            }
            
            .fee-breakdown-enhanced {
                grid-template-columns: 1fr;
            }
            
            .payment-options {
                flex-direction: column;
            }
            
            .feature-grid-enhanced {
                grid-template-columns: 1fr;
            }
            
            .zones-map {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .scenarios-grid {
                grid-template-columns: 1fr;
            }
            
            .decision-options {
                grid-template-columns: 1fr;
            }
            
            .helpful-section {
                flex-direction: column;
                gap: 0.75rem;
            }
        }
        
        @media (max-width: 480px) {
            .faq-question-header {
                padding: 1rem 1.5rem;
            }
            
            .faq-content-enhanced {
                padding: 1.5rem;
            }
            
            .setup-step {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }
            
            .timeline-item-enhanced {
                flex-direction: column;
                text-align: center;
            }
            
            .timeline-connector {
                display: none;
            }
            
            .process-step {
                flex-direction: column;
                text-align: center;
            }
            
            .step-connector {
                display: none;
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
