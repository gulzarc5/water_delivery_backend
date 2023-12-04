<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Size;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    public function sizeFrom(Request $request,$product_id,$size_id = null)
    {
        $product = Product::findOrFail($product_id);
        $sizes = Size::where('status',1)->orderBy('name','asc')->get();
        if (!empty($size_id)) {
            $product_size = ProductSize::findOrFail($size_id);
            return view('admin.product.size.form',compact('product_size','sizes','product'));
        }

        return view('admin.product.size.form',compact('sizes','product'));     
    }

    public function fromSubmit(Request $request)
    {
        $this->Validate($request,[
            'product_size_id' => 'nullable|numeric',
            'product_id' => 'required|numeric',
            'size_id' => 'required|numeric',
            'mrp' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:1',
            'product_discount' => 'required|numeric|min:0',
            'coin_use' => 'required|numeric|min:0',
            'coin_generate' => 'required|numeric|min:0',
            'shipping_charge' => 'required|numeric|min:0',
            'is_jar_available' => 'required|numeric|in:1,2',
            'jar_mrp' => 'required_if:is_jar_available,1',
            'jar_price' => 'required_if:is_jar_available,1',
            'jar_discount' => 'required_if:is_jar_available,1',
            'image' => 'required_without:product_size_id|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $product_id = $request->input('product_id');
        $product_size_id = $request->input('product_size_id');
        if (!empty($product_size_id)) {
            $product_size_chaeck = ProductSize::where('product_id',$product_id)->where('size_id',$request->input('size_id'))->where('id','!=',$request->input('product_size_id'))->count();
            if ($product_size_chaeck > 0) {
                return back()->with('error','Product Size Already Exist');
            }
            $product = ProductSize::findOrFail($product_size_id);
            $this->productSizeSave($product,$request,2);
            return back()->with('message','data updated successfully');
        }
        $product_size_chaeck = ProductSize::where('product_id',$product_id)->where('size_id',$request->input('size_id'))->count();
        if ($product_size_chaeck > 0) {
            return back()->with('error','Product Size Already Exist');
        }
        $this->productSizeSave(new ProductSize(),$request,1);
        return back()->with('message','data Added successfully');
        
    }

    private function productSizeSave($product_size,$request,$isUpdate)
    {
        
        // is_update 1 = no,2=yes
        $product_size->size_id = $request->input('size_id');
        $product_size->product_id = $request->input('product_id');
        $product_size->mrp = $request->input('mrp');
        $product_size->price = $request->input('price');
        $product_size->product_discount = $request->input('product_discount');
        $product_size->coin_use = $request->input('coin_use');
        $product_size->coin_generate = $request->input('coin_generate');
        $product_size->jar_available_status = $request->input('is_jar_available');
        $product_size->shipping_charge = $request->input('shipping_charge');
        if ($request->input('is_jar_available') == 1) {
            $product_size->jar_mrp = $request->input('jar_mrp');
            $product_size->jar_price = $request->input('jar_price');
            $product_size->jar_discount = $request->input('jar_discount');
        } else {
            $product_size->jar_mrp = 0;
            $product_size->jar_price = 0;
            $product_size->jar_discount = 0;
        }
        if ($request->hasFile('image')) {
            if ($isUpdate == 2) {
                ImageService::delete($product_size->image);
            }
            $product_size->image = ImageService::save($request->file('image'));
        }        
        $product_size->save();
        return true;
    }

    public function sizeStatus(ProductSize $size)
    {
        $size->status = $size->status == 1 ? 2 : 1 ;
        $size->save();
        return back();
    }

    public function list()
    {
        $product_sizes = ProductSize::orderBy('created_at')->get();
        return view('admin.product.size.list',compact('product_sizes'));
    }
}
