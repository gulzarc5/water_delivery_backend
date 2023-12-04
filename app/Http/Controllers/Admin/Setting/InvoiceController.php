<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\InvoiceSetting;
use Illuminate\Http\Request;
use File;
use Image;

class InvoiceController extends Controller
{
    public function invoiceForm()
    {
        $invoice = InvoiceSetting::find(1);
        return view('admin.invoice.invoice',compact('invoice'));
    }

    public function invoiceUpdate(Request $request)
    {
        $this->validate($request, [
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'note1' => 'required',
            'note2' => 'required',
            'note3' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $invoice = InvoiceSetting::find(1);
        $invoice->address = $request->input('address');
        $invoice->phone = $request->input('phone');
        $invoice->gst = $request->input('gst');
        $invoice->email = $request->input('email');
        $invoice->note1 = $request->input('note1');
        $invoice->note2 = $request->input('note2');
        $invoice->note3 = $request->input('note3');

        if($request->hasfile('image'))
        {

        	$image = $request->file('image');
            $destination = public_path().'/images/';
            $image_extension = $image->getClientOriginalExtension();
            $image_name = md5(date('now').time())."-".uniqid()."."."$image_extension";
            $original_path = $destination.$image_name;
            Image::make($image)->save($original_path);

            $prev_img_delete_path = public_path().'/images/'.$invoice->image;
            if ( File::exists($prev_img_delete_path)) {
                File::delete($prev_img_delete_path);
            }

            $invoice->image = $image_name;
        }

        $invoice->save();
        return redirect()->back()->with('message','invoice Data Updated Successfully');
    }
}
