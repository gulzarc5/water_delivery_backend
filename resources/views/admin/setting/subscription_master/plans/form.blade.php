
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    @if(isset($plan) && !empty($plan))
                        <h2>Update Subscription Plan</h2>
                    @else
                        <h2>Add New Subscription Plan</h2>
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
                        @if(isset($plan) && !empty($plan))
                            {{Form::model($plan, ['method' => 'post','route'=>['admin.setting.plan_details_submit'],'enctype'=>'multipart/form-data'])}}
                            <input type="hidden" name="plan_details_id" value="{{$plan->id}}" class="">
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.setting.plan_details_submit','enctype'=>'multipart/form-data']) }}
                        @endif

                        <div class="form-group">
                            <label for="plan_id">Select Plan Master</label>
                            <select class="form-control" name="plan_id" id="plan_id">
                                <option value="">Select Plan Master</option>
                                @if(isset($masters) && !empty($masters))
                                    @foreach($masters as $item)
                                        <option value="{{ $item->id }}" {{isset($plan) && $plan->plan_id == $item->id ? ' selected' : ''}}>{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if($errors->has('plan_id'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('plan_id') }}</strong>
                                </span>
                            @enderror
                        </div>   

                        <div class="form-group">
                            <label for="brand_id">Select Brand</label>
                            <select class="form-control" name="brand_id" id="brand_id">
                                <option value="">Select Brand</option>
                                @if(isset($brands) && !empty($brands))
                                    @foreach($brands as $item)
                                        <option value="{{ $item->id }}" {{isset($plan) && $plan->brand_id == $item->id ? ' selected' : ''}}>{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if($errors->has('brand_id'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('brand_id') }}</strong>
                                </span>
                            @enderror
                        </div>     

                        <div class="form-group">
                            <label for="size_id">Select Size</label>
                            <select class="form-control" name="size_id" id="size_id">
                                <option value="">Select Size</option>
                                @if (isset($sizes) && !empty($sizes))
                                    @foreach ($sizes as $item)
                                        <option value="{{$item->id}}" {{isset($plan) && $plan->size_id == $item->id ? ' selected' : ''}}>{{$item->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if($errors->has('size_id'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('size_id') }}</strong>
                                </span>
                            @enderror
                        </div>     

                        <div class="form-group">
                            {{ Form::label('mrp', 'Enter Per Bootle MRP')}} 
                            {{ Form::text('mrp',null,array('class' => 'form-control','placeholder'=>'Enter Per Bootle MRP')) }}
                            @if($errors->has('mrp'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('mrp') }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            {{ Form::label('price', 'Per Bootle Price')}} 
                            {{ Form::text('price',null,array('class' => 'form-control','placeholder'=>'Per Bootle Price')) }}
                            @if($errors->has('price'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            {{ Form::label('jar_mrp', 'Enter Per Bootle Jar MRP')}} 
                            {{ Form::text('jar_mrp',null,array('class' => 'form-control','placeholder'=>'Enter Per Bootle Jar MRP')) }}
                            @if($errors->has('jar_mrp'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('jar_mrp') }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            {{ Form::label('jar_price', 'Per Bootle Jar Price')}} 
                            {{ Form::text('jar_price',null,array('class' => 'form-control','placeholder'=>'Per Bootle Jar Price')) }}
                            @if($errors->has('jar_price'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('jar_price') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            @if(isset($category) && !empty($category))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            @else
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                            @endif
                            <a href="{{route('admin.setting.plan_details_list')}}" class="btn btn-warning">Back</a>
                            
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


    // $(document).ready(function(){
    //     $("#brand_id").change(function(){
    //         var brand_id = $(this).val();
    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });
    //         $.ajax({
    //             type:"GET",
    //             url:"{{ url('/admin/ajax/get/size/by/brand/')}}"+"/"+brand_id+"",
    //             success:function(data){
    //                 $("#size_id").html("<option value=''>Please Select Size</option>");

    //                 $.each( data, function( key, value ){
    //                     $("#size_id").append("<option value='"+key+"'>"+value+"</option>");
    //                 });
    //             }
    //         });
    //     });
    // });
</script>
@endsection