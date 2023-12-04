<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Size;
use App\Models\SubscriptionDetail;
use App\Models\SubscriptionPlan;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function masterForm(Request $request,$master_id = null)
    {
        if (!empty($master_id)) {
            $master = SubscriptionPlan::findOrFail($master_id);
            return view('admin.setting.subscription_master.form',compact('master'));
        }

        return view('admin.setting.subscription_master.form');     
    }

    public function masterSubmit(Request $request)
    {
        $this->Validate($request,[
            'master_id' => 'nullable|numeric',
            'name' => 'string|required',
            'type' => 'required|in:1,2',
            'duration' => 'required_if:type,1',
            'description' => 'nullable',
            'image'=>'required_without:master_id|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $master_id = $request->input('master_id');
        if (!empty($master_id)) {
            $master = SubscriptionPlan::findOrFail($master_id);
            $this->masterSave($master,$request,2);
            return back()->with('message','data updated successfully');
        }

        $this->masterSave(new SubscriptionPlan(),$request,1);
        return back()->with('message','data Added successfully');
        
    }

    private function masterSave($master,$request,$is_update)
    {
        // is_update 1 = no,2=yes
        $master->name = $request->input('name');
        $master->type = $request->input('type');
        $master->duration = $request->input('duration');
        $master->description = $request->input('description');
        if($request->hasfile('image'))
        {
            if ($is_update == 2) {
                ImageService::delete($master->image);
            }
            $master->image = ImageService::save($request->file('image'));
        }
        $master->save();
        return true;
    }

    public function list()
    {
        $masters = SubscriptionPlan::orderBy('created_at')->get();
        return view('admin.setting.subscription_master.list',compact('masters'));
    }

    public function masterStatus($master_id)
    {
        $master = SubscriptionPlan::findOrFail($master_id);
        $master->status = $master->status == 1 ? 2 : 1 ;
        $master->save();
        return back();
    }



    public function planList()
    {
        $plans = SubscriptionDetail::orderBy('brand_id')->get();
        return view('admin.setting.subscription_master.plans.list',compact('plans'));
    }

    public function planForm(Request $request,$plan_id = null)
    {
        $masters = SubscriptionPlan::where('status',1)->orderBy('name')->get();
        $brands = Brand::where('status',1)->orderBy('name')->get();
        $sizes = Size::where('status',1)->orderBy('name')->get();
        if (!empty($plan_id)) {
            $plan = SubscriptionDetail::findOrFail($plan_id);
            $sizes = null;
            if (!empty($plan->brand_id)) {
                $sizes = Size::where('status',1)->get();
            }
            return view('admin.setting.subscription_master.plans.form',compact('plan','masters','brands','sizes'));
        }

        return view('admin.setting.subscription_master.plans.form',compact('masters','brands','sizes'));     
    }

    public function planSubmit(Request $request)
    {
        $this->Validate($request,[
            'plan_details_id' => 'nullable|numeric',
            'plan_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'size_id' => 'required|numeric',
            'mrp' => 'required|numeric',
            'price' => 'required|numeric',
            'jar_mrp' => 'required|numeric',
            'jar_price' => 'required|numeric',
        ]);
       
        $plan_details_id = $request->input('plan_details_id');
        if (!empty($plan_details_id)) {
            $check = SubscriptionDetail::where('plan_id',$request->input('plan_id'))
            ->where('brand_id',$request->input('brand_id'))
            ->where('size_id',$request->input('size_id'))
            ->where('id','!=',$request->input('plan_details_id'))
            ->count();
            if ($check == 0) {
                $plan = SubscriptionDetail::findOrFail($plan_details_id);
                $this->planSave($plan,$request);
                return back()->with('message','data updated successfully');
            }
                return back()->with('error','Sorry This Plan Alresy Exist');
        }
        $check = SubscriptionDetail::where('plan_id',$request->input('plan_id'))
        ->where('brand_id',$request->input('brand_id'))
        ->where('size_id',$request->input('size_id'))
        ->count();
        if ($check == 0) {
            $this->planSave(new SubscriptionDetail(),$request);
            return back()->with('message','data Added successfully');
        }
        return back()->with('error','Sorry This Plan Alredy Exist');
    }

    private function planSave($plan,$request)
    {
        // is_update 1 = no,2=yes
        $plan->plan_id = $request->input('plan_id');
        $plan->brand_id = $request->input('brand_id');
        $plan->size_id = $request->input('size_id');
        $plan->mrp = $request->input('mrp');        
        $plan->price = $request->input('price');        
        $plan->jar_mrp = $request->input('jar_mrp');        
        $plan->jar_price = $request->input('jar_price');        
        $plan->save();
        return true;
    }

    public function planStatus($plan_id)
    {
        $master = SubscriptionDetail::findOrFail($plan_id);
        $master->status = $master->status == 1 ? 2 : 1 ;
        $master->save();
        return back();
    }

}
