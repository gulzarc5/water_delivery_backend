<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $table='product_sizes';

    protected $fillable=[
        'product_id',
        'size_id',
        'mrp',
        'price',
        'product_discount',
        'coint_use',
        'coint_generate',
        'jar_available_status',
        'jar_mrp',
        'jar_price',
        'jar_discount',
        'status',
    ];

    public function size()
    {
        return $this->belongsTo('App\Models\Size','size_id','id');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
