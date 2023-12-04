<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscriptionOrderDate extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_subscription_id','order_date','status'
    ];
}
