<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoinHistory extends Model
{
    protected $table='coin_histories';

    protected $fillable =['user_coins_id','coins','total_coins','comment'];
}
