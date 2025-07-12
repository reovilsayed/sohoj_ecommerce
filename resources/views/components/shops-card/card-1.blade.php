@php
    // Pre-calculate values to avoid multiple database calls
    $productCount = $shop->products->count();
    $followerCount = rand(50, 500);
    $averageRating = Sohoj::average_rating($shop->ratings);
    $ratingCount = $shop->ratings->count();
    $shopLocation = $shop->city . ' ' . $shop->state . ' ' . $shop->post_code . ' ' . $shop->country ?? 'Unknown Location';
    $shopDescription = Str::limit($shop->short_description ?? 'A trusted shop offering quality products and excellent service.', 60, '...');
    $isAuthenticated = auth()->check();
    $isFollowing = $isAuthenticated ? auth()->user()->follows($shop) : false;
@endphp

<div class="col-12 mb-6 mt-4">
    <div class="modern-shop-card">
        {{-- Shop Image Section --}}
        <div class="shop-card-image-wrapper">
            <div class="shop-card-image">
                <img src="{{ Storage::url($shop->logo) }}" 
                     alt="{{ $shop->name }}" 
                     class="shop-card-img"
                     loading="lazy">
                
                {{-- Hover Overlay with Actions --}}
                <div class="shop-card-overlay">
                    <div class="shop-card-actions">
                        <a href="{{ route('store_front', $shop->slug) }}" 
                           class="shop-action-btn" 
                           title="Visit Shop"
                           aria-label="Visit {{ $shop->name }}">
                            <i class="fas fa-external-link-alt text-light"></i>
                        </a>
                        <button class="shop-action-btn" 
                                title="Follow Shop"
                                aria-label="Follow {{ $shop->name }}">
                            <i class="fas fa-heart"></i>
                        </button>
                        <button class="shop-action-btn" 
                                title="Share Shop"
                                aria-label="Share {{ $shop->name }}">
                            <i class="fas fa-share-alt"></i>
                        </button>
                    </div>
                </div>

                {{-- Badges --}}
                @if ($shop->is_featured)
                    <div class="shop-featured-badge" aria-label="Featured Shop">
                        <i class="fas fa-star"></i>
                        <span>Featured</span>
                    </div>
                @endif
                @if ($shop->is_verified)
                    <div class="shop-verified-badge" aria-label="Verified Shop">
                        <i class="fas fa-check-circle"></i>
                        <span>Verified</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Shop Content Section --}}
        <div class="shop-card-content">
            {{-- Header with Title and Rating --}}
            <div class="shop-card-header">
                <h5 class="shop-card-title">
                    <a href="{{ route('store_front', $shop->slug) }}" 
                       aria-label="Visit {{ $shop->name }} shop">
                        {{ $shop->name }}
                    </a>
                </h5>
                <div class="shop-card-rating" aria-label="Shop rating: {{ $averageRating }} out of 5">
                    <div class="shop-stars" role="img" aria-label="Rating: {{ $averageRating }} stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= 4 ? 'filled' : '' }}" 
                               aria-hidden="true"></i>
                        @endfor
                    </div>
                    <span class="shop-rating-text">({{ $averageRating }})</span>
                </div>
            </div>

            {{-- Shop Meta Information --}}
            <div class="shop-card-meta">
                <div class="shop-card-category">
                    <span>{{ $shop->company_name ?? 'General Store' }}</span>
                </div>
                <div class="shop-card-location">
                    <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                    <span>{{ $shopLocation }}</span>
                </div>
            </div>

            {{-- Shop Statistics --}}
            <div class="shop-card-stats">
                <div class="shop-stat-item" aria-label="{{ $productCount }} products available">
                    <i class="fas fa-box" aria-hidden="true"></i>
                    <div>
                        <span class="stat-number">{{ $productCount }}</span>
                        <span>Products</span>
                    </div>
                </div>
                <div class="shop-stat-item" aria-label="{{ $followerCount }} followers">
                    <i class="fas fa-users" aria-hidden="true"></i>
                    <div>
                        <span class="stat-number">{{ $followerCount }}</span>
                        <span>Followers</span>
                    </div>
                </div>
            </div>

            {{-- Shop Description --}}
            <div class="shop-card-description">
                <p>{{ $shopDescription }}</p>
            </div>

            {{-- Action Buttons --}}
            <div class="shop-card-footer">
                <a href="{{ route('store_front', $shop->slug) }}" 
                   class="shop-visit-btn"
                   aria-label="Visit {{ $shop->name }} shop">
                    <span class="text-light">Visit Shop</span>
                    <i class="fas fa-arrow-right text-light" aria-hidden="true"></i>
                </a>
                
                @if ($isAuthenticated)
                    <form action="{{ route('follow', $shop) }}" 
                          method="post" 
                          style="display:inline"
                          class="follow-form">
                        @csrf
                        <button class="shop-follow-btn" 
                                type="submit"
                                aria-label="{{ $isFollowing ? 'Unfollow' : 'Follow' }} {{ $shop->name }}">
                            <i class="fas fa-heart" aria-hidden="true"></i>
                            {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                        </button>
                    </form>
                @else
                    <a class="shop-follow-btn" 
                       href="{{ route('login') }}"
                       aria-label="Login to follow {{ $shop->name }}">
                        <i class="fas fa-heart" aria-hidden="true"></i>
                        <span>Follow</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* Optimized CSS with better organization and performance */
    .modern-shop-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0, 0, 0, 0.05);
        height: 100%;
        will-change: transform;
    }

    .modern-shop-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        border-color: #3bb77e;
    }

    /* Image Section */
    .shop-card-image-wrapper {
        position: relative;
        overflow: hidden;
    }

    .shop-card-image {
        position: relative;
        height: 160px;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    }

    .shop-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
        will-change: transform;
    }

    .modern-shop-card:hover .shop-card-img {
        transform: scale(1.05);
    }

    /* Overlay and Actions */
    .shop-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(59, 183, 126, 0.9), rgba(45, 157, 107, 0.9));
        opacity: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.3s ease;
    }

    .modern-shop-card:hover .shop-card-overlay {
        opacity: 1;
    }

    .shop-card-actions {
        display: flex;
        gap: 8px;
    }

    .shop-action-btn {
        width: 32px;
        height: 32px;
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
        text-decoration: none;
        font-size: 0.8rem;
        will-change: transform;
    }

    .shop-action-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
        color: white;
    }

    /* Badges */
    .shop-featured-badge,
    .shop-verified-badge {
        position: absolute;
        top: 10px;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
        z-index: 2;
    }

    .shop-featured-badge {
        left: 10px;
        background: linear-gradient(135deg, #ffd700, #ffed4e);
        color: #2c3e50;
    }

    .shop-verified-badge {
        right: 10px;
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
    }

    /* Content Section */
    .shop-card-content {
        padding: 16px;
    }

    .shop-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .shop-card-title {
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
        flex: 1;
        line-height: 1.3;
    }

    .shop-card-title a {
        color: #2c3e50;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .shop-card-title a:hover {
        color: #3bb77e;
    }

    /* Rating */
    .shop-card-rating {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .shop-stars {
        display: flex;
        gap: 1px;
    }

    .shop-stars i {
        color: #ddd;
        font-size: 0.7rem;
    }

    .shop-stars i.filled {
        color: #ffc107;
    }

    .shop-rating-text {
        font-size: 0.65rem;
        color: #6c757d;
    }

    /* Meta Information */
    .shop-card-meta {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 12px;
    }

    .shop-card-category span {
        background: linear-gradient(135deg, #e8f5e8, #d4edda);
        color: #2d9d6b;
        padding: 3px 8px;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .shop-card-location {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #6c757d;
        font-size: 0.8rem;
    }

    .shop-card-location i {
        color: #3bb77e;
        font-size: 0.7rem;
    }

    /* Statistics */
    .shop-card-stats {
        display: flex;
        gap: 8px;
        margin-bottom: 12px;
        padding: 8px;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        border-radius: 8px;
        border: 1px solid rgba(59, 183, 126, 0.1);
    }

    .shop-stat-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.7rem;
        color: #2c3e50;
        font-weight: 600;
        padding: 6px 8px;
        background: white;
        border-radius: 6px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        flex: 1;
        justify-content: center;
        will-change: transform;
    }

    .shop-stat-item:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(59, 183, 126, 0.15);
        background: linear-gradient(135deg, #e8f5e8, #d4edda);
    }

    .shop-stat-item i {
        color: #3bb77e;
        font-size: 0.8rem;
        width: 12px;
        text-align: center;
    }

    .shop-stat-item span {
        font-weight: 600;
        color: #2c3e50;
    }

    .shop-stat-item .stat-number {
        color: #3bb77e;
        font-weight: 800;
        font-size: 0.8rem;
    }

    /* Description */
    .shop-card-description {
        margin-bottom: 16px;
    }

    .shop-card-description p {
        color: #6c757d;
        font-size: 0.8rem;
        line-height: 1.4;
        margin: 0;
    }

    /* Footer Actions */
    .shop-card-footer {
        display: flex;
        gap: 8px;
    }

    .shop-visit-btn {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 8px 12px;
        background: linear-gradient(135deg, #3bb77e, #2d9d6b);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        will-change: transform;
    }

    .shop-visit-btn:hover {
        background: linear-gradient(135deg, #2d9d6b, #1a7a4a);
        transform: translateY(-1px);
        color: white;
    }

    .shop-follow-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        background: white;
        color: #3bb77e;
        border: 1px solid #3bb77e;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        cursor: pointer;
        will-change: transform;
    }

    .shop-follow-btn:hover {
        background: #3bb77e;
        color: white;
        transform: translateY(-1px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .shop-card-content {
            padding: 12px;
        }

        .shop-card-title {
            font-size: 0.9rem;
        }

        .shop-card-image {
            height: 140px;
        }
    }

    @media (max-width: 576px) {
        .shop-card-image {
            height: 120px;
        }

        .shop-card-content {
            padding: 10px;
        }

        .shop-card-footer {
            flex-direction: column;
        }
    }

    /* Focus states for accessibility */
    .shop-action-btn:focus,
    .shop-visit-btn:focus,
    .shop-follow-btn:focus {
        outline: 2px solid #3bb77e;
        outline-offset: 2px;
    }
</style>

<script>
    // Optimized JavaScript with better error handling and performance
    document.addEventListener('DOMContentLoaded', function() {
        // Use event delegation for better performance
        document.addEventListener('click', function(e) {
            if (e.target.closest('.wishlist-shop-btn')) {
                e.preventDefault();
                handleFollowClick(e.target.closest('.wishlist-shop-btn'));
            }
        });

        function handleFollowClick(button) {
            const shopId = button.dataset.shopId;
            const form = button.closest('form');
            
            if (!shopId || !form) {
                console.error('Missing shop ID or form');
                return;
            }

            // Show loading state
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            button.disabled = true;

            fetch(`/follow/${shopId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const element = document.getElementById(`shop_heart_${shopId}`);
                if (element) {
                    if (element.classList.contains('far')) {
                        element.classList.remove('far', 'fa-heart', 'text-white');
                        element.classList.add('fas', 'fa-heart');
                        button.style.color = 'rgba(252, 79, 79, 0.96)';
                    } else {
                        element.classList.remove('fas', 'fa-heart');
                        element.classList.add('far', 'fa-heart', 'text-white');
                        button.style.color = '';
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Show user-friendly error message
                alert('Something went wrong. Please try again.');
            })
            .finally(() => {
                // Restore button state
                button.innerHTML = originalText;
                button.disabled = false;
            });
        }
    });
</script>
