
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    @if(isset($product_size) && !empty($product_size))
                        <h2>Update Product Size of Product {{$product->name}}</h2>
                    @else
                        <h2>Add New Size of Product {{$product->name}}</h2>
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
                        @if(isset($product_size) && !empty($product_size))
                            {{Form::model($product_size, ['method' => 'post','route'=>['admin.size.from_submit'],'enctype'=>'multipart/form-data'])}}
                            <input type="hidden" name="product_size_id" value="{{$product_size->id}}" class="">
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.size.from_submit','enctype'=>'multipart/form-data']) }}
                        @endif
                        <input type="hidden" name="product_id" value="{{$product->id}}" class="">

                        <div class="form-group">
                            <label for="size_id">Select Size</label>
                            <select class="form-control" name="size_id">
                                <option value="">Select Size</option>
                                @if(isset($sizes) && !empty($sizes))
                                    @foreach($sizes as $item)
                                        <option value="{{ $item->id }}" {{ isset($product_size) && $product_size->size_id == $item->id ? 'selected' : ''}}>{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if($errors->has('size_id'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('size_id') }}</strong>
                                </span>
                            @enderror
                        </div> 
                        <div class="col-md-12">
                            <div class="col-md-4">
                                {{ Form::label('mrp', 'Product MRP')}} 
                                {{ Form::number('mrp',null,array('class' => 'form-control','placeholder'=>'Enter MRP')) }}
                                @if($errors->has('mrp'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('mrp') }}</strong>
                                    </span> 
                                @enderror
                            </div>

                            <div class="col-md-4">
                                {{ Form::label('price', 'Product Price')}} 
                                {{ Form::number('price',null,array('class' => 'form-control','placeholder'=>'Enter Price')) }}
                                @if($errors->has('price'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span> 
                                @enderror
                            </div>
                            <div class="col-md-4">
                                {{ Form::label('product_discount', 'Product Discount')}} 
                                {{ Form::number('product_discount',null,array('class' => 'form-control','placeholder'=>'Enter Discount')) }}
                                @if($errors->has('product_discount'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('product_discount') }}</strong>
                                    </span> 
                                @enderror
                            </div>
                            <div class="col-md-4">
                                {{ Form::label('coin_use', 'Coin Use')}} 
                                {{ Form::number('coin_use',null,array('class' => 'form-control','placeholder'=>'Enter Coin Use')) }}
                                @if($errors->has('coin_use'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('coin_use') }}</strong>
                                    </span> 
                                @enderror
                            </div>
                            <div class="col-md-4">
                                {{ Form::label('coin_generate', 'Coin Generate')}} 
                                {{ Form::number('coin_generate',null,array('class' => 'form-control','placeholder'=>'Enter Coin Generate')) }}
                                @if($errors->has('coin_generate'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('coin_generate') }}</strong>
                                    </span> 
                                @enderror
                            </div>
                            <div class="col-md-4">
                                {{ Form::label('shipping_charge', 'Shipping Charge')}} 
                                {{ Form::number('shipping_charge',null,array('class' => 'form-control','placeholder'=>'Enter Coin Generate')) }}
                                @if($errors->has('shipping_charge'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('shipping_charge') }}</strong>
                                    </span> 
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('image', 'Image')}} 
                            <input type="file" class="form-control" name="image">
                            @error('image')
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                            @if (isset($product_size) && ($product_size->image) )
                                <img src="{{asset('backend_images/thumb/'.$product_size->image.'')}}" alt="" height="100" >                                
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('is_jar_available', 'Is Jar Available')}} 
                            <input type="radio" name="is_jar_available" value="1" {{ isset($product_size) && ($product_size->jar_available_status == 1) ?'checked' : ''}}> Yes
                            <input type="radio" name="is_jar_available" value="2"  {{ isset($product_size) && ($product_size->jar_available_status == 2) ?'checked' : ''}} {{ isset($product_size) ?'' : 'checked'}}> No
                            @if($errors->has('is_jar_available'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('is_jar_available') }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div id="jar_div" class="col-md-12" {{ isset($product_size) && ($product_size->jar_available_status == 1) ?'' : 'style=display:none;'}} {{ isset($product_size) ?'' : 'style=display:none;'}}>
                            <div class="col-md-4">
                                {{ Form::label('jar_mrp', 'Jar MRP')}} 
                                {{ Form::number('jar_mrp',null,array('class' => 'form-control','placeholder'=>'Enter MRP')) }}
                                @if($errors->has('jar_mrp'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('jar_mrp') }}</strong>
                                    </span> 
                                @enderror
                            </div>

                            <div class="col-md-4">
                                {{ Form::label('jar_price', 'Jar Price')}} 
                                {{ Form::number('jar_price',null,array('class' => 'form-control','placeholder'=>'Enter Price')) }}
                                @if($errors->has('jar_price'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('jar_price') }}</strong>
                                    </span> 
                                @enderror
                            </div>
                            <div class="col-md-4">
                                {{ Form::label('jar_discount', 'Jar Discount')}} 
                                {{ Form::number('jar_discount',null,array('class' => 'form-control','placeholder'=>'Enter Discount')) }}
                                @if($errors->has('jar_discount'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('jar_discount') }}</strong>
                                    </span> 
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            @if(isset($category) && !empty($category))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            @else
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                            @endif
                            <a href="{{route('admin.size.list')}}" class="btn btn-warning">Back</a>
                            
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

{{-- <script src="{{ asset('admin/ckeditor4/ckeditor.js')}}"></script> --}}
<script>
    $(document).ready(function() {
        $('input:radio[name=is_jar_available]').click(function(){
            let type = $('input:radio[name=is_jar_available]:checked').val();
            if (type == 1) {
                $("#jar_div").show();
            } else {
                $("#jar_div").hide();
                
            }
        });
    })
</script>
@endsection