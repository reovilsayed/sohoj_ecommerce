@extends('layouts.app')

@section('content')
    <x-app.header />
    {{-- <x-app.breadcrumb /> --}}


    <!-- Vendor dashboard section -->
    <section class="ec-page-content ec-vendor-dashboard section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <x-app.user_sidebar />
                @yield('dashboard-content')
            </div>

        </div>
    </section>
    <!-- End Vendor dashboard section -->
@endsection
@section('js')
    <script src="{{ asset('assets/frontend-assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>

    <script src="{{ asset('assets/frontend-assets/js/main.js') }}"></script>
@endsection
