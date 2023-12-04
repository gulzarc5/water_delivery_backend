<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   protected $table='orders';

   protected $fillable=['user_id','address_id','payable_amount','total_amount','coins_used','coin_earned','discount','payment_type','payment_status','total_subscribed_amount','delivery_schedule_date','delivery_slot_id','delivery_schedule'];

   public function user()
   {
      return $this->belongsTo('App\Models\User','user_id','id');
   }

   public function addrees()
   {
      return $this->belongsTo('App\Models\Address','address_id','id');
   }

   public function detail()
   {
      return $this->hasMany('App\Models\OrderDetail','order_id','id');
   }
   public function deliverySlot()
   {
      return $this->belongsTo('App\Models\DeliverySlot','delivery_slot_id','id');
   }
}
