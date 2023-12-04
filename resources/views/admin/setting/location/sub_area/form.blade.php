
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    @if(isset($location) && !empty($location))
                        <h2>Update Sub Location</h2>
                    @else
                        <h2>Add New Subscription location</h2>
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
                        @if(isset($location) && !empty($location))
                            {{Form::model($location, ['method' => 'post','route'=>['admin.setting.sub_area.add'],'enctype'=>'multipart/form-data'])}}
                            <input type="hidden" name="area_id" value="{{$location->id}}" class="">
                        @else
                            {{ Form::open(['method' => 'post','route'=>'admin.setting.sub_area.add','enctype'=>'multipart/form-data']) }}
                        @endif

                        <div class="form-group">
                            <label for="main_area_id">Select Main Location</label>
                            <select class="form-control" name="main_area_id" id="main_area_id">
                                <option value="">Select Main Location</option>
                                @if(isset($main_location) && !empty($main_location))
                                    @foreach($main_location as $item)
                                        <option value="{{ $item->id }}" {{isset($location) && $location->main_area_id == $item->id ? ' selected' : ''}}>{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if($errors->has('main_area_id'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('main_area_id') }}</strong>
                                </span>
                            @enderror
                        </div>   
   

                        <div class="form-group">
                            {{ Form::label('name', 'Sub Location Name')}} 
                            {{ Form::text('name',null,array('class' => 'form-control','placeholder'=>'Sub Location Name')) }}
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group">
                            @if(isset($location) && !empty($location))
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                            @else
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                            @endif
                            <a href="{{route('admin.setting.sub_area.list')}}" class="btn btn-warning">Back</a>
                            
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


    $(document).ready(function(){
        $("#brand_id").change(function(){
            var brand_id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url:"{{ url('/admin/ajax/get/size/by/brand/')}}"+"/"+brand_id+"",
                success:function(data){
                    $("#size_id").html("<option value=''>Please Select Size</option>");

                    $.each( data, function( key, value ){
                        $("#size_id").append("<option value='"+key+"'>"+value+"</option>");
                    });
                }
            });
        });
    });
</script>
@endsection