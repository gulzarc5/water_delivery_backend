@extends('admin.template.admin_master')

@section('content')
<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">`
    	            <h2>Make Membership</h2>
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
    	           
    	            	{{ Form::open(['method' => 'post','route'=>'admin.order.invoice.membership.order.place']) }}
                        <input type="hidden" name="user_id" value="{{$customer_id}}" id="cart_user_id" />
                        <input type="hidden" name="delivery_address_id" value="{{$address_id}}" id="address_id" />
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-3">                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="plan_id">Select Plan</label>
                                    <select class="form-control" name="plan_id" id="plan_id">
                                        <option value="">Select Plan</option>
                                        @if (isset($plans) && !empty($plans))
                                            @foreach ($plans as $item)
                                                <option value="{{$item->id}}">{{$item->name}} - ({{$item->duration}})</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('plan_id'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('plan_id') }}</strong>
                                        </span>
                                    @enderror
                                </div>                         
                                                            
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="subscription_details_id">Select Product</label>
                                    <select class="form-control" name="subscription_details_id" id="product" onchange="checkJar()">
                                        <option value="">Select Product</option>
                                    </select>
                                    @if($errors->has('subscription_details_id'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('subscription_details_id') }}</strong>
                                        </span>
                                    @enderror
                                </div>                         
                                                            
                                <div class="col-md-2 col-sm-12 col-xs-12 mb-3">
                                    <label for="quantity">Select Quantity</label>
                                    <select class="form-control" name="quantity" id="quantity">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                                    @if($errors->has('quantity'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('quantity') }}</strong>
                                        </span>
                                    @enderror
                                </div>                         
                                                            
                                <div class="col-md-2 col-sm-12 col-xs-12 mb-3">
                                    <label for="is_jar">Select Jar</label>
                                    <select class="form-control" name="is_jar" id="is_jar">
                                        <option value="2">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                    @if($errors->has('is_jar'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('is_jar') }}</strong>
                                        </span>
                                    @enderror
                                </div>                         
                                <div class="col-md-2 col-sm-12 col-xs-12 mb-3">
                                    <label for="frequency">Select Frequency</label>
                                    <select class="form-control" name="frequency" id="frequency">
                                        <option value="1">Daily</option>
                                        <option value="2">Alternative</option>
                                    </select>
                                    @if($errors->has('frequency'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('frequency') }}</strong>
                                        </span>
                                    @enderror
                                </div>                         
                                <div class="col-md-2 col-sm-12 col-xs-12 mb-3">
                                    <label for="delivery_start_date">1St Delivery Date</label>
                                    <input type="date" class="form-control" name="delivery_start_date">
                                    @if($errors->has('delivery_start_date'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('delivery_start_date') }}</strong>
                                        </span>
                                    @enderror
                                </div>    
                                
                                <div class="col-md-2 col-sm-12 col-xs-12 mb-3">
                                    <label for="delivery_slot_id">Select Shift</label>
                                    <select class="form-control" name="delivery_slot_id" id="shift">
                                        <option value="1">Morning</option>
                                        <option value="2">Evening</option>
                                    </select>
                                    @if($errors->has('delivery_slot_id'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('delivery_slot_id') }}</strong>
                                        </span>
                                    @enderror
                                </div>                                   
                            </div>
                        </div>
                        

                        <div class="well" style="overflow: auto" id="image_div">
                            @if (Session::has('order_message'))
                                <div class="alert alert-success" >{{ Session::get('order_message') }}</div>
                            @endif
                            @if (Session::has('error_order'))
                                <div class="alert alert-danger">{{ Session::get('error_order') }}</div>
                            @endif
    
                            <div class="form-row order-form-table mb-3">                                
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th style="width:50px">#</th>
                                            <th>Order Details</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <td colspan='5' align='right'>Total Mrp</td>
                                                <td align='right' id="mrp_div">₹ 100</td>
                                            </tr>
                                            <tr>
                                                <td colspan='5' align='right'>Discount</td>
                                                <td align='right' id="discount_div">₹ 200</td>
                                            </tr>
                                            <tr>
                                                <td colspan='5' align='right'>Jar Price</td>
                                                <td align='right' id="jar_div">Free</td>
                                            </tr>
                                            <tr>
                                                <td colspan='5' align='right'><strong>Total Amount</strong></td>
                                                <td align='right' id="price_div">₹ 500</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
    	            	<div class="col-md-3 col-sm-12 col-xs-12" style="margin-top:10px;">                             
                            <button class="btn btn-success">Add Membership</button>   
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
            $("#plan_id").change(function(){
                var plan_id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/order/invoice/membership/product/list')}}"+"/"+plan_id,
                    success:function(data){
                        if (data && data.length > 0) {
                            let productHtml = `<option value="">Select Product</option>`;
                            $.each(data, function(key, item){
                                productHtml+=`<option value="${item.id}" data-jar="${item.jar_price}">${item.brand.name} - (${item.size.name})</option>`;
                            });
                            $("#product").html(productHtml);
                        }
                        console.log(data);
                    }
                });
            });

            $("#product").change(function(){
                getPrice();
            });
            $("#quantity").change(function(){
                getPrice();
            });
            $("#frequency").change(function(){
                getPrice();
            });
            $("#is_jar").change(function(){
                getPrice();
            });
        });

        function checkJar() {
            let jar_price = $('select#product').find(':selected').data('jar');
            console.log(jar_price);
            if (jar_price > 0) {
                $("#is_jar").prop('disabled',false);
            } else {
                $("#is_jar").prop('disabled',true);                
            }
        }

        function getPrice() {
            let product_id = $("#product").val();
            let quantity = $("#quantity").val();
            let frequency = $("#frequency").val();
            let is_jar = $("#is_jar").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"POST",
                url:"{{route('admin.membership.order.price')}}",
                beforeSend : function(){
                    $("#couponLoader").html(`<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>`);
                },
                data : {
                    product_id:product_id,
                    quantity:quantity,
                    frequency:frequency,
                    is_jar:is_jar,
                },
                success:function(data){
                    $("#couponLoader").html("");
                    if (data) {
                        $("#mrp_div").html(`₹ ${data.mrp}`);
                        $("#discount_div").html(`₹ ${data.discount}`);
                        $("#jar_div").html(`₹ ${data.jar_price}`);
                        $("#price_div").html(`₹ ${data.price}`);
                    } else {
                        $("#mrp_div").html(`₹ 0.00`);
                        $("#discount_div").html(`₹ 0.00`);
                        $("#jar_div").html(`₹ 0.00`);
                        $("#price_div").html(`₹ 0.00`);
                    }
                }
            });
        }
    </script>
 @endsection


        
    