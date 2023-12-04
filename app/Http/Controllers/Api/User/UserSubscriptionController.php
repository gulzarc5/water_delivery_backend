<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriptionOrder\SubscriptionOrderResource;
use App\Http\Resources\User\UserSubscriptionListResource;
use App\Models\RefundInfo;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

class UserSubscriptionController extends Controller
{
    public function list(Request $request)
    {
        $subscriptions = UserSubscription::where('user_id',$request->user()->id)->latest()->paginate(10);
        // return $subscriptions;

        $response = [
            'status' => true,
            'message' => 'User Subscription List',
            'current_page' => $subscriptions->currentPage(),
            'total_pages' => $subscriptions->lastPage(),
            'has_more_pages' => $subscriptions->hasMorePages(),
            'total_data' => $subscriptions->total(),
            'data' => SubscriptionOrderResource::collection($subscriptions),
        ];
        return response()->json($response, 200);
    }

    public function cancel($id)
    {
        $subscription = UserSubscription::find($id);
        if ($subscription && ($subscription->is_cancellable == '1')) {
            $subscription->status = 4;
            $subscription->is_cancellable = 2;
            if ($subscription->payment_status == 3) {
                $subscription->is_refund = 1;
                $refund_info = new RefundInfo();
                $refund_info->user_id = $subscription->user_id;
                $refund_info->order_id = $subscription->id;
                $refund_info->type = 2;
                $refund_info->amount = $subscription->total_amount;
                $refund_info->save();
            }
        }
        $subscription->save();
        
        $response = [
            'status' => true,
            'message' => 'Your Subscription Cancelled',
        ];
        return response()->json($response, 200);
    }

    public function detail($subscription_id)
    {
        $detail = UserSubscription::with('subscriptionDates')->find($subscription_id);
        $response = [
            'status' => true,
            'message' => 'User Subscription List',
            'data' => SubscriptionOrderResource::make($detail)
        ];
        return response()->json($response, 200);
    }
}
