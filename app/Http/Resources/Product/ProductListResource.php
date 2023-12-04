<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'product_size_id' =>$this->id,
            'product_id' =>$this->product->id ?? null,
            'name' =>($this->product->name ?? null),
            'brand' =>$this->product->brand->name ?? null,
            'size_name' =>$this->size->name ?? null,
            'mrp' => $this->mrp,
            'price' => $this->price,
            'product_discount' => $this->product_discount,
            'coin_use' => $this->coin_use,
            'coin_generate' => $this->coin_generate,
            'jar_available_status' => $this->jar_available_status,
            'jar_mrp' => $this->jar_mrp,
            'jar_price' => $this->jar_price,
            'jar_discount' => $this->jar_discount,
            'image' =>$this->product->image ?? null,
            'short_description' =>$this->product->short_description ?? null,
            'long_description' =>$this->product->long_description ?? null,
            'images' =>$this->product->images ?? null,
        ];
    }
}
