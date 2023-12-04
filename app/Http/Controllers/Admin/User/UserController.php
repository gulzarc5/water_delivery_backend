<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SignupOtp;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use App\Exports\SignupOtpExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

use DataTables;

class UserController extends Controller
{
    public function list(Request $request)
    {
        return view('admin.user.list');
    }

    public function listAjax(Request $request)
    {
        $model = User::latest();
        return DataTables::eloquent($model)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            $btn ='';
            $btn .= '<a href="'.route('admin.user.edit_user_form',['user_id'=>$row->id]).'" class="btn btn-warning btn-xs">Edit</a>';
            $btn .= '<a href="'.route('admin.user.details',['user_id'=>$row->id]).'" class="btn btn-warning btn-xs">Details</a>';
            if ($row->status == 1) {
                $btn .= '<a href="'.route('admin.user.status',['user_id'=>$row->id]).'" class="btn btn-danger btn-xs">Disable</a>';
            } else {
                $btn .= '<a href="'.route('admin.user.status',['user_id'=>$row->id]).'" class="btn btn-success btn-xs">Enable</a>';
            }
            return $btn;
            
        })
        ->rawColumns(['action'])
        ->toJson();
    }

    public function unregisteredList(Request $request)
    {
        return view('admin.user.unregistered_list');
    }

    public function unregisteredListAjax(Request $request)
    {
        $model = SignupOtp::latest();
        return DataTables::eloquent($model)
        ->addIndexColumn()
        ->addColumn('created_date',function($row){

            return $row->created_at ? $row->created_at->toDateString() : null;
            
        }) ->rawColumns(['created_date'])
        ->toJson();
    }

    public function unregisteredListExport()
    {
        return Excel::download(new SignupOtpExport, 'unregistered_'.Carbon::now()->toDateString().'.xlsx');
    }


    public function editUserForm($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('admin.user.form',compact('user'));
    }

    public function updateUser(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'mobile'=>'required|numeric|digits:10|unique:users,mobile,'.$request->input('user_id'),
            'gender'=>'required|in:M,F',
        ]);

        $user = User::findOrFail($request->input('user_id'));
        $user->name = $request->input('name');
        $user->gender = $request->input('gender');
        $user->mobile = $request->input('mobile');
        if($user->save()){
            return redirect()->back()->with('message','User Details Updated Successfully');
        }
    }

    public function viewUserDetails($user_id)
    {
        $user_details = User::findOrFail($user_id);
        $subscriptions = UserSubscription::latest()->get();
        return view('admin.user.details',compact('user_details','subscriptions'));
    }

    public function userStatus($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->status = $user->status == 1 ? 2 : 1 ;
        $user->save();
        return back();
    }


}
