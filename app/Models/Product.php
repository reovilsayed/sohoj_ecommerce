<?php

namespace App\Models;

use App\Casts\ProductVarient;
use App\Casts\ProductVarient\Varient;
use App\Models\Traits\ShippingInfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Product extends Model
{
    use HasFactory, ShippingInfo;
    protected $guarded = [];

    protected $casts = [
        'images' => 'array',
        'variations' => ProductVarient::class,
        'parcels' => 'array',

    ];

    public $with = ['ratings'];

    public function getVariationBySku($sku)
    {
        return Varient::bySku($this, $sku);
    }


    public function getParcelsAttribute($value)
    {
        // If value is already an array, use it directly
        if (is_array($value)) {
            $parcels = $value;
        }
        // If value is a JSON string, decode it
        elseif (is_string($value) && !empty($value)) {
            $parcels = json_decode($value, true);
            // If json_decode fails or returns null, use empty array
            if (json_last_error() !== JSON_ERROR_NONE || $parcels === null) {
                $parcels = [];
            }
        }
        // For any other case (null, empty string, etc.)
        else {
            $parcels = [];
        }

        return collect($parcels)->map(function ($parcel) {
            // Ensure $parcel is an array
            if (!is_array($parcel)) {
                return [
                    'length' => null,
                    'width' => null,
                    'height' => null,
                    'actual_weight' => null,
                    'contains_battery_pi966' => false,
                    'contains_battery_pi967' => false,
                    'contains_liquids' => false,
                    'category_id' => null,
                    'description' => '',
                    'origin_country_alpha2' => '',
                ];
            }

            return [
                'length' => isset($parcel['length']) ? (int) $parcel['length'] : null,
                'width' => isset($parcel['width']) ? (int) $parcel['width'] : null,
                'height' => isset($parcel['height']) ? (int) $parcel['height'] : null,
                'actual_weight' => isset($parcel['actual_weight']) ? (float) $parcel['actual_weight'] : null,
                'contains_battery_pi966' => isset($parcel['contains_battery_pi966']) ? (bool) $parcel['contains_battery_pi966'] : false,
                'contains_battery_pi967' => isset($parcel['contains_battery_pi967']) ? (bool) $parcel['contains_battery_pi967'] : false,
                'contains_liquids' => isset($parcel['contains_liquids']) ? (bool) $parcel['contains_liquids'] : false,
                'category_id' => $parcel['category_id'] ?? null,
                'description' => $parcel['description'] ?? '',
                'origin_country_alpha2' => $parcel['origin_country_alpha2'] ?? '',
            ];
        })->toArray();
    }


    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function discount()
    {
        $discount_amount  = $this->price - $this->sale_price;
        $discount_percantage = ($discount_amount / $this->price) * 100;
        return round($discount_percantage);
    }
    public function prodcats()
    {
        return $this->belongsToMany(Prodcat::class)->withTimestamps();
    }
    public function parentproduct()
    {
        return $this->belongsTo(Product::class, 'parent_id', 'id');
    }
    public function path()
    {
        return route('product', $this->slug);
    }
    
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }

    public function subproducts()
    {
        return $this->hasMany(Product::class, 'parent_id', 'id');
    }

    public function subproductsuser()
    {
        return $this->hasMany(Product::class, 'parent_id', 'id')->where('price', '>', 0)->whereNotNull('variations');
    }

    public function scopeFilter($query)
    {

        //new
        return $query
            ->when(request()->filled('category'), function ($q) {
                return $q->whereHas('prodcats', function ($query) {
                    $query->where('slug', request()->category);
                });
            })
            ->when(request()->has('search'), function ($q) {
                return $q->where(function ($query) {
                    $search = request()->search;

                    $query->where('name', 'LIKE', '%' . request()->search . '%')
                        ->orWhere('short_description', 'LIKE', '%' . request()->search . '%')
                        ->orWhere('search_keywords', 'LIKE', "%{$search}%")
                    ;
                });
            })
            ->when(request()->has('featured'), function ($q) {
                return $q->where('featured', 1);
            })
            ->when(request()->has('shop'), function ($q) {
                return $q->whereHas('shop', function ($query) {
                    $query->where('name', request()->shop);
                });
            })
            ->when(
                request()->has('ratings'),
                function ($q) {
                    return  $q->whereHas('ratings', function ($q) {
                        $q->where('rating', request()->ratings);
                    });
                }
            )

            ->when(request()->has('filter_products') && request()->filter_products == 'price-low-high', function ($q) {
                return $q->orderBy('price', 'asc');
            })
            ->when(request()->has('filter_products') && request()->filter_products == 'price-high-low', function ($q) {
                return $q->orderBy('price', 'desc');
            })
            ->when(request()->has('filter_products') && request()->filter_products == 'most-popular', function ($q) {
                return $q->orderBy('total_sale', 'desc');
            })
            ->when(request()->has('filter_products') && request()->filter_products == 'trending', function ($q) {
                return $q->orderBy('views', 'desc');
            })
            ->when(request('priceMin') && request('priceMax'), function ($q) {
                return $q->whereBetween('price', [request('priceMin'), request('priceMax')]);
            })
            ->when(Session::has('post_city'), function ($q) {
                $post_city = Session::get('post_city');
                return $q->whereHas('shop', function ($qr) use ($post_city) {
                    $qr->where(function ($qp) use ($post_city) {
                        $qp->whereIn('city', $post_city);
                    });
                });
            })->when(Session::has('state'), function ($q) {
                $state = Session::get('state');
                return $q->whereHas('shop', function ($qr) use ($state) {
                    $qr->where('state', 'like', '%' . $state . '%');
                });
            });
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class)->where('status', 1)->latest();
    }

    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = is_array($value) ? json_encode($value) : $value;
    }

    public function getImagesAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    /**
     * Get a specific variation by index
     */
    public function getVariation($index)
    {
        if (isset($this->variations[$index])) {
            return $this->variations[$index];
        }
        return null;
    }

    /**
     * Update a specific variation and save
     */
    public function updateVariation($index, $data)
    {
        if (isset($this->variations[$index])) {
            $variation = $this->variations[$index];
            foreach ($data as $key => $value) {
                $variation->$key = $value;
            }
            $this->save();
            return true;
        }
        return false;
    }

    public function getPrice()
    {
        return $this->sale_price ?? $this->price;
    }
}
