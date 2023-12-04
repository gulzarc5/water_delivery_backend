<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';

    protected $fillable=['name','brand_id','image','short_description','long_description','status'];

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand','brand_id','id');
    }
    public function images()
    {
        return $this->hasMany('App\Models\ProductImage','product_id','id');
    }
    public function sizes()
    {
        return $this->hasMany('App\Models\ProductSize','product_id','id');
    }
}
