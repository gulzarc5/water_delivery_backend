<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCoin extends Model
{
    protected $table='user_coins';

    protected $fillable=['user_id','total_coins'];
}
