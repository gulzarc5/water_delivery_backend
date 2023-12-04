<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\InvoiceSetting;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\RefundInfo;
use App\Models\User;
use App\Models\UserCoin;
use App\Models\UserCoinHistory;
use App\Models\UserSubscription;
use App\Models\UserSubscriptionOrderDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use App\Services\PushService;
use App\Services\SmsService;
use Exception;

class OrderController extends Controller
{
    public function newList()
    {
        return view('admin.order.order_list');
    }

    public function newListAjax(Request $request)
    {
        $model = Order::with('user')->orderBy('created_at','desc');

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->addColumn('payable_amount',function ($row){
                return $row->total_sale_price - ($row->coins_used+$row->coupon_discount);
            })
            ->addColumn('status_data',function ($row){
                if ($row->payment_type == 1 && $row->payment_status != 3) {
                    $btn = '<a href="'.route('admin.order.view',['order_id'=>$row->id]).'" class="btn btn-warning btn-xs">View</a>';
                    if ($row->payment_status == 1) {
                        $btn .= "<span class='btn btn-warning btn-xs'>Payment Pending</span>
                        ";
                    } else {
                        $btn .= "<span class='btn btn-danger btn-xs'>Payment Failed</span>";
                    }                    
                    return $btn;
                }
                $btn = '<a href="'.route('admin.order.view',['order_id'=>$row->id]).'" class="btn btn-warning btn-xs">View</a>';
                if ($row->status == 1) {
                    $btn .= '<b id="status_'.$row->id.'"><button class="btn btn-primary btn-xs"  onclick="openModal('.$row->id.',2,'."'Are You Sure To Accept Order'".')">Accept</button></b>
                    <b id="cancel_'.$row->id.'"><button class="btn btn-danger btn-xs"  onclick="openModal('.$row->id.',5,'."'Are You Sure To Cancel Order'".')">Cancel</button></b>
                    ';
                }elseif ($row->status == 2) {
                    $btn .= '<b id="status_'.$row->id.'"><button class="btn btn-info btn-xs"  onclick="openModal('.$row->id.',3,'."'Are You Sure Update Order On The Way'".')">On The Way</button></b>
                    <b id="cancel_'.$row->id.'"><button class="btn btn-danger btn-xs"  onclick="openModal('.$row->id.',5,'."'Are You Sure To Cancel Order'".')">Cancel</button></b>
                    ';
                }elseif ($row->status == 3) {
                    $btn .= '<b id="status_'.$row->id.'"><button class="btn btn-success btn-xs"  onclick="openModal('.$row->id.',4,'."'Are You Sure Update Order As Delivered'".')">Delivered</button></b>
                    <b id="cancel_'.$row->id.'"><button class="btn btn-danger btn-xs"  onclick="openModal('.$row->id.',5,'."'Are You Sure To Cancel Order'".')">Cancel</button></b>
                    ';
                }

                return $btn;
                
            })
            ->rawColumns(['payable_amount','action','status_data'])
            ->toJson();
    }

    public function orderView($order_id)
    {
        $order = Order::findOrFail($order_id);
        $order_items = OrderDetail::where('order_id',$order_id)->get();
        $invoice_setting = InvoiceSetting::find(1);
        return view('admin.order.order_details',compact('order','invoice_setting','order_items'));

    }

    public function orderSearchForm(Request $request)
    {
        return view('admin.order.search_form');
    }

    public function orderSearchFormSubmit(Request $request)
    {
        $this->Validate($request,[
            'delivery_schedule_date' => 'required_without:from_date|required_without:to_date|nullable|date|date_format:Y-m-d',
            'from_date' => 'required_without:delivery_schedule_date|nullable|date|date_format:Y-m-d',
            'to_date' => 'required_without:delivery_schedule_date|nullable|date|date_format:Y-m-d',
            'payment_type' => 'nullable|in:1,2,3,A',
            'payment_status' => 'nullable|in:1,2,3,A',
            'order_status' => 'nullable|in:1,2,3,4,5,A',
            'delivery_slot' => 'nullable|in:1,2,A',
        ]);

        $schedule_date = $request->input('delivery_schedule_date');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');
        $payment_type = $request->input('payment_type');
        $payment_status = $request->input('payment_status');
        $order_status = $request->input('order_status');
        $delivery_slot = $request->input('delivery_slot');

        $orders = Order::query();
        if (!empty($schedule_date)) {
            $orders->where('delivery_schedule_date',$schedule_date);
        }
        if (!empty($delivery_slot) && $delivery_slot != 'A') {
            $orders->where('delivery_slot_id',$delivery_slot);
        }
        if (!empty($from_date) && !empty($to_date)) {
            $orders->whereBetween('created_at',[Carbon::parse($from_date)->startOfDay(),Carbon::parse($to_date)->endOfDay()]);
        }

        if (!empty($payment_type)) {
            $orders->where('payment_type',$payment_type);
        }

        if (!empty($payment_status)) {
            $orders->where('payment_status',$payment_status);
        }

        if (!empty($order_status)) {
            $orders->where('status',$order_status);
        }

        $orders = $orders->latest()->paginate(50);
        // return $orders;
        if ($request->ajax()) {
            return view('admin.order.pagination.order_search_pagination',compact('orders'));
        }
        return view('admin.order.order_search_list',compact('orders'));
    }

    public function statusUpdate($id,$status)
    {
        $order = Order::findOrFail($id);
        if ($status == 4) {
            if ($order->coin_earned > 0) {
                $comment = "Coin Credited For Order With Id $order->id";
                $this->userCoinCredit($order->coin_earned,$order->user_id,$comment);
               
                $title = "Pyaas Coin Credited";
                $body = "$order->coin_earned Coin Credited To your coin wallet after successfull delivery of order $order->id, You Can use coin at the time of purchase t&c apply";
                $this->sendPush($order->user_id,$title,$body);
            }
        }elseif($status == 5){
            if ($order->payment_type == 1 && $order->payment_status == 3) {
                $order->is_refund = 2;
                $refund_info = new RefundInfo();
                $refund_info->user_id = $order->user_id;
                $refund_info->order_id = $order->id;
                $refund_info->amount = $order->total_sale_price - ($order->coins_used + $order->coupon_discount);
                $refund_info->save();
            }elseif($order->payment_type == 3){
                $this->addAnotherDayToSubscription($order->user_id);

                $title = "Order Undelivered";
                $body = "Sorry we are unable to deliver your order today, Don't worry we will extend your subscription one more day, Have a nice day";
                $this->sendPush($order->user_id,$title,$body);
            }

            if ($order->coins_used > 0) {
                $comment = "Coin Refunded due to Order cancellation With Id $order->id";
                $this->userCoinCredit($order->coins_used,$order->user_id,$comment);

                $title = "Pyaas Coin Refunded";
                $body = "$order->coin_earned Coin Refunded To your coin wallet due to order cancellation of order $order->id, If you have problem with this order do not hasitate to contact with us thank you";
                $this->sendPush($order->user_id,$title,$body);
            }
        }
        $order->status = $status;
        if ($order->save()) {
            $this->sendOrderPush($order);
            return true;
        }else{
            return false;
        }
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

    private function addAnotherDayToSubscription($user_id){
        $subscription = UserSubscription::where('user_id', $user_id)->where('status', 2)->where('payment_status',3)->first();
        if ($subscription) {
            $subs_dates = UserSubscriptionOrderDate::where('user_subscription_id',$subscription->id)->orderBy('order_date','desc')->select('order_date')->first();
            $order_dates = New UserSubscriptionOrderDate();
            $order_dates->user_subscription_id = $subscription->id;
            if ($subscription->frequency == 1) {
                $order_dates->order_date = Carbon::parse($subs_dates->order_date)->addDays(1)->toDateString();
            }elseif ($subscription->frequency == 2) {
                $order_dates->order_date = Carbon::parse($subs_dates->order_date)->addDays(2)->toDateString();                
            }elseif ($subscription->frequency == 3) {
                $order_dates->order_date = Carbon::parse($subs_dates->order_date)->addDays(7)->toDateString();
            }
            $order_dates->save();
        }
    }

    private function sendOrderPush($order)
    {
        $user = User::where('id', $order->user_id)->select('fcm_token')->first();
        if($user->fcm_token){
            $title = "";
            $body = "";
            if ($order->status == 2) {
                $title = "Order Accepted";
                $body = "Your Order With Order Id : $order->id , Is Accepted and We are Preparing Your Order. We Will notify you once delivery boy pick up your order. Thanks for shopping with us";
            }elseif($order->status == 3){
                $title = "Out For Delivery";
                $body = "Your Order With Order Id : $order->id , Is Out For Delivery. Thanks for shopping with us";
                //Send Message
                $message = "Dear customer your order at Pyaas is out for delivery.
                Thanks for choosing PYAAS";
                if ($order->user->mobile) {
                    try {
                        SmsService::send($order->user->mobile,$message,1207162696581468387) ;              
                    }catch(Exception $e){
                        //DO Nothing
                    }            
                }
            }elseif($order->status == 4){
                $title = "Order Delivered";
                $body = "Your Order With Order Id : $order->id , Is Delivered Successfully. Thanks for shopping with us";
            }elseif($order->status == 5){
                $title = "Order Cancelled";
                $body = "Your Order With Order Id : $order->id , Is Cancelled. Thanks for shopping with us";
            }
            try {
                PushService::notification($user->fcm_token, $title,$body,1);
            } catch (Exception $e) {
                //throw $th;
            }
        }
    }

    private function sendPush($user_id,$title,$body){
        $user = User::where('id', $user_id)->select('fcm_token')->first();
        if($user->fcm_token){
            PushService::notification($user->fcm_token, $title,$body,1);
        }
    }

    public function orderReceiptPrint($order_id)
    {
        $date = Carbon::now()->timezone('Asia/Kolkata')->format('F j, Y g:i:s A');
        $orders = Order::with('detail')->where('id',$order_id)->get();
        return view('admin.order.print',compact('orders','date'));
    }
}
