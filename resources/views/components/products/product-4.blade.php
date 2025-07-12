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
    $categoryName = $product->category->name ?? 'General';
@endphp

<div class="col-md-4 col-sm-6 col-6 mb-4">
    <div class="product-card">
        {{-- Product Image Section --}}
        <div class="product-image-wrapper">
            <div class="product-image">
                <img src="{{ Storage::url($product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="product-img"
                     loading="lazy">

                {{-- Product Actions Overlay --}}
                <div class="product-overlay">
                    <div class="product-actions">
                        <a href="{{ route('product_details', $product->slug) }}" 
                           class="action-btn" 
                           title="Quick View"
                           aria-label="View {{ $product->name }} details">
                            <i class="fas fa-eye text-light"></i>
                        </a>
                        
                        <form action="{{ route('cart.store') }}" method="post" class="cart-form">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button class="action-btn" 
                                    title="Add to Cart" 
                                    type="submit"
                                    aria-label="Add {{ $product->name }} to cart">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </form>
                        
                        <button class="action-btn compare-btn" 
                                title="Compare"
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
                <span>{{ $categoryName }}</span>
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
            <form action="{{ route('cart.store') }}" method="post" class="add-to-cart-form">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="add-to-cart-btn" 
                        type="submit"
                        aria-label="Add {{ $product->name }} to cart">
                    <i class="fas fa-shopping-cart me-2" aria-hidden="true"></i>
                    Add to Cart
                </button>
            </form>
        </div>
    </div>
</div>

<style>
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
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        border-color: #3bb77e;
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
        color: #3bb77e;
        font-size: 1.2rem;
        font-weight: 700;
    }

    /* Add to Cart Button */
    .add-to-cart-form {
        margin: 0;
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
        will-change: transform;
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

    /* Focus states for accessibility */
    .action-btn:focus,
    .add-to-cart-btn:focus,
    .product-title a:focus {
        outline: 2px solid #3bb77e;
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

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>

<script>
    // Optimized JavaScript with better performance and error handling
    document.addEventListener('DOMContentLoaded', function() {
        // Add to cart form enhancement
        document.addEventListener('submit', function(e) {
            if (e.target.closest('.add-to-cart-form')) {
                e.preventDefault();
                handleAddToCart(e.target.closest('.add-to-cart-form'));
            }
        });

        function handleAddToCart(form) {
            const button = form.querySelector('.add-to-cart-btn');
            const originalText = button.innerHTML;
            
            // Show loading state
            button.classList.add('loading');
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Adding...';
            button.disabled = true;

            // Submit form
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Show success message
                showNotification('Product added to cart successfully!', 'success');
                
                // Update cart count if available
                updateCartCount();
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to add product to cart. Please try again.', 'error');
            })
            .finally(() => {
                // Restore button state
                button.classList.remove('loading');
                button.innerHTML = originalText;
                button.disabled = false;
            });
        }

        // Compare functionality
        document.addEventListener('click', function(e) {
            if (e.target.closest('.compare-btn')) {
                e.preventDefault();
                handleCompare(e.target.closest('.compare-btn'));
            }
        });

        function handleCompare(button) {
            const productCard = button.closest('.product-card');
            const productName = productCard.querySelector('.product-title a').textContent;
            
            // Add to compare list (implement your compare logic here)
            console.log('Compare product:', productName);
            
            // Show feedback
            button.style.background = '#3bb77e';
            button.style.color = 'white';
            
            setTimeout(() => {
                button.style.background = '';
                button.style.color = '';
            }, 1000);
        }

        // Utility functions
        function showNotification(message, type) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.textContent = message;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 12px 20px;
                border-radius: 8px;
                color: white;
                font-weight: 600;
                z-index: 9999;
                animation: slideIn 0.3s ease;
                background: ${type === 'success' ? '#3bb77e' : '#ff6b6b'};
            `;

            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        function updateCartCount() {
            // Update cart count in header if available
            const cartCountElement = document.querySelector('.cart-count');
            if (cartCountElement) {
                const currentCount = parseInt(cartCountElement.textContent) || 0;
                cartCountElement.textContent = currentCount + 1;
            }
        }

        // Add CSS animations
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    });
</script>
