<?php

namespace App\Http\Controllers\Api\Cart;

use App\Http\Controllers\Controller;
use App\Http\Resources\Cart\CartResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\ProductSize;
use App\Models\UserCoin;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Validator;

class CartController extends Controller
{
    public function add(Request $request)
    {        
        $validation = Validator::make($request->all(),[
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
            'is_jar' => 'nullable|numeric|in:1,2'
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

        $product_id = $request->input('product_id');
        $is_jar = $request->input('is_jar');

        $product = ProductSize::find($product_id);
        if (!$product) {
            $response = [
                'status' => false,
                'message' => 'Sorry Product Does Not Exist',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        }

        if ($is_jar == 1 && $product->jar_available_status != 1) {
            $response = [
                'status' => false,
                'message' => 'Sorry Product Does Not Have Extra JAR',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        }

        $check_cart = Cart::where('product_id',$product_id)->where('user_id',$request->user()->id)->count();
        if ($check_cart == 0) {
            $this->cartSave(new Cart(),$request,$product->id);
        }

        $response = [
            'status' => true,
            'message' => 'Product Added To Cart',
            'error_code' => false,
            'error_message' => null,
        ];
        return response()->json($response, 200);
    }

    public function cartUpdate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'cart_id' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
            'is_jar' => 'nullable|numeric|in:1,2'
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

       

        $cart = Cart::find($request->input('cart_id'));
        if (!$cart) {
            $response = [
                'status' => false,
                'message' => 'Sorry Cart Id Is Invalid',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        }

        $product = ProductSize::find($cart->product_id);
        if (!$product) {
            $response = [
                'status' => false,
                'message' => 'Sorry Product Does Not Exist',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        }

        if ($request->input('is_jar') == 1 && $product->jar_available_status != 1) {
            $response = [
                'status' => false,
                'message' => 'Sorry Product Does Not Have Extra JAR',
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200);
        }

        $this->cartSave($cart,$request,$cart->product_id);

        $response = [
            'status' => true,
            'message' => 'Cart Updated Successfully',
            'error_code' => false,
            'error_message' => null,
        ];
        return response()->json($response, 200);
    }

    private function cartSave($cart,Request $request,$product_id){
        $cart->product_id = $product_id;
        $cart->user_id = $request->user()->id;
        $cart->quantity = $request->input('quantity');
        $cart->is_jar = !empty($request->input('is_jar')) ? $request->input('is_jar') : 2;
        $cart->save();
        return true;
    }

    public function cartDelete($cart_id)
    {
        Cart::where('id', $cart_id)->delete();
        $response = [
            'status' => true,
            'message' => 'Item Removed From Cart',
        ];
        return response()->json($response, 200);
    }

    public function list(Request $request)
    {
        $carts = Cart::where('user_id', $request->user()->id)->get();
        $user_coins = UserCoin::where('user_id', $request->user()->id)->select('total_coins')->first();

        $total_mrp = 0;
        $total_shipping_charge = 0;
        $total_amount = 0;
        $user_coin = $user_coins->total_coins;
        $coin_used = 0;
        $coin_usable = 0;
        foreach ($carts as $key => $cart) {
            $total_mrp += ($cart->product->mrp ?? 0) * $cart->quantity;
            $total_amount += ($cart->product->price ?? 0)  * $cart->quantity;
           
            if ($cart->is_jar == 1) {
                $total_mrp += ($cart->product->jar_mrp ?? 0) * $cart->quantity;
                $total_amount += ($cart->product->jar_price ?? 0)  * $cart->quantity;
            }    
            $coin_usable +=  ($cart->product->coin_use ?? 0)  * $cart->quantity;
            $total_shipping_charge +=  ($cart->product->shipping_charge ?? 0)  * $cart->quantity;
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
            'shipping_charge' => $total_shipping_charge,
            'payable_amount' => ($total_amount - $coin_used)+$total_shipping_charge,
            'coin_can_use' => $coin_usable,
        ];

        $response = [
            'status' => true,
            'message' => 'Cart Item List',
            'data' => [
                'cart' => CartResource::collection($carts),
                'cart_total' => $cart_total,
            ]
        ];
        return response()->json($response, 200);
    }

    public function cartReOrder($order_id)
    {
        $order = Order::findOrFail($order_id);
        if ($order) {
            Cart::where('user_id', $order->user_id)->delete();
            foreach ($order->detail as $key => $detail) {
                $cart = new Cart();
                $cart->product_id = $detail->productSize->id;
                $cart->user_id = $order->user_id;
                $cart->quantity = $detail->quantity;
                $cart->save();
            }
            $response = [
                'status' => true,
                'message' => "Product Added To Cart",
            ];
            return response()->json($response, 200);
        }
        $response = [
            'status' => false,
            'message' => "Sorry We Can't Process Your Request",
        ];
        return response()->json($response, 200);
    }
}
