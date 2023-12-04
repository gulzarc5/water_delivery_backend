<?php

namespace App\Http\Controllers\Api\Order\Bulk;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BulkOrder;
use App\Models\Size;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Validator;

class BulkOrderController extends Controller
{
    public function settingDataFetch()
    {
        $brands =  Brand::where('status',1)->latest()->get(['id','name']);
        $sizes =  Size::where('status',1)->latest()->get(['id','name']);

        $response = [
            'status' => true,
            'message' => 'Bulk Order Fetch',
            'data' =>[
                'brands'=>$brands,
                'sizes'=> $sizes,
            ],
        ]; 
        return response()->json($response, 200);
    }

    public function BulkOrderPlace(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required|string|max:200', //1 = online, 2= cod, 3 = subscription
            'mobile' => 'required|numeric|digits:10',
            'brand_id' => 'required|numeric|exists:brands,id',
            'size_id' => 'required|numeric|exists:sizes,id',
            'quantity' => 'required|numeric|min:1',
            'address' => 'nullable|string|max:250',
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

        $bulk_order = new BulkOrder();
        $bulk_order->name = $request->input('name');
        $bulk_order->mobile = $request->input('mobile');
        $bulk_order->brand_id = $request->input('brand_id');
        $bulk_order->size_id = $request->input('size_id');
        $bulk_order->quantity = $request->input('quantity');
        $bulk_order->address = $request->input('address');
        $bulk_order->save();

        $message = "Hi there!
Thanks for your order with us! This is an automatic sms just to let you know We’ve got your query. We’ll get you an answer back shortly.
Thanks for choosing PYAAS";
        if ($bulk_order->mobile) {
            try {
                SmsService::send($bulk_order->mobile,$message,1207163804189929690) ;              
            }catch(Exception $e){
                return $e;
            }            
        }
        $response = [
            'status' => true,
            'message' => 'Your Order Placed Successfully and We wil get back to you soon',
            'error_code' => false,
            'error_message' => null,
        ];
        return response()->json($response, 200);
    }
    
}
