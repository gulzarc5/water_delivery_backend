<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Services\ImageService;
use Illuminate\Http\Request;

class SliderController extends Controller
{
   public function sliderForm()
   {
       return view('admin.setting.slider.form');
   }

   public function sliderSave(Request $request)
   {
        $this->validate($request,[
            'image' =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:600',
            'caption'=>'required|string'
        ]);

        $slider = new Slider();
        $slider->caption = $request->input('caption');
        if($request->hasfile('image')){
            $slider->image = ImageService::save($request->file('image'));
        }
        $slider->save();
        return redirect()->back()->with('message','Slider Added Successfully');
    }

    public function list()
    {
        $sliders = Slider::latest()->get();
        return view('admin.setting.slider.list',compact('sliders'));
    }

    public function sliderStatus($slider_id)
    {
        $slider = Slider::findOrFail($slider_id);
        $slider->status = $slider->status == 1 ? 2 : 1 ;
        $slider->save();
        return back();
    }

    public function deleteSlider($slider_id)
    {
        $slider = Slider::findOrFail($slider_id);
        if(!empty($slider->image)){
            $status = ImageService::delete($slider->image);
            if($status == true){
                $slider->delete();
            }
        }
        return back();
    }
}
