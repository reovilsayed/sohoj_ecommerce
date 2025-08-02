@extends('layouts.app')
@section('content')
@section('title', 'About AfrikArtt - Authentic African Art Marketplace')
<x-app.header />
<style>
    .page-hero {
        background: var(--accent-color);
        color: var(--text-light);
        box-shadow: var(--shadow-medium);
        padding: 2rem 2.5rem 1.5rem 2.5rem;
        margin-bottom: 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .page-hero::after {
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

    .page-hero h1,
    .page-hero p,
    .page-hero-breadcrumb {
        position: relative;
        z-index: 1;
    }

    .page-content {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .page-content h1, .page-content h2, .page-content h3 {
        color: #2d3748;
        margin-bottom: 1rem;
    }

    .page-content p {
        color: #4a5568;
        line-height: 1.7;
        margin-bottom: 1rem;
    }

    .page-content ul, .page-content ol {
        color: #4a5568;
        line-height: 1.7;
        margin-bottom: 1rem;
        padding-left: 2rem;
    }

    .page-content blockquote {
        border-left: 4px solid var(--accent-color);
        background: #f7fafc;
        padding: 1rem 1.5rem;
        margin: 1.5rem 0;
        border-radius: 0 8px 8px 0;
    }

    .page-meta {
        background: #f7fafc;
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
        color: #718096;
    }

    .feature-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin: 2rem 0;
    }

    .feature-card {
        background: #f7fafc;
        padding: 1.5rem;
        border-radius: 12px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        background: var(--accent-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 1.5rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }

    .stat-card {
        background: linear-gradient(135deg, var(--accent-color), #2d3748);
        color: white;
        padding: 1.5rem;
        border-radius: 12px;
        text-align: center;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }
</style>

<div class="container py-5" style="padding-top: 5rem !important;">
    <!-- Page Hero Section -->
    <div class="page-hero mb-4 position-relative">
        <h1 class="fw-bold mb-1 text-light">About AfrikArtt</h1>
        <p class="mb-0">Connecting the world with authentic African art and talented artists</p>
        <div class="page-hero-breadcrumb d-none d-md-flex position-absolute end-0 top-0 h-100 align-items-center pe-4">
            <span class="badge bg-light text-primary me-2">
                <i class="fas fa-home me-1"></i>Home
            </span>
            <i class="fas fa-chevron-right text-light mx-2"></i>
            <span class="badge bg-light text-primary">About Us</span>
        </div>
    </div>

    <!-- Page Content -->
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <!-- Page Meta Information -->
            <div class="page-meta">
                <div class="meta-left">
                    <span><i class="fas fa-calendar-alt me-1"></i>Established: 2020</span>
                </div>
                <div class="meta-right">
                    <span><i class="fas fa-globe me-1"></i>Serving customers worldwide</span>
                </div>
            </div>

            <!-- Page Content -->
            <div class="page-content">
                <h1>Welcome to AfrikArtt - Your Premier African Art Marketplace</h1>
                
                <p>AfrikArtt.com is a leading multi-vendor marketplace dedicated to showcasing and selling authentic African art from talented artists across the continent. Our platform connects art enthusiasts worldwide with the rich cultural heritage and contemporary creativity of Africa.</p>

                <h2>Our Mission</h2>
                <p>We believe that African art deserves a global stage. Our mission is to provide African artists with a platform to share their incredible talents with the world while offering art lovers access to genuine, high-quality pieces that tell the stories of Africa's diverse cultures.</p>

                <blockquote>
                    "Art is the signature of civilizations. At AfrikArtt, we celebrate the vibrant civilizations of Africa through authentic artistic expressions that have been passed down through generations and continue to evolve today."
                </blockquote>

                <h2>Why Choose AfrikArtt?</h2>
                
                <div class="feature-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h4>Authentic Artworks</h4>
                        <p>Every piece is verified for authenticity and comes with a certificate of origin from our partner artists.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Multi-Vendor Platform</h4>
                        <p>Browse artworks from hundreds of verified African artists and art dealers across the continent.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <h4>Global Shipping</h4>
                        <p>We safely deliver authentic African art to customers in over 50 countries worldwide.</p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h4>Direct Artist Support</h4>
                        <p>Your purchases directly support African artists and their communities, promoting cultural preservation.</p>
                    </div>
                </div>

                <h2>Our Marketplace Statistics</h2>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Verified Artists</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-number">10,000+</div>
                        <div class="stat-label">Authentic Artworks</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Countries Served</div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-number">25,000+</div>
                        <div class="stat-label">Happy Customers</div>
                    </div>
                </div>

                <h2>What We Offer</h2>
                <ul>
                    <li><strong>Traditional African Art:</strong> Masks, sculptures, textiles, and ceremonial pieces</li>
                    <li><strong>Contemporary African Art:</strong> Modern paintings, mixed media, and innovative artistic expressions</li>
                    <li><strong>Cultural Artifacts:</strong> Authentic pieces with historical and cultural significance</li>
                    <li><strong>Custom Commissions:</strong> Work directly with artists to create personalized pieces</li>
                    <li><strong>Art Consultation:</strong> Expert guidance on building your African art collection</li>
                </ul>

                <h2>Our Commitment to Artists</h2>
                <p>AfrikArtt is more than just a marketplace - we're a community. We provide our vendor artists with:</p>
                <ul>
                    <li>Fair commission rates and transparent pricing</li>
                    <li>Marketing support to reach global audiences</li>
                    <li>Secure payment processing and timely payouts</li>
                    <li>Artist spotlight features and promotional opportunities</li>
                    <li>Educational resources on digital marketing and e-commerce</li>
                </ul>

                <h2>Quality Assurance</h2>
                <p>Every artwork on AfrikArtt goes through our rigorous verification process:</p>
                <ol>
                    <li><strong>Artist Verification:</strong> We verify the identity and credentials of all our vendor artists</li>
                    <li><strong>Authenticity Check:</strong> Each piece is examined for authenticity and cultural accuracy</li>
                    <li><strong>Quality Assessment:</strong> We ensure all artworks meet our high standards for craftsmanship</li>
                    <li><strong>Documentation:</strong> Every piece comes with proper documentation and provenance</li>
                </ol>

                <h2>Join the AfrikArtt Community</h2>
                <p>Whether you're an art collector, cultural enthusiast, or someone who appreciates the beauty of African creativity, AfrikArtt welcomes you to explore our diverse collection. Experience the richness of African culture through authentic artworks created by talented artists who pour their heritage, stories, and passion into every piece.</p>

                <p><strong>Visit us at:</strong> <a href="https://afrikartt.com" target="_blank" style="color: var(--accent-color);">https://afrikartt.com</a></p>
            </div>

            <!-- Page Footer -->
            <div class="page-footer mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="page-contact-info p-3 bg-light rounded">
                            <h6 class="mb-2"><i class="fas fa-question-circle me-2"></i>Have Questions?</h6>
                            <p class="mb-1 small">Learn more about our African art collection or artist verification process</p>
                            <a href="{{ route('contact') }}" class="btn btn-sm" style="background: var(--accent-color); color: white;">
                                <i class="fas fa-envelope me-1"></i>Contact Us
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="page-explore-info p-3 bg-light rounded">
                            <h6 class="mb-2"><i class="fas fa-palette me-2"></i>Start Shopping</h6>
                            <p class="mb-1 small">Explore our curated collection of authentic African artworks</p>
                            <a href="{{ route('homepage') }}" class="btn btn-sm" style="background: var(--accent-color); color: white;">
                                <i class="fas fa-shopping-bag me-1"></i>Browse Collection
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
