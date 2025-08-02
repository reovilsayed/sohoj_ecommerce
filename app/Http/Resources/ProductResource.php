<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'slug'          => $this->slug,
            'image'         => Storage::url($this->image),
            'images'        => array_map(function ($image) {
                return asset('storage/' . $image);
            }, $this->images),
            'price'         => $this->price,
            'sale_price'    => $this->sale_price,
            'shop'          => VendorResource::make($this->shop),
            'categories'    => CategoryResource::collection($this->prodcats),
            'description'   => $this->description,
            'short_description' => $this->short_description,
            'views'         => $this->views,
        ];
    }
}
