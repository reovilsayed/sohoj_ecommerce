   <div class="col-lg-3 col-6 mb-4 pro-gl-content-shop">
       <div
           class="ec-product-inner position-relative shop-card border rounded-3 shadow-sm h-100 overflow-hidden bg-white transition-hover">
           <div class="position-absolute top-0 end-0 p-2 z-1">
               {{-- Wishlist Button (optional) --}}
               {{-- <a class="btn btn-sm btn-light rounded-circle"><i class="fa-solid fa-heart text-danger"></i></a> --}}
           </div>

           <div class="ec-pro-image-outer p-3 bg-light text-center">
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
                   @php $tags = explode(',', $shop->tags); @endphp
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
