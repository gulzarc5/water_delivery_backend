<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubArea extends Model
{
    use HasFactory;

    public function main()
    {
        return $this->belongsTo(MainArea::class,'main_area_id','id');
    }
}
