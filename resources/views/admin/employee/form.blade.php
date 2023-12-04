
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Add New Employee</h2>                   
                    <div class="clearfix"></div>
                </div>

                 <div>
                    @if (Session::has('message'))
                        <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                </div>

                <div>
                    <div class="x_content">
                        {{Form::open(['method' => 'post','route'=>['admin.employee.form.submit']])}}
                        <div class="form-group">
                            {{ Form::label('name', 'Employee Name')}} 
                            {{ Form::text('name',old('name'),array('class' => 'form-control','placeholder'=>'Employee Name')) }}
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', 'Email Id')}} 
                            {{ Form::email('email',old('email'),array('class' => 'form-control','placeholder'=>'Enter Email Id')) }}
                            @if($errors->has('email'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            {{ Form::label('user_type', 'User Type')}} 
                           <select name="user_type" id="user_type" class="form-control">
                                <option value="">Select User Type</option>
                                <option value="2">Office Executive</option>
                                <option value="3">Marketing Executive</option>
                            </select>
                            @if($errors->has('user_type'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('user_type') }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            {{ Form::label('password', 'Password')}} 
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            @if($errors->has('password'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            
                            <a href="{{route('admin.employee.list')}}" class="btn btn-warning">Back</a>
                            
                        </div>
                        {{ Form::close() }}
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="clearfix"></div>
</div>
@endsection

@section('script')

<script src="{{ asset('admin/ckeditor4/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace( 'description', {
        height: 100,
    });
</script>
@endsection