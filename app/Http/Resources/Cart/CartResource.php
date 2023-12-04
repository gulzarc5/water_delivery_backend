<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'cart_id' => $this->id,
            'product_name' => $this->product->product->name ?? null,
            'product_id' => $this->product->product->id ?? null,
            'product_image' => asset('backend_images/thumb/'.$this->product->image ?? null),
            'brand_name' => $this->product->product->brand->name ?? null,
            'size_name' => $this->product->size->name ?? null,
            'quantity' => $this->quantity,
            'mrp' => $this->product->mrp ?? 0,
            'price' => $this->product->price ?? 0,
            'coin_used' => $this->product->coin_use ?? 0,
            'product_is_jar' => $this->product->jar_available_status ?? null,
            'jar_mrp' => $this->product->jar_mrp ?? 0,
            'jar_price' => $this->product->jar_price ?? 0,
            'cart_is_jar' => $this->is_jar,
        ];
    }
}
