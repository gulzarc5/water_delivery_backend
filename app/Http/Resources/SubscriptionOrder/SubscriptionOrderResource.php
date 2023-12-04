<?php

namespace App\Http\Resources\SubscriptionOrder;

use App\Http\Resources\User\UserAddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionOrderResource extends JsonResource
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
            "user_id" => $this->user_id,
            "delivery_address_id" => $this->delivery_address_id,
            "delivery_slot_id" => $this->delivery_slot_id,
            "brand_id" => $this->brand_id,
            "size_id" => $this->size_id,
            "brand" => $this->brand,
            "size" => $this->size,
            "plan_name" => $this->plan_name,
            "quantity" => $this->quantity,
            "frequency" => $this->frequency,
            "plan_start_date" => $this->plan_start_date,
            "plan_end_date" => $this->plan_end_date,
            "total_order" => $this->total_order,
            "total_mrp" => $this->total_mrp,
            "total_amount" => $this->total_amount,
            "plan_duration" => $this->plan_duration,
            "updated_at" => $this->updated_at,
            "created_at" => $this->created_at,
            "payment_request_id" => $this->payment_request_id,
            "is_refund" => $this->is_refund,
            "is_cancellable" => $this->is_cancellable,
            "status" => $this->status,
            "payment_status" => $this->payment_status,
            "shipping_address" => UserAddressResource::make($this->address),
            'order_dates' => SubscriptionOrderDateResource::collection($this->whenLoaded('subscriptionDates'))
        ];
    }
}
