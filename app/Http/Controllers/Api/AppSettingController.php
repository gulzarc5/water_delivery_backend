<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppLoad\ProductResource;
use App\Http\Resources\AppLoad\SliderResource;
use App\Http\Resources\Brand\BrandListResource;
use App\Http\Resources\Plan\AppLoadPlanListResource;
use App\Http\Resources\Plan\SubscriptionPlanResource;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\MainArea;
use App\Models\ProductSize;
use App\Models\Size;
use App\Models\Slider;
use App\Models\SubArea;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    public function appLoad()
    {
        $brands = Brand::where('status',1)->latest()->get(['id','name','image'])->map(function($brand){
             $brand->products = ProductSize::where('product_sizes.status',1)
             ->leftJoin('products','products.id','=','product_sizes.product_id')
             ->where('products.status',1)
             ->select('product_sizes.*')
             ->where('products.brand_id',$brand->id)->orderBy('id','desc')->get();
             return $brand;
        });
        $sliders = Slider::where('status',1)->latest()->get(['id','image','caption','type']);
        $sizes = Size::where('status',1)->latest()->get(['id','name']);
        $products = ProductSize::where('product_sizes.status',1)
        ->leftJoin('products','products.id','=','product_sizes.product_id')
        ->where('products.status',1)
        ->limit(10)
        ->select('product_sizes.*')
        ->orderBy('display_priority','ASC')
        ->get();

        $subscriptions = SubscriptionPlan::with('details')->where('status',1)->latest()->get();
        $locations = MainArea::with(['subArea' => function($q) {
            $q->select('id', 'name','main_area_id');
            $q->where('status',1);
        }])->where('status',1)->OrderBy('name')->get(['id','name']);
        //products,brands, subscriptions, prvious orders
        // return $brands;
        $coupons = Coupon::where('status',1)->get();
        $response = [
            'status' => true,
            'message' => 'Appload Data',
            'data' =>[
                'brands'=>BrandListResource::collection($brands),
                'sliders'=> SliderResource::collection($sliders),
                'products'=> ProductResource::collection($products),
                'subscriptions' => AppLoadPlanListResource::collection($subscriptions),
                'locations'=> $locations,
                'coupons' => $coupons,
                'sizes' => $sizes,
            ],
        ]; 
        return response()->json($response, 200);
        
    }

    public function locationList()
    {
        $locations = MainArea::with(['subArea' => function($q) {
            $q->select('id', 'name','main_area_id');
            $q->where('status',1);
        }])->where('status',1)->OrderBy('name')->get(['id','name']);

        $response = [
            'status' => true,
            'message' => 'Location Data',
            'data' =>$locations,
        ]; 
        return response()->json($response, 200);
    }

    public function fcmTokenUpdate($user_id,$token)
    {
        $user = User::find($user_id);
        if ($user) {
            $user->fcm_token = $token;
            $user->save();
        }

        $response = [
            'status' => true,
            'message' => 'Token Updated',
        ]; 
        return response()->json($response, 200);
    }
}
