<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserAddressResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Validation\Rule;
class UserAddressController extends Controller
{
    public function userAddressList(Request $request)
    {
        $addresses=Address::where('user_id',$request->user()->id)->orderBy('created_at', 'desc')->get();
    
        $response = [
            'status' => true,
            'message' => 'User Address List',
            'data' =>  UserAddressResource::collection($addresses),
        ];
        return response()->json($response, 200);

    }

    public function userAddress($address_id)
    {
        $address = Address::find($address_id);
        if($address){
            $response = [
                'status' => true,
                'message' => 'User Address',
                'data' =>  new UserAddressResource($address),
            ];
            return response()->json($response, 200);
        }
        $response = [
            'status' => false,
            'message' => 'No Address Found',
            'data' =>  null,
        ];
        return response()->json($response, 200);
    }
    public function userAddressSubmit(Request $request,$address_id=null)
    {
        $validation = Validator::make($request->all(),[ 
            'name'=>'required|string',
            'mobile'=>'required|numeric|digits:10',   
            'main_location_id'=>'required|numeric|exists:main_areas,id',         
            'sub_location_id'=>'required|numeric|exists:sub_areas,id',         
            'flat_no' => 'required',
            'house_no' =>'nullable',
            'address_one' =>'required',
            'address_two' =>'nullable',
            'landmark'=>'required|string',
            'lat' =>'nullable|numeric',
            'long'=>'nullable|numeric',
            'address_status'=>'required|numeric|in:1,2,3',
            'pin' => 'required|numeric|digits:6'
        ]);

        if ($validation->fails()) {
            $response = [
                'status' => false,
                'message' => 'Validation Errors',
                'data' => null,
                'error_code' => true,
                'error_message' => $validation->errors(),

            ];
            return response()->json($response, 200);
        }
        $address = new Address();
        $this->addressSave($address,$request);
        $response = [
            'status' => true,
            'message' => 'Address Added successfully',
            'data' => new UserAddressResource($address),
            'error_code' => false,
            'error_message' => null,

        ];
        return response()->json($response, 200);
        
    }

    public function userAddressUpdate(Request $request,$id)
    {
        $validation = Validator::make($request->all(),[ 
            'name'=>'required|string',
            'mobile'=>'required|numeric|digits:10',           
            'main_location_id'=>'required|numeric|exists:main_areas,id',         
            'sub_location_id'=>'required|numeric|exists:sub_areas,id',   
            'flat_no' => 'required',
            'house_no' =>'nullable',
            'address_one' =>'required',
            'address_two' =>'nullable',
            'landmark'=>'required|string',
            'lat' =>'nullable|numeric',
            'long'=>'nullable|numeric',
            'address_status'=>'required|numeric|in:1,2,3',
            'pin' => 'required|numeric|digits:6'
        ]);

        if ($validation->fails()) {
            $response = [
                'status' => false,
                'message' => 'Validation Errors',
                'error_code' => true,
                'error_message' => $validation->errors(),

            ];
            return response()->json($response, 200);
        }
        $address = Address::find($id);
        if ($address) {
            $this->addressSave($address,$request);
            $response = [
                'status' => true,
                'message' => 'Address Updated Successfully',
                'error_code' => false,
                'error_message' => null,

            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong Please Try Again',
                'error_code' => false,
                'error_message' => null,

            ];
            return response()->json($response, 200);
        }
        
    }

    private function addressSave($address,$request){
        //is_update 1=No,2=Yes
        $address->flat_no = $request->get('flat_no');
        $address->user_id = $request->user()->id;
        $address->main_location_id = $request->get('main_location_id');
        $address->sub_location_id = $request->get('sub_location_id');
        $address->address_one = $request->get('address_one');
        $address->house_no = $request->get('house_no');
        $address->address_two = $request->get('address_two');
        $address->landmark = $request->get('landmark');
        $address->lat = $request->get('lat');
        $address->long = $request->get('long');
        $address->name =  $request->get('name');
        $address->mobile =  $request->get('mobile');
        $address->address_status =  $request->get('address_status');
        $address->pin =  $request->get('pin');
        $address->save();
        
        return true;
    }

    public function userAddressDelete($address_id)
    {
        Address::where('id',$address_id)->delete();
        $response = [
            'status' => true,
            'message' => 'Address Deleted Successfully',
        ];
        return response()->json($response, 200);
    }


}
