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
                            <h1>Welcome back, {{ Auth::user()->name }}!</h1>
                            <p>Here's your personalized dashboard to manage your account</p>
                            <div class="welcome-stats">
                                <div class="stat-item">
                                    <i class="fas fa-shopping-bag"></i>
                                    <span>5 Orders</span>
                                </div>
                                <div class="stat-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ Auth()->user()->addresses->count() }} Addresses</span>
                                </div>
                                <div class="stat-item">
                                    <i class="fas fa-credit-card"></i>
                                    <span>{{ auth()->user()->paymentMethods()->count() }} Cards</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Grid -->
            <div class="dashboard-grid">
                <!-- Personal Information Section -->
                <div class="info-section">
                    <div class="info-card">
                        <div class="card-header">
                            <h2><i class="fas fa-user"></i> Personal Information</h2>
                            <a href="{{ route('user.update_profile') }}" class="btn-edit-profile">
                                <i class="fas fa-edit"></i>
                                Edit Profile
                            </a>
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
                                    <div class="verification-badge verified">
                                        <i class="fas fa-check-circle"></i> Verified
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">
                                        <i class="fas fa-phone"></i>
                                        <span>Phone Number</span>
                                    </div>
                                    <div class="info-value">
                                        @if (Auth::check() && !empty(Auth::user()->phone))
                                            {{ Auth::user()->phone }}
                                            <div class="verification-badge verified">
                                                <i class="fas fa-check-circle"></i> Verified
                                            </div>
                                        @else
                                            <a href="{{ route('user.update_profile') }}" class="add-phone-link">
                                                <i class="fas fa-plus"></i> Add Phone Number
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="info-item full-width">
                                    <div class="info-label">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>Account Created</span>
                                    </div>
                                    <div class="info-value">
                                        {{ Auth::user()->created_at->format('M d, Y') }}
                                        <span class="account-age">({{ Auth::user()->created_at->diffForHumans() }})</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Section -->
                <div class="quick-actions-section">
                    <div class="quick-actions-card">
                        <div class="card-header">
                            <h2><i class="fas fa-bolt"></i> Quick Actions</h2>
                        </div>
                        <div class="card-body">
                            <div class="actions-grid">
                                <a href="{{route('user.ordersIndex')}}" class="action-item">
                                    <div class="action-icon">
                                        <i class="fas fa-shopping-bag"></i>
                                    </div>
                                    <div class="action-text">
                                        <h3>My Orders</h3>
                                        <p>View your order history</p>
                                    </div>
                                </a>

                                <a href="{{route('wishlist.index')}}" class="action-item">
                                    <div class="action-icon">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <div class="action-text">
                                        <h3>Wishlist</h3>
                                        <p>View saved items</p>
                                    </div>
                                </a>

                                <button class="action-item" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <div class="action-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="action-text">
                                        <h3>Add Address</h3>
                                        <p>Add a new shipping address</p>
                                    </div>
                                </button>

                                <a href="{{ route('user.change_password') }}" class="action-item">
                                    <div class="action-icon">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                    <div class="action-text">
                                        <h3>Change Password</h3>
                                        <p>Update your account password</p>
                                    </div>
                                </a>

                                <a href="{{ route('user.offers') }}" class="action-item">
                                    <div class="action-icon">
                                        <i class="fas fa-gift"></i>
                                    </div>
                                    <div class="action-text">
                                        <h3>Offers</h3>
                                        <p>View your Offers history</p>
                                    </div>
                                </a>
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
                                <div class="shop-status">
                                    <span class="status-badge active">Active</span>
                                </div>
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

                                    <div class="seller-stats">
                                        <div class="stat-card">
                                            <div class="stat-icon">
                                                <i class="fas fa-box-open"></i>
                                            </div>
                                            <div class="stat-content">
                                                <h3>24</h3>
                                                <p>Total Products</p>
                                            </div>
                                        </div>

                                        <div class="stat-card">
                                            <div class="stat-icon">
                                                <i class="fas fa-shopping-cart"></i>
                                            </div>
                                            <div class="stat-content">
                                                <h3>156</h3>
                                                <p>Total Orders</p>
                                            </div>
                                        </div>

                                        <div class="stat-card">
                                            <div class="stat-icon">
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="stat-content">
                                                <h3>4.8</h3>
                                                <p>Average Rating</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="action-buttons">
                                        <a href="{{ route('vendor.shop') }}" class="btn-update">
                                            <i class="fas fa-edit"></i>
                                            Update Shop Info
                                        </a>
                                        <a href="{{ route('vendor.products') }}" class="btn-view-products">
                                            <i class="fas fa-boxes"></i>
                                            View Products
                                        </a>
                                        <a href="{{ route('vendor.orders') }}" class="btn-view-orders">
                                            <i class="fas fa-clipboard-list"></i>
                                            View Orders
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
                                    <p>Start selling your products and reach thousands of customers. Enjoy low fees and
                                        powerful tools to grow your business.</p>
                                    <div class="seller-benefits">
                                        <div class="benefit-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Easy product listing</span>
                                        </div>
                                        <div class="benefit-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Powerful dashboard</span>
                                        </div>
                                        <div class="benefit-item">
                                            <i class="fas fa-check-circle"></i>
                                            <span>Low commission rates</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('user.become.seller') }}" class="btn-become-seller">
                                        <i class="fas fa-arrow-right"></i>
                                        Start Selling Today
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
                        <div class="header-actions">
                            <button class="btn-add-address" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-plus"></i>
                                Add Address
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (Auth()->user()->addresses->count() > 0)
                            <div class="addresses-grid">
                                @foreach (Auth()->user()->addresses as $address)
                                    <div class="address-card {{ $address->is_default ? 'default-address' : '' }}">
                                        <div class="address-header">
                                            <div class="address-title">
                                                <span class="address-number">Address {{ $loop->index + 1 }}</span>
                                                @if ($address->is_default)
                                                    <span class="default-badge">Default</span>
                                                @endif
                                            </div>
                                            <div class="address-actions">
                                                @if (!$address->is_default)
                                                    <form action="" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn-set-default"
                                                            title="Set as default">
                                                            <i class="fas fa-star"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('user.address-edit', $address->id) }}" class="btn-edit"
                                                    title="Edit address">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('user.address.destroy', $address) }}"
                                                    onclick="return confirm('Are you sure you want to delete this Address?');"
                                                    class="btn-delete" title="Delete address">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="address-content">
                                            <div class="address-details">
                                                <p class="address-name"><strong>{{ $address->first_name }}
                                                        {{ $address->last_name }}</strong></p>
                                                <p><i class="fas fa-map-marker-alt"></i> {{ $address->country }},
                                                    {{ $address->state }}</p>
                                                <p>{{ $address->city }}, {{ $address->address_1 }}</p>
                                                @if ($address->address_2)
                                                    <p>{{ $address->address_2 }}</p>
                                                @endif
                                                <p><i class="fas fa-mail-bulk"></i> <strong>Postal Code:</strong>
                                                    {{ $address->post_code }}</p>
                                                <p><i class="fas fa-phone"></i> <strong>Phone:</strong>
                                                    {{ $address->phone }}</p>
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
                                <button class="btn-add-first-address" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
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
                            <form id="cardAddFrom" action="{{ route('user.card.add') }}" method="POST">
                                @csrf
                                <div class="add-card-form">
                                    <div class="form-header">
                                        <h3><i class="fas fa-plus"></i> Add New Card</h3>
                                    </div>
                                    <div class="form-body">
                                        <input id="card-holder-name" type="hidden" value="{{ auth()->user()->name }}">
                                        <input type="hidden" id="paymentmethod" name="payment_method" value="">

                                        <div class="form-group">
                                            <label>Cardholder Name</label>
                                            <input type="text" class="form-control"
                                                value="{{ auth()->user()->name }}" disabled>
                                        </div>

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

                        @if ($methods->count() > 0)
                            <div class="existing-cards">
                                <h3>Your Cards</h3>
                                <div class="cards-grid">
                                    @foreach ($methods as $payment)
                                        <div class="card-item">
                                            <div class="card-header-info">
                                                <div class="card-brand">
                                                    <i
                                                        class="fab fa-cc-{{ strtolower($payment->card->brand) }} brand-icon"></i>
                                                    <span>{{ ucwords($payment->card->brand) }}</span>
                                                </div>
                                                <div class="card-actions">
                                                    @if ($payment->id !== auth()->user()->defaultPaymentMethod())
                                                        {{-- <form action="#"
                                                            method="POST" class="d-inline">
                                                            @csrf --}}
                                                        <button type="submit" class="btn-set-default"
                                                            title="Set as default">
                                                            <i class="fas fa-star"></i>
                                                        </button>
                                                        {{-- </form> --}}
                                                    @else
                                                        <span class="default-badge">Default</span>
                                                    @endif
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
                                                        <span>Expires:
                                                            {{ $payment->card->exp_month }}/{{ $payment->card->exp_year }}</span>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName">First Name *</label>
                                    <input type="text" name="first_name" required
                                        class="form-control @error('first_name') is-invalid @enderror" id="firstName"
                                        placeholder="Enter first name">
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastName">Last Name *</label>
                                    <input type="text" name="last_name" required
                                        class="form-control @error('last_name') is-invalid @enderror" id="lastName"
                                        placeholder="Enter last name">
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="inputAddress">Street Address *</label>
                                    <input type="text" name="address_1" value="" required
                                        class="form-control @error('address_1') is-invalid @enderror" id="inputAddress"
                                        placeholder="Enter your street address">
                                    @error('address_1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="inputAddress2">Address Line 2</label>
                                    <input type="text" name="address_2"
                                        placeholder="Apartment, suite, etc. (optional)"
                                        class="form-control @error('address_2') is-invalid @enderror" value=""
                                        id="inputAddress2">
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
                                    <input type="text" placeholder="Enter city" required value=""
                                        name="city" class="form-control @error('city') is-invalid @enderror"
                                        id="inputCity">
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputPostCode">Postal Code *</label>
                                    <input type="text" required
                                        class="form-control @error('post_code') is-invalid @enderror" value=""
                                        name="post_code" placeholder="Enter postal code" id="inputPostCode">
                                    @error('post_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputPhone">Phone Number *</label>
                                    <input type="text" required
                                        class="form-control @error('phone') is-invalid @enderror" value=""
                                        name="phone" placeholder="Enter phone number" id="inputPhone">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-check mt-4 pt-2">
                                        <input class="form-check-input" type="checkbox" name="is_default"
                                            id="defaultAddress">
                                        <label class="form-check-label" for="defaultAddress">
                                            Set as default shipping address
                                        </label>
                                    </div>
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
        :root {
            --primary-color: #3bb77e;
            --primary-dark: #2d9d6b;
            --primary-light: #e8f5e8;
            --secondary-color: #2c3e50;
            --accent-color: #f39c12;
            --light-gray: #f8f9fa;
            --medium-gray: #e9ecef;
            --dark-gray: #6c757d;
            --danger-color: #dc3545;
            --success-color: #28a745;
            --info-color: #17a2b8;
            --border-radius: 12px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        .modern-dashboard-container {
            background: var(--light-gray);
            min-height: 100vh;
            padding-bottom: 2rem;
        }

        /* Welcome Section */
        .welcome-section {
            margin-bottom: 2rem;
        }

        .welcome-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border-radius: var(--border-radius);
            padding: 3rem;
            color: white;
            box-shadow: var(--box-shadow);
            position: relative;
            overflow: hidden;
            border: none;
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
            font-size: 3.5rem;
            color: rgba(255, 255, 255, 0.9);
            background: rgba(255, 255, 255, 0.15);
            padding: 1.5rem;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            flex-shrink: 0;
        }

        .welcome-text h1 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .welcome-text p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0 0 1.5rem 0;
        }

        .welcome-stats {
            display: flex;
            gap: 1.5rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.15);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            backdrop-filter: blur(5px);
        }

        .stat-item i {
            font-size: 0.9rem;
        }

        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 992px) {
            .dashboard-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        /* Info Sections */
        .info-section,
        .seller-section,
        .addresses-section,
        .payment-section,
        .quick-actions-section {
            margin-bottom: 2rem;
        }

        .info-card,
        .seller-card,
        .addresses-card,
        .payment-card,
        .quick-actions-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            position: relative;
            border: none;
            transition: var(--transition);
        }

        .info-card:hover,
        .seller-card:hover,
        .addresses-card:hover,
        .payment-card:hover,
        .quick-actions-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--medium-gray);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .card-header h2 i {
            color: var(--primary-color);
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.2rem;
        }

        .info-item {
            background: var(--light-gray);
            border-radius: 10px;
            padding: 1.2rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: var(--transition);
            position: relative;
        }

        .info-item:hover {
            background: white;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .info-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            color: var(--dark-gray);
            font-weight: 600;
            font-size: 0.85rem;
        }

        .info-label i {
            color: var(--primary-color);
            width: 18px;
            text-align: center;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--secondary-color);
        }

        .verification-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.75rem;
            padding: 0.2rem 0.5rem;
            border-radius: 50px;
            margin-top: 0.3rem;
        }

        .verification-badge.verified {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }

        .verification-badge i {
            font-size: 0.8rem;
        }

        .account-age {
            font-size: 0.85rem;
            color: var(--dark-gray);
            font-weight: normal;
            margin-left: 0.5rem;
        }

        .add-phone-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            font-size: 0.95rem;
        }

        .add-phone-link:hover {
            color: var(--primary-dark);
            transform: translateX(3px);
        }

        .btn-edit-profile {
            background: rgba(59, 183, 126, 0.1);
            color: var(--primary-color);
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            font-size: 0.85rem;
        }

        .btn-edit-profile:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Quick Actions Section */
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .action-item {
            background: white;
            border-radius: 10px;
            padding: 1.2rem;
            border: 1px solid var(--medium-gray);
            transition: var(--transition);
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .action-item:hover {
            background: var(--primary-light);
            border-color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(59, 183, 126, 0.1);
        }

        .action-icon {
            width: 40px;
            height: 40px;
            background: rgba(59, 183, 126, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .action-text h3 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 0.3rem;
        }

        .action-text p {
            font-size: 0.85rem;
            color: var(--dark-gray);
            margin: 0;
        }

        /* Seller Section */
        .seller-promo {
            display: flex;
            align-items: center;
            gap: 2rem;
            padding: 2rem;
            background: linear-gradient(135deg, #e8f5e8, #d4edda);
            border-radius: var(--border-radius);
            border: 1px solid rgba(59, 183, 126, 0.2);
        }

        .promo-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            background: white;
            padding: 1.5rem;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(59, 183, 126, 0.2);
            flex-shrink: 0;
        }

        .promo-content h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .promo-content p {
            color: var(--dark-gray);
            margin-bottom: 1.5rem;
        }

        .seller-benefits {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .benefit-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: var(--secondary-color);
        }

        .benefit-item i {
            color: var(--primary-color);
        }

        .btn-become-seller {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }

        .btn-become-seller:hover {
            background: linear-gradient(135deg, var(--primary-dark), #1a7a4a);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 183, 126, 0.3);
        }

        .shop-status {
            display: flex;
            align-items: center;
        }

        .status-badge {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
        }

        .status-badge.active {
            background: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }

        .seller-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            border: 1px solid var(--medium-gray);
            text-align: center;
            transition: var(--transition);
        }

        .stat-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 5px 15px rgba(59, 183, 126, 0.1);
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            background: rgba(59, 183, 126, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            color: var(--primary-color);
            font-size: 1.1rem;
        }

        .stat-content h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 0.2rem;
        }

        .stat-content p {
            font-size: 0.85rem;
            color: var(--dark-gray);
            margin: 0;
        }

        /* Addresses Section */
        .btn-add-address {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            font-size: 0.85rem;
        }

        .btn-add-address:hover {
            background: linear-gradient(135deg, var(--primary-dark), #1a7a4a);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 183, 126, 0.2);
        }

        .addresses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.2rem;
        }

        .address-card {
            background: white;
            border-radius: 10px;
            padding: 1.2rem;
            border: 1px solid var(--medium-gray);
            transition: var(--transition);
            position: relative;
        }

        .address-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            transform: translateY(-3px);
        }

        .address-card.default-address {
            border: 2px solid var(--primary-color);
            background: rgba(59, 183, 126, 0.03);
        }

        .address-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--medium-gray);
        }

        .address-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .address-number {
            font-weight: 700;
            color: var(--secondary-color);
            font-size: 0.95rem;
        }

        .default-badge {
            background: rgba(59, 183, 126, 0.1);
            color: var(--primary-color);
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 50px;
            font-weight: 600;
        }

        .address-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-set-default,
        .btn-edit,
        .btn-delete {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            font-size: 0.8rem;
        }

        .btn-set-default {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .btn-set-default:hover {
            background: #ffc107;
            color: white;
        }

        .btn-edit {
            background: rgba(59, 183, 126, 0.1);
            color: var(--primary-color);
        }

        .btn-edit:hover {
            background: var(--primary-color);
            color: white;
        }

        .btn-delete {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
        }

        .btn-delete:hover {
            background: var(--danger-color);
            color: white;
        }

        .address-details p {
            margin-bottom: 0.5rem;
            color: var(--secondary-color);
            font-size: 0.9rem;
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .address-details p i {
            color: var(--dark-gray);
            font-size: 0.8rem;
            margin-top: 0.2rem;
        }

        .address-name {
            font-size: 1rem !important;
            margin-bottom: 0.8rem !important;
        }

        .no-addresses {
            text-align: center;
            padding: 3rem 2rem;
        }

        .no-addresses-icon {
            font-size: 3rem;
            color: var(--dark-gray);
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .no-addresses h3 {
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
        }

        .no-addresses p {
            color: var(--dark-gray);
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }

        .btn-add-first-address {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            cursor: pointer;
            font-size: 0.95rem;
        }

        .btn-add-first-address:hover {
            background: linear-gradient(135deg, var(--primary-dark), #1a7a4a);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 183, 126, 0.3);
        }

        /* Payment Section */
        .add-card-section {
            margin-bottom: 2rem;
        }

        .add-card-form {
            background: var(--light-gray);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            border: 1px solid var(--medium-gray);
        }

        .form-header h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-header h3 i {
            color: var(--primary-color);
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
            display: block;
            font-size: 0.9rem;
        }

        .card-element-container {
            margin-bottom: 1.5rem;
        }

        .card-element-container label {
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
            display: block;
            font-size: 0.9rem;
        }

        #card-element {
            padding: 1rem;
            border: 2px solid var(--medium-gray);
            border-radius: 8px;
            background: white;
            transition: var(--transition);
        }

        #card-element:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 183, 126, 0.1);
        }

        .btn-add-card {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            cursor: pointer;
            font-size: 0.95rem;
        }

        .btn-add-card:hover {
            background: linear-gradient(135deg, var(--primary-dark), #1a7a4a);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 183, 126, 0.3);
        }

        .existing-cards h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.2rem;
        }

        .card-item {
            background: white;
            border-radius: 10px;
            padding: 1.2rem;
            border: 1px solid var(--medium-gray);
            transition: var(--transition);
        }

        .card-item:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            transform: translateY(-3px);
        }

        .card-item.default-card {
            border: 2px solid var(--primary-color);
            background: rgba(59, 183, 126, 0.03);
        }

        .card-header-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--medium-gray);
        }

        .card-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 700;
            color: var(--secondary-color);
        }

        .brand-icon {
            font-size: 1.8rem;
        }

        .fa-cc-visa {
            color: #1a1f71;
        }

        .fa-cc-mastercard {
            color: #eb001b;
        }

        .fa-cc-amex {
            color: #016fd0;
        }

        .fa-cc-discover {
            color: #ff6000;
        }

        .card-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-remove-card {
            background: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            cursor: pointer;
            font-size: 0.8rem;
        }

        .btn-remove-card:hover {
            background: var(--danger-color);
            color: white;
        }

        .card-body-info {
            color: var(--secondary-color);
        }

        .card-number {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .card-details {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            color: var(--dark-gray);
        }

        .no-cards {
            text-align: center;
            padding: 3rem 2rem;
        }

        .no-cards-icon {
            font-size: 3rem;
            color: var(--dark-gray);
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .no-cards h3 {
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
            font-size: 1.3rem;
        }

        .no-cards p {
            color: var(--dark-gray);
            font-size: 0.95rem;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin-top: 1.5rem;
        }

        .btn-update,
        .btn-view-products,
        .btn-view-orders {
            background: rgba(59, 183, 126, 0.1);
            color: var(--primary-color);
            text-decoration: none;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            font-size: 0.85rem;
            border: none;
            cursor: pointer;
        }

        .btn-update:hover {
            background: var(--primary-color);
            color: white;
        }

        .btn-view-products {
            background: rgba(23, 162, 184, 0.1);
            color: var(--info-color);
        }

        .btn-view-products:hover {
            background: var(--info-color);
            color: white;
        }

        .btn-view-orders {
            background: rgba(108, 117, 125, 0.1);
            color: var(--dark-gray);
        }

        .btn-view-orders:hover {
            background: var(--dark-gray);
            color: white;
        }

        /* Modal Styles */
        .modal-content {
            border-radius: var(--border-radius);
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border-bottom: none;
            padding: 1.5rem;
        }

        .modal-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 700;
            color: white;
        }

        .modal-title i {
            font-size: 1.2rem;
        }

        .btn-close {
            filter: invert(1);
            opacity: 0.8;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .form-control {
            border: 2px solid var(--medium-gray);
            border-radius: 8px;
            padding: 0.65rem 1rem;
            transition: var(--transition);
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(59, 183, 126, 0.1);
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .modal-footer {
            border-top: 1px solid var(--medium-gray);
            padding: 1.2rem 1.5rem;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .welcome-card {
                padding: 2rem;
            }

            .welcome-text h1 {
                font-size: 2rem;
            }
        }

        @media (max-width: 992px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .seller-promo {
                flex-direction: column;
                text-align: center;
            }

            .promo-icon {
                margin-bottom: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .welcome-content {
                flex-direction: column;
                text-align: center;
                gap: 1.5rem;
            }

            .welcome-stats {
                justify-content: center;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .addresses-grid,
            .cards-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .welcome-text h1 {
                font-size: 1.8rem;
            }

            .welcome-stats {
                flex-direction: column;
                align-items: center;
                gap: 0.8rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .seller-stats {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-update,
            .btn-view-products,
            .btn-view-orders {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endsection

{{-- @section('js')
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

        // Toastr notification settings
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "timeOut": "5000"
        };

        // Add animation to cards when they come into view
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll(
                '.info-card, .seller-card, .addresses-card, .payment-card, .quick-actions-card');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            cards.forEach(card => {
                card.style.opacity = 0;
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(card);
            });
        });
    </script>
@endsection --}}

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
