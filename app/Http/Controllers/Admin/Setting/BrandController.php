<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Services\ImageService;
use Illuminate\Http\Request;


class BrandController extends Controller
{
    public function brandForm(Request $request,$brand_id = null)
    {
        if (!empty($brand_id)) {
            $brand = Brand::findOrFail($brand_id);
            return view('admin.setting.brand.form',compact('brand'));
        }

        return view('admin.setting.brand.form');     
    }

    public function brandSubmit(Request $request)
    {
        $this->Validate($request,[
            'brand_id' => 'nullable|numeric',
            'name' => 'string|required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable'
        ]);
        $brand_id = $request->input('brand_id');
        if (!empty($brand_id)) {
            $brand = Brand::findOrFail($brand_id);
            $this->brandSave($brand,$request,2);
            return back()->with('message','data updated successfully');
        }

        $this->brandSave(new Brand(),$request,1);
        return back()->with('message','data Added successfully');
        
    }

    private function brandSave($brand,$request,$is_update)
    {
        // is_update 1 = no,2=yes
        $brand->name = $request->input('name');
        $brand->description = $request->input('description');
        if($request->hasfile('image'))
        {
            if ($is_update == 2) {
                ImageService::delete($brand->image);
            }
            $brand->image = ImageService::save($request->file('image'));
        }
        $brand->save();
        return true;
    }

    public function list()
    {
        $brands = Brand::orderBy('created_at')->get();
        return view('admin.setting.brand.list',compact('brands'));
    }

    public function brandStatus($brand_id)
    {
        $brand = Brand::findOrFail($brand_id);
        $brand->status = $brand->status == 1 ? 2 : 1 ;
        $brand->save();
        return back();
    }
}
