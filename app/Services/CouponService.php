<?php
namespace App\Services;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class CouponService {

    public static function checkUser($user_id)
    {
        // 2 = old, 1 = new
        $is_new_user = Order::where('user_id',$user_id)->where('status','!=',5)->count();
        if ($is_new_user > 0) {
            return 2;
        }else{
            return 1;
        }
    }

    public static function cartFetch($user_id)
    {
        $cart = Cart::where('user_id', $user_id)->get();
        return $cart;
    }

    public static function fetchCoupons($user_id)
    {
        $coupons = new Collection();
        $cart = self::cartFetch($user_id);
        if (!empty($cart) && count($cart) > 0) {
            foreach ($cart as $item){
                $user_type = self::checkUser($user_id);                
                $size_id = $item->product->size_id ?? null;
                $brand_id = $item->product->product->brand_id ?? null;
                $coupon_data = Coupon::where('brand_id', $brand_id)->where('size_id', $size_id)->where('expire_date','>=',Carbon::today())->where('status',1)
                ->where(function ($q) use($user_type){
                    $q->where('user_type',$user_type)
                    ->orWhere('user_type',3);
                })
                ->get();
                $data = [];
                foreach ($coupon_data as $key => $coupon) {
                    $data =[
                        'id' => $coupon->id,
                        'coupon' => $coupon->coupon,
                        'description' => $coupon->description,
                        'discount' => $coupon->discount,
                        'max_discount' => $coupon->max_discount,
                        'user_type' => $coupon->user_type,
                        'coupon_type' => $coupon->coupon_type,
                        'expire_date' => $coupon->expire_date,
                    ];

                    if($coupons->where('id',$coupon->id)->count() == 0){
                        $coupons->push($data);
                    }
                }
            }
        }
        return $coupons;
    }

    public static function calculateDiscount($user_id,$coupon_id)
    {
        $coupon = Coupon::where('id',$coupon_id)->where('status',1)->first();
        $cart = Cart::where('user_id',$user_id)
        ->join('product_sizes','product_sizes.id','=','carts.product_id')
        ->where('product_sizes.size_id',$coupon->size_id)
        ->join('products','products.id','=','product_sizes.product_id')
        ->where('products.brand_id',$coupon->brand_id)
        ->select('product_sizes.price as price','product_sizes.shipping_charge as shipping_charge','carts.quantity as quantity')->get();
        $amount = 0;
        $shipping_amount = 0;
        if (!empty($cart) && count($cart) > 0) {
            foreach ($cart as $item){
                $amount += $item->price * $item->quantity;
                $shipping_amount += $item->shipping_charge * $item->quantity;
            }
        }

        if ($coupon->coupon_type == 'S') {
            $discount = ($shipping_amount*$coupon->discount)/ 100 ;
        } else {
            $discount = ($amount*$coupon->discount)/ 100 ;
        }
        
        if ($discount > $coupon->max_discount) {
            $discount = $coupon->max_discount;
        }
        return $discount;
    }
}