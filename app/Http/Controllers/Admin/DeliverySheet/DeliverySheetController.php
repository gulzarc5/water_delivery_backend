<?php

namespace App\Http\Controllers\Admin\DeliverySheet;

use App\Exports\DeliverySheet;
use App\Http\Controllers\Controller;
use App\Models\MainArea;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DeliverySheetController extends Controller
{
    public function form()
    {
        $main_location = MainArea::where('status',1)->get();
        return view('admin.delivery_sheet.search_orders',compact('main_location'));
    }

    public function formSubmit(Request $request)
    {
        $this->Validate($request,[
            'delivery_schedule_date' => 'required|date|date_format:Y-m-d',
            'delivery_slot' => 'required|in:1,2,A',
            'main_location' => 'nullable|numeric',
            'sub_location' => 'nullable|numeric',
        ]);

        $delivery_schedule_date = $request->input('delivery_schedule_date');
        $delivery_slot = $request->input('delivery_slot');
        $main_location = $request->input('main_location');
        $sub_location = $request->input('sub_location');
        $orders = Order::where('orders.delivery_schedule_date', $delivery_schedule_date)->where('orders.status',2)
        ->where(function($q){
            $q->where(function($s){
                $s->where('orders.payment_type', 1)
                ->where('orders.payment_status',3);
            })->orWhere('orders.payment_type',2)
            ->orWhere('orders.payment_type',3);
        });

        if (($delivery_slot == 1) || ($delivery_slot == 2)) {
            $orders->where('orders.delivery_slot_id',$delivery_slot);
        }

        if($main_location){
            $orders->leftjoin('addresses','addresses.id','orders.address_id')
            ->where('addresses.main_location_id',$main_location);
            if ($sub_location) {
                $orders->where('addresses.sub_location_id',$sub_location);               
            }
        }

        $orders = $orders->get();

        foreach ($orders as $order) {
            foreach ($order->detail as $item){
                // dd($item->productSize->jar_available_status);
            }
        }

        return view('admin.delivery_sheet.sheet_order_list',compact('orders'));
    }

    public function excelExport(Request $request)
    {
        $this->Validate($request,[
            'delivery_schedule_date' => 'required|date|date_format:Y-m-d',
            'delivery_slot' => 'required|in:1,2,A',
            'main_location' => 'nullable|numeric',
            'sub_location' => 'nullable|numeric',
        ]);
        $name = "DeliverySheet_".Carbon::today()->toDateString().".xlsx";
        return Excel::download(new DeliverySheet($request), $name);
    }
    public function receiptPrintAll(Request $request)
    {
        $this->Validate($request,[
            'delivery_schedule_date' => 'required|date|date_format:Y-m-d',
            'delivery_slot' => 'required|in:1,2,A',
            'main_location' => 'nullable|numeric',
            'sub_location' => 'nullable|numeric',
        ]);
        $delivery_schedule_date = $request->input('delivery_schedule_date');
        $delivery_slot = $request->input('delivery_slot');
        $main_location = $request->input('main_location');
        $sub_location = $request->input('sub_location');
        $orders = Order::where('orders.delivery_schedule_date', $delivery_schedule_date)->where('orders.status',2)
        ->where(function($q){
            $q->where(function($s){
                $s->where('orders.payment_type', 1)
                ->where('orders.payment_status',3);
            })->orWhere('orders.payment_type',2)
            ->orWhere('orders.payment_type',3);
        });

        if (($delivery_slot == 1) || ($delivery_slot == 2)) {
            $orders->where('orders.delivery_slot_id',$delivery_slot);
        }

        if($main_location){
            $orders->leftjoin('addresses','addresses.id','orders.address_id')
            ->where('addresses.main_location_id',$main_location);
            if ($sub_location) {
                $orders->where('addresses.sub_location_id',$sub_location);               
            }
        }

        $orders = $orders->get();
        $date = Carbon::now()->timezone('Asia/Kolkata')->format('F j, Y g:i:s A');
        return view('admin.order.print',compact('orders','date'));
    }
}
