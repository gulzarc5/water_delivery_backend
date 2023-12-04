
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    @if(isset($size) && !empty($size))
                        <h2>Update Size</h2>
                    @else
                        <h2>Add New Size</h2>
                    @endif
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
                        @if(isset($size) && !empty($size))
                            {{Form::model($size, ['method' => 'post','route'=>['admin.setting.size_submit'],'enctype'=>'multipart/form-data'])}}
                            <input type="hidden" name="size_id" value="{{$size->id}}" class="">
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.setting.size_submit','enctype'=>'multipart/form-data']) }}
                        @endif

                        <div class="form-group">
                            {{ Form::label('name', 'Size Name')}} 
                            {{ Form::text('name',null,array('class' => 'form-control','placeholder'=>'Enter Size name')) }}
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            @if(isset($size) && !empty($size))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            @else
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                            @endif
                            <a href="{{route('admin.setting.size_list')}}" class="btn btn-warning">Back</a>
                            
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


@endsection