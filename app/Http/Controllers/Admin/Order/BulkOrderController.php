<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\BulkOrder;
use Illuminate\Http\Request;

class BulkOrderController extends Controller
{
    public function list(Request $request)
    {
        $bulk_orders = BulkOrder::latest()->paginate(50);
        return view('admin.order.bulk.order_list',compact('bulk_orders'));
    }

    public function status($id,$status)
    {
        $bulk_orders = BulkOrder::findOrFail($id);
        $bulk_orders->status = $status;
        $bulk_orders->save();
        return back();
    }
}
