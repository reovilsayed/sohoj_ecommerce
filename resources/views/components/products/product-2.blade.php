@php
    // Pre-calculate values for better performance
    $averageRating = Sohoj::average_rating($product->ratings);
    $ratingCount = $product->ratings->count();
    $currentPrice = $product->sale_price ?? $product->price;
    $originalPrice = $product->price;
    $hasDiscount = $product->sale_price && $product->sale_price < $product->price;
    $discountPercentage = $hasDiscount ? round((($originalPrice - $currentPrice) / $originalPrice) * 100) : 0;
    $fullStars = floor($averageRating);
    $hasHalfStar = $averageRating - $fullStars >= 0.5;
@endphp

<style>
    @import url('https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600;700&display=swap');

    /* Optimized CSS with better organization and performance */
    .product-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        height: 100%;
        border: 1px solid rgba(0, 0, 0, 0.05);
        will-change: transform;
        font-family: 'Segoe UI', 'Inter', Arial, sans-serif;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        border-color: #FF0000;
    }

    /* Image Section */
    .product-image-wrapper {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    }

    .product-image {
        position: relative;
        height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
        will-change: transform;
    }

    .product-card:hover .product-img {
        transform: scale(1.1);
    }

    /* Overlay and Actions */
    .product-overlay {
        position: absolute;
        inset: 0;
        background: #c1bebe91;
        opacity: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.3s ease;
    }

    .product-card:hover .product-overlay {
        opacity: 1;
    }

    .product-actions {
        display: flex;
        gap: 12px;
    }

    .action-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: none;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        font-size: 14px;
        will-change: transform;
    }

    .action-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }

    /* Cart Form */
    .cart-form {
        margin: 0;
        display: inline;
    }

    /* Badges */
    .discount-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        background: linear-gradient(135deg, #ff6b6b, #ee5a52);
        color: white;
        padding: 6px 12px;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 2;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    /* Content Section */
    .product-content {
        padding: 20px;
        display: flex;
        flex-direction: column;
        height: calc(100% - 250px);
    }

    .product-category {
        margin-bottom: 8px;
    }

    .product-category span {
        background: linear-gradient(135deg, #e8f5e8, #d4edda);
        color: #01949a;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .product-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 8px;
        line-height: 1.3;
        flex-grow: 1;
        font-family: 'Segoe UI', 'Inter', Arial, sans-serif;
        color: #000 !important;
    }

    .product-title a {
        color: #000 !important;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    /* Rating */
    .product-rating {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 12px;
    }

    .stars {
        display: flex;
        gap: 1px;
    }

    .stars i {
        color: #ddd;
        font-size: 0.8rem;
    }

    .stars i.filled {
        color: #ffc107;
    }

    .rating-count {
        font-size: 0.75rem;
        color: #6c757d;
    }

    /* Price */
    .product-price {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 15px;
    }

    .original-price {
        color: #6c757d;
        text-decoration: line-through;
        font-size: 0.85rem;
    }

    .current-price {
        color: #000;
        font-size: 1.2rem;
        font-weight: 700;
    }

    /* Add to Cart Button */
    .add-to-cart-form {
        margin: 0;
    }

    .add-to-cart-btn {
        background: #FF0000 !important;
        color: #fff;
        border: none;
        padding: 7px 12px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        cursor: pointer;
        width: 100%;
        margin-top: auto;
        will-change: transform;
        box-shadow: 0 2px 8px rgba(58, 112, 151, 0.10);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .add-to-cart-btn .spinner {
        display: none;
        margin-right: 8px;
        font-size: 1rem;
        animation: spin 1s linear infinite;
    }

    .add-to-cart-btn.loading .spinner {
        display: inline-block;
    }

    .add-to-cart-btn.loading .btn-text {
        opacity: 0.6;
    }

    .add-to-cart-btn.loading {
        pointer-events: none;
        opacity: 0.7;
    }

    /* @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    } */

    .product-title {
        font-size: 0.9rem;
    }

    .action-btn {
        width: 35px;
        height: 35px;
        font-size: 12px;
    }

    @media (max-width: 576px) {
        .product-image {
            height: 180px;
        }

        .product-content {
            padding: 12px;
        }

        .product-title {
            font-size: 0.85rem;
        }

        .add-to-cart-btn {
            padding: 10px 16px;
            font-size: 0.8rem;
        }
    }

    /* Focus states for accessibility */
    .action-btn:focus,
    .add-to-cart-btn:focus,
    .product-title a:focus {
        outline: 2px solid #01949a;
        outline-offset: 2px;
    }

    /* Loading states */
    .add-to-cart-btn.loading {
        pointer-events: none;
        opacity: 0.7;
    }

    .add-to-cart-btn.loading i {
        animation: spin 1s linear infinite;
    }
</style>

<div class=" col-md-3 col-sm-6 col-6 mb-4">
    <div class="product-card">
        {{-- Product Image Section --}}
        <div class="product-image-wrapper">
            <div class="product-image">
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="product-img"
                    loading="lazy">

                {{-- Product Actions Overlay --}}
                <div class="product-overlay">
                    <div class="product-actions">
                        <a href="{{ route('product_details', $product->slug) }}" class="action-btn" title="Quick View"
                            aria-label="View {{ $product->name }} details">
                            <i class="fas fa-eye text-light"></i>
                        </a>

                        <form action="{{ route('cart.store') }}" method="post" class="cart-form">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button class="action-btn" title="Add to Cart" type="submit"
                                aria-label="Add {{ $product->name }} to cart">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </form>

                        <button class="action-btn compare-btn" title="Compare"
                            aria-label="Compare {{ $product->name }}">
                            <i class="fas fa-exchange-alt"></i>
                        </button>
                    </div>
                </div>

                {{-- Discount Badge --}}
                @if ($hasDiscount)
                    <div class="discount-badge" aria-label="{{ $discountPercentage }}% discount">
                        <span>-{{ $discountPercentage }}%</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Product Content Section --}}
        <div class="product-content">
            {{-- Product Category --}}
            <div class="product-category">
                @foreach ($product->prodcats as $categoryName)
                    <span class="my-3">{{ $categoryName->name }}</span>
                @endforeach
            </div>

            {{-- Product Title --}}
            <h3 class="product-title">
                <a href="{{ route('product_details', $product->slug) }}"
                    aria-label="View {{ $product->name }} details">
                    {{ Str::limit($product->name, 35) }}
                </a>
            </h3>

            {{-- Product Rating --}}
            <div class="product-rating" aria-label="Rating: {{ $averageRating }} out of 5 stars">
                <div class="stars" role="img" aria-label="Rating: {{ $averageRating }} stars">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $fullStars)
                            <i class="fas fa-star filled" aria-hidden="true"></i>
                        @elseif($i == $fullStars + 1 && $hasHalfStar)
                            <i class="fas fa-star-half-alt filled" aria-hidden="true"></i>
                        @else
                            <i class="fas fa-star" aria-hidden="true"></i>
                        @endif
                    @endfor
                </div>
                <span class="rating-count">({{ $ratingCount }})</span>
            </div>

            {{-- Product Price --}}
            <div class="product-price">
                @if ($hasDiscount)
                    <span class="original-price" aria-label="Original price">{{ Sohoj::price($originalPrice) }}</span>
                @endif
                <span class="current-price" aria-label="Current price">{{ Sohoj::price($currentPrice) }}</span>
            </div>

            {{-- Add to Cart Button --}}
            <form action="{{ route('cart.store') }}" method="POST" class="add-to-cart-form">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="add-to-cart-btn" type="submit" aria-label="Add {{ $product->name }} to cart">
                    <span class="spinner" style="display:none;margin-right:8px;"><i
                            class="fas fa-spinner fa-spin"></i></span>
                    <i class="fas fa-shopping-cart me-2" aria-hidden="true"></i>
                    <span class="btn-text">Add to Cart</span>
                </button>
            </form>

        </div>
    </div>
</div>
