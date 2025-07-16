<header class="main-header shadow-sm">
    <!-- Top Bar -->
    <div class="header-top py-3 mt-0 bg-dark text-light d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-phone-alt me-2"></i> <span>+123 5678 890</span>
                <span class="mx-3">|</span>
                <i class="fas fa-envelope me-2"></i> <span>support@sohoj.com</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="#" class="text-light me-2"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-light me-2"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-light me-2"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-light me-2"><i class="fab fa-linkedin-in"></i></a>
                <!-- Language/Currency Switcher -->
                {{-- <div class="dropdown d-inline mx-2">
                    <a class="dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown">EN</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">EN</a></li>
                        <li><a class="dropdown-item" href="#">BN</a></li>
                    </ul>
                </div>
                <div class="dropdown d-inline">
                    <a class="dropdown-toggle text-light" href="#" role="button"
                        data-bs-toggle="dropdown">USD</a>
                            <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">USD</a></li>
                        <li><a class="dropdown-item" href="#">EUR</a></li>
                            </ul>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Main Bar -->
    <div class="header-main py-3 bg-white">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <a href="{{ route('homepage') }}" class="navbar-brand d-flex align-items-center">
                <img src="{{ asset('assets/logo/logo007.png') }}" alt="Logo" style="height: 48px;">
                <span class="ms-2 fw-bold text-dark fs-4">Sohoj</span>
            </a>
            <!-- Search Bar -->
            @php
                use Illuminate\Support\Facades\Cache;
                use App\Models\Prodcat;
                // Fetch categories for the search bar dropdown
                $categories = Cache::remember('header_categories', 3600, function () {
                    return Prodcat::whereNull('parent_id')->orderBy('role', 'asc')->with('childrens')->get();
                });
            @endphp
            <form class="d-none d-md-flex flex-grow-1 mx-4" action="{{ route('shops') }}" method="get"
                style="max-width: 600px;">
                <div class="input-group w-100">
                    <input type="text" class="form-control rounded-start" name="search"
                        placeholder="Search products...">
                    <select class="form-select border rounded-0 pt-2 h-100" name="category" style="max-width: 200px;">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            @if ($category->childrens->count())
                                <optgroup label="{{ $category->name }}">
                                    @foreach ($category->childrens as $child)
                                        <option value="{{ $child->slug }}"
                                            @if (request('category') == $child->slug) selected @endif>
                                            {{ $child->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @else
                                <option value="{{ $category->slug }}" @if (request('category') == $category->slug) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <button class="btn btn-success rounded-end h-100" type="submit"><i
                            class="fas fa-search"></i></button>
                </div>
            </form>
            @php
                $wishlist = session()->get('wishlist', []);
            @endphp
            <!-- Icons -->
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('wishlist.index') }}" class="header-icon-btn position-relative" title="Wishlist">
                    <i class="far fa-heart"></i>
                    @if (count($wishlist) > 0)
                        <span class="header-icon-badge">
                            {{ count($wishlist) }}
                        </span>
                    @endif
                </a>
                <a href="#" class="header-icon-btn position-relative" data-bs-toggle="offcanvas"
                    data-bs-target="#cartOffcanvas" title="Cart">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="header-icon-badge">
                        {{ Cart::content()->count() }}
                    </span>
                </a>
                @auth
                    <div class="dropdown">
                        <a class="header-icon-btn user-dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            title="Account">
                            <i class="fas fa-user-circle"></i>
                        </a>
                        <ul class="dropdown-menu user-dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('user.dashboard') }}"><i
                                        class="fas fa-user me-2"></i>Profile</a></li>
                            @if (Auth()->user()->role_id == 3)
                                <li><a class="dropdown-item" href="{{ url('vendor') }}"><i
                                            class="fas fa-store me-2"></i>Vendor Profile</a></li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="dropdown">
                        <a class="header-icon-btn user-dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            title="Account">
                            <i class="fas fa-user-circle"></i>
                        </a>
                        <ul class="dropdown-menu user-dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('login') }}"><i
                                        class="fas fa-sign-in-alt me-2"></i>Login</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}"><i
                                        class="fas fa-user-plus me-2"></i>Register</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('vendor.create') }}"><i
                                        class="fas fa-store me-2"></i>Register as Vendor</a></li>
                        </ul>
                    </div>
                @endauth
            </div>
            <!-- Mobile Menu Toggle -->
            <button class="btn d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu">
                <i class="fas fa-bars fs-4"></i>
            </button>
        </div>
        <!-- Mobile Search -->
        <form class="d-flex d-md-none mt-2 px-3" action="{{ route('shops') }}" method="get">
            <div class="input-group w-100">
                <input type="text" class="form-control rounded-start" name="search"
                    placeholder="Search products...">
                <select class="form-select" name="category" style="max-width: 200px;">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->slug }}" @if (request('category') == $category->slug) selected @endif>
                            {{ $category->name }}
                        </option>
                        @foreach ($category->childrens as $child)
                            <option value="{{ $child->slug }}" @if (request('category') == $child->slug) selected @endif
                                style="font-weight:300;">&nbsp;&nbsp;&nbsp;&nbsp;{{ $child->name }}</option>
                        @endforeach
                    @endforeach
                </select>
                <button class="btn btn-success rounded-end" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-md navbar-light bg-light shadow">
        <div class="container">
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{ route('homepage') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('shops') }}">Shops</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('shops', ['filter_products' => 'trending']) }}">Trending</a></li>
                    <li class="nav-item"><a class="nav-link"
                            href="{{ route('shops', ['filter_products' => 'most-popular']) }}">Best Seller</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/vendors') }}">Vendors</a></li>
                    <li class="nav-item"><a class="nav-link" href="#footer">Help</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Offcanvas Mobile Menu -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('homepage') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('shops') }}">Shops</a></li>
                <li class="nav-item"><a class="nav-link"
                        href="{{ route('shops', ['filter_products' => 'trending']) }}">Trending</a></li>
                <li class="nav-item"><a class="nav-link"
                        href="{{ route('shops', ['filter_products' => 'most-popular']) }}">Best Seller</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/vendors') }}">Vendors</a></li>
                <li class="nav-item"><a class="nav-link" href="#footer">Help</a></li>
                {{-- <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login/Register</a></li> --}}
            </ul>
        </div>
    </div>
    <!-- Cart Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="cartOffcanvasLabel">
                <i class="fas fa-shopping-cart me-2"></i>Shopping Cart
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @if (Cart::count() > 0)
                <div class="cart-items">
                    @foreach (Cart::content() as $product)
                        <div class="cart-item d-flex align-items-center mb-3 p-3 border rounded">
                            <img src="{{ Storage::url($product->model->image) }}" alt="{{ $product->name }}"
                                class="me-3" style="width: 60px; height: 60px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $product->name }}</h6>
                                <p class="mb-1 text-muted">Qty: {{ $product->quantity }}</p>
                                <p class="mb-0 fw-bold">${{ $product->price }}</p>
                            </div>
                            <a href="{{ route('cart.destroy', $product->rowId) }}"
                                onclick="return confirm('Remove this item?');" class="btn-sm removeBtn rounded-circle">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
                <hr>
                <div class="cart-summary">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span class="fw-bold">${{ Cart::subtotal() }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Total:</span>
                        <span class="fw-bold text-success">${{ Cart::subtotal() }}</span>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('cart') }}" class="btn"
                            style="background: #e72104; color: #ffffff !important;">View Cart</a>
                        <a href="{{ route('checkout') }}" class="btn btn-success" style="color:#ffffff !important">Checkout</a>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Your cart is empty</h5>
                    <p class="text-muted">Add some products to your cart to see them here.</p>
                    <a href="{{ route('shops') }}" class="btn btn-primary">Start Shopping</a>
                </div>
            @endif
        </div>
    </div>
    <style>
        .main-header .navbar-nav .nav-link {
            font-weight: 500;
            color: #232946;
            margin: 0 10px;
            transition: color 0.2s, border-bottom 0.2s;
            border-bottom: 2px solid transparent;
        }

        .main-header .navbar-nav .nav-link:hover,
        .main-header .navbar-nav .nav-link.active {
            color: #01949a;
            border-bottom: 2px solid #01949a;
            background: rgba(1, 153, 154, 0.07);
        }

        .main-header .header-main {
            /* border-bottom: 2px solid #01949a; */
        }

        .main-header .header-top {
            font-size: 0.95rem;
            background: #01949a !important;
            color: #fff !important;
        }

        .main-header .header-top a,
        .main-header .header-top i {
            color: #fff !important;
        }

        .main-header .header-top a:hover {
            color: #e0f7fa !important;
        }

        .main-header .navbar-light .navbar-nav .nav-link {
            color: #232946;
        }

        .main-header .navbar-light .navbar-nav .nav-link:hover,
        .main-header .navbar-light .navbar-nav .nav-link.active {
            color: #01949a;
        }

        .main-header .form-select {
            background-color: #f8f9fa;
            border: 2px solid #01949a;
            border-radius: 8px;
            color: #495057;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .main-header .form-select:focus {
            background-color: #ffffff;
            border-color: #01949a;
            box-shadow: 0 0 0 0.2rem rgba(1, 153, 154, 0.15);
            color: #232946;
        }

        .main-header .form-select:hover {
            border-color: #01949a;
            background-color: #ffffff;
        }

        /* Optgroup Styling */
        .main-header .form-select optgroup {
            font-weight: 600;
            color: #01949a;
            background-color: #f8f9fa;
        }

        .main-header .form-select option {
            background-color: #ffffff;
            color: #495057;
            padding: 8px 12px;
        }

        .main-header .form-select option:hover {
            background-color: #01949a;
            color: #ffffff;
        }

        .main-header .btn-success,
        .main-header .btn-primary {
            background: #01949a !important;
            border-color: #01949a !important;
        }

        .main-header .btn-success:hover,
        .main-header .btn-primary:hover {
            background: #017a7a !important;
            border-color: #017a7a !important;
        }

        .main-header .btn-outline-primary {
            color: #01949a;
            border-color: #01949a;
        }

        .main-header .btn-outline-primary:hover {
            background: #01949a;
            color: #fff;
        }

        .main-header .dropdown-menu {
            border-top: 2px solid #01949a;
        }

        .main-header .dropdown-item.active,
        .main-header .dropdown-item:active {
            background-color: #01949a;
            color: #fff;
        }

        .main-header .dropdown-item:hover {
            background-color: #e0f7fa;
            color: #01949a;
        }

        .main-header .badge.bg-danger {
            background: #01949a !important;
        }

        .main-header .offcanvas-title {
            color: #01949a;
        }

        .main-header .btn-close:focus {
            box-shadow: 0 0 0 0.2rem rgba(1, 153, 154, 0.25);
        }

        .header-icon-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #f8f9fa;
            color: #01949a;
            font-size: 1.5rem;
            position: relative;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 8px rgba(1, 153, 154, 0.07);
            text-decoration: none;
        }

        .header-icon-btn:hover,
        .header-icon-btn:focus {
            /* background: #01949a; */
            color: #017a7a !important;
            box-shadow: 0 4px 16px rgba(1, 153, 154, 0.18);
        }

        .header-icon-badge {
            position: absolute;
            top: -4px;
            right: 1px;
            background: #FF0000;
            color: #fff;
            font-size: 0.75rem;
            border-radius: 50%;
            padding: 2px 6px;
            min-width: 20px;
            text-align: center;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(1, 153, 154, 0.18);
        }

        .user-dropdown-toggle {
            /* border: 2px solid #01949a; */
            background: #fff;
        }

        .user-dropdown-toggle:hover,
        .user-dropdown-toggle:focus {
            /* background: #01949a; */
            color: #fff;
        }

        .user-dropdown-menu {
            min-width: 200px;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(1, 153, 154, 0.10);
            border-top: 3px solid #01949a;
            padding: 0.5rem 0;
        }

        .user-dropdown-menu .dropdown-item {
            font-weight: 500;
            color: #232946;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
        }

        .user-dropdown-menu .dropdown-item i {
            color: #01949a;
            min-width: 18px;
            text-align: center;
        }

        .user-dropdown-menu .dropdown-item:hover,
        .user-dropdown-menu .dropdown-item:focus {
            background: #e0f7fa;
            color: #01949a;
        }

        .user-dropdown-menu .dropdown-divider {
            margin: 0.3rem 0;
        }
        .removeBtn{
            background: #a2a1a05d;
            color: #017a7a !important;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s, color 0.2s;
        }
        .removeBtn:hover {
            color: #FF0000 !important;
        }
    </style>
</header>
