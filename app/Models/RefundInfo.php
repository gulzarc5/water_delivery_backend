<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefundInfo extends Model
{
    protected $table='refund_infos';
    protected $fillable=['user_id','order_id','cancel_reason','cancelled_products','amount','status'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
