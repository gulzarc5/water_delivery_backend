<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Services\ImageService;

class SizeController extends Controller
{
    public function sizeForm(Request $request,$size_id = null)
    {
        if (!empty($size_id)) {
            $size = Size::findOrFail($size_id);
            return view('admin.setting.size.form',compact('size'));
        }

        return view('admin.setting.size.form');     
    }

    public function sizeSubmit(Request $request)
    {
        $this->Validate($request,[
            'size_id' => 'nullable|numeric',
            'name' => 'string|required',
        ]);
        $size_id = $request->input('size_id');
        if (!empty($size_id)) {
            $size = Size::findOrFail($size_id);
            $this->sizeSave($size,$request,2);
            return back()->with('message','data updated successfully');
        }

        $this->sizeSave(new Size(),$request,1);
        return back()->with('message','data Added successfully');
        
    }

    private function sizeSave($size,$request,$is_update)
    {
        // is_update 1 = no,2=yes
        $size->name = $request->input('name');
        $size->save();
        return true;
    }

    public function list()
    {
        $sizes = Size::orderBy('created_at')->get();
        return view('admin.setting.size.list',compact('sizes'));
    }

    public function sizeStatus($size_id)
    {
        $size = Size::findOrFail($size_id);
        $size->status = $size->status == 1 ? 2 : 1 ;
        $size->save();
        return back();
    }
}
