<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use DataTables;

class EmployeeController extends Controller
{
    public function list(Request $request)
    {
        return view('admin.employee.list');
    }

    public function listAjax(Request $request)
    {
        $model = Admin::where('user_type',"!=",1)->orderBy('created_at');
        return DataTables::eloquent($model)
        ->addIndexColumn()
        ->addColumn('action',function($row){
            $btn ='';
            if ($row->status == 1) {
                $btn .= '<a href="'.route('admin.emloyee.status',['employee_id'=>$row->id]).'" class="btn btn-danger btn-xs">Disable</a>';
            } else {
                $btn .= '<a href="'.route('admin.emloyee.status',['employee_id'=>$row->id]).'" class="btn btn-success btn-xs">Enable</a>';
            }
            return $btn;            
        })
        ->rawColumns(['action'])
        ->toJson();
    }

    public function addEmployeeForm()
    {
        return view('admin.employee.form');
    }

    public function formSubmit(Request $request)
    {
        $this->Validate($request,[
            'name' => 'required|string|max:200',
            'email' => 'required|email|max:200',
            'password' => 'required|string|min:8',
            'user_type' => 'required|numeric|in:2,3',
        ]);

        $employee = new Admin();
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->password = bcrypt($request->input('password'));
        $employee->user_type = $request->input('user_type');
        $employee->save();
        return back()->with('message','Employee Added Successfully');
    }

    public function employeeStatus($employee_id)
    {
        $employee = Admin::findOrFail($employee_id);
        $employee->status = $employee->status == 1 ? 2 : 1 ;
        $employee->save();
        return back();
    }
}
