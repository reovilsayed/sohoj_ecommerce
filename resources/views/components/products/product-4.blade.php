<style>
    .product-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        height: 100%;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        border-color: #3bb77e;
    }

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
    }

    .product-card:hover .product-img {
        transform: scale(1.1);
    }

    .product-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(59, 183, 126, 0.9), rgba(45, 157, 107, 0.9));
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
    }

    .action-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }

    .wishlist-btn {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 3;
        background: rgba(255, 255, 255, 0.95);
        color: #6c757d;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .wishlist-btn:hover {
        background: #ff6b6b;
        color: white;
        transform: scale(1.1);
    }

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
    }

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
        color: #2d9d6b;
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
    }

    .product-title a {
        color: #2c3e50;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .product-title a:hover {
        color: #3bb77e;
    }

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
        color: #3bb77e;
        font-size: 1.2rem;
        font-weight: 700;
    }

    .add-to-cart-btn {
        background: linear-gradient(135deg, #3bb77e, #2d9d6b);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        cursor: pointer;
        width: 100%;
        margin-top: auto;
    }

    .add-to-cart-btn:hover {
        background: linear-gradient(135deg, #2d9d6b, #1a7a4a);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 183, 126, 0.3);
    }

    .add-to-cart-btn:active {
        transform: translateY(0);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .product-image {
            height: 200px;
        }

        .product-content {
            padding: 15px;
        }

        .product-title {
            font-size: 0.9rem;
        }

        .action-btn {
            width: 35px;
            height: 35px;
            font-size: 12px;
        }
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
</style>
<div class=" col-md-4 col-sm-6 col-6 mb-4">
    <div class="product-card">
        <div class="product-image-wrapper">
            <div class="product-image">
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="product-img">

                <!-- Wishlist Button -->
                {{-- <button class="action-btn wishlist-btn" title="Add to Wishlist" aria-label="Add to Wishlist">
                    <i class="fa-regular fa-heart"></i>
                </button> --}}

                <!-- Product Actions Overlay -->
                <div class="product-overlay">
                    <div class="product-actions">
                        <a href="{{ route('product_details', $product->slug) }}" class="action-btn" title="Quick View">
                            <i class="fas fa-eye text-light"></i>
                        </a>
                        <form action="{{ route('cart.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button class="action-btn" title="Add to Cart" type="submit">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </form>
                        <button class="action-btn" title="Compare">
                            <i class="fas fa-exchange-alt"></i>
                        </button>
                    </div>
                </div>

                <!-- Discount Badge -->
                @if ($product->sale_price && $product->sale_price < $product->price)
                    <div class="discount-badge">
                        <span>-{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="product-content">
            <!-- Product Category -->
            <div class="product-category">
                <span>{{ $product->category->name ?? 'General' }}</span>
            </div>

            <!-- Product Title -->
            <h3 class="product-title">
                <a href="{{ route('product_details', $product->slug) }}">
                    {{ Str::limit($product->name, 35) }}
                </a>
            </h3>

            <!-- Product Rating -->
            <div class="product-rating">
                <div class="stars">
                    @php
                        $rating = Sohoj::average_rating($product->ratings);
                        $fullStars = floor($rating);
                        $hasHalfStar = $rating - $fullStars >= 0.5;
                    @endphp

                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $fullStars)
                            <i class="fas fa-star filled"></i>
                        @elseif($i == $fullStars + 1 && $hasHalfStar)
                            <i class="fas fa-star-half-alt filled"></i>
                        @else
                            <i class="fas fa-star"></i>
                        @endif
                    @endfor
                </div>
                <span class="rating-count">({{ $product->ratings->count() }})</span>
            </div>

            <!-- Product Price -->
            <div class="product-price">
                @if ($product->sale_price && $product->sale_price < $product->price)
                    <span class="original-price">{{ Sohoj::price($product->price) }}</span>
                @endif
                <span class="current-price">{{ Sohoj::price($product->sale_price ?? $product->price) }}</span>
            </div>

            <!-- Add to Cart Button -->
            <form action="{{ route('cart.store') }}" method="post">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="add-to-cart-btn" type="submit">
                    <i class="fas fa-shopping-cart me-2"></i>
                    Add to Cart
                </button>
            </form>
        </div>
    </div>
</div>
