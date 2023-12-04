<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkOrder extends Model
{
    use HasFactory;

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
    public function size()
    {
        return $this->belongsTo(Size::class,'size_id','id');
    }
}
