
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    @if(isset($master) && !empty($master))
                        <h2>Update Subscription Master</h2>
                    @else
                        <h2>Add New Subscription Master</h2>
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
                        @if(isset($master) && !empty($master))
                            {{Form::model($master, ['method' => 'post','route'=>['admin.setting.plan_master_submit'],'enctype'=>'multipart/form-data'])}}
                            <input type="hidden" name="master_id" value="{{$master->id}}" class="">
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.setting.plan_master_submit','enctype'=>'multipart/form-data']) }}
                        @endif

                        <div class="form-group">
                            {{ Form::label('name', 'Plan Name')}} 
                            {{ Form::text('name',null,array('class' => 'form-control','placeholder'=>'Enter Plan name')) }}
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type">Select Type</label>
                            <select class="form-control" name="type" id="type">
                                <option value="">Select Type</option>
                                <option value="1" {{isset($master) && $master->type == 1 ? ' selected' : ''}}>By Duration</option>
                                <option value="2" {{isset($master) && $master->type == 2 ? ' selected' : ''}}>By Refil</option>
                            </select>
                            @if($errors->has('type'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @enderror
                        </div>  

                        <div class="form-group" id="duration_div" {{isset($master) && empty($master->duration) ? 'style=display:none' : ''}}>
                            {{ Form::label('duration', 'Duration In Days')}} 
                            {{ Form::number('duration',null,array('class' => 'form-control','id' => 'duration','placeholder'=>'Enter Duration In Days')) }}
                            @if($errors->has('duration'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('duration') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            {{ Form::label('image', 'Image')}} 
                            {{ Form::file('image',null,array('class' => 'form-control')) }}
                            @if($errors->has('image'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group" >
                            <label for="description">Descriptions</label>
                            <textarea name="description" id="description" class="form-control">{{isset($master) && !empty($master) ? $master->description : ''}}</textarea>
                            @if($errors->has('description'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            @if(isset($category) && !empty($category))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            @else
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                            @endif
                            <a href="{{route('admin.setting.plan_master_list')}}" class="btn btn-warning">Back</a>
                            
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

    $(document).ready(function() {
        $('#type').change(function(){
            // alert('hi');
            if ($(this).val() == 2) {
                $("#duration_div").hide();
            }else{
                $("#duration_div").show();
            }
        })
    });
</script>
@endsection