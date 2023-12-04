
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                        <h2>Add New Slider</h2>
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
                        
                            {{ Form::open(['method' => 'post','route'=>'admin.setting.slider_save','enctype'=>'multipart/form-data']) }}
                        

                        <div class="form-group">
                            <label for="image">Image<span style="color:red">(Size Should Be Less Than 600 KB)</span></label>
                            <input type="file" name="image" class="form-control" accept=".jpeg,.png,.jpg,.gif,.svg">
                            @if($errors->has('image'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            {{ Form::label('caption', 'Caption')}} 
                            {{ Form::text('caption',null,array('class' => 'form-control','placeholder'=>'Enter Caption')) }}
                            @if($errors->has('caption'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('caption') }}</strong>
                                </span> 
                            @enderror
                        </div>
                       

                        <div class="form-group">
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            <a href="{{route('admin.setting.slider_list')}}" class="btn btn-warning">Back</a>
                            
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