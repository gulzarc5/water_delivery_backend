<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderListResource;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\UserCoin;
use App\Models\UserCoinHistory;
use App\Models\UserSubscription;
use App\Services\CouponService;
use App\Services\Generate;
use App\Services\SmsService;
use Exception;
use Illuminate\Http\Request;
use Validator;
use Razorpay\Api\Api;

class OrderController extends Controller
{
    public function orderPlace(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'payment_type' => 'required|numeric|in:1,2,3', //1 = online, 2= cod, 3 = subscription
            'address_id' => 'required|numeric',
            'delivery_date' => 'required|date|date_format:Y-m-d',
            'delivery_slot' => 'required|numeric|exists:delivery_slots,id',
            'coupon_code' => 'nullable|string|exists:coupons,coupon',
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

        $user_id = $request->user()->id;
        // User Coins 
        $user_coin = $this->userCoinFetch($user_id);
        if (!$user_coin) {
            $response = [
                'status' => false,
                'message' => 'Sorry Something Went Wrong Please Try Again',
                'error_code' => false,
                'error_message' => null,
                'data' => null,
            ];
            return response()->json($response, 200);
        }
        $coupon = null;
        if (!empty($request->input('coupon_code'))) {
            $coupon = Coupon::where('coupon',$request->input('coupon_code'))->where('status',1)->first();
        }

        $cart = Cart::where('user_id', $user_id);
        if ($cart->count() == 0) {
            $response = [
                'status' => false,
                'message' => 'Sorry Cart Is Empty',
                'error_code' => false,
                'error_message' => null,
                'data' => null,
            ];
            return response()->json($response, 200);
        }

        $order = new Order();
        $order->user_id = $request->user()->id;
        $order->address_id = $request->input('address_id');
        $order->payment_type = $request->input('payment_type');
        $order->delivery_schedule_date = $request->input('delivery_date');
        $order->delivery_slot_id = $request->input('delivery_slot');
        if (!$order->save()) {
            $response = [
                'status' => false,
                'message' => 'Sorry Something Went Wrong Please Try Again',
                'error_code' => false,
                'error_message' => null,
                'data' => null,
            ];
            return response()->json($response, 200);
        }

        $carts = $cart->get();

        $total_user_coin = $user_coin->total_coins;
        $total_mrp = 0;
        $total_shipping_charge = 0;
        $total_price = 0;
        $coins_generate = 0;
        $coins_used = 0;
        $coin_usable = 0;
        foreach ($carts as $key => $cart) {           
            $order_details =  new OrderDetail();
            $order_details->order_id = $order->id;
            $order_details->product_id = $cart->product_id;
            $order_details->quantity = $cart->quantity;
            $order_details->type = 1; //1 = normal, 2 = subscription
            $order_details->mrp = $cart->product->mrp ?? 0;
            $order_details->price = $cart->product->price ?? 0;
            $order_details->is_jar = $cart->is_jar;
            $order_details->jar_mrp = $cart->product->jar_mrp ?? 0;
            $order_details->jar_price = $cart->product->jar_price ?? 0;
            $order_details->coin_generated = ($cart->product->coin_generate ?? 0) * $cart->quantity;
            $order_details->save();

            if ($cart->is_jar == 1) {
                $total_mrp +=  $order_details->jar_mrp * $order_details->quantity;
                $total_price += $order_details->jar_price * $order_details->quantity;
            }

            $total_mrp +=  $order_details->mrp * $order_details->quantity;
            $total_price += $order_details->price * $order_details->quantity;            
            $coins_generate += $order_details->coin_generated * $cart->quantity;
            $coin_usable +=  ($cart->product->coin_use ?? 0)  * $cart->quantity;
            $total_shipping_charge +=  ($cart->product->shipping_charge ?? 0)  * $cart->quantity;
        }
        if (($total_user_coin > 0) && ($coin_usable > 0)) {
            if ($total_user_coin >= $coin_usable) {
                $coins_used =  $coin_usable;
            }else{
                $coins_used =  $total_user_coin;
            }
        }

        $order->total_mrp = $total_mrp;
        $order->total_sale_price = $total_price;
        $order->coins_used = $coins_used;
        $order->shipping_charge = $total_shipping_charge;
        $order->coin_earned = $coins_generate;
        $order->order_id = Generate::orderId($order->id,1);
        if (!empty($request->input('coupon_code')) && !empty($coupon)) {
            $order->coupon_discount  = CouponService::calculateDiscount($user_id,$coupon->id);
        }
        $order->save();
        if ($order->payment_type == 2) {
            if ($order->coins_used > 0) {
                $this->userCoinDebit($user_coin,$order->coins_used);
            }

            $message = "Thanks for choosing Pyaas. Your order placed successfully and You will be updated once the order is out for delivery.";
            if ($order->user->mobile) {
                try {
                    SmsService::send($order->user->mobile,$message,1207162696518944389) ;              
                }catch(Exception $e){
                    //DO Nothing
                }            
            }
            $response = [
                'status' => true,
                'message' => 'Order Placed Successfully',
                'error_code' => false,
                'error_message' => null,
                'data' => [
                    'id' => $order->id,
                    'payment' => false,
                    'amount' => $order->total_sale_price-($order->coins_used+$order->coupon_discount),
                    'payment_data' => null,
                ],
                'order' =>  OrderListResource::make(Order::with('detail','addrees')-> find($order->id)),
            ];
            return response()->json($response, 200);
        } else {
            $api = new Api(config('services.razorpay.id'), config('services.razorpay.key'));
            $orders = $api->order->create(array(
                'receipt' => $order->id,
                'amount' => (($order->total_sale_price+$order->shipping_charge) - ($order->coins_used+$order->coupon_discount))*100,
                'currency' => 'INR',
                'payment_capture' => 0,
                )
            );
            $order->payment_request_id = $orders['id'];
            $order->save();           

            $payment_data = [
                'key_id' => config('services.razorpay.id'),
                'amount' =>(($order->total_sale_price+$order->shipping_charge) - ($order->coins_used+$order->coupon_discount))*100,
                'order_id' => $orders['id'],
                'name' => $order->user->name ?? null,
                'email' => $order->user->email ?? null,
                'mobile' => $order->user->mobile ?? null,
            ];

            $response = [
                'status' => true,
                'message' => 'Order Placed Successfully',
                'error_code' => false,
                'error_message' => null,
                'data' => [
                    'id' => $order->id,
                    'payment' => true,
                    'amount' => $order->total_sale_price-($order->coins_used+$order->coupon_discount),
                    'payment_data' => $payment_data,
                ],
                'order' =>  OrderListResource::make(Order::with('detail')->find($order->id)),
            ];
            return response()->json($response, 200);
        }
    }
    

    public function refilSubscriptionOrder(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'quantity' => 'required|numeric', //1 = cod, 2= online, 3 = subscription
            'address_id' => 'required|numeric',
            'delivery_date' => 'required|date|date_format:Y-m-d',
            'delivery_slot' => 'required|numeric|exists:delivery_slots,id'
        ]);
        if ($validation->fails()) {
            $response = [
                'status' => false,
                'message' => 'Validation Error',
                'error_code' => true,
                'error_message' => $validation->errors(),
            ];
            return response()->json($response, 200);
        }
        $quantity = $request->input('quantity');

        //Check Subscription
        $subscription = UserSubscription::where('user_id', $request->user()->id)
            ->where('plan_type',2)
            ->where('frequency',4)
            ->where('payment_status',3)
            ->where('status',2)
            ->first();
        if ($subscription ) {
           if (($subscription->total_order-$subscription->order_consumed) < $quantity) {
                $response = [
                    'status' => false,
                    'message' => 'Sorry Order Quantity Should be less then Subscribed Quantity',
                    'error_code' => false,
                    'error_message' => null,
                ];
                return response()->json($response, 200);
           }
        }else{
            $response = [
                'status' => false,
                'message' => 'Sorry No Subscription Found',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        }

        // check product
        $product = Product::where('products.status',1)
        ->where('products.brand_id',$subscription->brand_id)
        ->join('product_sizes','product_sizes.product_id','=','products.id')
        ->where('product_sizes.size_id',$subscription->size_id)
        ->where('product_sizes.status',1)
        ->select('product_sizes.*')
        ->first();

        $order = new Order();
        $order->user_id = $request->user()->id;
        $order->address_id = $request->input('address_id');
        $order->payment_type = 3;
        $order->delivery_schedule_date = $request->input('delivery_date');
        $order->delivery_slot_id = $request->input('delivery_slot');
        if (!$order->save()) {
            $response = [
                'status' => false,
                'message' => 'Sorry Something Went Wrong Please Try Again',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        }

        $order_details =  new OrderDetail();
        $order_details->order_id = $order->id;
        $order_details->product_id = $product->id;
        $order_details->quantity = $quantity;
        $order_details->subscribed_quantity = $quantity;
        $order_details->type = 2; //1 = normal, 2 = subscription
        $order_details->mrp = $product->mrp;
        $order_details->price = $product->price;
        $order_details->subscribed_amount = ($product->price * $quantity);
        $order_details->coin_used = 0;
        $order_details->coin_generated = 0;
        if($order_details->save()){
            $order->total_mrp = $product->mrp*$quantity;
            $order->total_sale_price = $product->price*$quantity;
            $order->total_subscribed_amount = $product->price*$quantity;
            $order->payment_status = 3;
            $order->save();

            $this->userSubscriptionOrderDeduct($subscription->id,$request->user()->id,$quantity);
            $response = [
                'status' => true,
                'message' => 'Order Placed Successfully',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'Sorry Something Went Wrong Please Try Again',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        }
    }

    private function userSubscriptionOrderDeduct($subscription_id,$user_id,$quantity){
        $subscription = UserSubscription::find($subscription_id);
        if ($subscription) {
            $subscription->order_consumed = $subscription->order_consumed+$quantity;
            $subscription->save();
            if ($subscription->total_order == $subscription->order_consumed) {
                $subscription->status = 3;
                $subscription->save();
            }
            return true;
        }else{
            return false;
        }
    }

    private function userCoinFetch($user_id){
        $user_coin = UserCoin::where('user_id',$user_id)->first();
        return $user_coin;
    }

    private function userCoinDebit(UserCoin $user_coin,$debit_coin){
        $user_coin->total_coins = $user_coin->total_coins-$debit_coin;
        $user_coin->save();
        $this->userCoinDetailsInsert($user_coin,1,$debit_coin,"Coin Used For Purchase");
        return true;
    }

    private function userCoinCredit(UserCoin $user_coin,$debit_coin){
        $user_coin->total_coins = $user_coin->total_coins+$debit_coin;
        $user_coin->save();
        $this->userCoinDetailsInsert($user_coin,2,$debit_coin,"Coin Added from purchase");
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

    public function paymentPayNow(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'order_id' => 'required|numeric|exists:orders,id', 
        ]);
        if ($validation->fails()) {
            $response = [
                'status' => false,
                'message' => 'Validation Error',
                'error_code' => true,
                'error_message' => $validation->errors(),
            ];
            return response()->json($response, 200);
        }
        $order = Order::find($request->input('order_id'));
        $api = new Api(config('services.razorpay.id'), config('services.razorpay.key'));
            $orders = $api->order->create(array(
                'receipt' => $order->id,
                'amount' => (($order->total_sale_price+$order->shipping_charge) - ($order->coins_used+$order->coupon_discount))*100,
                'currency' => 'INR',
                'payment_capture' => 0,
                )
            );
            $order->payment_request_id = $orders['id'];
            $order->save();           

            $payment_data = [
                'key_id' => config('services.razorpay.id'),
                'amount' =>(($order->total_sale_price+$order->shipping_charge) - ($order->coins_used+$order->coupon_discount))*100,
                'order_id' => $orders['id'],
                'name' => $order->user->name ?? null,
                'email' => $order->user->email ?? null,
                'mobile' => $order->user->mobile ?? null,
            ];

            $response = [
                'status' => true,
                'message' => 'Order Placed Successfully',
                'error_code' => false,
                'error_message' => null,
                'data' => [
                    'id' => $order->id,
                    'payment' => true,
                    'amount' => ($order->total_sale_price+$order->shipping_charge)-($order->coins_used+$order->coupon_discount),
                    'payment_data' => $payment_data,
                ]
            ];
            return response()->json($response, 200);
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
        $order = Order::find($request->input('order_id'));
        $capture = $this->paymentCapture($request->input('razorpay_payment_id'),$order->id);
        if ($verify && $capture){
           
            $order->payment_id =  $request->input('razorpay_payment_id');
            $order->payment_status = 3;
            $order->payment_type = 1;
            $order->save(); 
            $message = "Thanks for choosing Pyaas. Your order placed successfully and You will be updated once the order is out for delivery.";
            if ($order->user->mobile) {
                try {
                    SmsService::send($order->user->mobile,$message,1207162696518944389) ;              
                }catch(Exception $e){
                    //DO Nothing
                }
            }
            $response = [
                'status' => true,
                'message' => 'Payment Success',
            ];
            return response()->json($response, 200);
        }else{
            $order = Order::find($request->input('order_id'));
            $order->payment_status = 2;
            $order->save();           
            $response = [
                'status' => false,
                'message' => 'Payment Failed',
            ];
            return response()->json($response, 200);
        }
    }


    private function paymentCapture($payment_id,$order_id)
    {
        try {
            $api = new Api(config('services.razorpay.id'), config('services.razorpay.key'));
            $order = Order::find($order_id);
            $amount = (($order->total_sale_price+$order->shipping_charge)-($order->coins_used+$order->coupon_discount))*100;
            $payment = $api->payment->fetch($payment_id);
            $payment->capture(array('amount' => $amount, 'currency' => "INR"));
            $success = true;
        }catch(\Exception $e){
            $success = false;
        }
        return $success;
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

    public function couponApply(Request $request,$couponCode)
    {
        $coupon = Coupon::where('coupon',$couponCode)->where('status',1)->first();
        if(!$coupon){
            $response = [
                'status' => false,
                'message' => 'Coupon Is Invalid',
            ];
            return response()->json($response, 200);
        }
        $user_id = $request->user()->id;
        $discount = CouponService::calculateDiscount($user_id,$coupon->id);

        $response = [
            'status' => true,
            'message' => 'Coupon Applied Successfully',
            'coupon_type' => $coupon->coupon_type,
            'discount' => $discount,
        ];
        return response()->json($response, 200);

    }

    public function couponFetch(Request $request)
    {
        $user_id = $request->user()->id;
        $coupons = CouponService::fetchCoupons($user_id);

        $response = [
            'status' => true,
            'message' => 'Coupon List',
            'coupons' => $coupons,
        ];
        return response()->json($response, 200);

    }

}
