<?php

namespace App\Http\Controllers\Admin\Refund;

use App\Http\Controllers\Controller;
use App\Models\RefundInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminRefundController extends Controller
{
    public function list(Request $request)
    {
        $refunds = RefundInfo::latest()->paginate(50);
        return view('admin.refunds.list',compact('refunds'));
    }

    public function refundStatus($refund_id,$status)
    {
        $refunds = RefundInfo::findOrFail($refund_id);
        $refunds->status = $status;
        $refunds->refund_process_date = Carbon::today();
        $refunds->save();

        $order = Order::findOrFail($refunds->order_id);
        $order->is_refund = 2;
        $order->save();
        return back();
    }
}
