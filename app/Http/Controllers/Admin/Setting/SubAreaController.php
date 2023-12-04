<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\MainArea;
use App\Models\SubArea;
use Illuminate\Http\Request;

class SubAreaController extends Controller
{
    public function addForm(Request $request,$area_id = null)
    {
        $main_location = MainArea::orderBy('name')->get();
        if (!empty($area_id)) {
            $location = SubArea::findOrFail($area_id);
            return view('admin.setting.location.sub_area.form',compact('location','main_location'));
        }

        return view('admin.setting.location.sub_area.form',compact('main_location'));     
    }

    public function areaAdd(Request $request)
    {
        $this->Validate($request,[
            'area_id' => 'nullable|numeric',
            'main_area_id' => 'required|numeric',
            'name' => 'string|required',
        ]);
        $area_id = $request->input('area_id');
        if (!empty($area_id)) {
            $area = SubArea::findOrFail($area_id);
            $this->areaSave($area,$request);
            return back()->with('message','Area updated successfully');
        }

        $this->areaSave(new SubArea(),$request);
        return back()->with('message','Area Added successfully');
        
    }

    private function areaSave($area,$request)
    {
        // is_update 1 = no,2=yes
        $area->name = $request->input('name');
        $area->main_area_id = $request->input('main_area_id');
        $area->save();
        return true;
    }

    public function list()
    {
        $locations = SubArea::orderBy('created_at')->get();
        return view('admin.setting.location.sub_area.list',compact('locations'));
    }

    public function areaStatus($area_id)
    {
        $area = SubArea::findOrFail($area_id);
        $area->status = $area->status == 1 ? 2 : 1 ;
        $area->save();
        return back();
    }

    public function getSubLocation($main_location_id)
    {
        $area = SubArea::where('main_area_id',$main_location_id)->where('status',1)->get();
        return $area;
    }
}
