<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionDetail extends Model
{
    protected $table='subscription_details';
    protected $fillable=[
        'plan_id',
        'brand_id',
        'size_id',
        'total_discount',
        'status',
    ];

    public function planMaster()
    {
        return $this->belongsTo('App\Models\SubscriptionPlan','plan_id','id');
    }
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand','brand_id','id');
    }
    public function size()
    {
        return $this->belongsTo('App\Models\Size','size_id','id');
    }
}
