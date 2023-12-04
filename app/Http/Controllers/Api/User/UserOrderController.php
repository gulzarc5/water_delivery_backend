<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderDetailResource;
use App\Http\Resources\Order\OrderListResource;
use App\Models\Order;
use App\Models\RefundInfo;
use App\Models\User;
use App\Models\UserCoin;
use App\Models\UserCoinHistory;
use App\Services\PushService;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function list(Request $request)
    {
        $orders = Order::where('user_id',$request->user()->id)->latest()->paginate(20);

        $response = [
            'status' => true,
            'message' => 'Order List',
            'current_page' => $orders->currentPage(),
            'total_pages' => $orders->lastPage(),
            'has_more_pages' => $orders->hasMorePages(),
            'total_data' => $orders->total(),
            'data' => OrderListResource::collection($orders),
        ];
        return response()->json($response, 200);
    }

    public function previousOrder(Request $request)
    {
        $order = null;
        if ($request->user()->id) {
            $order = Order::with('detail')->where('user_id',$request->user()->id)->latest()->first();
        }

        $response = [
            'status' => true,
            'message' => 'Previous Order',
            'data' => $order ? OrderListResource::make($order) : null,
        ];
        return response()->json($response, 200);
    }

    public function detail($order_id)
    {
        $order = Order::with('detail','addrees')->find($order_id);
        $response = [
            'status' => true,
            'message' => 'Order Details',
            'data' => OrderListResource::make($order),
        ];
        return response()->json($response, 200);
    }

    public function orderCancel($order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            $order->status = 5;
            if ($order->payment_type == 1 && $order->payment_status == 3) {
                $order->is_refund = 1;
                $refund_info = new RefundInfo();
                $refund_info->user_id = $order->user_id;
                $refund_info->order_id = $order->id;
                $refund_info->amount = ($order->total_sale_price+$order->shipping_charge) - ($order->coins_used + $order->coupon_discount);
                $refund_info->save();
            } 
            if($order->save()){
                if ($order->coins_used > 0) {
                    $comment = "Coin Refunded due to Order cancellation With Id $order->id";
                    $this->userCoinCredit($order->coins_used,$order->user_id,$comment);
    
                    $title = "Pyaas Coin Refunded";
                    $body = "$order->coin_earned Coin Refunded To your coin wallet due to order cancellation of order $order->id, If you have problem with this order do not hasitate to contact with us thank you";
                    $this->sendPush($order->user_id,$title,$body);
                }
            }            
        }
        $response = [
            'status' => true,
            'message' => 'Order Cancelled',
        ];
        return response()->json($response, 200);
    }

    private function userCoinCredit($credit_coin,$user_id,$comment){
        $user_coin = UserCoin::where('user_id',$user_id)->first();
        if($user_coin){
            $user_coin->total_coins = $user_coin->total_coins+$credit_coin;
            $user_coin->save();
            $this->userCoinDetailsInsert($user_coin,2,$credit_coin,$comment);
        }
        return true;
    }

    private function userCoinDetailsInsert(UserCoin $user_coin,$type,$coin,$comment){
        // type 1 = debit, 2 = credit
        $coin_details = new UserCoinHistory();
        $coin_details->user_coin_id = $user_coin->id;
        $coin_details->type = $type;
        $coin_details->coin = $coin;
        $coin_details->total_coin = $user_coin->total_coins;
        $coin_details->comment = $comment;
        $coin_details->save();
        return true;
    }

    private function sendPush($user_id,$title,$body){
        $user = User::where('id', $user_id)->select('fcm_token')->first();
        if($user->fcm_token){
            PushService::notification($user->fcm_token, $title,$body,1);
        }
    }
}
