<?php
namespace App\Services;

use App\Jobs\MemberShipOrder;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\UserSubscription;
use App\Models\UserSubscriptionOrderDate;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Log;

class SubscriptionOrderPlaceService
{
    public static function place($id){
        // $order->order_id = Generate::orderId($order->id,1);
        $today = Carbon::today()->toDateString();
        $user_subscription = UserSubscriptionOrderDate::where('user_subscription_order_dates.id',$id)
            ->join('user_subscriptions','user_subscriptions.id','=','user_subscription_order_dates.user_subscription_id')
            ->select('user_subscriptions.*','user_subscription_order_dates.id as order_date_id')
            ->first();
       if ($user_subscription) {
            self::orderPlace($user_subscription);
       }
     
    }

    private static function orderPlace($subscription){
        Log::debug($subscription);
        $product = Product::where('products.status',1)
        ->where('products.brand_id',$subscription->brand_id)
        ->join('product_sizes','product_sizes.product_id','=','products.id')
        ->where('product_sizes.size_id',$subscription->size_id)
        ->where('product_sizes.status',1)
        ->select('product_sizes.*')
        ->first();

        $order = new Order();
        $order->user_id = $subscription->user_id;
        $order->address_id = $subscription->delivery_address_id;
        $order->payment_type =3;
        $order->payment_status = 3;
        $order->delivery_schedule_date = Carbon::today()->toDateString();
        $order->delivery_slot_id = $subscription->delivery_slot_id;
        if ($order->save()) {
            $order->order_id = Generate::orderId($order->id,2);
            $order->save();
    
            $order_details =  new OrderDetail();
            $order_details->order_id = $order->id;
            $order_details->product_id = $product->id;
            $order_details->quantity = $subscription->quantity;
            $order_details->subscribed_quantity = $subscription->quantity;
            $order_details->type = 2; //1 = normal, 2 = subscription
            $order_details->mrp = $product->mrp;
            $order_details->price = $product->price;
            $order_details->subscribed_amount = ($product->price * $subscription->quantity);
            $order_details->coin_used = 0;
            $order_details->coin_generated = 0;
            if($order_details->save()){
                $order->total_mrp = $product->mrp*$subscription->quantity;
                $order->total_sale_price = $product->price*$subscription->quantity;
                $order->total_subscribed_amount = $product->price*$subscription->quantity;
                $order->save();
                self::userSubscriptionOrderDeduct($subscription);
            }
        }
    }

    private static function userSubscriptionOrderDeduct($subscription_data){
        $subscription = UserSubscription::find($subscription_data->id);
        if ($subscription) {
            $subscription->order_consumed = $subscription->order_consumed+$subscription_data->quantity;
            $subscription->save();
            if ($subscription->total_order == $subscription->order_consumed) {
                $subscription->status = 3;
                $subscription->save();
            }
            $subscription_date = UserSubscriptionOrderDate::find($subscription_data->order_date_id);
            if ($subscription_date) {
               $subscription_date->status = 2;
               $subscription_date->save();
            }
            return true;
        }else{
            return false;
        }
    }


}