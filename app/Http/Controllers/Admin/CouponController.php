<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\Size;
use App\Services\ImageService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function couponList(){
        $coupons = Coupon::orderBy('id','desc')->get();
        return view('admin.coupon.coupon_list',compact('coupons'));
    }
    public function couponView($id){
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.coupon_view',compact('coupon'));
    }

    public function addCoupon(){
        $brands = Brand::where('status',1)->orderBy('name')->get(['id','name']);
        $sizes = Size::where('status',1)->orderBy('name')->get(['id','name']);
        return view('admin.coupon.coupon_add_form',compact('brands','sizes'));
    }

    public function couponEdit($coupon_id)
    {
        $brands = Brand::where('status',1)->orderBy('name')->get(['id','name']);
        $sizes = Size::where('status',1)->orderBy('name')->get(['id','name']);
        $coupon = Coupon::where('id',$coupon_id)->first();
        return view('admin.coupon.coupon_add_form',compact('coupon','brands','sizes'));
    }

    public function couponInsertForm(Request $request)
    {
        $this->validate($request, [
            'brand_id'   => 'required|numeric',
            'size_id'   => 'required|numeric',
            'expiry_date'   => 'required|date|date_format:Y-m-d',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_type'   => 'required|in:1,2,3',
            'coupon_type'   => 'required|in:P,S',
            'coupon'   => 'required|string|unique:coupons,coupon',
            'discount'   => 'required|numeric',
            'max_discount'   => 'required|numeric',
            'description'   => 'required|string',
        ]);

        $this->couponSave(new Coupon(),$request);
        return redirect()->back()->with('message','Coupon Added Successfully');

    }

    private function couponSave($coupon,$request)
    {
        $coupon->brand_id = $request->input('brand_id');
        $coupon->size_id = $request->input('size_id');
        $coupon->expire_date = $request->input('expiry_date');
        $coupon->user_type = $request->input('user_type');
        $coupon->coupon_type = $request->input('coupon_type');
        $coupon->coupon = $request->input('coupon');
        $coupon->discount = $request->input('discount');
        $coupon->max_discount = $request->input('max_discount');
        $coupon->description = $request->input('description');
        
        if ($coupon->save() && $request->hasFile('image')) {
            $image = $request->file('image');
            $coupon->image = ImageService::save($image);
            $coupon->save();
        }
        return true;
    }

    public function couponUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'brand_id'   => 'required|numeric',
            'size_id'   => 'required|numeric',
            'expiry_date'   => 'required|date|date_format:Y-m-d',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_type'   => 'required|in:1,2,3',
            'coupon_type'   => 'required|in:P,S',
            'coupon'   => 'required|string|unique:coupons,coupon,'.$id,
            'discount'   => 'required|numeric',
            'max_discount'   => 'required|numeric',
            'description'   => 'required|string',
        ]);

        $coupon = Coupon::findOrFail($id);
        $this->couponSave($coupon,$request);
        return redirect()->back()->with('message','Coupon Updated Successfully');
    }

    public function couponStatus(Coupon $coupon){
       
        $coupon->status = $coupon->status == 1 ? 2 : 1 ;
        $coupon->save();
        return redirect()->back();
    }

}
