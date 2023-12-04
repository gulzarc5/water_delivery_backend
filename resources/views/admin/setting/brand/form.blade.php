
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    @if(isset($brand) && !empty($brand))
                        <h2>Update Brand</h2>
                    @else
                        <h2>Add New Brand</h2>
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
                        @if(isset($brand) && !empty($brand))
                            {{Form::model($brand, ['method' => 'post','route'=>['admin.setting.brand_submit'],'enctype'=>'multipart/form-data'])}}
                            <input type="hidden" name="brand_id" value="{{$brand->id}}" class="">
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.setting.brand_submit','enctype'=>'multipart/form-data']) }}
                        @endif

                        <div class="form-group">
                            {{ Form::label('name', 'Brand Name')}} 
                            {{ Form::text('name',null,array('class' => 'form-control','placeholder'=>'Enter Brand name')) }}
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('name') }}</strong>
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

                        <div class="form-group">
                            <label for="description">Descriptions</label>
                            <textarea name="description" id="description" class="form-control">{{isset($brand) && !empty($brand) ? $brand->description : ''}}</textarea>
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
                            <a href="{{route('admin.setting.brand_list')}}" class="btn btn-warning">Back</a>
                            
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