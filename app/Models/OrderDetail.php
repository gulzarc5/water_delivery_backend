<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table='order_details';

    protected $fillable=['order_id','product_id','type','mrp','price','size_id','brand_id','coin_used','coin_generated','order_status','cancelled_date','remarks'];

    public function productSize()
    {
        return $this->belongsTo('App\Models\ProductSize','product_id','id');
    }
}
