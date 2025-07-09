<div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
    <div class="card shadow-sm border-0 rounded-4 overflow-hidden position-relative h-100">
        <div class="position-relative">
            <a href="{{ route('product_details', $product->slug) }}">
                <img src="{{ Storage::url($product->image) }}" class="w-100" style="height: 220px; object-fit: cover;">
            </a>
            <div class="position-absolute top-0 start-0 m-2">
                @if ($product->stock <= 0)
                    <span class="badge bg-danger">Out of Stock</span>
                @elseif($product->sale_price)
                    <span class="badge bg-success">Sale</span>
                @endif
            </div>
            <div class="position-absolute top-0 end-0 m-2 d-flex flex-column gap-1">
                <button class="btn btn-sm btn-light rounded-circle" title="Quick View"><i
                        class="fa fa-eye"></i></button>
                <button class="btn btn-sm btn-light rounded-circle" title="Wishlist"><i
                        class="fa fa-heart"></i></button>
            </div>
        </div>
        <div class="card-body text-center">
            <h6 class="fw-semibold text-truncate">{{ $product->name }}</h6>
            <div class="text-muted small mb-1">{{ Str::limit(strip_tags($product->short_description), 40) }}</div>
            <div class="mb-2">
                <span class="text-danger fw-bold">{{ Sohoj::price($product->sale_price ?? $product->price) }}</span>
                @if ($product->sale_price)
                    <span
                        class="text-muted text-decoration-line-through ms-1">{{ Sohoj::price($product->price) }}</span>
                @endif
            </div>
            <div class="d-flex justify-content-center align-items-center gap-2 mb-2">
                <input value="{{ Sohoj::average_rating($product->ratings) }}" class="rating published_rating"
                    data-size="xs" readonly>
                <small class="text-muted">({{ $product->ratings->count() }})</small>
            </div>
            <form class="addToCartForm_{{ $product->id }}">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="btn btn-sm btn-dark w-100" type="button" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                    <i class="fi-rr-shopping-cart me-1"></i>
                    {{ $product->stock <= 0 ? 'Out of Stock' : 'Add to Cart' }}
                </button>
            </form>
        </div>
    </div>
</div>
<style>
    .card:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
        transform: translateY(-3px);
        transition: 0.3s ease;
    }
</style>
