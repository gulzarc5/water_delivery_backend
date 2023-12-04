<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainArea extends Model
{
    use HasFactory;

    public function subArea()
    {
        return $this->hasMany(SubArea::class,'main_area_id','id');
    }
}
