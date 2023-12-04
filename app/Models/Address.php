<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table='addresses';

    protected $fillable=['user_id','main_location_id','sub_location_id','house_no','flat_no','address_one','address_two','landmark','name','mobile','lat','long','status'];

    public function mainLocation()
    {
        return $this->belongsTo(MainArea::class,'main_location_id','id');
    }
    public function subLocation()
    {
        return $this->belongsTo(SubArea::class,'sub_location_id','id');
    }
}
