<?php

namespace App\Http\Controllers\Api\Order\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriptionOrder\SubscriptionOrderResource;
use App\Models\Product;
use App\Models\SubscriptionDetail;
use App\Models\UserSubscription;
use App\Models\UserSubscriptionOrderDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use Razorpay\Api\Api;

class SubscriptionOrderController extends Controller
{
    public function orderPlace(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'subscription_details_id' => 'required|numeric',
            'frequency' => 'required|numeric|in:1,2,3',
            'quantity' => 'required|numeric',
            'delivery_address_id' => 'required',
            'delivery_slot_id' => 'required|in:1,2',
            'delivery_start_date' => 'required|date_format:Y-m-d',
            'is_jar'=>'required|in:1,2',
        ]);

        if ($validation->fails()) {
            $response = [
                'status' => false,
                'message' => 'Validation Error',
                'error_code' => true,
                'error_message' => $validation->errors(),
                'data' => null,
            ];
            return response()->json($response, 200);
        }

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
        $order->user_id = $request->user()->id;
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
        $order->is_jar = $request->input('is_jar');
        $order->plan_duration = $plan_details->duration ?? 0;
        $order->plan_start_date = $delivery_start_date->toDateString();
        $order->plan_end_date = $delivery_start_date->addDays($plan_details->planMaster->duration-1)->toDateString();

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
            
            $api = new Api(config('services.razorpay.id'), config('services.razorpay.key'));
            $orders = $api->order->create(array(
                'receipt' => $order->id,
                'amount' => (($order->total_amount) * 100),
                'currency' => 'INR',
                'payment_capture' => 0,
                )
            );
            
            $payment_data = [
                'key_id' => config('services.razorpay.id'),
                'amount' => (($order->total_amount) * 100),
                'order_id' => $orders['id'],
                'name' => $order->user->name ?? null,
                'email' => $order->user->email ?? null,
                'mobile' => $order->user->mobile ?? null,
            ];

            $order->payment_request_id = $orders['id'];
            $order->save();


            $response = [
                'status' => true,
                'message' => 'order Placed Successfully',
                'error_code' => false,
                'error_message' => null,
                'data' => [
                    'order' => SubscriptionOrderResource::make($order),
                    'payment_data' => $payment_data,
                ],
            ];
            return response()->json($response, 200);
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


    public function paymentVerify(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'razorpay_order_id' => 'required',
            'razorpay_payment_id' => 'required', 
            'razorpay_signature' => 'required',
            'order_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'status' => false,
                'message' => 'Required Field Can not be Empty',
                'error_code' => true,
                'error_message' => $validator->errors(),
                'data' => [],
            ];
            return response()->json($response, 200);
        }

        $verify = $this->signatureVerify(
            $request->input('razorpay_order_id'),
            $request->input('razorpay_payment_id'),
            $request->input('razorpay_signature')
        );
        $order = UserSubscription::find($request->input('order_id'));
        $capture = $this->paymentCapture($request->input('razorpay_payment_id'),$order);
        if ($verify && $capture){           
            $order->payment_id =  $request->input('razorpay_payment_id');
            $order->payment_status = 3;
            $order->status = 2;
            $order->save();    

            $response = [
                'status' => true,
                'message' => 'Payment Success',
            ];
            return response()->json($response, 200);
        }else{
            $order = UserSubscription::find($request->input('order_id'));
            $order->payment_status = 2;
            $order->save();           
            $response = [
                'status' => false,
                'message' => 'Payment Failed',
            ];
            return response()->json($response, 200);
        }
    }

    private function signatureVerify($order_id,$payment_id,$signature)
    {
        try {
            $api = new Api(config('services.razorpay.id'), config('services.razorpay.key'));
            $attributes = array(
                'razorpay_order_id' => $order_id,
                'razorpay_payment_id' => $payment_id,
                'razorpay_signature' => $signature
            );

            $api->utility->verifyPaymentSignature($attributes);
            $success = true;
        } catch (\Exception $e) {
            $success = false;
        }
        return $success;
    }

    private function paymentCapture($payment_id,$order)
    {
        try {
            $api = new Api(config('services.razorpay.id'), config('services.razorpay.key'));
            $amount = $order->total_amount*100;
            $payment = $api->payment->fetch($payment_id);
            $payment->capture(array('amount' => $amount, 'currency' => "INR"));
            $success = true;
        }catch(\Exception $e){
            $success = false;
        }
        return $success;
    }

}
