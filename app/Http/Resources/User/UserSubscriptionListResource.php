<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserSubscriptionListResource extends JsonResource
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
            'brand' => $this->brand,
            'size' => $this->size,
            'plan_type' => $this->plan_type,
            'plan_name' => $this->plan_name,
            'quantity' => $this->quantity,
            'frequency' => $this->frequency,
            'plan_start_date' => $this->plan_start_date,
            'plan_end_date' => $this->plan_end_date,
            'total_order' => $this->total_order,
            'order_consumed' => $this->order_consumed,
            'total_mrp' => $this->total_mrp,
            'total_amount' => $this->total_amount,
            'discount' => $this->discount,
            'payment_request_id' => $this->payment_request_id,
            'payment_id' => $this->payment_id,
            'payment_status' => $this->payment_status,
            'status' => $this->status,
            'created_at' => $this->created_at->toDateString(),
        ];
    }
}
