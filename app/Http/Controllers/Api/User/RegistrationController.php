<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\SignupOtp;
use App\Models\User;
use App\Models\UserCoin;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Validator;
use Str;
class RegistrationController extends Controller
{
    public function registrationDetailUpdate(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'mobile' => 'required|numeric|digits:10|unique:users,mobile',
            'otp' =>'required|numeric|digits:5',
            'name' =>'required|string',
            'gender' =>'required|in:M,F',
            'lat'=>'nullable|numeric',
            'long' =>'nullable|numeric'
        ]);

        if ($validation->fails()) {
            $response = [
                'status' => false,
                'message' => 'Validation Errors',
                'error_code' => true,
                'error_message' => $validation->errors(),
                'login'=>false,
                'data' => null,
            ];
            return response()->json($response, 200);
        }
        $mobile = $request->input('mobile');
        $otp = $request->input('otp');
        $gender = $request->input('gender');
        $name = $request->input('name');
        $lat = $request->input('lat');
        $long = $request->input('long');

        $signup = SignupOtp::where('mobile', $mobile)->where('otp',$otp);

        if($signup->count() > 0  ){
            $user=new User();
            $user->mobile = $mobile;
            $user->otp = $otp;
            $user->gender = $gender;
            $user->name = $name;
            $user->api_token = Str::random(60);
            $user->lat = $lat;
            $user->long = $long;
            $user->save();

            $user_coin = new UserCoin();
            $user_coin->user_id = $user->id;
            $user_coin->save();
            $response = [
                'status' => true,
                'message' => 'Registration Detail Updated Successfully',
                'error_code' => false,
                'error_message' => null,
                'login'=>true,
                'data' => $user,
            ];
            return response()->json($response, 200);
        }

        $response = [
            'status' => false,
            'message' => 'You Have Entered Incorrect Details',
            'error_code' => false,
            'error_message' => null,
            'login'=>false,
            'data' => null,
        ];
        return response()->json($response, 200);
    }

    public function marketingUserRegister(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'mobile' => 'required|numeric|digits:10|unique:users,mobile',
            'name' =>'required|string',
            'gender' =>'required|in:M,F',
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
        $mobile = $request->input('mobile');
        $gender = $request->input('gender');
        $name = $request->input('name');


        $user=new User();
        $user->mobile = $mobile;
        $user->gender = $gender;
        $user->name = $name;
        $user->registered_through = 2;
        $user->save();

        $user_coin = new UserCoin();
        $user_coin->user_id = $user->id;
        $user_coin->save();

        $message = "Congratulations!  Kindly click https://rb.gy/j4tqmt to register & avail the coupon code for free shipping for amazing discounts!
Thank you
Team PYAAS";
        try {
            SmsService::send($mobile,$message,1207163908180173996);         
        } catch (Exception $e) {
            //throw $th;
        }
        $response = [
            'status' => true,
            'message' => 'Registration Successfull',
            'error_code' => false,
            'error_message' => null,
        ];
        return response()->json($response, 200);

    }

   
}
