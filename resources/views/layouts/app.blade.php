<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>@yield('title', 'Sohoj E-commerce')</title>
    <meta name="description" content="@yield('meta_description', 'This is a demo e-commerce website built with Laravel and Voyager.')">
    <meta name="keywords" content="@yield('meta_keywords', 'ecommerce, online shop, sohoj, buy, sell, products')">
    <!-- Open Graph & Twitter Card Placeholders -->
    @yield('meta_og')
    @yield('meta_twitter')
    <meta name="author" content="sayed khan">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- site Favicon -->
    <link rel="icon" href="{{ asset('assets/logo/favicon.png') }}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{ asset('assets/logo/favicon.png') }}" />
    <meta name="msapplication-TileImage" content="{{ asset('assets/logo/favicon.png') }}" />


    <!-- css Icon Font -->
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/vendor/ecicons.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    {{-- google font --}}


    <!-- css All Plugins Files -->


    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/plugins/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/plugins/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/plugins/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/plugins/countdownTimer.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/plugins/nouislider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/plugins/slick.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/plugins/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/plugins/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/plugins/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/star-rating.css') }}">
    <link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">


    <link
        href="https://fonts.googleapis.com/css2?family=Arya&family=Great+Vibes&family=Inter:wght@200;400;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Inter';
        }

        .category-drop::after {
            top: 7px !important;
        }
    </style>



    <!-- Main Style -->

    @yield('css')

    <style>
        .ec-footer {
            background: #fff !important;
        }

        .ec-footer .footer-top .ec-footer-widget .ec-footer-links .ec-footer-link:not(:last-child) {
            /* margin-bottom: 0 !important; */

        }

        .ec-footer .footer-top .ec-footer-widget .ec-footer-heading {
            color: #212529 !important;

        }

        .ec-footer .footer-top .ec-footer-widget .ec-footer-heading::before {
            border-bottom: 1px solid #000000 !important;
        }

        .footer-bottom .ec-copy .site-name:hover {
            color: #000 !important;
            ;
        }

        #scrollUp {
            background-color: #000000 !important;
        }

        .is-invalid {
            border: 1px solid red !important;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @livewireStyles
    <link rel="canonical" href="@yield('canonical_url', url()->current())" />
    @yield('jsonld')
    @yield('jsonld_breadcrumb')
</head>

<body>
    <!-- <div id="ec-overlay">
        <div class="ec-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div> -->
    <!-- Header start  -->
    <main id="main-content" tabindex="-1">
        @yield('content')
    </main>

    <!-- Footer Start -->
    <footer class="footer-modern py-5 text-light" id="footer" style="background: #1a2238;">
        <div class="container">
            <div class="row gy-5 align-items-start">
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="fw-bold mb-3 text-uppercase">Newsletter</h6>
                    <p class="mb-2" style="color:#b8c1ec; font-size: 0.97rem;">Subscribe to our newsletter and be the
                        first to know about new arrivals, exclusive deals, and special offers!</p>
                    <form class="d-flex" name="ec-newsletter-form" method="post" action="{{ route('subscribe') }}">
                        @csrf
                        <input type="email" class="form-control form-control-sm bg-dark border-0 text-light me-2"
                            name="email" placeholder="Your email" required>
                        <button class="btn btn-pink btn-sm px-3" type="submit">Subscribe</button>
                    </form>
                    <small class="d-block mt-2" style="color:#b8c1ec;">Get the latest updates and offers.</small>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="fw-bold mb-3 text-uppercase" style="color:#fff;letter-spacing:1px;">Account</h6>
                    <x-menu name="leftside" />
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="fw-bold mb-3 text-uppercase" style="color:#fff;letter-spacing:1px;">Useful Links</h6>
                    <x-menu name="middle" />
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="fw-bold mb-3 text-uppercase" style="color:#fff;letter-spacing:1px;">Customer Service
                    </h6>
                    <x-menu name="main" />
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="fw-bold mb-3 text-uppercase" style="color:#fff;letter-spacing:1px;">Social links</h6>
                    <p class="mt-3 small" style="color:#b0b8c1;">Your trusted marketplace for quality products and
                        great deals.</p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i
                                class="fab fa-instagram"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i
                                class="fab fa-twitter"></i></a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

            </div>
            <hr class="my-4" style="border-color: #232a36;">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start small" style="color:#b0b8c1;">
                    &copy; {{ date('Y') }} <a href="{{ route('homepage') }}"
                        class="fw-bold text-light text-decoration-none">Sohoj E-commerce</a>. All rights reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <img src="{{ asset('assets/img/cards.png') }}" alt="Payment Methods" style="height: 32px;">
                </div>
            </div>
        </div>
    </footer>
    <style>
        .footer-modern h6 {
            /* border-bottom: 2px solid #f4d160; */
            color: #ffffff;
        }

        .footer-modern .footer-link {
            color: #eaeaea;
        }

        .footer-modern .footer-link:hover {
            color: #f4d160;
        }

        .footer-modern .btn-outline-light {
            border: 1px solid #009e4a;
        }

        .footer-modern .btn-outline-light:hover {
            background: #009e4a;
            color: #ffffff !important;
        }

        .footer-modern .btn-pink,
        .btn-pink {
            background: #009e4a !important;
            color: #fcfcfc !important;
            border: none !important;
        }

        .footer-modern .btn-pink:hover,
        .btn-pink:hover {
            background: #fff !important;
            color: #1a2238 !important;
        }

        .footer-modern hr {
            border-color: #222b45;
        }
    </style>
    <!-- Footer Area End -->


    <div class="modal fade" id="ec_quickview_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close qty_close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <div class="modal-body" id="quick_view">

                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter Modal Start -->
    {{-- <div id="ec-popnews-bg"></div> --}}
    {{-- <div id="ec-popnews-box">
        <div id="ec-popnews-close"><i class="ecicon eci-close"></i></div>
        <div class="row">
            <div class="col-md-6 disp-no-767">
                <img src="{{ Voyager::image(setting('site.newslletter_logo')) }}" alt="newsletter">
            </div>
            <div class="col-md-6">
                <div id="ec-popnews-box-content">
                    <h2>Subscribe Newsletter</h2>
                    <p>Subscribe the ekka ecommerce to get in touch and get the future update. </p>
                    <form id="ec-popnews-form" action="{{ route('subscribe') }}" method="post">
                        @csrf
                        <input type="email" name="email" placeholder="Email Address" required />
                        <button type="submit" class="btn btn-primary" name="subscribe">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Newsletter Modal end -->


    <!-- Footer navigation panel for responsive display -->
    {{-- <div class="ec-nav-toolbar">
        <div class="container">
            <div class="ec-nav-panel">
                <div class="ec-nav-panel-icons">
                    <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><i
                            class="fi-rr-menu-burger"></i></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="#ec-side-cart" class="toggle-cart ec-header-btn ec-side-toggle"><i
                            class="fi-rr-shopping-bag"></i><span
                            class="ec-cart-noti ec-header-count cart-count-lable">3</span></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="{{ route('homepage') }}" class="ec-header-btn"><i class="fi-rr-home"></i></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="wishlist.html" class="ec-header-btn"><i class="fi-rr-heart"></i><span
                            class="ec-cart-noti">4</span></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="login.html" class="ec-header-btn"><i class="fi-rr-user"></i></a>
                </div>

            </div>
        </div>
    </div> --}}

    <x-alert :exclude="[route('user.update_profile')]" />

    <!-- Vendor JS -->
    <script src="{{ asset('assets/frontend-assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>

    <!--Plugins JS-->

    <script src="{{ asset('assets/frontend-assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/countdownTimer.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/nouislider.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/slick.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/infiniteslidev2.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/click-to-call.js') }}"></script>

    <!-- Main Js -->
    <!-- <script src="{{ asset('assets/js/filter.js') }}"></script> -->
    <script src="{{ asset('assets/frontend-assets/js/vendor/index.js') }}"></script>
    <script src="{{ asset('assets/js/star-rating.js') }}"></script>
    <script src="cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        function cartQnty() {
            $.ajax({
                type: 'get',
                url: '/cart-qty',
                success: function(response) {
                    console.log(response);

                    $('#cartQty').text(response);
                    $('#cartQty2').text(response);
                    if (response == 0) {
                        $('#cartQty').hide();
                    } else {
                        $('#cartQty').show();
                    }
                },
                error: function(xhr) {
                    // Handle the error response
                    console.log(xhr.responseText);
                }
            });
        }

        cartQnty();
        console.log(cartQnty())
        $(document).ready(function() {
            $('.cart-store').click(function() {
                var addToCartBtn = $(this);
                var productId = $(this).data('product-id');
                var quantity = $('.addToCartForm_' + productId).find('.qty').val();
                var oldQty = "{{ Cart::count() }}";
                var parentDiv = $(this).closest('.ec-product-inner');

                $.ajax({
                    type: 'POST',
                    url: '/add-cart',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        // Handle the success response
                        console.log(response);
                        cartQnty();
                        addToCartBtn.attr('disabled', true);
                        parentDiv.find('.fi-rr-shopping-basket').addClass('text-success').attr(
                            'disabled', true);
                        parentDiv.find('#addToCartBtn').text('added').attr('disabled', true);

                    },
                    error: function(xhr) {
                        // Handle the error response
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        function quickView(id) {

            $.ajax({
                url: '/quickview',
                method: 'GET',
                data: {
                    product_id: id
                },
                success: function(response) {
                    $('#ec_quickview_modal').modal('show')
                    $('#quick_view').html(response)
                },

            });
        }
    </script>


    <script>
        function wishlist(id) {

            $.ajax({
                url: '/wishlist/add',
                method: 'GET',
                data: {
                    productId: id
                },
                success: function() {
                    var element = $('.add-wish-new_' + id);
                    if (element.hasClass('fa-solid')) {
                        element.addClass('fa-regular').removeClass('fa-solid text-success');
                    } else {
                        element.addClass('fa-solid text-success').removeClass('fa-regular ');
                    }


                }

            });
        }
    </script>

    <script>
        var shopUrl = "{{ route('shops') }}";

        $(document).ready(function() {
            $('#ratingForm input[type="checkbox"]').on('change', function() {
                if ($(this).is(':checked')) {
                    updateSearchParams("ratings", $(this).val(), shopUrl);
                } else {
                    removeSearchParam("ratings", shopUrl);
                }
            });

            $("#price-slider").slider({
                range: true,
                min: {{ request()->has('priceMin') ? request('priceMin') : 0 }},
                max: {{ request()->has('priceMax') ? request('priceMax') : 1000 }},
                values: [0, 1000],
                slide: function(event, ui) {
                    $("#minPriceDisplay").text(ui.values[0]);
                    $("#maxPriceDisplay").text(ui.values[1]);
                },
                stop: function(event, ui) {
                    updateSearchParams('', '', shopUrl, ui.values[0], ui.values[1]);
                }
            });

            // Display initial price values
            $("#minPriceDisplay").text($("#price-slider").slider("values", 0));
            $("#maxPriceDisplay").text($("#price-slider").slider("values", 1));
        });

        function updateSearchParams(searchParam, searchValue, route, priceMin, priceMax) {
            var url;
            console.log(searchValue);

            if (window.location.pathname !== "/shops" || (new URL(route)).pathname == '/vendors') {
                url = new URL(route);
            } else {
                url = new URL(window.location.href);
            }

            url.searchParams.set(searchParam, searchValue);

            // Set the price range parameters if provided
            if (priceMin !== undefined) {
                url.searchParams.set('priceMin', priceMin);
            }

            if (priceMax !== undefined) {
                url.searchParams.set('priceMax', priceMax);
            }

            var existingParams = new URLSearchParams(window.location.search);
            existingParams.delete(searchParam);

            // Remove existing price range parameters
            existingParams.delete('priceMin');
            existingParams.delete('priceMax');

            existingParams.forEach(function(value, key) {
                url.searchParams.set(key, value);
            });

            var newUrl = url.href;
            window.location = newUrl;
        }

        function removeSearchParam(searchParam, route) {
            var url;

            if (window.location.pathname !== "/shops" || (new URL(route)).pathname == '/vendors') {
                url = new URL(route);
            } else {
                url = new URL(window.location.href);
            }

            var existingParams = new URLSearchParams(window.location.search);
            existingParams.delete(searchParam);

            var newUrl = url.href.split('?')[0] + '?' + existingParams.toString();
            window.location = newUrl;
        }
    </script>


    <script>
        $("#product_rating").rating({
            showCaption: true
        });
        $(".published_rating").rating({
            showCaption: false,
            readonly: true,
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @yield('js')

    <script>
        $(document).ready(function() {
            $('.toast').toast('show');
        })
        $('.toast_close').click(function() {
            $('.toast').toast('hide');
        })
    </script>
    @if (session()->has('subscribeEmail'))
        <script>
            var dataValue = true;
            ecCreateCookie('ecPopNewsLetter', dataValue, 1);
        </script>
    @endif
</body>

</html>
