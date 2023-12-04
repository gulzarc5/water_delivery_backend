<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\InvoiceSetting;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

use DataTables;

class UserSubscriptionController extends Controller
{
    public function paidList(Request $request)
    {
        return view('admin.user.subscription.paid_list');
    }

    public function paidListAjax(Request $request)
    {
        $model = UserSubscription::with('user')->where('payment_status',3);

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->addColumn('action',function ($row){
                $btn = '<a href="'.route('admin.user.subscription.details',['subscription_id'=>$row->id]).'" class="btn btn-warning btn-xs">View</a>';
                return $btn;
                
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function unPaidList(Request $request)
    {
        return view('admin.user.subscription.un_paid_list');
    }

    public function unPaidListAjax(Request $request)
    {
        $model = UserSubscription::with('user')->where('payment_status','!=',3);

        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->toJson();
    }

    public function subscriptionDetails($subscription_id)
    {
        $invoice_setting = InvoiceSetting::findOrFail(1);
        $subscription = UserSubscription::findOrFail($subscription_id);
        return view('admin.user.subscription.details',compact('invoice_setting','subscription'));
    }
}
