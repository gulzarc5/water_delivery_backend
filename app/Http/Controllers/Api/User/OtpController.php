<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\SignupOtp;
use App\Models\User;
use App\Services\SmsService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'mobile' => 'required|numeric|digits:10',
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
        
        $random = rand(11111, 99999);
        // $random = 11111;

        $user = User::where('mobile', $mobile);
        
        if ($user->count() > 0) {
            $user = $user->first();
            $user->otp = $random;
            $user->save();
           
        }else{
            $signup_otp = SignupOtp::firstOrNew([
                'mobile' => $mobile,
            ]);
            $signup_otp->otp = $random;
            $signup_otp->save();   
        }
        $message = "Your OTP is $random , Please do not share this OTP to any one.
        Thank you,
        TEAM PYAAS";
        try {
            SmsService::send($mobile,$message,1207162646623265433);         
        } catch (Exception $e) {
            //throw $th;
        }

        $response = [
            'status' => true,
            'message' => 'Otp Sent Successfully',
            'error_code' => false,
            'error_message' => null,
        ];
        return response()->json($response, 200);
    }

    public function otpVerify(Request $request)
    {
        $validation = Validator::make($request->all(),[ 
            'mobile' => 'required|numeric|digits:10',
            'otp'=>'required|numeric|digits:5'
        ]);

        if ($validation->fails()) {
            $response = [
                'status' => false,
                'message' => 'Validation Errors',
                'error_code' => true,
                'error_message' => $validation->errors(),
                'registration' => false,
                'data' => null,
            ];
            return response()->json($response, 200);
        }
        $mobile = $request->input('mobile');
        $otp = $request->input('otp');

        $user = User::where('mobile', $mobile)->where('status',1);
        if($user->count() > 0){
            $user = $user->first();
            if($user->otp == $otp){
                $user->api_token = Str::random(60);
                $user->save();
                
                $response = [
                    'status' => true,
                    'message' => 'Otp Verified Successfully',
                    'error_code' => false,
                    'error_message' => null,
                    'registration' => false,
                    'data' => $user,
                ];
                return response()->json($response, 200);
            }
        }else{
            $signup_otp = SignupOtp::where('mobile',$mobile)->where('otp',$otp);
            if($signup_otp->count()>0){
                $response = [
                    'status' => true,
                    'message' => 'Otp Verified Successfully',
                    'error_code' => false,
                    'error_message' => null,
                    'registration' => true,
                    'data' => $signup_otp->first(),
                ];
                return response()->json($response, 200);
            }
        }
        $response = [
            'status' => false,
            'message' => 'Otp Is Invalid',
            'error_code' => false,
            'error_message' => null,
            'login'=>null,
            'data' => null,
        ];
        return response()->json($response, 200);

    }

    public function userCheck($mobile)
    {
        $count = User::where('mobile', $mobile)->count();
        if ($count > 0) {
            $response = [
                'status' => false,
                'message' => 'Sorry User Already Registered With Us',
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => true,
                'registration' => "This User Name is available",
            ];
            return response()->json($response, 200);
        }
    }
}
