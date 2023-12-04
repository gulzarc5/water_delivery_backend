<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
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
        'id'=>$this->id,
        'name'=>$this->name,
        'mobile'=>$this->mobile,
        'main_location_id'=>$this->main_location_id,
        'main_location_name'=>$this->mainLocation->name ?? null,
        'sub_location_id'=>$this->sub_location_id,
        'sub_location_name'=>$this->subLocation->name ?? null,
        'house_no'=>$this->house_no,
        'flat_no'=>$this->flat_no,
        'address_one'=>$this->address_one,
        'address_two'=>$this->address_two,
        'landmark'=>$this->landmark,
        'latitude'=>$this->lat,
        'longitude'=>$this->long,
        'address_status'=>$this->address_status,
        'pin'=>$this->pin,
       ];
    }
}
