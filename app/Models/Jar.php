<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jar extends Model
{
    protected $table='jars';

    protected $fillable=['brand_id','size_id','mrp','price','status'];
}
