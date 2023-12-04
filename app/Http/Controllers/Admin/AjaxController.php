<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getSizeByBrand($brand_id)
    {
        $sizes = Size::where('brand_id', $brand_id)->where('status',1)->pluck('name','id');
        return $sizes;
    }
}
