<?php

namespace App\Http\Resources\Plan;

use Illuminate\Http\Resources\Json\JsonResource;

class AppLoadPlanListResource extends JsonResource
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
            'plan_name' => $this->name,
            'description' => $this->description,
            'image' =>  asset('backend_images/thumb/' .$this->image),
            'duration' => $this->duration,
            'type' => $this->type,
            'status' =>  $this->status,
            'plan_list' => SubscriptionPlanDetailsResource::collection($this->whenLoaded('details')),
        ];
    }
}
