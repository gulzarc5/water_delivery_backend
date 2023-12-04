<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Product\ProductDetailsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            'id' => $this->id,
            'order_id' => $this->order_id,
            'product_name' => $this->productSize->product->name ?? null,
            'brand' => $this->productSize->product->brand->name ?? null,
            'size' => $this->productSize->size->name ?? null,
            'quantity' => $this->quantity,
            'subscribed_quantity' => $this->subscribed_quantity,
            'type' => $this->type,
            'product_type' => $this->product_type,
            'mrp' => $this->mrp,
            'price' => $this->price,
            'is_jar' => $this->is_jar,
            'jar_mrp' => $this->jar_mrp,
            'jar_price' => $this->jar_price,
            'subscribed_amount' => $this->subscribed_amount,
            'coin_used' => $this->coin_used,
            'coin_generated' => $this->coin_generated,
            'order_status' => $this->order_status,
            'cancelled_date' => $this->cancelled_date,
            'remarks' => $this->remarks,
            'created_at' => $this->created_at->toDateString(),
            'product' => ProductDetailsResource::make($this->productSize),
        ];
    }
}
