<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\BulkOrder;
use App\Models\Order;
use Hash;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\RefundInfo;
use App\Models\Size;
use App\Models\SubscriptionDetail;
use App\Models\User;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function dashboardView()
    {
       $data = new Collection();
       $data->total_user = User::count();
       $data->total_sizes = Size::count();
       $data->products = ProductSize::count();
       $data->newOrders = Order::where('status',1)->count();
       $data->refund_request =  RefundInfo::where('status',1)->count();
       $data->bulkOrders =  BulkOrder::where('status',1)->count();
       $recentOrders = Order::with('user')->orderBy('created_at','desc')->limit(10)->get();
       $bulk_orders = BulkOrder::latest()->limit(10)->get();
        return view('admin.dashboard',compact('data','recentOrders','bulk_orders'));
    }

    public function changePasswordForm()
    {
        return view('admin.change_password');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'same:confirm_password'],
        ]);

        $user = Admin::where('id',1)->first();
        
        if(Hash::check($request->input('current_password'), $user->password)){  
            Admin::where('id',1)->update([
            'password'=>Hash::make($request->input('new_password')),
            ]);
            return redirect()->back()->with('message','Password Changed Successfully');
        }else{
            return redirect()->back()->with('error','Sorry Current Password Does Not Correct');
        }
    }
}
