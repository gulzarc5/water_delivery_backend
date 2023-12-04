<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    protected $table='subscription_plans';

    protected $fillable=[
        'name',
        'description',
        'image',
        'duration',
        'type',
        'status',
    ];

    public function details()
    {
        return $this->hasMany('App\Models\SubscriptionDetail','plan_id','id')->where('status',1);
    }
}
