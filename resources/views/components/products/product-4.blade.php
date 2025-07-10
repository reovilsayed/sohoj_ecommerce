<style>
    .btn-secondary:hover {
    color:rgb(0, 0, 0);
    background-color: #e7eaee !important;
    border-color: #000000 !important;
}

</style>
<div class=" col-md-3 col-sm-6 col-6 mb-4">
    <div class="card border-0 rounded-4 shadow-sm text-center position-relative h-100">
        
        {{-- Wishlist button --}}
       <button 
  class="btn btn-sm btn-secondary opacity-75 rounded-circle position-absolute top-0 end-0 m-2 d-flex justify-content-center align-items-center" 
  title="Wishlist" 
  aria-label="Add to Wishlist" 
  style="height: 30px; width: 30px;"
>
  <i class="fa-regular fa-heart fa-fw"></i>
</button>


        {{-- Product Image --}}
        <a href="{{ route('product_details', $product->slug) }}">
           <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-100 mt-1"
                style="border-radius: 12px 12px 0px 0px; object-fit: cover; height: 220px;">
        </a>

        {{-- Product Content --}}
        <div class="card-body p-2">
            {{-- Product Name --}}
            <h6 class="fw-bold text-truncate">{{ $product->name }}</h6>

            {{-- Rating & Reviews --}}
            <div class="d-flex justify-content-center align-items-center gap-1 mb-2 small">
                <i class="fa fa-star text-warning"></i>
                <span class="fw-bold">{{ Sohoj::average_rating($product->ratings) }}</span>
                <span class="text-muted">({{ $product->ratings->count() }} Reviews)</span>
            </div>

            {{-- Price --}}
            <div class="fw-bold fs-5 text-dark mb-3">
                {{ Sohoj::price($product->sale_price ?? $product->price) }}
                @if ($product->sale_price)
                    <small class="text-muted text-decoration-line-through ms-1 fs-6">
                        {{ Sohoj::price($product->price) }}
                    </small>
                @endif
            </div>

            {{-- Add to Cart --}}
            <form action="{{ route('cart.store') }}" method="post">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="btn btn-sm btn-secondary w-100" type="submit" style="border-radius: 8px;">
                    Add to Cart
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
