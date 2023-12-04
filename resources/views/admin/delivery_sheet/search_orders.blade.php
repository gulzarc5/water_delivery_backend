
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Delivery Sheet</h2>
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
                   
                        {{ Form::open(['method' => 'get','route'=>'admin.delivery.sheet.form.submit']) }}
                        <div class="form-group">
                            {{ Form::label('delivery_schedule_date', 'Delivery Shchdule Date')}} 
                            {{ Form::date('delivery_schedule_date',null,array('class' => 'form-control')) }}
                            @if($errors->has('delivery_schedule_date'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('delivery_schedule_date') }}</strong>
                                </span> 
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="delivery_slot">Delivery Slot</label>
                            <select class="form-control" name="delivery_slot" id="delivery_slot">
                                <option value="">Select Delivery Slot</option>
                                <option value="1">Morning</option>
                                <option value="2">Evening</option>
                                <option value="A">All</option>
                            </select>
                            @if($errors->has('delivery_slot'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('delivery_slot') }}</strong>
                                </span>
                            @enderror
                        </div> 
                        <div class="form-group col-md-6">
                            <label for="main_location">Main Location</label>
                            <select class="form-control" name="main_location" id="main_location">
                                <option value="">Select Main Location</option>
                                @if (isset($main_location) && !empty($main_location))
                                    @foreach ($main_location as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>                                        
                                    @endforeach
                                @endif
                            </select>
                            @if($errors->has('main_location'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('main_location') }}</strong>
                                </span>
                            @enderror
                        </div> 
                        <div class="form-group col-md-6">
                            <label for="sub_location">Sub Location</label>
                            <select class="form-control" name="sub_location" id="sub_location">
                                <option value="">Select Sub Location</option>
                            </select>
                            @if($errors->has('sub_location'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('sub_location') }}</strong>
                                </span>
                            @enderror
                        </div> 
                         {{ Form::submit('Search', array('class'=>'btn btn-success')) }}
                           
                            
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

<script>
    $(document).ready(function(){
        $("#main_location").change(function(){
            let main_location = $(this).val();
            if (main_location) {
                getSubLocation(main_location);
            }
        });
    })

    function getSubLocation(main_location) {
        $.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
          $.ajax({
              type:"GET",
              url:"{{url('admin/setting/area/sub/get')}}"+"/"+main_location,
              success:function(data){
                $("#sub_location").html(`<option value="">Select Sub Location</option>`);
                if (data.length > 0) {
                    $.each(data, function(key, value){
                        $("#sub_location").append(`<option value="${value.id}">${value.name}</option>`);
                    })
                }
              }
            });
    }

</script>

@endsection