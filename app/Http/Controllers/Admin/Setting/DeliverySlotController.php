<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\DeliverySlot;
use Illuminate\Http\Request;

class DeliverySlotController extends Controller
{
    public function slotForm(Request $request,$slot_id = null)
    {
        if (!empty($slot_id)) {
            $slot = DeliverySlot::findOrFail($slot_id);
            return view('admin.setting.delivery_slot.form',compact('slot'));
        }

        return view('admin.setting.delivery_slot.form');     
    }

    public function slotSubmit(Request $request)
    {
        $this->Validate($request,[
            'slot_id' => 'nullable|numeric',
            'name' => 'string|required',
            'description' => 'nullable|string',
        ]);
        $slot_id = $request->input('slot_id');
        if (!empty($slot_id)) {
            $slot = DeliverySlot::findOrFail($slot_id);
            $this->slotSave($slot,$request);
            return back()->with('message','data updated successfully');
        }

        $this->slotSave(new DeliverySlot(),$request);
        return back()->with('message','data Added successfully');
        
    }

    private function slotSave($slot,$request)
    {
        // is_update 1 = no,2=yes
        $slot->name = $request->input('name');
        $slot->description = $request->input('description');
        $slot->save();
        return true;
    }

    public function list()
    {
        $slots = DeliverySlot::orderBy('created_at')->get();
        return view('admin.setting.delivery_slot.list',compact('slots'));
    }

    public function slotStatus($slot_id)
    {
        $size = DeliverySlot::findOrFail($slot_id);
        $size->status = $size->status == 1 ? 2 : 1 ;
        $size->save();
        return back();
    }
}
