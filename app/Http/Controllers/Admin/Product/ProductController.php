<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list()
    {
        $products = Product::orderBy('created_at')->get();
        return view('admin.product.list',compact('products'));
    }

    public function productFrom(Request $request,$product_id = null)
    {
        $brands = Brand::where('status',1)->orderBy('name','asc')->get();
        if (!empty($product_id)) {
            $product = Product::findOrFail($product_id);
            return view('admin.product.form',compact('product','brands'));
        }

        return view('admin.product.form',compact('brands'));     
    }

    public function fromSubmit(Request $request)
    {
        $this->Validate($request,[
            'product_id' => 'nullable|numeric',
            'name' => 'required|string',
            'brand_id' => 'required|numeric',
            'image' => 'array|required_without:product_id',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'short_description' => 'nullable|string',
            'description' => 'nullable'
        ]);
        $product_id = $request->input('product_id');
        if (!empty($product_id)) {
            $product_check = Product::where('brand_id', $request->input('brand_id'))->where('id','!=',$product_id)->count();
            if ($product_check > 0) {
                return back()->with('error','Product Already Exist');
            }
            $product = Product::findOrFail($product_id);
            $this->productSave($product,$request,2);
            return back()->with('message','data updated successfully');
        }
        $product_check = Product::where('brand_id', $request->input('brand_id'))->count();
        if ($product_check > 0) {
            return back()->with('error','Product Already Exist');
        }
        $this->productSave(new Product(),$request,1);
        return back()->with('message','data Added successfully');
        
    }

    private function productSave($product,$request,$is_update)
    {
        // dd($request->file('image'));
        // is_update 1 = no,2=yes
        $product->name = $request->input('name');
        $product->brand_id = $request->input('brand_id');
        $product->short_description = $request->input('short_description');
        $product->long_description = $request->input('description');
        if($product->save() && $request->hasfile('image'))
        {
            if ($is_update == 1) {
                for ($i=0; $i < count($request->file('image')); $i++) {
                    $image = $request->file('image')[$i];
                    $product_image = new ProductImage();
                    $product_image->product_id = $product->id;
                    $product_image->image = ImageService::save($image);
                    
                    if ($product_image->save() && $i==1) {
                        $product->image = $product_image->image;
                        $product->save();
                    }
                }
            }
        }
        return true;
    }


    public function productStatus($product_id)
    {
        $product = Product::findOrFail($product_id);
        $product->status = $product->status == 1 ? 2 : 1 ;
        $product->save();
        return back();
    }

    public function productView(Product $product)
    {
        return view('admin.product.details_view',compact('product'));
    }

    public function imagesView(Product $product)
    {
        return view('admin.product.images.image',compact('product'));
    }

    public function imagesAdd(Request $request)
    {
        $this->Validate($request,[
            'product_id' => 'required|numeric',
            'image' => 'array|required',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($request->input('product_id'));
        if($request->hasfile('image'))
        {
            for ($i=0; $i < count($request->file('image')); $i++) {
                $image = $request->file('image')[$i];
                $product_image = new ProductImage();
                $product_image->product_id = $product->id;
                $product_image->image = ImageService::save($image);
                $product_image->save();

               
                if (empty($product->image)) {
                    $product->image = $product_image->image;
                    $product->save();
                }
            }
        }
        return back()->with('message','Image Added Successfully');
    }

    public function makeCover(Product $product, ProductImage $image)
    {
        $product->image = $image->image;
        $product->save();
        return back();
    }

    public function deleteImage(ProductImage $image)
    {
        if (!empty($image->image)) {
            ImageService::delete($image->image);
            $image->delete();
        }
        return back();
    }
}
