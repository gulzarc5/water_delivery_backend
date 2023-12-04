
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">

                <div class="x_title">
                    @if(isset($coupon) && !empty($coupon))
                        <h2>Update Coupon</h2>
                    @else
                        <h2>Add New Coupon</h2>
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
                        @if(isset($coupon) && !empty($coupon))
                            {{Form::model($coupon, ['method' => 'put','route'=>['admin.coupon_update',$coupon->id],'enctype'=>'multipart/form-data'])}}
                        @else
                            {{Form::open(['method' => 'post','route'=>['admin.coupon_insert_form'],'enctype'=>'multipart/form-data'])}}
                        @endif

                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-3">                                
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="brand_id">Select Brand</label>
                                    <select class="form-control" name="brand_id">
                                        <option value="">Select Brand</option>
                                        @if (isset($brands) && !empty($brands))
                                            @foreach ($brands as $item)                                        
                                                <option value="{{$item->id}}" {{isset($coupon->brand_id) && $coupon->brand_id==$item->id ? 'selected' : (old('brand_id') == $item->id ? 'selected' : '')}}>{{$item->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('brand_id'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('brand_id') }}</strong>
                                        </span>
                                    @enderror
                                </div>                         
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="size_id">Select Size</label>
                                    <select class="form-control" name="size_id">
                                        <option value="">Select Size</option>
                                        @if (isset($sizes) && !empty($sizes))
                                            @foreach ($sizes as $item)
                                                <option value="{{$item->id}}" {{isset($coupon->size_id) && $coupon->size_id==$item->id ? 'selected' : (old('size_id') == $item->id ? 'selected' : '')}}>{{$item->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('size_id'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('size_id') }}</strong>
                                        </span>
                                    @enderror
                                </div>                      
                                                            
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    {{ Form::label('expiry_date', 'Expiry Date')}}
                                    {{ Form::date('expiry_date',(isset($coupon->expire_date) ? $coupon->expire_date : old('expiry_date')),array('class' => 'form-control')) }}

                                    @if($errors->has('expiry_date'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('expiry_date') }}</strong>
                                        </span>
                                    @enderror
                                </div>                         
                                                            
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control">
                                    @if($errors->has('image'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @enderror
                                </div>                                       
                            </div>
                        </div>
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-3">                                
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    {{ Form::label('user_type', 'User Type')}}
                                    <select name="user_type" id="" class="form-control">
                                        <option value="">Select User Type</option>
                                        <option value="1" {{isset($coupon->user_type) && $coupon->user_type==1 ? 'selected' : (old('user_type')==1 ? 'selected' :null)}}>New User</option>
                                        <option value="2" {{isset($coupon->user_type) && $coupon->user_type==2 ? 'selected' : (old('user_type')==1 ? 'selected' :null)}}>Old User</option>
                                        <option value="3" {{isset($coupon->user_type) && $coupon->user_type==3 ? 'selected' : (old('user_type')==1 ? 'selected' :null)}}>Both</option>
                                    </select>
                                    @if($errors->has('user_type'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('user_type') }}</strong>
                                        </span>
                                    @enderror
                                </div>                         
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    {{ Form::label('coupon_type', 'Coupon Type')}}
                                    <select name="coupon_type" id="" class="form-control">
                                        <option value="">Select User Type</option>
                                        <option value="P" {{isset($coupon->coupon_type) && $coupon->coupon_type=="P" ? 'selected' : (old('coupon_type')=="P" ? 'selected' :null)}}>Product</option>
                                        <option value="S" {{isset($coupon->coupon_type) && $coupon->coupon_type=="S" ? 'selected' : (old('coupon_type')=="S" ? 'selected' :null)}}>Shipping</option>
                                    </select>
                                    @if($errors->has('coupon_type'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('coupon_type') }}</strong>
                                        </span>
                                    @enderror
                                </div>                         
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="coupon">Coupon</label>
                                    <input type="text" name="coupon" class="form-control" placeholder="Enter Coupon Code" value="{{isset($coupon) ? $coupon->coupon : null}}">
                                    @if($errors->has('coupon'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('coupon') }}</strong>
                                        </span>
                                    @enderror
                                </div>                   
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="discount">Discount (In Percentage)</label>
                                    <input type="text" name="discount" class="form-control" placeholder="Enter Discount (In Percentage)" value="{{isset($coupon) ? $coupon->discount : null}}">
                                    @if($errors->has('discount'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('discount') }}</strong>
                                        </span>
                                    @enderror
                                </div>                   
                                <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                    <label for="max_discount">Max Discount (In Amount)</label>
                                    <input type="text" name="max_discount" class="form-control" placeholder="Enter Max Discount (In Amount)" value="{{isset($coupon) ? $coupon->max_discount : null}}">
                                    @if($errors->has('max_discount'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('max_discount') }}</strong>
                                        </span>
                                    @enderror
                                </div>                             
                            </div>
                        </div>

                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-3">                                
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    {{ Form::label('description', 'Enter Coupon Details')}}
                                    {{ Form::textarea('description',null,array('class' => 'form-control','placeholder' => 'Enter Coupon Description')) }}
        
                                    @if($errors->has('description'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @enderror
                                </div>                      
                            </div>
                        </div>

                        <div class="form-group">
                            @if(isset($coupon) && !empty($coupon))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            @else
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                            @endif
                            <a href="{{route('admin.coupon_list')}}" class="btn btn-warning">Back</a>

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
     <script>
          $(document).ready(function(){
            $("#category").change(function(){
                var category = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{ url('/admin/sub/category/list/with/category/')}}"+"/"+category+"",
                    success:function(data){
                        console.log(data);
                        $("#sub_category").html("<option value=''>Please Select Sub Category</option>");

                        $.each( data, function( key, value ) {
                            $("#sub_category").append("<option value='"+value.id+"'>"+value.name+"</option>");
                        });

                    }
                });
            });
        });
     </script>
 @endsection
