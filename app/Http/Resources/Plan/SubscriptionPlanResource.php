<?php

namespace App\Http\Resources\Plan;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionPlanResource extends JsonResource
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
            'image' =>  $this->planMaster->image ?? null,
            'duration' =>  $this->planMaster->duration ?? null,
            'type' =>  $this->planMaster->type ?? null,
            'plan_list' => SubscriptionPlanDetailsResource::collection($this->whenLoaded('detail')),
        ];
    }
}
