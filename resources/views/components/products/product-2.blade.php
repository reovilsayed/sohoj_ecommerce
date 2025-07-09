{{-- <div class="col-lg-2 col-md-4 col-sm-6 col-6 col-xs-6 mb-5 col-6">
    <div class="ec-product-inner">
        <div class="ec-pro-image-outer">
            <div class="ec-pro-image">
                <a href="{{ route('product_details', $product->slug) }}" class="image">
                    <img class="main-image" src="{{ Storage::url($product->image) }}" alt="Product" />
                    <img class="hover-image" src="{{ Storage::url($product->image) }}" alt="Product" />
                </a>
                <div class="ec-pro-actions">

                    <a href="JavaScript:void(0)" onclick="quickView({{ $product->id }})" class="quickview"><i
                            class="fi-rr-eye"></i></a>
                    <a href="javascript:void(0)" onclick="wishlist({{ $product->id }})" class="ec-btn-group wishlist " style="border-radius: 10px 10px 0 0"
                        title="Wishlist"><i class="fi-rr-heart"></i></a>
                </div>
            </div>
        </div>
        <div class="ec-pro-content  text-center " style="margin-top: 14px">
            <div class="height-shops">
                <h5 class="ec-pro-title"><a
                        href="{{ route('product_details', $product->slug) }}">{{ $product->name }}</a></h5>
                <div class="ec-pro-list-desc">
                    <p style="font-size: 9px; color: #787885">
                        {{ Str::limit(strip_tags($product->short_description), $limit = 40, $end = '...') }}
                    </p>
                </div>
            </div>
            <div class="ec-pro-rating reco-ratting d-flex justify-content-center">
                <input value="{{ Sohoj::average_rating($product->ratings) }}" class="rating published_rating"
                    data-size="xs">
            </div>
            <div class="d-flex justify-content-between button-size " style="margin-top: 23px">
                <span class="ec-price">

                    <span class="new-price">{{ Sohoj::price($product->sale_price ?? $product->price) }}</span>

                </span>
                <form class="addToCartForm_{{ $product->id }}">
                    @csrf
                    <input type="hidden" class="form-control qty" value="1" min="1" name="quantity">
                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                    <button class="btn btn-sm btn-dark cart-store" type="button" data-product-id="{{ $product->id }}"><i class="fi-rr-shopping-cart"></i>
                        ADD
                    </button>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<div class="col-md-3 col-sm-6 col-xs-6 col-6 mb-4">
    <div class="card border-0 shadow-sm rounded-4 position-relative overflow-hidden product-hover-group">
        <a href="{{ route('product_details', $product->slug) }}" class="image">
            <img src="https://5.imimg.com/data5/SELLER/Default/2021/11/JU/IF/CF/11337912/e-commerce-product-image-editing-services.jpg"
                alt="{{ $product->name }}" class="card-img-top"
                style="object-fit:cover; min-height:220px; max-height:220px;">
        </a>
        {{-- <div class="product-hover-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center"
            style="background:rgba(0,0,0,0.4); opacity:0; transition:opacity .3s;">
            <button class="btn btn-outline-secondary btn-sm rounded-circle" onclick="quickView({{ $product->id }})"
                title="Quick View"><i class="fi-rr-eye"></i></button>
            <button class="btn btn-outline-secondary btn-sm rounded-circle" onclick="wishlist({{ $product->id }})"
                title="Wishlist"><i class="fa-regular fa-heart"></i></button>
        </div> --}}
        <div class="card-body text-center">
            <a href="{{ route('product_details', $product->slug) }}" class="image">
                <h6 class="fw-semibold text-truncate mb-1">{{ $product->name }}</h6>
            </a>
            <div class="mb-2 text-muted small">{{ Str::limit(strip_tags($product->short_description), 40, '...') }}
            </div>
            <div class="d-flex justify-content-center align-items-center gap-2 mb-2">
                @if ($product->ratings->count() > 0)
                    <input value="{{ Sohoj::average_rating($product->ratings) }}" class="rating published_rating"
                        data-size="xs" readonly>
                    <span class="text-muted small">({{ $product->ratings->count() }})</span>
                @else
                    <span class="text-muted small">No ratings yet</span>
                @endif
            </div>
            <div class="fw-bold text-danger fs-5">{{ Sohoj::price($product->sale_price ?? $product->price) }}</div>
            @if ($product->sale_price && $product->price > $product->sale_price)
                <span class="text-muted text-decoration-line-through ms-1">{{ Sohoj::price($product->price) }}</span>
            @endif
            <form class="mt-2 addToCartForm_{{ $product->id }}">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="btn btn-sm w-100 px-3 cart-store" style="background-color: #CD184F; color: white"
                    type="button" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                    <i class="fi-rr-shopping-cart me-1"></i>
                    {{ $product->stock <= 0 ? 'Out of Stock' : 'Add to Cart' }}
                </button>
            </form>
        </div>
    </div>
</div>
