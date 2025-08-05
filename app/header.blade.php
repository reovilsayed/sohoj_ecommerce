@php
    $states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'];
@endphp
<style>
    /* .ec-select-inner::after {
        top: 10px !important;
    } */

    #map {
        height: 400px;
    }

    .custom-select {
        font-size: 16px;
        color: #333;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        padding: 5px;
        width: 200px;
    }

    /* Style the suggestion list */
    #suggestionList {
        list-style: none;
        padding: 0;
        margin: 0;
        max-height: 150px;
        overflow-y: auto;
        border: 1px solid #ccc;
        background-color: #fff;
    }

    /* Style individual suggestions */
    #suggestionList li {
        padding: 8px 16px;
        cursor: pointer;
    }

    /* Highlight suggestion on hover */
    #suggestionList li:hover {
        background-color: #f0f0f0;
    }

    .location-search {
        height: 50px !important;
    }

    .location-city {
        width: 70%;
    }

    #cityInput {
        height: 51px;
    }

    @media only screen and (max-width: 767px) {
        .location-search {
            height: 45px !important;
        }

        .location-search-group {
            width: 50% !important;
        }

        .location-city {
            width: 50% !important;
        }

        #cityInput {
            height: 45px;
        }
    }

    .select2-selection {
        height: 50px;
    }
</style>

@php
    use App\Models\Prodcat;
    use App\Models\Shop;
    use App\Models\Order;
    $categories = Prodcat::whereNull('parent_id')
        ->orderBy('role', 'asc')
        ->get();
    $shops = Shop::latest()->get();

    $route = route('shops');

@endphp
<header class="ec-header">
    <!--Ec Header Top Start -->
    <div class="header-top">
        <div class="container">
            <div class="row align-items-center">
                <!-- Header Top social Start -->
                <div class="col text-left header-top-left d-none d-lg-block">
                    <!-- <div class="header-top-social">
                        <span class="social-text text-upper">Follow us on:</span>
                        <ul class="mb-0">
                            <li class="list-inline-item"><a class="hdr-facebook" href="#"><i
                                        class="ecicon eci-facebook"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-twitter" href="#"><i
                                        class="ecicon eci-twitter"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-instagram" href="#"><i
                                        class="ecicon eci-instagram"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-linkedin" href="#"><i
                                        class="ecicon eci-linkedin"></i></a></li>
                        </ul>
                    </div> -->
                </div>
                <!-- Header Top social End -->
                <!-- Header Top Message Start -->
                <!-- <div class="col text-center header-top-center">
                    <div class="header-top-message text-upper">
                        <span>Free Shipping</span>This Week Order Over - $75
                    </div>
                </div> -->
                <div class="col tab-logo">
                    <div class="header-logo">
                        <a href="{{ route('homepage') }}"><img src="{{ Voyager::image(setting('site.logo')) }}"
                                alt="{{ setting('site.title') }}"></a>
                    </div>
                </div>
                <!-- Header Top Message End -->
                <!-- Header Top Language Currency -->
                <div class="col header-top-right d-none d-lg-block">
                    <div class="header-top-lan-curr d-flex justify-content-end">
                        <!-- Currency Start -->
                        <div class="header-top-curr dropdown">
                            <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">Currency <i
                                    class="ecicon eci-caret-down" aria-hidden="true"></i></button>
                            <ul class="dropdown-menu">
                                <li class="active"><a class="dropdown-item" href="#">USD $</a></li>
                                <li><a class="dropdown-item" href="#">EUR €</a></li>
                            </ul>
                        </div>
                        <!-- Currency End -->
                        <!-- Language Start -->
                        <div class="header-top-lan dropdown">
                            <button class="dropdown-toggle text-upper" data-bs-toggle="dropdown">Language <i
                                    class="ecicon eci-caret-down" aria-hidden="true"></i></button>
                            <ul class="dropdown-menu">
                                <li class="active"><a class="dropdown-item" href="#">English</a></li>
                                <li><a class="dropdown-item" href="#">Italiano</a></li>
                            </ul>
                        </div>
                        <!-- Language End -->

                    </div>
                </div>
                <!-- Header Top Language Currency -->
                <!-- Header Top responsive Action -->
                <div class="col d-lg-none ">
                    <div class="ec-header-bottons">
                        <!-- Header User Start -->


                        <!-- Header User End -->
                        <!-- Header Cart Start -->
                        {{-- <a href="{{ route('location.search') }}" class="ec-header-btn ec-header-wishlist">
                            <div class="header-icon"><i class="fas fa-map-marker-alt"></i></div>
                            
                        </a> --}}
                        <div
                            style="display: flex;width:180px;align-items:center;border-right: 2px solid;
                        padding-right: 5px;">
                            <i class="fas fa-map-marker-alt ml-1"></i>
                            <a class="ms-2" href="javascript:void(0)" data-bs-toggle="modal"
                                data-bs-target="#location" style="font-size: 14px;line-height: 16px;font-weight: 500;">
                                @if (session()->has('state') || session()->has('post_city'))
                                    @if (session()->has('post_city'))

                                        @foreach (session()->get('post_city') as $item)
                                            {{ $item }}
                                        @endforeach
                                        ,
                                    @endif
                                    {{ session()->get('state') }}
                                @else
                                    Set Location
                                @endif
                            </a>
                        </div>
                        <!-- Header Cart End -->
                        <!-- Header Cart Start -->
                        <a href="#ec-side-cart" class="ec-header-btn ec-side-toggle">
                            <div class="header-icon"><i class="fi-rr-shopping-bag"></i></div>

                            <span class="ec-header-count cart-count-lable" id="cartQty2">0</span>

                        </a>
                        <!-- Header Cart End -->
                        <!-- <a href="javascript:void(0)" class="ec-header-btn ec-sidebar-toggle">
                            <i class="fi fi-rr-apps"></i>
                        </a> -->
                        <!-- Header menu Start -->
                        <a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle d-lg-none">
                            <i class="fi fi-rr-menu-burger"></i>
                        </a>
                        <!-- Header menu End -->
                    </div>
                </div>
                <!-- Header Top responsive Action -->
            </div>
        </div>
    </div>
    <!-- Ec Header Top  End -->
    <!-- Ec Header Bottom  Start -->
    <div class="ec-header-bottom d-none d-lg-block">
        <div class="container position-relative">
            <div class="row">
                <div class="ec-flex">
                    <!-- Ec Header Logo Start -->

                    <div class="align-self-center">
                        <div class="header-logo">
                            <a href="{{ route('homepage') }}"><img src="{{ Voyager::image(setting('site.logo')) }}"
                                    alt="{{ setting('site.title') }}"></a>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->

                    <!-- Ec Header Search Start -->
                    <div class="align-self-center">
                        <div class="header-search">
                            <form class="ec-btn-group-form d-flex" action="{{ route('shops') }}" method="get">
                                <div id="desktop-search" class="ec-sort-select ">

                                    <div class="ec-select-inner-cat ec-select-inner header-drop">

                                        <select name="category" id="ec-select" style="border: 1px solid #373737;">
                                            <option selected value="">Categories</option>
                                            @foreach ($categories as $category)
                                                <option @if (request('category') == $category->slug) selected @endif
                                                    value="{{ $category->slug }}">{{ $category->name }}</option>
                                                @foreach ($category->childrens as $child)
                                                    <option value="{{ $child->slug }}" style="font-weight:300">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $child->name }}
                                                    </option>
                                                @endforeach
                                            @endforeach


                                        </select>

                                    </div>
                                </div>
                                <input class="form-control ec-search-bar" style="border: 1px solid #373737;"
                                    name="search" value="{{ request('search') }}" placeholder="Search products..."
                                    type="text">
                                <button class="submit header-search-btn" type="submit"><i
                                        class="fi-rr-search"></i></button>

                            </form>


                        </div>

                    </div>

                    <!-- Ec Header Search End -->

                    <!-- Ec Header Button Start -->
                    <div class="align-self-center">
                        <div class="ec-header-bottons"
                            style="
                        align-items: baseline;
                    ">

                            <!-- Header User Start -->
                            <div class="ec-header-user dropdown">
                                <button class="dropdown-toggle" data-bs-toggle="dropdown">

                                    <i class="fi-rr-user" style="font-size: 20px"></i>
                                    @if (Auth::check())
                                        <span class="ms-2 pe-1"
                                            style="border-right: 1px solid #000000;">{{ auth()->user()->name }}</span>
                                    @endif
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @guest
                                        @if (Route::has('register'))
                                            <li>
                                                <a class=" dropdown-item"
                                                    href="{{ route('register') }}">{{ __('Register') }}</a>

                                            </li>
                                            <li>
                                                <a class=" dropdown-item"
                                                    href="{{ route('vendor.create') }}">{{ __('Register as Vendor') }}</a>

                                            </li>
                                            <li>
                                                <a class=" dropdown-item"
                                                    href="{{ route('login') }}">{{ __('Log In') }}</a>

                                            </li>
                                        @endif
                                    @else
                                        <li>


                                            @if (Auth()->user())
                                                <a class="dropdown-item" href="{{ route('user.dashboard') }}">User
                                                    Profile</a>
                                            @endif
                                            @if (Auth()->user()->role_id == 3)
                                                <a class="dropdown-item" href="{{ route('vendor.dashboard') }}">Vendor
                                                    Profile</a>
                                            @endif
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>


                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>

                                        </li>
                                    @endguest
                                </ul>
                            </div>
                            <!-- Header User End -->
                            <!-- Header wishlist Start -->

                            <!-- Header wishlist End -->
                            <!-- Header Cart Start -->
                            <a href="{{ route('homepage', ['cart' => 'show']) }}" class="ec-header-btn">
                                <div class="header-icon">
                                    <i class="fa-solid fa-cart-shopping" style="font-size: 20px"></i>
                                </div>

                                <span class="ec-header-count cart-count-lable" id="cartQty">0</span>

                            </a>
                            @auth

                                @php
                                    $notifications = App\Models\Notification::where('user_id', auth()->id())
                                        ->where('status', 0)
                                        ->latest()
                                        ->get();

                                @endphp

                                <div class=" dropdown" style="margin-left: 0;">
                                    <button class="" style="margin-left:0" data-bs-toggle="dropdown">
                                        @if ($notifications->count() > 0)
                                            <span class="ec-header-count"
                                                style="background-color: rgba(216, 25, 25, 0.82);padding:2px 7px;border-radius:50%;position:absolute;top: -11px;font-size: 11px;font-weight: 600;color: #fff;">{{ $notifications->count() }}</span>
                                        @endif
                                        <div class="header-icon">
                                            <i class="fa-solid fa-bell" style="font-size: 20px"></i>
                                        </div>
                                    </button>

                                    <ul class="dropdown-menu">
                                        @if ($notifications->count() > 0)
                                            @foreach ($notifications as $notification)
                                                <li class="d-flex" style="border-bottom:1px solid #888;padding:10px 5px;">
                                                    <a class="dropdown-item"
                                                        href="{{ route('massage.seen', ['notification' => $notification]) }}">{{ Str::limit($notification->title, $limit = 20, $end = '...') }}
                                                        <small class="pt-5"
                                                            style="font-weight: 500; font-size:10px;margin:0 10px">({{ $notification->created_at->diffForHumans() }})</small></a>
                                                    <a class="me-2 text-danger"
                                                        href="{{ route('massage.seen', ['notification' => $notification, 'seen' => 1]) }}">X</a>
                                                </li>
                                            @endforeach
                                        @else
                                            <p class="p-2 text-danger">Not notifications found</p>
                                    </ul>
                                    @endif
                                </div>



                            @endauth
                            <!-- Header Cart End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Header Button End -->
    <!-- Header responsive Bottom  Start -->
    <div class="ec-header-bottom d-lg-none">
        <div class="container position-relative">
            <div class="row justify-content-center m-0">
                <div class="ec-header-user dropdown col-12 my-3">

                    <form class="ec-btn-group-form d-flex " action="{{ route('shops') }}" method="get"
                        style="">

                        <input class="form-control ec-search-bar" style="border: 1px solid #373737;" name="search"
                            value="{{ request('search') }}" placeholder="Search products..." type="text">
                        <button class="submit header-search-btn "
                            style="width: 75px !important;border-top-right-radius: 6px !important;border-bottom-right-radius: 6px !important;"
                            type="submit"><i class="fi-rr-search"></i></button>

                    </form>

                </div>

                <!-- Ec Header Logo Start -->
                <div class="col mobile-logo">
                    <div class="header-logo">
                        <a href="{{ route('homepage') }}"><img src="{{ Voyager::image(setting('site.logo')) }}"
                                alt="{{ setting('site.title') }}"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header responsive Bottom  End -->
    <!-- EC Main Menu Start -->
    <div id="ec-main-menu-desk" class="d-none d-lg-block sticky-nav">
        <div class="container position-relative">
            <div class="row">
                <div class="col-md-12 align-self-center my-3">
                    <div class="ec-main-menu">
                        <ul>
                            <li>
                                <div class="ec-select-inner category-drop  sellers-dropdown mid-header"
                                    style="background-color: #000000;border-radius: 10px">
                                    <select name="ec-select custom-select"
                                        @php $vendor_route=route('vendors') ; @endphp
                                        onchange='updateSearchParams("category",this.value,"{{ $vendor_route }}")'
                                        class="cat-select" id="ec-select"
                                        style="font-weight: 600;color:#fff !important;font-size:16px;">

                                        <option value="1">


                                            Browse Shop By Category
                                        </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->slug }}"
                                                @if (request('category') == $category->slug) selected @endif
                                                style="font-weight:500">
                                                {{ $category->name }}
                                            </option>
                                            @foreach ($category->childrens as $child)
                                                <option value="{{ $child->slug }}"
                                                    @if (request('category') == $child->slug) selected @endif
                                                    style="font-weight:300">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $child->name }}
                                                </option>
                                            @endforeach
                                        @endforeach



                                    </select>
                                </div>
                            </li>
                            <li><a href="{{ route('shops', ['filter_products' => 'trending']) }}"
                                    style="font-size: 14px">Trending </a></li>
                            <li class=""><a href="{{ route('shops', ['filter_products' => 'most-popular']) }}"
                                    style="font-size: 14px">Best
                                    Seller</a>


                            </li>
                            <li class="dropdown"><a href="javascript:void(0)">Saves</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('wishlist.index') }}">Save Products</a></li>
                                    <li><a href="{{ route('follow.shops') }}">Followed Shops</a></li>

                                </ul>
                            </li>


                            <!-- <li class="dropdown "><a href=""  style="font-size: 14px">Reciving
                                    Method <i class="fa-solid fa-angle-down ms-3"></i></a>

                            </li> -->
                            <li class="dropdown"><a href="{{ url('/vendors') }}" id=""
                                    style="font-size: 14px">Vendors </a>

                            </li>
                            <li class="dropdown"><a href="#footer" id="" style="font-size: 14px">Help <i
                                        class="far fa-question-circle ml-1"></i></a>

                            </li>
                            <li class="dropdown"><a href="javascript:void(0)" data-bs-toggle="modal"
                                    data-bs-target="#location" style="font-size: 14px;width:70%;line-height: 16px;"><i
                                        class="fas fa-map-marker-alt mr-1" style="font-size: 18px"></i>

                                    @if (session()->has('state') || session()->has('post_city'))
                                        @if (session()->has('post_city'))
                                            @foreach (session()->get('post_city') as $item)
                                                {{ $item }}
                                            @endforeach,
                                        @endif
                                        {{ session()->get('state') }}
                                    @else
                                        Set Location
                                    @endif
                                </a>

                            </li>



                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Main Menu End -->
    <!-- ekka Mobile Menu Start -->
    <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu ">
        <div class="ec-menu-title">
            <span class="menu_title">My Menu</span>
            <button class="ec-close">×</button>
        </div>
        <div class="ec-menu-inner">
            <div class="ec-menu-content">
                <ul>

                    <li>
                        <div class="ec-select-inner category-drop  sellers-dropdown mid-header mt-2"
                            style="background-color: #000000;border-radius: 10px">
                            <select name="ec-select custom-select" @php $vendor_route=route('vendors') ; @endphp
                                onchange='updateSearchParams("category",this.value,"{{ $vendor_route }}")'
                                class="cat-select" id="ec-select"
                                style="font-weight: 600;color:#fff !important;font-size:16px;">

                                <option value="1">


                                    Browse Shop By Category
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}"
                                        @if (request('category') == $category->slug) selected @endif style="font-weight:500">
                                        {{ $category->name }}
                                    </option>
                                    @foreach ($category->childrens as $child)
                                        <option value="{{ $child->slug }}"
                                            @if (request('category') == $child->slug) selected @endif style="font-weight:300">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $child->name }}
                                        </option>
                                    @endforeach
                                @endforeach



                            </select>
                        </div>
                    </li>
                    <li class="text-center"><a href="{{ route('login') }}"><i class="fi-rr-user"
                                style="font-size: 20px"></i> login / Register</a></li>
                    <li><a href="{{ route('homepage') }}">Home</a></li>
                    <li><a href="{{ route('shops', ['filter_products' => 'trending']) }}"
                            style="font-size: 14px">Trending </a></li>
                    <li class=""><a href="{{ route('shops', ['filter_products' => 'most-popular']) }}"
                            style="font-size: 14px">Best
                            Seller</a>


                    </li>
                    <li class="dropdown"><a href="javascript:void(0)">Saves</a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('wishlist.index') }}">Save Products</a></li>
                            <li><a href="{{ route('follow.shops') }}">Followed Shops</a></li>

                        </ul>
                    </li>

                    <li class="dropdown"><a href="{{ url('/vendors') }}" id=""
                            style="font-size: 14px">Vendors </a>

                    </li>
                    <li class="dropdown"><a href="#footer" id="" style="font-size: 14px">Help <i
                                class="far fa-question-circle ml-1"></i></a>

                    </li>


                </ul>
            </div>

        </div>
    </div>
    <!-- ekka mobile Menu End -->
</header>

<!-- Header End  -->

<!-- ekka Cart Start -->
<div class="ec-side-cart-overlay" @if (Request('cart') == 'show') style="display:block" @endif></div>
<div id="ec-side-cart" class="ec-side-cart {{ Request('cart') == 'show' ? 'ec-open' : '' }}">
    <div class="ec-cart-inner">
        <div class="ec-cart-top">
            <div class="ec-cart-title">
                <span class="cart_title">My Cart</span>

                <a href="{{ route('homepage') }}" class=""
                    style="position: relative;border: 0;font-size: 30px;line-height: 1;color: #555;">×</a>
            </div>
            @if (Cart::count() > 0)
                <ul class="eccart-pro-items">
                    @foreach (Cart::getContent() as $product)
                        <li class="d-flex align-items-center">
                            <a href="product-left-sidebar.html" class="sidekka_pro_img"><img
                                    src="{{ Storage::url($product->model->image) }}" alt="product"></a>

                            <div class="ec-pro-content ">

                                <a href="" class="cart_pro_title">{{ $product->name }} (
                                    {{ $product->quantity }})</a>

                                <span class="cart-price">{{ $product->price }}$</span>


                                <a href="{{ route('cart.destroy', $product->id) }}"
                                    onclick="return confirm('Are you sure you want to delete this item?');"
                                    class="remove">x</a>
                            </div>
                        </li>
                    @endforeach

                </ul>
            @else
                <h2><span>No items in your cart</span></h2>
            @endif
        </div>
        <div class="ec-cart-bottom">
            <div class="cart-sub-total">
                @if (Cart::count() > 0)
                    <table class="table cart-table">`
                        <tbody>
                            <tr>
                                <td class="text-left">Sub-Total :</td>
                                <td class="text-right">${{ Cart::getSubTotal() }}</td>
                            </tr>
                            {{-- <tr>
                            <td class="text-left">VAT (20%) :</td>
                            <td class="text-right">{{ Sohoj::price(Sohoj::tax()) }}</td>
                        </tr> --}}
                            <tr>
                                <td class="text-left">Total :</td>
                                <td class="text-right primary-color">${{ Cart::getTotal() }}</td>
                            </tr>
                        </tbody>
                    </table>
                @endif
            </div>
            @if (Cart::count() > 0)
                <div class="cart_btn continue">
                    <a href="{{ route('cart') }}" class="btn btn-dark">View Cart</a>
                    <a href="{{ route('checkout') }}" class="btn btn-secondary">Checkout</a>
                </div>
            @endif
        </div>

    </div>
</div>


<div class="modal fade" id="location" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Set Location</h1>
                <button type="button" id="" class="btn-close closeButton" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ route('location.search.query') }}" method="get">
                <div class="modal-body">

                    <div class="input-group">
                        <div class="location-search-group">
                            <div class="ec-select-inner category-drop  sellers-dropdown me-0 location-search"
                                style="border: 1px solid #b9b3b3;">
                                <select name="state" class="cat-select " id="stateSearch"
                                    style="font-weight: 400;color:black !important;font-size:16px;margin-right: 25px;"
                                    wire:model="ss">
                                    <option value="">
                                        Select your State
                                    </option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state }}" style="font-weight:500"
                                            {{ session('state') == $state ? 'selected' : '' }}>
                                            {{ $state }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="input-group-append location-city">

                            {{-- <input type="text" name="post_city" id="cityInput" class="form-control"
                                placeholder="    your city or post code" value="{{session('post_city')}}"> --}}
                            <select multiple name="post_city[]" id="cityInput" class="form-select"
                                style="border: .5px solid !important; border-radius:0 !important;">

                            </select>

                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="" class="btn btn-dark "
                        data-bs-dismiss="modal">Search</button>
                    <a href="{{ route('location.reset') }}" class="btn btn-danger">Reset</a>
                    <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
                </div>
            </form>
        </div>
    </div>
</div>
{{-- <div class="modal fade" id="location" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Set Location</h1>
                <button type="button" id="" class="btn-close closeButton" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div id="map"></div>

            <div class="modal-footer">
                <a href="{{ route('location.reset') }}" class="btn btn-primary">Reset</a>
                <button type="button" id="closeButton" class="btn btn-dark " data-bs-dismiss="modal">save</button>
                <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
            </div>
            </form>
        </div>
    </div>
</div> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {

        $('#cityInput').select2();
    
        var selectedState = $('#stateSearch').val();

            if (selectedState) {
                $.ajax({
                    type: 'POST',
                    url: '/get-state',
                    data: {
                        _token: '{{ csrf_token() }}',
                        state: selectedState,
                    },

                    success: function(data) {
                        var cityInput = $('#cityInput');
                        cityInput.empty();
                        cityInput.append('<option value="">Select your City</option>');
                        $.each(data, function(key, value) {
                            var selectedCities =
                                @json(session()->get('post_city', [])); // Laravel code
                            var selected = selectedCities.includes(key) ?
                                'selected' : '';
                            cityInput.append('<option value="' + key + '" ' +
                                selected + '>' +
                                value + '</option>');
                        });
                    }
                });
            } else {
                $('#cityInput').empty(); // Clear the city dropdown if no state is selected.
            }


        $('#stateSearch').on('change', function() {
            var selectedState = $(this).val();
            if (selectedState) {
                $.ajax({
                    type: 'POST',
                    url: '/get-state',
                    data: {
                        _token: '{{ csrf_token() }}',
                        state: selectedState,
                    },

                    success: function(data) {
                        var cityInput = $('#cityInput');
                        cityInput.empty();
                        cityInput.append('<option value="">Select your City</option>');
                        $.each(data, function(key, value) {
                            var selectedCities =
                                @json(session()->get('post_city', [])); // Laravel code
                            var selected = selectedCities.includes(key) ?
                                'selected' : '';
                            cityInput.append('<option value="' + key + '" ' +
                                selected + '>' +
                                value + '</option>');
                        });
                    }
                });
            } else {
                $('#cityInput').empty(); // Clear the city dropdown if no state is selected.
            }
        });
    });
</script>






<script>
    // Add event listener to the close button
    document.getElementById("closeButton").addEventListener("click", function() {
        // Reload the window
        location.reload();
    });
</script>
<script>
    // Initialize the map
    var map;
    var geocoder;
    var newlat = {{ session()->has('location') ? session('location')['lat'] : 42.28169 }};
    var newlng = {{ session()->has('location') ? session('location')['lng'] : -73.80106 }};
    var radius = {{ session()->has('location') ? session('location')['radius'] : 1000 }};
    var circle;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: newlat,
                lng: newlng
            }, // New York coordinates
            zoom: 13,
            styles: [{
                featureType: "poi",
                elementType: "labels",
                stylers: [{
                    visibility: "off"
                }]
            }]
        });

        circle = new google.maps.Circle({
            map: map,
            center: {
                lat: newlat,
                lng: newlng
            }, // New York coordinates
            radius: radius,
            editable: true
        });

        var centerMarker = new google.maps.Marker({
            position: circle.getCenter(),
            map: map,
            draggable: true
        });

        geocoder = new google.maps.Geocoder();

        // Add an event listener to track changes in circle radius and center
        google.maps.event.addListener(circle, 'radius_changed', function() {
            var newRadius = circle.getRadius();
            searchPostcodes(circle.getCenter(), newRadius);
        });

        google.maps.event.addListener(circle, 'center_changed', function() {
            var newRadius = circle.getRadius();
            searchPostcodes(circle.getCenter(), newRadius);
        });
    }

    // Function to search for postcodes using reverse geocoding
    function searchPostcodes(center, radius) {
        var bounds = circle.getBounds();

        var pointCount = 36; // Number of points on the circle
        var angleStep = (2 * Math.PI) / pointCount;

        var promises = []; // Array to store geocoding promises

        for (var i = 0; i < pointCount; i++) {
            var angle = i * angleStep;
            var dx = radius * Math.cos(angle);
            var dy = radius * Math.sin(angle);

            var latLng = new google.maps.LatLng(center.lat() + dx / 111319, center.lng() + dy / (111319 * Math.cos(
                center.lat() * Math.PI / 180)));
            bounds.extend(latLng);

            var promise = geocodeLatLng(latLng);
            promises.push(promise);
        }

        // Wait for all promises to resolve
        Promise.all(promises)
            .then(function(results) {
                var postcodes = results
                    .filter(function(result) {
                        return result && result.address_components;
                    })
                    .map(function(result) {
                        return extractPostcode(result.address_components);
                    });

                var lng = center.lng();
                var lat = center.lat();
                var state = extractState(results); // Extract state name

                setLocation(postcodes, lng, lat, radius, state); // Include state in data sent to server
            })
            .catch(function(error) {
                console.log(error);
            });

        map.fitBounds(bounds);
    }

    // Function to perform reverse geocoding
    function geocodeLatLng(latLng) {
        return new Promise(function(resolve, reject) {
            geocoder.geocode({
                location: latLng
            }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK && results.length > 0) {
                    resolve(results[0]);
                } else {
                    resolve(null);
                }
            });
        });
    }

    // Function to extract postcode from address components
    function extractPostcode(components) {
        for (var i = 0; i < components.length; i++) {
            var component = components[i];
            if (component.types.includes('postal_code')) {
                return component.long_name;
            }
        }
        return null;
    }

    // Function to extract state name from results
    function extractState(results) {
        for (var i = 0; i < results.length; i++) {
            var result = results[i];
            var addressComponents = result.address_components;
            for (var j = 0; j < addressComponents.length; j++) {
                var addressComponent = addressComponents[j];
                if (addressComponent.types.includes('administrative_area_level_1')) {
                    return addressComponent.long_name;
                }
            }
        }
        return null;
    }

    function setLocation(postcodes, lng, lat, radius, state) {
        var data = {
            postcodes: postcodes,
            lng: lng,
            lat: lat,
            radius: radius,
            state: state // Include state in the data sent to the server
        };

        $.ajax({
            url: '/set-location',
            type: 'get',
            data: data,
            success: function(response) {
                // Handle success response
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.log(xhr.responseText);
            }
        });
    }
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCs1ZPEcNnbEdIaS8L07OVhwNP3dVUM2Fc&callback=initMap"></script>
