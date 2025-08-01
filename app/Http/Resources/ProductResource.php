<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'slug'          => $this->slug,
            'image'         => $this->image,
            'images'        => $this->images,
            'price'         => $this->price,
            'sale_price'    => $this->sale_price,
            'shop'          => $this->shop,
            'categories'    => $this->prodcats,
            'description'   => $this->description,
            'short_description' => $this->short_description,
            'views'         => $this->views,
        ];
    }
}