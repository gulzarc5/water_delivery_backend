<?php

namespace App\Http\Controllers\Admin\Membership;

use App\Http\Controllers\Controller;
use App\Models\MainArea;
use App\Models\SubscriptionDetail;
use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;
use App\Models\UserSubscriptionOrderDate;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class MembershipOrderController extends Controller
{
    public function form()
    {
        $main_location = MainArea::where('status',1)->get();
        return view('admin.memberShip_order.customer_info',compact('main_location'));
    }

    public function customerProceed(Request $request) 
    {
        $this->validate($request, [
            'customer_id' => 'required|numeric',
            'address_id' => 'required|numeric',
        ]);
        $customer_id = $request->input('customer_id');
        $address_id = $request->input('address_id');
        $plans = SubscriptionPlan::where('status',1)->get();

        
        return view('admin.memberShip_order.order_form',compact('plans','customer_id','address_id'));
    }

    public function getProduct($plan_id)
    {
        $plan_details = SubscriptionDetail::with(['brand','size'])->where('plan_id',$plan_id)->where('status',1)->get();
        return $plan_details;
    }

    public function getPrice(Request $request)
    {
        $this->Validate($request,[
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'frequency' => 'required|numeric',
            'is_jar' => 'nullable|numeric',
        ]);

        $plan_details = SubscriptionDetail::where('id', $request->input('product_id'))->first();
        if (!$plan_details) {
            return false;
        }
        $quantity = $request->input('quantity');
        $frequency = $request->input('frequency');
        $is_jar = $request->input('is_jar');
        $duration = $plan_details->planMaster->duration ?? 0;
        $mrp = ($plan_details->mrp * $quantity);
        $price = ($plan_details->price * $quantity);
        $jar_price = 0;
        if ($is_jar == 1) {
            $jar_price = ($plan_details->jar_price * $quantity);
        }
        if ($frequency == 1) {
            $mrp = $mrp*$duration;
            $price = $price*$duration;
        }else{
            $duration = (int)$duration/2;
            $mrp = $mrp*$duration;
            $price = $price*$duration;
        }
        $discount = $mrp - $price;
        $data = new Collection([
            'mrp' => $mrp ,
            'price' => $price+$jar_price,
            'discount' => $discount,
            'jar_price' => $jar_price,
        ]);        
        
        return $data;
    }

    public function orderPlace(Request $request)
    {
        $this->Validate($request,[ 
            'user_id' => 'required|numeric',
            'subscription_details_id' => 'required|numeric',
            'quantity' => 'required|numeric',
            'is_jar'=>'nullable|in:1,2',
            'frequency' => 'required|numeric|in:1,2,3',
            'delivery_start_date' => 'required|date|after:now|date_format:Y-m-d',
            'delivery_slot_id' => 'required|in:1,2',
            'delivery_address_id' => 'required',
        ]);

        // dd($request->all());
        $frequency = $request->input('frequency');
        $quantity = $request->input('quantity');
        


        $plan_details = SubscriptionDetail::where('subscription_details.status',1)
        ->where('subscription_details.id',$request->input('subscription_details_id'))
        ->join('subscription_plans','subscription_plans.id','=','subscription_details.plan_id')
        ->where('subscription_plans.status',1)
        ->select('subscription_details.*','subscription_plans.duration as duration')
        ->first();

   
         //frequency 	1 = daily,2 = alternative_days, 3 = weekly
        $delivery_start_date = Carbon::parse($request->input('delivery_start_date'));
        $order = new UserSubscription();
        $order->user_id = $request->input('user_id');;
        $order->delivery_address_id = $request->input('delivery_address_id');
        $order->delivery_slot_id = $request->input('delivery_slot_id');
        $order->brand_id = $plan_details->brand_id;
        $order->size_id = $plan_details->size_id;
        $order->brand = $plan_details->brand->name ?? null;
        $order->size = $plan_details->size->name ?? null;
        $order->plan_type = $plan_details->planMaster->type ?? null;
        $order->plan_name = $plan_details->planMaster->name ?? null;
        $order->quantity = $quantity;
        $order->frequency = $frequency;
        $order->order_from = 2;
        $order->is_jar = $request->input('is_jar') ?? 2;
        $order->plan_duration = $plan_details->duration ?? 0;
        $order->plan_start_date = $delivery_start_date->toDateString();
        $order->plan_end_date = $delivery_start_date->addDays($plan_details->planMaster->duration-1)->toDateString();
        $order->payment_status = 3;
        $order->status = 2;

        $total_order = 0;
        $total_mrp = 0;
        $total_price = 0;
        if ($frequency == 1) {
            $total_order = ($plan_details->planMaster->duration*$quantity);
            $total_mrp = $total_order*$plan_details->mrp;
            $total_price = $total_order*$plan_details->price;
            if ($request->input('is_jar')==1) {
                $total_mrp = $total_mrp+($plan_details->jar_mrp*$quantity);
                $total_price = $total_price+($plan_details->jar_price*$quantity);
            }
        } elseif ($frequency == 2){
            $total_order = intdiv($plan_details->planMaster->duration, 2) * $quantity;
            $total_mrp = $total_order*$plan_details->mrp;
            $total_price = $total_order*$plan_details->price;
            if ($request->input('is_jar')==1) {
                $total_mrp = $total_mrp+($plan_details->jar_mrp*$quantity);
                $total_price = $total_price+($plan_details->jar_price*$quantity);
            }
        }elseif ($frequency == 3){
            $total_order = intdiv($plan_details->planMaster->duration, 7) * $quantity;
            $total_mrp = $total_order*$plan_details->mrp;
            $total_price = $total_order*$plan_details->price;
            if ($request->input('is_jar')==1) {
                $total_mrp = $total_mrp+($plan_details->jar_mrp*$quantity);
                $total_price = $total_price+($plan_details->jar_price*$quantity);
            }
        }
        $order->total_order = $total_order;
        $order->total_mrp = $total_mrp;
        $order->total_amount = $total_price;

        
        if($order->save()){

            $order_dates = New UserSubscriptionOrderDate();
   
            $dates = $this->getDates(Carbon::parse($request->input('delivery_start_date')),$delivery_start_date->addDays($plan_details->planMaster->duration-1),$order->frequency,$plan_details->planMaster->duration);

            if (isset($dates) && !empty($dates) && (count($dates) > 0)) {
                foreach ($dates as $date){
                    $order_date_data[] = [
                        'user_subscription_id' => $order->id,
                        'order_date' => $date,
                    ];
                }
        
                if ($order_date_data) {
                    UserSubscriptionOrderDate::insert($order_date_data);
                }
            }
            $order->save();


            return redirect()->route('admin.user.subscription.details',['subscription_id'=>$order->id]);
        }
    }

    private function getDates($start_date,$end_date,$frequency,$duration){
     
        $dates[] = $start_date->toDateString();
        // return $start_date;
        $j = 1;
        if ($frequency == 1) {
            // return $start_date->addDays(1)->toDateString();
            for ($i=$start_date->addDays(1); $i <= $end_date; $i++){
                if ($j<$duration) {
                    $dates[] = $i->toDateString();
                    $j++;
                }
                $start_date = $start_date->addDays(1);
            }
        } elseif ($frequency == 2){
            for ($i=$start_date->addDays(2); $i <= $end_date; $i++){
                if ($j<($duration/2)) {
                    $dates[] = $i->toDateString();
                    $j++;
                }
                $start_date = $start_date->addDays(2);
            }
        }elseif ($frequency == 3){
            for ($i=$start_date->addDays(7); $i <= $end_date; $i++){
                if ($j<($duration/7)) {
                    $dates[] = $i->toDateString();
                    $j++;
                }
                $start_date = $start_date->addDays(7);
            }
        }
        
        return $dates;
    }

    public function checkMembership($user_id)
    {
        $user_subscriptions = UserSubscription::where('user_id', $user_id)->where('status',2)
        ->count();
        if ($user_subscriptions > 0) {
            return true;
        } else {
            return false;
        }
    }
}
