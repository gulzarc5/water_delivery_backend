<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\User\UserAddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderListResource extends JsonResource
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
            'user_id' => $this->user_id,
            'address_id' => $this->address_id,
            'total_mrp' => $this->total_mrp,
            'total_sale_price' => $this->total_sale_price,
            'shipping_charge' => $this->shipping_charge,
            'total_subscribed_amount' => $this->total_subscribed_amount,
            'coins_used' => $this->coins_used,
            'coin_earned' => $this->coin_earned,
            'coupon_discount' => $this->coupon_discount,
            'payment_type' => $this->payment_type,
            'payment_status' => $this->payment_status,
            'payment_request_id' => $this->payment_request_id,
            'payment_id' => $this->payment_id,
            'delivery_schedule_date' => $this->delivery_schedule_date,
            'delivery_slot_id' => $this->delivery_slot_id,
            'status' => $this->status,
            'is_refund' => $this->is_refund,
            'created_at' => $this->created_at->toDateString(),
            'details' => OrderDetailResource::collection($this->whenLoaded('detail')),
            'shipping_address' => UserAddressResource::make($this->whenLoaded('addrees')),
        ];
    }
}
