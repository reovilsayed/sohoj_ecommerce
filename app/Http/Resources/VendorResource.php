<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class VendorResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'slug'          => $this->slug,
            'description'   => $this->description,
            'logo'          => Storage::url($this->logo),
            'banner'        => Storage::url($this->banner),
            'address'       => $this->address,
            'city'          => $this->city,
            'state'         => $this->state,
            'post_code'     => $this->post_code,
            'phone'         => $this->phone,
            'email'         => $this->email,
            'status'        => $this->status,
            'rating'        => $this->rating,
            'total_products' => $this->products_count ?? $this->products->count(),
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
} 