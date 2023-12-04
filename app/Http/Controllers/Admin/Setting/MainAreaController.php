<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\MainArea;
use Illuminate\Http\Request;

class MainAreaController extends Controller
{
    public function addForm(Request $request,$area_id = null)
    {
        if (!empty($area_id)) {
            $location = MainArea::findOrFail($area_id);
            return view('admin.setting.location.main_area.form',compact('location'));
        }

        return view('admin.setting.location.main_area.form');     
    }

    public function areaAdd(Request $request)
    {
        $this->Validate($request,[
            'area_id' => 'nullable|numeric',
            'name' => 'string|required',
        ]);
        $area_id = $request->input('area_id');
        if (!empty($area_id)) {
            $area = MainArea::findOrFail($area_id);
            $this->areaSave($area,$request);
            return back()->with('message','Area updated successfully');
        }

        $this->areaSave(new MainArea(),$request);
        return back()->with('message','Area Added successfully');
        
    }

    private function areaSave($area,$request)
    {
        // is_update 1 = no,2=yes
        $area->name = $request->input('name');
        $area->save();
        return true;
    }

    public function list()
    {
        $locations = MainArea::orderBy('created_at')->get();
        return view('admin.setting.location.main_area.list',compact('locations'));
    }

    public function areaStatus($area_id)
    {
        $area = MainArea::findOrFail($area_id);
        $area->status = $area->status == 1 ? 2 : 1 ;
        $area->save();
        return back();
    }
}
