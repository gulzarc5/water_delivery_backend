<?php

namespace App\Http\Resources\Brand;

use App\Http\Resources\Product\ProductDetailsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'name' => $this->name,
            'image' => asset('backend_images/' . $this->image),
            'products' => isset($this->products) && !empty($this->products) ? ProductDetailsResource::collection($this->products) : [],
        ];
    }
}
