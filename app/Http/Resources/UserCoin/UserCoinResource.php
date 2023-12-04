<?php

namespace App\Http\Resources\UserCoin;

use Illuminate\Http\Resources\Json\JsonResource;

class UserCoinResource extends JsonResource
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
            'user_coin_id' => $this->user_coin_id,
            'type' => $this->type,
            'coin' => $this->coin,
            'total_coin' => $this->total_coin,
            'comment' => $this->comment,
            'created_at' => $this->created_at->toDateString(),
        ];
    }
}
