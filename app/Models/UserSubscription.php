<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    protected $table='user_subscriptions';

    protected $fillable=['user_id','delivery_address_id','delivery_slot_id','plan_type','plan_name','discount_percentage','quantity','frequency','plan_start_date','plan_end_date','total_order','order_consumed'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function address()
    {
        return $this->belongsTo('App\Models\Address','delivery_address_id','id');
    }
    public function brandItem()
    {
        return $this->belongsTo('App\Models\Brand','brand_id','id');
    }
    public function subscriptionDates()
    {
        return $this->hasMany('App\Models\UserSubscriptionOrderDate','user_subscription_id','id');
    }
}
