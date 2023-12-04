<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
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
          'email'=>$this->email,  
          'gender'=>$this->gender,  
          'status'=>$this->status,  
          'permanent_address' => isset($this->permanentAddress) ? new UserAddressResource($this->permanentAddress) : null,
        ];
    }
}
