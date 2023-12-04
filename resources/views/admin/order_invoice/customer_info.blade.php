@extends('admin.template.admin_master')

@section('content')
<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Make New Order</h2>
    	            <div class="clearfix"></div>
    	        </div>
                <div>
                     @if (Session::has('message'))
                        <div class="alert alert-success" >{{ Session::get('message') }}</div>
                     @endif
                     @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                     @endif

                </div>
    	        <div>
    	            <div class="x_content">                        
                        <div id="address-select">
                            {{ Form::open(['method' => 'get','route'=>'admin.order.invoice.customer.proceed' , 'enctype'=>'multipart/form-data']) }}
                                <input type="hidden" name="customer_id" id="customer_id">
                                <div class="well" style="overflow: auto">
                                    <div class="form-row mb-10">
                                        <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                            <label for="mobile">Customer Mobile Number</label>
                                            <input type="number" class="form-control" name="mobile" id="mobile"  placeholder="Enter Customer Mobile Number" >
                                            
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('mobile') }}</strong>
                                            </span>
                                        </div>
        
                                        <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="name">Customer Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Customer name" disabled>
                                            @if($errors->has('name'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                
                                </div>
        
                                <div class="well" style="overflow: auto; display:none" id="address_show">
                                    <label for="">Select Address</label>
                                    <div class="form-row mb-10">
                                        <span id="address_list">
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                <label class="address-block">
                                                    <input type="radio" name="customer_address"> 
                                                    <p>
                                                        <span>Gulzar AH Choudhary</span>
                                                        <span>H No- 14, Green Valley Road, By lane 2, Sub area, Area</span>
                                                        <span>Near Landmark</span>
                                                        <span>Ph: 9436590120</span>
                                                    </p>
                                                </label>
                                            </div>
                                        </span>
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <div class="add-address-block" id="add-address">
                                                <i class="fa fa-plus"></i>
                                                <p>Add New Address</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>                           
                                
                                <div class="form-group">    	            	
                                    {{ Form::submit('Next', array('class'=>'btn btn-success')) }}  
                                </div>
                        </div>
                        
                        <div id="address-add" style="display:none">
                            <div class="well" style="overflow: auto">
                                <div class="x_title">
                                    <h2>Add New Adresses</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-row mb-10">
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group">
                                            <label for="name">Customer Name</label> 
                                            <input class="form-control" placeholder="Enter Name"  type="text" id="address_name" >
                                            <span id="error_address_name"></span>
                                        </div>
                                    </div>
    
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group">
                                            <label for="name">Customer Phone</label> 
                                            <input class="form-control" placeholder="Enter Mobile Number"  type="text" id="address_mobile">
                                            <span id="error_address_mobile"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row mb-10">

                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group">
                                            <label for="main_area">Select Area</label>
                                            <select class="form-control" id="address_main_area">
                                                <option value="">Select Area</option>
                                                @if (isset($main_location) && !empty($main_location))
                                                    @foreach ($main_location as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <span id="error_address_main_area"></span>
                                        </div> 
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group">
                                            <label for="sub_location">Select Sub Area</label>
                                            <select class="form-control" id="address_sub_location">
                                                <option value="">Select Sub Area</option>
                                            </select>
                                            <span id="error_address_sub_location"></span>
                                        </div> 
                                    </div>
                                </div>

                                <div class="form-row mb-10">
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group">
                                            <label for="name">Landmark</label> 
                                            <input class="form-control" placeholder="Enter Landmark" type="text" id="address_landmark">
                                            <span id="error_address_landmark"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group">
                                            <label for="name">House No</label> 
                                            <input class="form-control" placeholder="Enter House No" type="text" id="address_house_no">
                                            <span id="error_address_house_no"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group">
                                            <label for="name">Pin</label> 
                                            <input class="form-control" placeholder="Enter Pin" type="text" id="address_pin">
                                            <span id="error_address_pin"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group">
                                            <label for="short_description">Address line 1</label>
                                            <textarea  id="address_address_one" class="form-control" placeholder="Enter Address"></textarea>
                                            <span id="error_address_address_one"></span>
                                        </div> 
                                    </div>
                                </div>
                            
                            </div>

                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <button type="button" class="btn btn-success" onclick="addressAdd()">Save address</button>
                                    <button class="btn btn-warning" type="button" id="show-address-select">Back</button>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
    	            </div>
    	        </div>
    	    </div>
    	</div>
    	{{-- <div class="col-md-2"></div> --}}
    </div>
</div>


 @endsection

  @section('script')
    <script>

        $(document).ready(function(){

            $("#mobile").blur(function(){
                let mobile = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/order/invoice/customer/get')}}"+"/"+mobile,
                    success:function(data){
                        console.log(data);
                        if (data) {
                            $("#address_show").show();
                            $("#name").val(data.name);
                            $("#name").prop("disabled", true);
                            $("#customer_id").val(data.id);
                            $("#address_list").html("");
                            if (data.addresses.length > 0) {
                                let addressHtml = "";
                                $.each(data.addresses, function(key,address){
                                    addressHtml +=`<div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label class="address-block">
                                            <input type="radio" name="address_id" value="${address.id}"> 
                                            <p>
                                                <span>${address.name}</span>
                                                <span>${address.mobile}</span>
                                                <span>H No- ${address.flat_no}, ${address.address_one}, ${address.main_location ? address.main_location.name : ''}, ${address.sub_location ? address.sub_location.name : ''}</span>
                                                <span>${address.landmark}</span>
                                                <span>Ph: ${address.mobile}</span>
                                            </p>
                                        </label>
                                    </div>`;
                                })
                                $("#address_list").html(addressHtml);
                            }
                        } else {
                            $("#address_show").hide();
                            $("#name").val("");
                            $("#name").prop("disabled", false);
                            $("#customer_id").val("");
                        }
                    }
                });
            });

            $("#name").blur(function() {
                registerCustomer();
            })
            $("#address_main_area").change(function() {
                let main_location = $("#address_main_area").val();
                console.log(main_location);
                getSubLocation(main_location);
            })
            
        });

        function registerCustomer() {
            let mobile = $("#mobile").val();
            let name = $("#name").val();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"POST",
                    url:"{{route('admin.order.invoice.customer.register')}}",
                    data:{
                        mobile:mobile,
                        name:name,
                    },
                    success:function(data){
                        console.log(data);
                        if (data) {
                            $("#address_show").show();
                            $("#name").val(data.name);
                            $("#name").prop("disabled", true);
                            $("#customer_id").val(data.id);
                            $("#address_list").html("");
                            if (data.addresses && data.addresses.length > 0) {
                                let addressHtml = "";
                                $.each(data.addresses, function(key,address){
                                    addressHtml +=`<div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label class="address-block">
                                            <input type="radio" name="address_id" value="${address.id}"> 
                                            <p>
                                                <span>${address.name}</span>
                                                <span>${address.mobile}</span>
                                                <span>H No- ${address.flat_no}, ${address.address_one}, ${address.main_location ? address.main_location.name : ''}, ${address.sub_location ? address.sub_location.name : ''}</span>
                                                <span>${address.landmark}</span>
                                                <span>Ph: ${address.mobile}</span>
                                            </p>
                                        </label>
                                    </div>`;
                                })
                                $("#address_list").html(addressHtml);
                            }
                        } else {
                            $("#address_show").hide();
                            $("#name").val("");
                            $("#name").prop("disabled", false);
                            $("#customer_id").val("");
                        }
                    }
                });
        }

        function addressAdd() {
            let customer_id = $("#customer_id").val();
            let address_name = $("#address_name").val();
            let address_mobile = $("#address_mobile").val();
            let address_main_area = $("#address_main_area").val();
            let address_sub_location = $("#address_sub_location").val();
            let address_landmark = $("#address_landmark").val();
            let address_house_no = $("#address_house_no").val();
            let address_pin = $("#address_pin").val();
            let address_address_one = $("#address_address_one").val();
            let validate = true;
            if (!address_name) {
                validate = false;
                $("#error_address_name").html("<p style='color:red'>Name Field Is Required</p>");
            }else{
                $("#error_address_name").html("");
            }
            if (!address_mobile || address_mobile.length !=10) {
                validate = false;
                $("#error_address_mobile").html("<p style='color:red'>Enter 10 Digit Mobile Number</p>");
            }else{
                $("#error_address_mobile").html("");
            }
            if (!address_main_area) {
                validate = false;
                $("#error_address_main_area").html("<p style='color:red'>Name Field Is Required</p>");
            }else{
                $("#error_address_main_area").html("");
            }
            if (!address_sub_location) {
                validate = false;
                $("#error_address_sub_location").html("<p style='color:red'>Name Field Is Required</p>");
            }else{
                $("#error_address_sub_location").html("");
            }
            if (!address_house_no) {
                validate = false;
                $("#error_address_house_no").html("<p style='color:red'>Name Field Is Required</p>");
            }else{
                $("#error_address_house_no").html("");
            }
            if (!address_address_one) {
                validate = false;
                $("#error_address_address_one").html("<p style='color:red'>Name Field Is Required</p>");
            }else{
                $("#error_address_address_one").html("");
            }


            if (validate) {
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"POST",
                    url:"{{route('admin.order.invoice.customer.address.add')}}",
                    data:{
                        customer_id:customer_id,
                        name:address_name,
                        mobile:address_mobile,
                        main_location_id:address_main_area,
                        sub_location_id:address_sub_location,
                        landmark:address_landmark,
                        flat_no:address_house_no,
                        pin:address_pin,
                       address_one:address_address_one,
                    },
                    success:function(data){
                        if (data) {

                            $("#address-select").show();
                            $("#address-add").hide();
                            let addressHtml =`<div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label class="address-block">
                                        <input type="radio" name="address_id" value="${data.id}"> 
                                        <p>
                                            <span>${data.name}</span>
                                            <span>${data.mobile}</span>
                                            <span>H No- ${data.flat_no}, ${data.address_one}, ${data.main_location ? data.main_location.name : ''}, ${data.sub_location ? data.sub_location.name : ''}</span>
                                            <span>${data.landmark}</span>
                                            <span>Ph: ${data.mobile}</span>
                                        </p>
                                    </label>
                                </div>`;
                            $("#address_list").append(addressHtml);
                        } else {
                            alert("Something Went Wrong");
                        }
                    }
                });
            }

        }

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
                $("#address_sub_location").html(`<option value="">Select Sub Location</option>`);
                if (data.length > 0) {
                    $.each(data, function(key, value){
                        $("#address_sub_location").append(`<option value="${value.id}">${value.name}</option>`);
                    })
                }
                }
            });
        }

    </script>
    <script>
        $("#add-address").click(function(){
            $("#address-select").hide();
            $("#address-add").show();
        });
        
        // Show hidden paragraphs
        $("#show-address-select").click(function(){
            $("#address-select").show();
            $("#address-add").hide();
        });
    </script>
 @endsection


        
    