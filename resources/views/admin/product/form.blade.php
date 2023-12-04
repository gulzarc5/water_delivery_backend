
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    @if(isset($product) && !empty($product))
                        <h2>Update Product</h2>
                    @else
                        <h2>Add New Product</h2>
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
                        @if(isset($product) && !empty($product))
                            {{Form::model($product, ['method' => 'post','route'=>['admin.product.from_submit'],'enctype'=>'multipart/form-data'])}}
                            <input type="hidden" name="product_id" value="{{$product->id}}" class="">
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.product.from_submit','enctype'=>'multipart/form-data']) }}
                        @endif

                        <div class="form-group">
                            {{ Form::label('name', 'Product Name')}} 
                            {{ Form::text('name',null,array('class' => 'form-control','placeholder'=>'Enter Brand name')) }}
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="brand">Select Brand</label>
                            <select class="form-control" name="brand_id" id="brand">
                                <option value="">Select Brand</option>
                                @if(isset($brands) && !empty($brands))
                                    @foreach($brands as $item)
                                        <option value="{{ $item->id }}" {{ isset($product) && $product->brand_id == $item->id ? 'selected' : ''}}>{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if($errors->has('brand_id'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('brand_id') }}</strong>
                                </span>
                            @enderror
                        </div> 
                        @if (!isset($product) && empty($product) )                            
                            <div class="form-group">
                                {{ Form::label('image', 'Image')}} 
                                <input type="file" class="form-control" name="image[]" multiple>
                                @error('image.*')
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $message }}</strong>
                                    </span> 
                                @enderror

                                @error('image')
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $message }}</strong>
                                    </span> 
                                @enderror
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="short_description">Short Descriptions</label>
                            <textarea name="short_description" id="short_description" class="form-control">{{isset($product) && !empty($product) ? $product->short_description : ''}}</textarea>
                            @if($errors->has('short_description'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('short_description') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Descriptions</label>
                            <textarea name="description" id="description" class="form-control">{{isset($product) && !empty($product) ? $product->long_description : ''}}</textarea>
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
                            <a href="{{route('admin.product.list')}}" class="btn btn-warning">Back</a>
                            
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