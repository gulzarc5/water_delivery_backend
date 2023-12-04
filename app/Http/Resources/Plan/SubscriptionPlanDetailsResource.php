<?php

namespace App\Http\Resources\Plan;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionPlanDetailsResource extends JsonResource
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
            'plan_name' => $this->planMaster->name ?? null,
            'brand_name' => $this->brand->name ?? null,
            'size_name' => $this->size->name ?? null,
            'discount' => $this->total_discount,
            'mrp' => $this->mrp,
            'price' => $this->price,
            'jar_mrp' => $this->jar_mrp,
            'jar_price' => $this->jar_price,
            'image' =>  asset("backend_images/".$this->planMaster->image) ?? null,
            'duration' =>  $this->planMaster->duration ?? null,
            'type' =>  $this->planMaster->type ?? null,
            'description' =>  $this->planMaster->description ?? null,
        ];
    }
}
