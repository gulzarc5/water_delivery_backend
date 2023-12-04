
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Update User</h2>
                   
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
                        {{Form::model($user, ['method' => 'post','route'=>['admin.user.update_user'],'enctype'=>'multipart/form-data'])}}
                        <input type="hidden" name="user_id" value="{{$user->id}}" class="">
                        <div class="form-group">
                            {{ Form::label('name', 'User Name')}} 
                            {{ Form::text('name',!empty($user->name)?$user->name:old('name'),array('class' => 'form-control')) }}
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            {{ Form::label('mobile', 'Mobile No')}} 
                            {{ Form::number('mobile',!empty($user->mobile)?$user->mobile:old('mobile'),array('class' => 'form-control')) }}
                            @if($errors->has('mobile'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            {{ Form::label('gender', 'Gender')}} 
                           <select name="gender" id="gender" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="M" {{$user->gender =='M'?'selected':''}}>Male</option>
                                <option value="F" {{$user->gender =='F'?'selected':''}}>Female</option>
                            </select>
                            @if($errors->has('gender'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        
                       


                       

                        <div class="form-group">
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            
                            <a href="{{route('admin.user.list')}}" class="btn btn-warning">Back</a>
                            
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