<?php

namespace App\Http\Controllers\Admin\Invoice;

use App\Http\Controllers\Controller;
use App\Http\Resources\Cart\CartResource;
use App\Http\Resources\Product\ProductListResource;
use App\Models\Address;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\MainArea;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Size;
use App\Models\User;
use App\Models\UserCoin;
use App\Models\UserCoinHistory;
use App\Services\CouponService;
use App\Services\Generate;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderInvoiceController extends Controller
{
    public function form()
    {
        $main_location = MainArea::where('status',1)->get();
        return view('admin.order_invoice.customer_info',compact('main_location'));
    }

    public function getCustomer($mobile)
    {
        $user = User::with(['addresses','addresses.mainLocation','addresses.subLocation'])->where('mobile',$mobile)->first();
        return $user;        
    }

    public function customerRegister(Request $request)
    {
        $this->Validate($request,[
            'mobile' => "required|numeric|digits:10|unique:users,mobile",
            'name' => 'required|string',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->mobile = $request->input('mobile');
        $user->registered_through = 3;
        if($user->save()){
            $user_coin = new UserCoin();
            $user_coin->user_id = $user->id;
            $user_coin->save();
            $user = User::with(['addresses','addresses.mainLocation','addresses.subLocation'])->where('id',$user->id)->first();
            return $user;        
        }else{
            return null;
        }
    }

    public function AddressAdd(Request $request)
    {
        $this->Validate($request,[
            'customer_id'=>'required|numeric',
            'name'=>'required|string',
            'mobile'=>'required|numeric|digits:10',   
            'main_location_id'=>'required|integer',         
            'sub_location_id'=>'required|integer',
            'flat_no' =>'nullable',
            'address_one' =>'required',
            'landmark'=>'nullable|string',
        ]);
        $address = new Address();
        $address->flat_no = $request->input('flat_no');
        $address->user_id = $request->input('customer_id');
        $address->main_location_id = $request->input('main_location_id');
        $address->sub_location_id = $request->input('sub_location_id');
        $address->address_one = $request->input('address_one');
        $address->landmark = $request->input('landmark');
        $address->name =  $request->input('name');
        $address->mobile =  $request->input('mobile');
        $address->pin =  $request->input('pin');
        if($address->save()){
            $address = Address::with(['mainLocation','subLocation'])->where('id',$address->id)->first();
            return $address;
        }else{
            return null;
        }
    }

    public function invoiceCustomerProceed(Request $request) 
    {
        $this->validate($request, [
            'customer_id' => 'required|numeric',
            'address_id' => 'required|numeric',
        ]);
        $customer_id = $request->input('customer_id');
        $address_id = $request->input('address_id');
        $brands = Brand::where('status',1)->get();
        $sizes = Size::where('status',1)->get();

        $carts = Cart::where('user_id', $customer_id)->get();
        $user_coins = UserCoin::where('user_id', $customer_id)->select('total_coins')->first();

        $total_mrp = 0;
        $total_amount = 0;
        $user_coin = $user_coins->total_coins;
        $coin_used = 0;
        $coin_usable = 0;
        $shipping_charge = 0;
        foreach ($carts as $key => $cart) {
            $total_mrp += ($cart->product->mrp ?? 0) * $cart->quantity;
            $total_amount += ($cart->product->price ?? 0)  * $cart->quantity;
            $shipping_charge += ($cart->product->shipping_charge ?? 0)  * $cart->quantity;
            // Log::debug("Mrp of id $cart->product_id");
            // Log::debug($cart->product->mrp);
            // Log::debug("Price of id $cart->product_id");
            // Log::debug($cart->product->price);
            if ($cart->is_jar == 1) {
                $total_mrp += ($cart->product->jar_mrp ?? 0) * $cart->quantity;
                $total_amount += ($cart->product->jar_price ?? 0)  * $cart->quantity;
            }    
            $coin_usable +=  ($cart->product->coin_use ?? 0)  * $cart->quantity;
        }

        if (($user_coin > 0) && ($coin_usable > 0)) {
            if ($user_coin >= $coin_usable) {
                $coin_used =  $coin_usable;
            }else{
                $coin_used =  $user_coin;
            }
        }

        $cart_total = [
            'total_mrp' => $total_mrp,
            'total_amount' => $total_amount,
            'coins' => $coin_used,
            'payable_amount' => $total_amount - $coin_used,
            'coin_can_use' => $coin_usable,
            'shipping_charge' => $shipping_charge,
        ];
        $coupons = CouponService::fetchCoupons($customer_id);
        $data = [
            'cart' => $carts,
        ];
        return view('admin.order_invoice.order_form',compact('brands','sizes','customer_id','address_id','data','coupons','cart_total'));
    }

    public function getProduct($brand_id)
    {
        $products = ProductSize::where('product_sizes.status',1)
        ->leftJoin('products','products.id','=','product_sizes.product_id')
        ->where('products.status',1)
        ->where('products.brand_id',$brand_id)
        ->select('product_sizes.*')->get();

        return ProductListResource::collection($products);
    }

    public function cardItemRemove($cartId)
    {
        Cart::where('id',$cartId)->delete();
        return back();
    }

    public function cardItemAdd(Request $request)
    {        
        $this->Validate($request,[
            'user_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
            'is_jar' => 'nullable|numeric|in:1,2'
        ]);
        

        $product_id = $request->input('product_id');
        $is_jar = $request->input('is_jar');

        $product = ProductSize::find($product_id);
        if (!$product) {
           return back()->with('error', 'Sorry Product not found');
        }

        if ($is_jar == 1 && $product->jar_available_status != 1) {
            return back()->with('error', 'Sorry Product Jar Not found');
        }

        $check_cart = Cart::where('product_id',$product_id)->where('user_id',$request->input('user_id'))->count();
        if ($check_cart == 0) {
            $this->cartSave(new Cart(),$request,$product->id);
        }
        return back();
    }

    private function cartSave($cart,Request $request,$product_id){
        $cart->product_id = $product_id;
        $cart->user_id = $request->input('user_id');
        $cart->quantity = $request->input('quantity');
        $cart->is_jar = !empty($request->input('is_jar')) ? $request->input('is_jar') : 2;
        $cart->save();
        return true;
    }

    public function couponApply($user_id,$coupon_id)
    {
        $discount = CouponService::calculateDiscount($user_id,$coupon_id);
        return $discount;

    }

    public function invoiceOrderPlace(Request $request)
    {
        $this->Validate($request, [
            'user_id' => 'required|numeric',
            'address_id' => 'required|numeric',
            'delivery_date' => 'required|date|date_format:Y-m-d',
            'delivery_slot' => 'required|numeric|exists:delivery_slots,id',
            'coupon_id' => 'nullable|string|exists:coupons,id',
        ]);
        $user_id = $request->input('user_id');
        $user_coin = $this->userCoinFetch($user_id);
        if (!$user_coin) {
            return back('error_order','Sorry User Coins Does Not Exist');
        }

        $coupon = null;
        if (!empty($request->input('coupon_id'))) {
            $coupon = Coupon::where('id',$request->input('coupon_id'))->where('status',1)->first();
            if ($coupon->user_type == 1) {
                $is_new_user = Order::where('user_id',$user_id)->where('status','!=',5)->count();
                if ($is_new_user > 0) {
                    return back('error_order','Sorry Coupon Is Invalid');
                }
            }
        }


        $cart = Cart::where('user_id', $user_id);
        if ($cart->count() == 0) {
            return back('error_order','Sorry Cart Is Empty');
        }

        $order = new Order();
        $order->user_id = $user_id;
        $order->address_id = $request->input('address_id');
        $order->payment_type = 2;
        $order->delivery_schedule_date = $request->input('delivery_date');
        $order->delivery_slot_id = $request->input('delivery_slot');
        $order->order_type = 2;
        if (!$order->save()) {
            return back('error_order','Sorry Something Went Wrong Please Try Again');
        }
       
        $carts = $cart->get();

        $total_user_coin = $user_coin->total_coins;
        $total_mrp = 0;
        $total_price = 0;
        $coins_generate = 0;
        $shipping_charge = 0;
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
            $shipping_charge +=  ($cart->product->shipping_charge ?? 0)  * $cart->quantity;
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
        $order->coin_earned = $coins_generate;
        $order->shipping_charge = $shipping_charge;
        if (!empty($request->input('coupon_id')) && !empty($coupon)) {
            $order->coupon_discount  = CouponService::calculateDiscount($user_id,$coupon->id);
        }
        $order->order_id = Generate::orderId($order->id,1);
        $order->save();

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
        
        return redirect()->route('admin.order.view',['order_id'=>$order->id]);
    }


    private function userCoinDebit(UserCoin $user_coin,$debit_coin){
        $user_coin->total_coins = $user_coin->total_coins-$debit_coin;
        $user_coin->save();
        $this->userCoinDetailsInsert($user_coin,1,$debit_coin,"Coin Used For Purchase");
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

    private function userCoinFetch($user_id){
        $user_coin = UserCoin::where('user_id',$user_id)->first();
        return $user_coin;
    }
}
