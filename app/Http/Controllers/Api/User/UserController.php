<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserProfileResource;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
class UserController extends Controller
{
    public function userProfileFetch(Request $request)
    {
        $profile = User::find($request->user()->id);
        if($profile){
            $response = [
                'status' => true,
                'message' => 'User Profile',
                'data' => new UserProfileResource($profile),
            ];
            return response()->json($response, 200);
        }
        $response = [
            'status' => false,
            'message' => 'No User Profile Found',
            'data' => null,
        ];
        return response()->json($response, 200);

    }

    public function userProfileUpdate(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'gender' =>'required|in:M,F',
            'name'=>'required|string',
            'email' =>'nullable|email',
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

        $user = User::find($request->user()->id);
        if($user){
            $user->gender = $request->input('gender');
            $user->name = $request->input('name');
            $user->email = $request->input('email');     
            if($user->save()){
                $response = [
                    'status' => true,
                    'message' => 'User Profile Updated Successfully',
                    'data' => null,
                ];
                return response()->json($response, 200);
            }     
        }
        $response = [
            'status' => false,
            'message' => 'No User Profile Found',
            'data' => null,
        ];
        return response()->json($response, 200);
    }
}
