@extends('layouts.app')
@section('title', 'Afrikartt E-commerce | Home')
@section('meta_description',
    'Discover trending products, top shops, and exclusive deals on Afrikartt E-commerce. Shop by
    category and enjoy a seamless online shopping experience.')
@section('meta_keywords', 'ecommerce, online shopping, trending products, best shops, Afrikartt')
@section('meta_og')
    <meta property="og:title" content="Afrikartt E-commerce | Home">
    <meta property="og:description"
        content="Discover trending products, top shops, and exclusive deals on Afrikartt E-commerce. Shop by category and enjoy a seamless online shopping experience.">
    <meta property="og:image" content="{{ Settings::setting('site_logo') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
@endsection
@section('meta_twitter')
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Afrikartt E-commerce | Home">
    <meta name="twitter:description"
        content="Discover trending products, top shops, and exclusive deals on Afrikartt E-commerce. Shop by category and enjoy a seamless online shopping experience.">
    <meta name="twitter:image" content="{{ Settings::setting('site_logo') }}">
@endsection
@section('canonical_url', route('homepage'))

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/responsive.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/demo2.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/shops.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend-assets/css/demo3.css') }}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <style>
        @media screen and (max-width:768px) {

            .category-thumbnail {
                height: auto !important;
            }
        }

        .border-hover:hover {
            border: 1px solid black;
        }

        .border-hover {
            border-radius: 10px;
        }







        .hero-slider-wrapper {
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(141, 110, 99, 0.08);
        }

        .hero-slider {
            display: flex;
            overflow: hidden;
            scroll-snap-type: x mandatory;
        }

        .hero__item {
            flex: 0 0 100%;
            min-height: 300px;
            height: 60vw;
            max-height: 431px;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            padding: 0 5%;
            scroll-snap-align: start;
            transition: transform 0.5s ease-in-out;
        }

        .hero__text {
            max-width: 600px;
        }

        .hero__text span {
            font-size: 14px;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 4px;
            color: var(--accent-color);
        }

        .hero__text h2 {
            font-size: clamp(28px, 5vw, 46px);
            color: var(--text-dark);
            line-height: 1.2;
            font-weight: 700;
            margin: 10px 0;
        }

        .hero__text p {
            margin-bottom: 35px;
            font-size: 16px;
            color: var(--text-secondary);
        }

        .primary-btn {
            display: inline-block;
            font-size: 14px;
            padding: 10px 28px;
            color: var(--text-light);
            text-transform: uppercase;
            font-weight: 700;
            background: var(--accent-color);
            border-radius: 4px;
            letter-spacing: 1px;
            transition: background 0.3s ease;
            text-decoration: none;
        }

        .primary-btn:hover,
        .primary-btn:focus {
            background: var(--primary-dark);
            outline: 2px solid var(--text-light);
            outline-offset: 2px;
        }

        .slider-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }

        .slider-dots .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .slider-dots .dot.active {
            background: var(--accent-color);
        }

        @media (min-width: 768px) {
            .hero__item {
                padding-left: 75px;
            }

        }





        /* Header */
        .hero__categories__all {
            background: var(--accent-color) !important;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .hero__categories__all::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .hero__categories__all:hover::before {
            left: 100%;
        }

        .hero__categories__all:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 25px var(--shadow-primary);
        }

        .category-icon-wrapper {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .category-toggle-icon {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .category-toggle-icon:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        /* Category List Styling */
        .category-list-wrapper {
            background: #f8f9fa;
        }

        .category-item {
            transition: all 0.3s ease;
        }

        .category-link {
            background: var(--bg-secondary);
            border: 1px solid var(--border-light);
            transition: all 0.3s ease;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .category-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, var(--shadow-primary), transparent);
            transition: left 0.5s ease;
        }

        .category-link:hover::before {
            left: 100%;
        }

        .category-link:hover {
            background: var(--bg-light);
            border-color: var(--accent-color);
            transform: translateX(5px);
            box-shadow: 0 4px 15px var(--shadow-primary);
        }

        .category-link:hover .fas.fa-chevron-right {
            transform: translateX(3px);
            color: var(--accent-color) !important;
        }

        .category-icon {
            background: var(--accent-color);
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-light) !important;
            font-size: 12px;
        }

        .category-sub-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 16px;
            height: 16px;
        }

        .category-sub-icon .fas.fa-circle {
            color: #6c757d !important;
        }

        /* Scrollbar styling */
        #static-category-list::-webkit-scrollbar {
            width: 6px;
        }

        #static-category-list::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #3bb77e, #2d9d6b);
            border-radius: 4px;
        }

        #static-category-list::-webkit-scrollbar-track {
            background-color: #f1f1f1;
            border-radius: 4px;
        }

        /* Animation for chevron */
        .transition {
            transition: all 0.3s ease;
        }

        /* Hover effects for category items */
        .category-item:hover .category-icon {
            transform: scale(1.1);
            box-shadow: 0 4px 12px var(--shadow-primary);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero__categories {
                margin-bottom: 1rem;
            }

            .category-link {
                padding: 0.75rem !important;
            }

            .category-icon {
                width: 28px;
                height: 28px;
                font-size: 10px;
            }
        }

        /* New Category Cards Design */
        .category-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--accent-color);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .category-card:hover::before {
            transform: scaleX(1);
        }

        .category-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 20px 60px var(--shadow-medium);
            border-color: var(--accent-color);
        }

        .category-card-inner {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .category-image-wrapper {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .category-image {
            position: relative;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .category-img {
            /* width: 100%; */
            height: 100% !important;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .category-card:hover .category-img {
            transform: scale(1.1);
        }

        .category-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--accent-color);
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.3s ease;
        }

        .category-card:hover .category-overlay {
            opacity: 1;
        }

        .category-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .category-icon i {
            color: var(--text-light);
            font-size: 20px;
        }

        /* Category Badge */
        .category-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 2;
        }

        .category-badge .badge {
            background: var(--accent-color) !important;
            border: 2px solid var(--text-light);
            box-shadow: 0 2px 8px var(--shadow-medium);
            font-weight: 600;
            font-size: 0.75rem;
        }

        /* Category Stats */
        .category-stats {
            position: absolute;
            top: 15px;
            right: 15px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            z-index: 2;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 6px 12px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #2c3e50;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .stat-item i {
            color: var(--accent-color);
            font-size: 0.7rem;
        }

        .category-content {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
        }

        .category-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0;
            line-height: 1.3;
            flex: 1;
        }

        .category-rating {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stars {
            display: flex;
            gap: 2px;
        }

        .stars i {
            color: #ffc107;
            font-size: 0.8rem;
        }

        .rating-text {
            font-size: 0.75rem;
            color: #6c757d;
            font-weight: 500;
        }

        .category-meta {
            margin-bottom: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .shop-count {
            font-size: 0.85rem;
            color: #6c757d;
            display: flex;
            align-items: center;
        }

        .shop-count i {
            color: var(--accent-color);
        }

        .product-count {
            font-size: 0.85rem;
            color: #6c757d;
            display: flex;
            align-items: center;
        }

        .product-count i {
            color: #6c757d;
        }

        /* Category Tags */
        .category-tags {
            display: flex;
            gap: 6px;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .tag {
            background: var(--bg-light);
            color: var(--accent-color);
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            border: 1px solid var(--border-light);
        }

        .category-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            margin-top: auto;
            padding: 12px 16px;
            background: var(--bg-light);
            border-radius: 12px;
            border: 1px solid var(--border-light);
        }

        .category-link:hover {
            color: var(--primary-dark);
            background: var(--bg-light);
            border-color: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px var(--shadow-primary);
        }

        .link-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background: var(--accent-color);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .link-icon i {
            color: var(--text-light);
            font-size: 0.7rem;
            transition: transform 0.3s ease;
        }

        .category-link:hover .link-icon {
            background: var(--primary-dark);
            transform: scale(1.1);
        }

        .category-link:hover .link-icon i {
            transform: translateX(2px);
        }

        /* Category section responsive */
        @media (max-width: 768px) {
            .category-card {
                margin-bottom: 1rem;
            }

            .category-image {
                height: 150px;
            }

            .category-content {
                padding: 1rem;
            }

            .category-title {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .category-image {
                height: 120px;
            }

            .category-content {
                padding: 0.75rem;
            }

            .category-title {
                font-size: 0.9rem;
            }

            .category-link {
                font-size: 0.8rem;
            }
        }

        /* Category Slider Styles */
        .category-slider-container {
            position: relative;
            margin: 0 auto;
        }

        .category-slider-wrapper {
            position: relative;
            overflow: hidden;
            padding: 20px 0;
        }

        .category-slider {
            display: flex;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            gap: 30px;
        }

        .category-slide {
            flex: 0 0 calc(25% - 22.5px);
            min-width: 280px;
            max-width: 320px;
        }





        /* Responsive Slider */
        @media (max-width: 1200px) {
            .category-slide {
                flex: 0 0 calc(33.333% - 20px);
            }
        }

        @media (max-width: 992px) {
            .category-slide {
                flex: 0 0 calc(50% - 15px);
            }

            .category-slider-container {
                padding: 0 50px;
            }
        }

        @media (max-width: 768px) {
            .category-slide {
                flex: 0 0 calc(100% - 10px);
                min-width: 250px;
            }
        }

        @media (max-width: 576px) {
            .category-slider-wrapper {
                padding: 15px 0;
            }
        }

        /* View More Shops Button Design */
        .view-more-shops-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 1rem;
        }

        .view-more-shops-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 7px 14px;
            background: var(--accent-color);
            color: var(--text-light);
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 32px var(--shadow-primary);
            border: 2px solid transparent;
            min-width: 280px;
            justify-content: center;
        }

        .view-more-shops-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .view-more-shops-btn:hover::before {
            left: 100%;
        }

        .view-more-shops-btn:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 16px 48px var(--shadow-primary);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .view-more-shops-btn:active {
            transform: translateY(-2px) scale(1.01);
        }

        .btn-text {
            position: relative;
            z-index: 2;
            font-weight: 700;
        }

        .btn-icon {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .btn-icon i {
            font-size: 14px;
            color: var(--text-light);
        }

        .view-more-shops-btn:hover .btn-icon {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1) rotate(5deg);
        }

        .btn-arrow {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .btn-arrow i {
            font-size: 12px;
            color: var(--text-light);
            transition: transform 0.3s ease;
        }

        .view-more-shops-btn:hover .btn-arrow {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.1);
        }

        .view-more-shops-btn:hover .btn-arrow i {
            transform: translateX(3px);
        }

        .btn-shine {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .view-more-shops-btn:hover .btn-shine {
            opacity: 1;
        }

        /* Button responsive design */
        @media (max-width: 768px) {
            .view-more-shops-btn {
                padding: 16px 28px;
                font-size: 1rem;
                min-width: 260px;
                gap: 10px;
            }

            .btn-icon {
                width: 28px;
                height: 28px;
            }

            .btn-icon i {
                font-size: 12px;
            }

            .btn-arrow {
                width: 20px;
                height: 20px;
            }

            .btn-arrow i {
                font-size: 10px;
            }
        }

        @media (max-width: 576px) {
            .view-more-shops-btn {
                padding: 14px 24px;
                font-size: 0.95rem;
                min-width: 240px;
                gap: 8px;
            }

            .btn-text {
                font-size: 0.9rem;
            }
        }

        /* Button animation on page load */
        @keyframes buttonEntrance {
            0% {
                opacity: 0;
                transform: translateY(20px) scale(0.9);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .view-more-shops-btn {
            animation: buttonEntrance 0.6s ease-out;
        }

        /* Category Carousel Section */
        /* Container */
        .category-carousel-container {
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 20px 0;
        }

        /* Carousel */
        .category-carousel {
            display: flex;
            flex-wrap: wrap;
            gap: 32px 24px;
            justify-content: center;
            width: 100%;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 0 60px;
            scrollbar-width: none;
        }

        .category-carousel::-webkit-scrollbar {
            display: none;
        }

        /* Category Item */
        .category-circle-link {
            text-decoration: none;
        }

        .category-circle {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: box-shadow 0.2s, transform 0.2s, border 0.2s;
            cursor: pointer;
            border: 2px solid #0000004f;
            position: relative;
        }

        .category-circle:hover {
            box-shadow: 0 8px 24px var(--shadow-primary);
            border: 2px solid var(--accent-color);
            transform: translateY(-4px) scale(1.04);
            background: var(--bg-light);
        }

        /* Circle Icon */
        .circle-icon {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: #f8f8f8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 10px;
            overflow: hidden;
        }

        .circle-icon img {
            width: 70%;
            height: 70%;
            object-fit: contain;
        }

        /* Category Name */
        .category-name {
            font-size: 14px;
            color: #222;
            word-break: break-word;
            margin-top: 2px;
        }

        /* Arrow Buttons */
        .category-arrow {
            position: absolute;
            top: 60%;
            transform: translateY(-50%);
            z-index: 2;
            background: #fff;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.13);
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.5rem;
            transition: background 0.2s;
        }



        .category-arrow:hover {
            background: var(--bg-light);
        }

        .left-arrow {
            left: 10px;
        }

        .right-arrow {
            right: 10px;
        }

        @media (max-width: 992px) {
            .category-carousel {
                gap: 24px 12px;
                padding: 0 20px;
            }

            .category-circle {
                width: 110px;
                height: 110px;
            }
        }

        @media (max-width: 576px) {
            .category-carousel {
                gap: 16px 8px;
                padding: 0 5px;
            }

            .category-circle {
                width: 90px;
                height: 90px;
            }

            .circle-icon {
                width: 36px;
                height: 36px;
                font-size: 1.2rem;
            }

            .category-name {
                font-size: 0.85rem;
            }
        }


        .custom-scroll {
            display: block;
            max-height: 324px;
            overflow-y: auto;
            background-color: #f9f9f9;
            padding-right: 8px;
            margin-bottom: 10px;
        }

        /* Chrome, Edge, Safari */
        .custom-scroll::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 10px;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 10px;
            border: 2px solid transparent;
            background-clip: content-box;
        }

        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background-color: #555;
        }

        /* Firefox */
        .custom-scroll {
            scrollbar-width: none;
            scrollbar-color: #888 #f0f0f0;
        }
    </style>
    <livewire:styles />
@endsection

@section('content')

    @php
        // Use Laravel cache for expensive queries
        use Illuminate\Support\Facades\Cache;
        use App\Models\Prodcat;
        use App\Models\Shop;
        $categories = Cache::remember('header_categories', 3600, function () {
            return Prodcat::whereNull('parent_id')->orderBy('role', 'asc')->with('childrens')->get();
        });

        $shops = Cache::remember('header_shops', 3600, function () {
            return Shop::latest()->get();
        });
    @endphp
    <x-app.header />
    {{-- <img src="{{Storage::url(auth()->user()->verification->signature)}}" alt="hello"> --}}
    <section class="hero">
        <div class="container-fluid">
            <div class="row mt-4">
                {{-- <div class="col-lg-3 ps-md-0 d-none d-md-block">
                    <div class="hero__categories rounded-4 shadow-lg overflow-hidden bg-white border-0">
                        <!-- Toggle Header -->
                        <div class="hero__categories__all d-flex align-items-center justify-content-between px-4 py-4 bg-gradient-primary"
                            onclick="toggleStaticCategory()">
                            <div class="d-flex align-items-center gap-3">
                                <div class="category-icon-wrapper">
                                    <i class="fas fa-th-large text-white fs-5"></i>
                                </div>
                                <div>
                                    <span class="fw-bold text-white fs-6">All Categories</span>
                                    <div class="text-white-50 small" style="    color: #ffffff !important;">Browse by
                                        category</div>
                                </div>
                            </div>
                            <div class="category-toggle-icon">
                                <i class="fas fa-chevron-down text-white transition" id="static-category-chevron"></i>
                            </div>
                        </div>

                        <!-- Category List -->
                        <div id="static-category-list" class="custom-scroll">
                            <div class="category-list-wrapper ps-2 pt-3">
                                @foreach ($categories as $category)
                                    <div class="category-item mb-2">
                                        <a href="{{ route('shops', ['category' => $category->slug]) }}"
                                            class="category-link d-flex align-items-center justify-content-between p-2 rounded-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="">
                                                    <i class="fas fa-circle text-muted" style="font-size: 6px;"></i>
                                                </div>
                                                <span class="fw-semibold text-dark">{{ $category->name }}</span>
                                            </div>
                                            <i class="fas fa-chevron-right text-muted small"></i>
                                        </a>
                                    </div>

                                    @foreach ($category->childrens as $child)
                                        <div class="category-item mb-1 ms-4">
                                            <a href="{{ route('shops', ['category' => $child->slug]) }}"
                                                class="category-link d-flex align-items-center justify-content-between p-2 rounded-3">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="category-sub-icon">
                                                        <i class="fas fa-circle text-muted" style="font-size: 6px;"></i>
                                                    </div>
                                                    <span class="text-secondary small">{{ $child->name }}</span>
                                                </div>
                                                <i class="fas fa-chevron-right text-muted" style="font-size: 10px;"></i>
                                            </a>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-5">
                    <x-banner.home-left-banner />
                </div>
           
                <div class="col-lg-7 pe-md-0">
                    <div class="hero-slider-wrapper">
                        <div class="hero-slider" role="region" aria-label="Product carousel">
                            @foreach ($sliders as $index => $slider)
                            
                                <div class="hero__item set-bg" onclick="window.location.href='{{ $slider->url }}'"
                                    style="background-image: url('{{ Storage::url($slider->image) }}');cursor: pointer"
                                    aria-hidden="{{ $index !== 0 ? 'true' : 'false' }}">
                                </div>
                            @endforeach
                        </div>

                        <!-- Navigation Dots -->
                        <div class="slider-dots">
                            @foreach ($sliders as $index => $slider)
                                <button class="dot{{ $index === 0 ? ' active' : '' }}"
                                    aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        </div>
                    </div>
                </div>
                

            </div>

        </div>
    </section>
    <!-- hero section end -->


    <!-- Main Slider End -->

    <!--  category Section Start -->
    <section class="section ec-category-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mb-5 mt-5">
                        <h1 class="related-product-sec-title mb-3">Browse Shops by Categories</h1>
                        <p class="text-muted fs-6">Discover amazing shops organized by categories</p>
                    </div>
                </div>
            </div>

            <div class="swiper category-swiper pb-5 pt-3">
                <div class="swiper-wrapper">
                    @foreach ($categories as $category)
                        <div class="swiper-slide">
                            <a href="{{ route('shops', ['category' => $category->slug]) }}" class="category-circle-link">
                                <div class="category-circle text-center">
                                    <div class="circle-icon mx-auto mb-2">
                                        @if (!empty($category->logo))
                                            <img src="{{ Storage::url($category->logo) }}" alt="{{ $category->name }}">
                                        @else
                                            <i class="fas fa-box-open"></i>
                                        @endif
                                    </div>
                                    <div class="category-name px-3">
                                        {{ Str::limit($category->name, 15) }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Swiper Arrows -->
                {{-- <div class="swiper-button-prev category-arrow"></div>
                <div class="swiper-button-next category-arrow"></div> --}}
            </div>


        </div>
    </section>
    <!--category Section End -->

    <!-- Product tab Area Start -->

    <section class="section ec-product-tab">
        <div class="container">
            <div class="row">

                <!-- Product area start -->
                @if ($latest_products->count() > 0)
                    <section class="section ec-new-product">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <div class="section-title">

                                        <h2 id="trending" class="related-product-sec-title"> Trending Products</h2>
                                    </div>
                                    <div class="ec-spe-section" data-animation="slideInLeft">
                                        <div class="ec-spe-products">
                                            @foreach ($latest_products->chunk(5) as $products)
                                                <div class="ec-fs-product">
                                                    <div class="ec-fs-pro-inner">
                                                        <div class="row row-cols-lg-5 cols-2 mt-4">
                                                            @foreach ($products as $product)
                                                                {{-- @dd($product) --}}
                                                                <x-products.product :product="$product" :variant="'green'"
                                                                    :showMultipleCategories="false" />
                                                            @endforeach
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- New Product Content -->


                    </section>
                @else
                    <h3 class="text-center text-danger my-5"> Please increase the location to see more products.</h3>
                @endif
                <!-- product area end -->
                <!-- Offer section  -->
                <div class="container">
                    <div class="row" style="height: max-content;">
                        <div class="col-lg-4 ps-0 d-flex mid-bn mb-4 me-5 margin-left img-fluid"
                            style="">
                    
                         <x-banner.home-one-left />
                        </div>
                    
                    
                        <div class="col-lg-7 mid-bn mb-4 img-fluid"
                            style="height: 100%;">
                    
                
                            <x-banner.home-one-right />
                    
                        </div>
                    </div>
                </div>
                <!-- Offer section end -->
                <!-- Product area start -->
                @if ($bestsaleproducts->count() > 0)
                    <section class="section ec-new-product">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <div class="section-title">

                                        <h2 id="bestSeller" class="related-product-sec-title"> Recommended For You</h2>
                                    </div>
                                    <div class="ec-spe-section  data-animation=" slideInLeft">


                                        <div class="ec-spe-products">
                                            @if ($recommandProducts->count() > 0)
                                                @foreach ($recommandProducts->chunk(5) as $products)
                                                    <div class="ec-fs-product">
                                                        <div class="ec-fs-pro-inner">
                                                            <div class="row row-cols-lg-5 cols-2 mt-4">
                                                                @foreach ($products as $product)
                                                                    <x-products.product :product="$product" :variant="'green'"
                                                                        :showMultipleCategories="false" />
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                @foreach ($bestsaleproducts->chunk(5) as $products)
                                                    <div class="ec-fs-product">
                                                        <div class="ec-fs-pro-inner">
                                                            <div class="row row-cols-lg-5 cols-2 mt-4">
                                                                @foreach ($products as $product)
                                                                    <x-products.product :product="$product" :variant="'green'"
                                                                        :showMultipleCategories="false" />
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- New Product Content -->
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </section>
    <!-- ec Product tab Area End -->
    <!-- Explore shop -->
    @if ($latest_shops->count() > 0)
        <section class="section ec-new-product">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-left">
                        <div class="section-title">

                            <h2 class="related-product-sec-title"> Trending Shops</h2>
                        </div>
                        <div class="ec-spe-section  data-animation="slideInLeft">
                            <div class="ec-spe-products">
                                @foreach ($latest_shops->chunk(4) as $shops)
                                    <div class="ec-fs-product">
                                        <div class="ec-fs-pro-inner">

                                            <div class="row mt-4">
                                                @foreach ($shops as $shop)
                                                    <div class="col-lg-3 col-12 mb-4 pro-gl-content-shop">
                                                        <x-shops-card.card-1 :shop="$shop" />
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>



                    </div>
                </div>
                <!-- New Product Content -->

            </div>
        </section>
    @endif
    <!-- New Product end -->
    <!-- Explore shop end -->
    <!-- Product tab Area Start -->
    @if ($latest_shops->count() > 0)
        <section class="section ec-product-tab section-space-p">
            <div class="container">
                <div class="row">
                    <div class=" col-md-12">
                        <h2 class="related-product-sec-title"> Recommended For You</h2>
                    </div>

                    <div class="tab-pane fade show active" id="all">
                        @foreach ($latest_shops as $shop)
                            @if ($shop->products->count())
                                <div class="row mb-4 mt-4">
                                    <div class="col-md-3 cols-12 pro-gl-content-shop">
                                        <x-shops-card.card-1 :shop="$shop" />
                                    </div>
                                    <div class="col-md-9">
                                        <div class="ec-spe-products">
                                            @foreach ($shop->products->whereNull('parent_id')->chunk(4) as $products)
                                                <div class="ec-fs-product">
                                                    <div class="ec-fs-pro-inner">
                                                        <div class="row">
                                                            @php
                                                                $last = $loop->last;
                                                                $count = $shop->products->count();
                                                            @endphp
                                                            @foreach ($products as $product)
                                                                <x-products.product :product="$product" :variant="'red'"
                                                                    :showMultipleCategories="true" />
                                                            @endforeach

                                                            {{-- @if ($last && $count >= 8)
                                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 pro-gl-content d-flex align-items-center"
                                                                    style="margin-bottom: 35px;">
                                                                    <a href="{{ route('store_front', $shop->slug) }}"
                                                                        class="btn btn-dark">View More</a>
                                                                </div>
                                                            @endif --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach


                        <div class="view-more-shops-container">
                            <a href="{{ route('vendors') }}" class="view-more-shops-btn">
                                <span class="btn-text" style="color: #ffffff">Explore All Shops</span>
                                <div class="btn-icon">
                                    <i class="fas fa-store"></i>
                                </div>
                                <div class="btn-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                                <div class="btn-shine"></div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- ec Product tab Area End -->


    <!-- Product tab area end -->
    </main>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    {{-- <livewire:scripts /> --}}
    <script src="{{ asset('assets/frontend-assets/js/demo-8.js') }}"></script>
    <script src="{{ asset('assets/frontend-assets/js/demo-3.js') }}"></script>

    <script>
        function toggleStaticCategory() {
            const list = document.getElementById('static-category-list');
            const icon = document.getElementById('static-category-chevron');
            const isVisible = list.style.display === 'block';

            list.style.display = isVisible ? 'none' : 'block';
            icon.className = isVisible ? 'fa fa-chevron-down text-dark' : 'fa fa-chevron-up text-dark';
        }

        // Category Slider Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('categorySlider');
            const slides = document.querySelectorAll('.category-slide');

            let currentSlide = 0;
            const slidesPerView = getSlidesPerView();
            const maxSlides = slides.length - slidesPerView;

            function getSlidesPerView() {
                if (window.innerWidth <= 576) return 1;
                if (window.innerWidth <= 768) return 1;
                if (window.innerWidth <= 992) return 2;
                if (window.innerWidth <= 1200) return 3;
                return 4;
            }

            function updateSlider() {
                const slideWidth = slides[0].offsetWidth + 30; // 30px gap
                const translateX = -currentSlide * slideWidth;
                slider.style.transform = `translateX(${translateX}px)`;
            }



            function nextSlide() {
                if (currentSlide < maxSlides) {
                    currentSlide++;
                    updateSlider();
                }
            }

            function prevSlide() {
                if (currentSlide > 0) {
                    currentSlide--;
                    updateSlider();
                }
            }



            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowLeft') {
                    prevSlide();
                } else if (e.key === 'ArrowRight') {
                    nextSlide();
                }
            });

            // Touch/swipe support
            let startX = 0;
            let endX = 0;

            slider.addEventListener('touchstart', function(e) {
                startX = e.touches[0].clientX;
            });

            slider.addEventListener('touchend', function(e) {
                endX = e.changedTouches[0].clientX;
                handleSwipe();
            });

            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = startX - endX;

                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        nextSlide();
                    } else {
                        prevSlide();
                    }
                }
            }

            // Resize handler
            window.addEventListener('resize', function() {
                const newSlidesPerView = getSlidesPerView();
                if (newSlidesPerView !== slidesPerView) {
                    currentSlide = 0;
                    updateSlider();
                }
            });

            // Initialize slider
            updateSlider();
        });

        // function scrollCategories(direction) {
        //     const carousel = document.getElementById('categoryCarousel');
        //     const scrollAmount = 300; // Adjust as needed
        //     carousel.scrollBy({
        //         left: direction * scrollAmount,
        //         behavior: 'smooth'
        //     });
        // }
    </script>
    <script>
        function scrollCategories(direction) {
            const carousel = document.getElementById('categoryCarousel');
            const scrollAmount = 300;
            carousel.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentSlide = 0;
            const slides = document.querySelectorAll('.hero__item');
            const dots = document.querySelectorAll('.slider-dots .dot');
            let slideInterval;
            const slideDuration = 5000;
            const sliderWrapper = document.querySelector('.hero-slider-wrapper');

            function updateSlider() {
                slides.forEach((slide, i) => {
                    slide.style.transform = `translateX(-${currentSlide * 100}%)`;
                    slide.setAttribute('aria-hidden', i !== currentSlide);
                });

                dots.forEach((dot, i) => {
                    dot.classList.toggle('active', i === currentSlide);
                });
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                updateSlider();
            }

            function goToSlide(index) {
                currentSlide = index;
                updateSlider();
                resetTimer();
            }

            function resetTimer() {
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, slideDuration);
            }

            // Initialize dots
            dots.forEach((dot, i) => {
                dot.addEventListener('click', () => goToSlide(i));
            });

            // Pause on hover
            sliderWrapper.addEventListener('mouseenter', () => clearInterval(slideInterval));
            sliderWrapper.addEventListener('mouseleave', resetTimer);

            // Start the slider
            slideInterval = setInterval(nextSlide, slideDuration);
            updateSlider();
        });
    </script>


    <script>
        const swiper = new Swiper('.category-swiper', {
            slidesPerView: 4,
            spaceBetween: 24,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                0: {
                    slidesPerView: 3,
                },
                576: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 5,
                },
                1200: {
                    slidesPerView: 7,
                }
            },
        });
    </script>

@endsection
