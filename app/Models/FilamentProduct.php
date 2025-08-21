<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilamentProduct extends Model
{

    protected $table = 'products';
    protected $guarded = [];
    protected $casts = [
        'images' => 'array',
        'variations' => 'array',
    ];

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
        return $this->belongsToMany(Prodcat::class,'prodcat_product','product_id','prodcat_id','id','id')->withTimestamps();
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

   
  


    public function getPrice()
    {
        return $this->sale_price ?? $this->price;
    }
}
