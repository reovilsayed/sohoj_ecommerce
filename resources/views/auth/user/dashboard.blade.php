@extends('layouts.user_dashboard')

@section('dashboard-content')
    <div class="ec-shop-rightside col-lg-9 col-md-12">
        <!-- Modern User Dashboard -->
        <div class="modern-dashboard-container">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <div class="welcome-card">
                    <div class="welcome-content">
                        <div class="welcome-icon">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div class="welcome-text">
                            <h1 style="color: #ffffff">Welcome back, {{ Auth::user()->name }}!</h1>
                            <p>Manage your account, addresses, and payment methods</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Personal Information Section -->
            <div class="info-section">
                <div class="info-card">
                    <div class="card-header">
                        <h2><i class="fas fa-user"></i> Personal Information</h2>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-user"></i>
                                    <span>Full Name</span>
                                </div>
                                <div class="info-value">{{ Auth::user()->name }}</div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-envelope"></i>
                                    <span>Email Address</span>
                                </div>
                                <div class="info-value">{{ Auth::user()->email }}</div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-phone"></i>
                                    <span>Phone Number</span>
                                </div>
                                <div class="info-value">
                                    @if (Auth::check() && !empty(Auth::user()->phone))
                                        {{ Auth::user()->phone }}
                                    @else
                                        <a href="{{ route('user.update_profile') }}" class="add-phone-link">
                                            <i class="fas fa-plus"></i> Add Phone Number
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seller Account Section -->
            @if (auth()->user()->role_id == 3)
                @if (auth()->user()->shop)
                    <div class="seller-section">
                        <div class="seller-card">
                            <div class="card-header">
                                <h2><i class="fas fa-store"></i> Seller Account</h2>
                            </div>
                            <div class="card-body">
                                <div class="seller-info">
                                    <div class="info-grid">
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="fas fa-store"></i>
                                                <span>Shop Name</span>
                                            </div>
                                            <div class="info-value">{{ Auth::user()->shop->name }}</div>
                                        </div>
                                        
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="fas fa-envelope"></i>
                                                <span>Shop Email</span>
                                            </div>
                                            <div class="info-value">{{ Auth::user()->shop->email }}</div>
                                        </div>
                                        
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="fas fa-phone"></i>
                                                <span>Shop Phone</span>
                                            </div>
                                            <div class="info-value">
                                                @if (Auth::check() && Auth::user()->phone)
                                                    {{ Auth::user()->shop->phone }}
                                                @else
                                                    <span class="text-muted">Not provided</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="info-item full-width">
                                            <div class="info-label">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span>Shop Address</span>
                                            </div>
                                            <div class="info-value">{{ Auth::user()->shop->company_registration }}</div>
                                        </div>
                                    </div>
                                    
                                    <div class="action-buttons">
                                        <a href="{{ route('vendor.shop') }}" class="btn-update">
                                            <i class="fas fa-edit"></i>
                                            Update Shop Info
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="become-seller-section">
                    <div class="seller-card">
                        <div class="card-body">
                            <div class="seller-promo">
                                <div class="promo-icon">
                                    <i class="fas fa-store"></i>
                                </div>
                                <div class="promo-content">
                                    <h3>Become a Seller</h3>
                                    <p>Start selling your products and reach thousands of customers</p>
                                    <a href="{{ route('user.become.seller') }}" class="btn-become-seller">
                                        <i class="fas fa-arrow-right"></i>
                                        Start Selling
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Addresses Section -->
            <div class="addresses-section">
                <div class="addresses-card">
                    <div class="card-header">
                        <h2><i class="fas fa-map-marker-alt"></i> My Addresses</h2>
                        <button class="btn-add-address" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fas fa-plus"></i>
                            Add Address
                        </button>
                    </div>
                    <div class="card-body">
                        @if (Auth()->user()->addresses->count() > 0)
                            <div class="addresses-grid">
                                @foreach (Auth()->user()->addresses as $address)
                                    <div class="address-card">
                                        <div class="address-header">
                                            <span class="address-number">Address {{ $loop->index + 1 }}</span>
                                            <div class="address-actions">
                                                <a href="{{ route('user.address-edit', $address->id) }}" class="btn-edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('user.address.destroy', $address) }}" 
                                                   onclick="return confirm('Are you sure you want to delete this Address?');" 
                                                   class="btn-delete">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="address-content">
                                            <div class="address-details">
                                                <p><strong>{{ $address->country }}, {{ $address->state }}</strong></p>
                                                <p>{{ $address->city }}, {{ $address->address_1 }}</p>
                                                @if($address->address_2)
                                                    <p>{{ $address->address_2 }}</p>
                                                @endif
                                                <p><strong>Postal Code:</strong> {{ $address->post_code }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="no-addresses">
                                <div class="no-addresses-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h3>No Addresses Added</h3>
                                <p>Add your first address to make checkout easier</p>
                                <button class="btn-add-first-address" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fas fa-plus"></i>
                                    Add Your First Address
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Payment Methods Section -->
            <div class="payment-section">
                <div class="payment-card">
                    <div class="card-header">
                        <h2><i class="fas fa-credit-card"></i> Payment Methods</h2>
                    </div>
                    <div class="card-body">
                        <!-- Add New Card -->
                        <div class="add-card-section">
                            <form id="cardAddFrom" action="{{route('user.card.add')}}" method="POST">
                                @csrf
                                <div class="add-card-form">
                                    <div class="form-header">
                                        <h3><i class="fas fa-plus"></i> Add New Card</h3>
                                    </div>
                                    <div class="form-body">
                                        <input id="card-holder-name" type="hidden" value="{{ auth()->user()->name }}">
                                        <input type="hidden" id="paymentmethod" name="payment_method" value="">
                                        
                                        <div class="card-element-container">
                                            <label>Card Details</label>
                                            <div id="card-element"></div>
                                        </div>
                                        
                                        <div class="form-actions">
                                            <button class="btn-add-card" type="button" id="card-button" 
                                                    data-secret="{{ $intent->client_secret }}">
                                                <i class="fas fa-plus"></i>
                                                Add Card
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Existing Cards -->
                        @php
                            $methods = auth()->user()->paymentMethods();
                        @endphp
                        
                        @if($methods->count() > 0)
                            <div class="existing-cards">
                                <h3>Your Cards</h3>
                                <div class="cards-grid">
                                    @foreach ($methods as $payment)
                                        <div class="card-item">
                                            <div class="card-header-info">
                                                <div class="card-brand">
                                                    <i class="fab fa-cc-{{ strtolower($payment->card->brand) }}"></i>
                                                    <span>{{ ucwords($payment->card->brand) }}</span>
                                                </div>
                                                <div class="card-actions">
                                                    <a href="{{ route('user.removeCard', ['method' => $payment->id]) }}" 
                                                       class="btn-remove-card"
                                                       onclick="return confirm('Are you sure you want to remove this card?');">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body-info">
                                                <div class="card-number">
                                                    <span>**** **** **** {{ $payment->card->last4 }}</span>
                                                </div>
                                                <div class="card-details">
                                                    <div class="card-expiry">
                                                        <span>Expires: {{ $payment->card->exp_month }}/{{ $payment->card->exp_year }}</span>
                                                    </div>
                                                    <div class="card-holder">
                                                        <span>{{ $payment->billing_details->name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="no-cards">
                                <div class="no-cards-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <h3>No Cards Added</h3>
                                <p>Add a payment method for faster checkout</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Address Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel">
                        <i class="fas fa-map-marker-alt"></i> Add New Address
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.address.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="inputAddress">Street Address *</label>
                                    <input type="text" name="address_1" value="" required
                                        class="form-control @error('address_1') is-invalid @enderror" 
                                        id="inputAddress" placeholder="Enter your street address">
                                    @error('address_1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="inputAddress2">Address Line 2</label>
                                    <input type="text" name="address_2" placeholder="Apartment, suite, etc. (optional)"
                                        class="form-control @error('address_2') is-invalid @enderror" 
                                        value="" id="inputAddress2">
                                    @error('address_2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country *</label>
                                    <x-country />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>State/Province *</label>
                                    <x-state />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputCity">City *</label>
                                    <input type="text" placeholder="Enter city" required value="" name="city"
                                        class="form-control @error('city') is-invalid @enderror" id="inputCity">
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputPostCode">Postal Code *</label>
                                    <input type="text" required class="form-control @error('post_code') is-invalid @enderror" 
                                        value="" name="post_code" placeholder="Enter postal code" id="inputPostCode">
                                    @error('post_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Address
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
<style>
    /* Modern Dashboard Styles */
    .modern-dashboard-container {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
    }

    /* Welcome Section */
    .welcome-section {
        margin-bottom: 2rem;
    }

    .welcome-card {
        background: linear-gradient(135deg, #3bb77e 0%, #2d9d6b 100%);
        border-radius: 25px;
        padding: 3rem;
        color: white;
        box-shadow: 0 20px 60px rgba(59, 183, 126, 0.3);
        position: relative;
        overflow: hidden;
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="10" cy="60" r="0.5" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="40" r="0.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .welcome-content {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .welcome-icon {
        font-size: 4rem;
        color: rgba(255, 255, 255, 0.9);
        background: rgba(255, 255, 255, 0.1);
        padding: 1.5rem;
        border-radius: 20px;
        backdrop-filter: blur(10px);
    }

    .welcome-text h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .welcome-text p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin: 0;
    }

    /* Info Sections */
    .info-section, .seller-section, .addresses-section, .payment-section {
        margin-bottom: 2rem;
    }

    .info-card, .seller-card, .addresses-card, .payment-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        position: relative;
    }

    .info-card::before, .seller-card::before, .addresses-card::before, .payment-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #3bb77e, #2d9d6b, #1a7a4a);
    }

    .card-header {
        padding: 2rem 2rem 1rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .card-header h2 i {
        color: #3bb77e;
    }

    .card-body {
        padding: 2rem;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .info-item {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 1.5rem;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .info-item:hover {
        background: white;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .info-item.full-width {
        grid-column: 1 / -1;
    }

    .info-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        color: #6c757d;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .info-label i {
        color: #3bb77e;
        width: 20px;
    }

    .info-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .add-phone-link {
        color: #3bb77e;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .add-phone-link:hover {
        color: #2d9d6b;
        transform: translateX(5px);
    }

    /* Seller Section */
    .seller-promo {
        display: flex;
        align-items: center;
        gap: 2rem;
        padding: 2rem;
        background: linear-gradient(135deg, #e8f5e8, #d4edda);
        border-radius: 20px;
        border: 1px solid rgba(59, 183, 126, 0.2);
    }

    .promo-icon {
        font-size: 3rem;
        color: #3bb77e;
        background: white;
        padding: 1.5rem;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(59, 183, 126, 0.2);
    }

    .promo-content h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .promo-content p {
        color: #6c757d;
        margin-bottom: 1.5rem;
    }

    .btn-become-seller {
        background: linear-gradient(135deg, #3bb77e, #2d9d6b);
        color: white;
        text-decoration: none;
        padding: 0.75rem 1.5rem;
        border-radius: 15px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-become-seller:hover {
        background: linear-gradient(135deg, #2d9d6b, #1a7a4a);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 183, 126, 0.3);
    }

    /* Addresses Section */
    .btn-add-address {
        background: linear-gradient(135deg, #3bb77e, #2d9d6b);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 15px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-add-address:hover {
        background: linear-gradient(135deg, #2d9d6b, #1a7a4a);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 183, 126, 0.3);
    }

    .addresses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 1.5rem;
    }

    .address-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .address-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .address-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .address-number {
        font-weight: 700;
        color: #3bb77e;
        font-size: 1.1rem;
    }

    .address-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-edit, .btn-delete {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-edit {
        background: rgba(59, 183, 126, 0.1);
        color: #3bb77e;
    }

    .btn-edit:hover {
        background: #3bb77e;
        color: white;
    }

    .btn-delete {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: white;
    }

    .address-details p {
        margin-bottom: 0.5rem;
        color: #2c3e50;
    }

    .no-addresses {
        text-align: center;
        padding: 3rem 2rem;
    }

    .no-addresses-icon {
        font-size: 4rem;
        color: #6c757d;
        margin-bottom: 1rem;
    }

    .no-addresses h3 {
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .no-addresses p {
        color: #6c757d;
        margin-bottom: 2rem;
    }

    .btn-add-first-address {
        background: linear-gradient(135deg, #3bb77e, #2d9d6b);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 15px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-add-first-address:hover {
        background: linear-gradient(135deg, #2d9d6b, #1a7a4a);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 183, 126, 0.3);
    }

    /* Payment Section */
    .add-card-section {
        margin-bottom: 2rem;
    }

    .add-card-form {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 2rem;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .form-header h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-header h3 i {
        color: #3bb77e;
    }

    .card-element-container {
        margin-bottom: 1.5rem;
    }

    .card-element-container label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        display: block;
    }

    #card-element {
        padding: 1rem;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        background: white;
        transition: all 0.3s ease;
    }

    #card-element:focus {
        border-color: #3bb77e;
        box-shadow: 0 0 0 3px rgba(59, 183, 126, 0.1);
    }

    .btn-add-card {
        background: linear-gradient(135deg, #3bb77e, #2d9d6b);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 15px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-add-card:hover {
        background: linear-gradient(135deg, #2d9d6b, #1a7a4a);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 183, 126, 0.3);
    }

    .existing-cards h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 1.5rem;
    }

    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .card-item {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .card-item:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .card-header-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .card-brand {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 700;
        color: #2c3e50;
    }

    .card-brand i {
        font-size: 1.5rem;
        color: #3bb77e;
    }

    .btn-remove-card {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-remove-card:hover {
        background: #dc3545;
        color: white;
    }

    .card-body-info {
        color: #2c3e50;
    }

    .card-number {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .card-details {
        display: flex;
        justify-content: space-between;
        font-size: 0.9rem;
        color: #6c757d;
    }

    .no-cards {
        text-align: center;
        padding: 3rem 2rem;
    }

    .no-cards-icon {
        font-size: 4rem;
        color: #6c757d;
        margin-bottom: 1rem;
    }

    .no-cards h3 {
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .no-cards p {
        color: #6c757d;
    }

    /* Action Buttons */
    .action-buttons {
        margin-top: 1.5rem;
    }

    .btn-update {
        background: linear-gradient(135deg, #3bb77e, #2d9d6b);
        color: white;
        text-decoration: none;
        padding: 0.75rem 1.5rem;
        border-radius: 15px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-update:hover {
        background: linear-gradient(135deg, #2d9d6b, #1a7a4a);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 183, 126, 0.3);
    }

    /* Modal Styles */
    .modal-content {
        border-radius: 20px;
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        background: linear-gradient(135deg, #3bb77e, #2d9d6b);
        color: white !important;
        border-bottom: none;
    }
    #exampleModalLabel{
        color: #ffffff !important
    }

    .modal-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 700;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #3bb77e;
        box-shadow: 0 0 0 3px rgba(59, 183, 126, 0.1);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .modern-dashboard-container {
            padding: 1rem 0;
        }

        .welcome-card {
            padding: 2rem;
        }

        .welcome-content {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .welcome-text h1 {
            font-size: 2rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .addresses-grid {
            grid-template-columns: 1fr;
        }

        .cards-grid {
            grid-template-columns: 1fr;
        }

        .seller-promo {
            flex-direction: column;
            text-align: center;
        }

        .card-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
    }

    @media (max-width: 576px) {
        .welcome-text h1 {
            font-size: 1.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .address-card, .card-item {
            padding: 1rem;
        }
    }
</style>
@endsection

@section('js')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
if (error?.setupIntent) {
document.getElementById('paymentmethod').value = error.setupIntent.payment_method
toastr.success('Card added');
} else {
toastr.error('Something went wrong. Try again letter');
}

} else {
document.getElementById('paymentmethod').value = setupIntent.payment_method
toastr.success('Card added');
$('#cardAddFrom').submit();
}
});

</script>
@endsection
