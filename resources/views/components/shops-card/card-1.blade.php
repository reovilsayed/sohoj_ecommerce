<div class="col-12 mb-6 mt-4">
    <div class="ec-product-inner position-relative shop-card border rounded-3 shadow-sm h-100 overflow-hidden bg-white transition-hover"
        style="padding-top: 0px !important;">

        <div class="ec-pro-image-outer p-3 bg-light text-center"
            style="background-image: url('{{ Storage::url($shop->banner) }}'); background-size: cover; background-position: center; ">

            <a href="{{ route('store_front', $shop->slug) }}" class="d-inline-block">
                <img src="{{ Storage::url($shop->logo) }}" alt="{{ $shop->name }}"
                    class="img-fluid rounded-circle shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
            </a>
        </div>

        <div class="ec-pro-content text-center p-3">
            <h5 class="mb-1">
                <a href="{{ route('store_front', $shop->slug) }}" class="text-dark fw-semibold text-decoration-none"
                    style="font-size: 16px;">
                    {{ $shop->name }}
                </a>
            </h5>

            <p class="text-muted mb-2" style="font-size: 13px;">
                {{ Str::limit($shop->short_description, 30, '...') }}
            </p>

            @if (!empty($shop->tags))
                @php
                    $tags = is_array($shop->tags) ? $shop->tags : explode(',', $shop->tags);
                @endphp
                <div class="d-flex justify-content-center flex-wrap gap-2 mb-2">
                    @foreach ($tags as $tag)
                        <span class="badge bg-light text-muted border small fw-normal" title="{{ $tag }}">
                            {{ Str::limit($tag, 5, '...') }}
                        </span>
                    @endforeach
                </div>
            @endif


            <div class="d-flex justify-content-center align-items-center gap-1 mt-2">
                <input value="{{ Sohoj::average_rating($shop->ratings) }}" class="rating published_rating"
                    data-size="sm" readonly>
                <span class="text-muted" style="font-size: 13px;">({{ $shop->ratings->count() }})</span>
            </div>
        </div>
    </div>
    <style>
        .transition-hover {
            transition: all 0.3s ease;
        }

        .transition-hover:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }
    </style>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.wishlist-shop-btn').on('click', function() {
            var button = $(this);
            var shopId = button.data('shop-id');
            var form = button.closest('form');

            $.ajax({
                url: 'follow/' + shopId,
                type: 'Post',
                data: {
                    _token: '{{ csrf_token() }}',

                },
                success: function(response) {

                    var element = $('#shop_heart_' + shopId);
                    if (element.hasClass('far fa-heart')) {
                        element.removeClass('far fa-heart text-white').addClass(
                            'fas fa-heart');
                        button.css({
                            'color': 'rgba(252, 79, 79, 0.96)'
                        })
                    } else {
                        element.removeClass('fas fa-heart').addClass(
                            'far fa-heart text-white');
                    }



                },
                error: function(xhr, status, error) {
                    // Request error, handle the error here
                    console.error(error);
                }
            });
        });
    });
</script>
