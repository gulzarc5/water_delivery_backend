<?php

namespace App\Http\Controllers\Api\Plan;

use App\Http\Controllers\Controller;
use App\Http\Resources\Plan\SubscriptionPlanDetailsResource;
use App\Http\Resources\Plan\SubscriptionPlanResource;
use App\Models\SubscriptionDetail;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Validator;

class SubscriptionController extends Controller
{
    public function masterList()
    {
        $subscription_masters = SubscriptionPlan::where('status', 1)->get(['name','image','duration','type']);
        $response = [
            'status' => true,
            'message' => 'Subscription Master List',
            'data' => $subscription_masters,
        ];
        return response()->json($response, 200);
    }

    public function planList(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'master_id' => 'nullable|numeric',
        ]);

        if ($validation->fails()) {
            $response = [
                'status' => false,
                'message' => 'Validation Error',
                'error_code' => true,
                'error_message' => $validation->errors(),
                'data' => [],
            ];
            return response()->json($response, 200);
        }
        $master_id = $request->input('master_id');
        $plan_list = SubscriptionDetail::where('status', 1);
        if (!empty($master_id)) {
            $plan_list->where('plan_id', $master_id);
        }
        $plan_list = $plan_list->get();
        $response = [
            'status' => true,
            'message' => 'Subscription Plan List',
            'error_code' => true,
            'error_message' => null,
            'data' => SubscriptionPlanResource::collection($plan_list),
        ];
        return response()->json($response, 200);
    }

    public function planDetails($plan_list_id)
    {
        $plan = SubscriptionDetail::find($plan_list_id);
// return $plan;
        $response = [
            'status' => true,
            'message' => 'Plan Details',
            'data' => SubscriptionPlanDetailsResource::make($plan),
        ];
        return response()->json($response, 200);
    }
}
