
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    @if(isset($slot) && !empty($slot))
                        <h2>Update Delivery Slot</h2>
                    @else
                        <h2>Add New Delivery Slot</h2>
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
                        @if(isset($slot) && !empty($slot))
                            {{Form::model($slot, ['method' => 'post','route'=>['admin.setting.slot_submit']])}}
                            <input type="hidden" name="slot_id" value="{{$slot->id}}" class="">
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.setting.slot_submit']) }}
                        @endif

                        <div class="form-group">
                            {{ Form::label('name', 'Slot Name')}} 
                            {{ Form::text('name',null,array('class' => 'form-control','placeholder'=>'Enter Slot name')) }}
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Descriptions</label>
                            <textarea name="description" id="description" class="form-control">{{isset($slot) && !empty($slot) ? $slot->description : ''}}</textarea>
                            @if($errors->has('description'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            @if(isset($slot) && !empty($slot))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            @else
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                            @endif
                            <a href="{{route('admin.setting.slot_list')}}" class="btn btn-warning">Back</a>
                            
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