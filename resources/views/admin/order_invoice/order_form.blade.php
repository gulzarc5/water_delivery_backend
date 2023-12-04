@extends('admin.template.admin_master')

@section('content')
<div class="right_col" role="main">
    <div class="row">
    	{{-- <div class="col-md-2"></div> --}}
    	<div class="col-md-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
    	            <h2>Add Product</h2>
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
    	           
    	            	{{ Form::open(['method' => 'post','route'=>'admin.order.invoice.cart.add']) }}
                        <input type="hidden" name="user_id" value="{{$customer_id}}" id="cart_user_id" />
                        <div class="well" style="overflow: auto">
                            <div class="form-row mb-3">                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="brand">Select Brand</label>
                                    <select class="form-control" name="brand" id="brand">
                                        <option value="">Select Brand</option>
                                        @if (isset($brands) && !empty($brands))
                                            @foreach ($brands as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('brand'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('brand') }}</strong>
                                        </span>
                                    @enderror
                                </div>                         
                                                            
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="product_id">Select Product</label>
                                    <select class="form-control" name="product_id" id="product" onchange="checkJar()">
                                        <option value="">Select Product</option>
                                    </select>
                                    @if($errors->has('product_id'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('product_id') }}</strong>
                                        </span>
                                    @enderror
                                </div>                         
                                                            
                                <div class="col-md-2 col-sm-12 col-xs-12 mb-3">
                                    <label for="quantity">Select Quantity</label>
                                    <select class="form-control" name="quantity">
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
                                    
                                <div class="col-md-3 col-sm-12 col-xs-12" style="margin-top:10px;">                             
                                    <button class="btn btn-success">Add to cart</button>   
                                </div>                                      
                            </div>
                        </div>
                        {{ Form::close() }}

                        {{ Form::open(['method' => 'post','route'=>'admin.order.invoice.customer.place']) }}
                        <input type="hidden" name="user_id" value="{{$customer_id}}" id="order_user_id" />
                        <input type="hidden" name="address_id" value="{{$address_id}}"/>
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
                                            <th>Product</th>
                                            <th style="width:100px">Quantity</th>
                                            <th style="width:200px">Jar</th>
                                            <th style="width:100px;text-align:right">Amount</th>
                                            <th style="width:72px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($data['cart']) && !empty($data['cart']))
                                                @forelse ($data['cart'] as $item)
                                                    <tr>
                                                        <th scope="row">{{$loop->iteration}}</th>
                                                        <td>{{$item->product->product->name ?? null,}} ({{$item->product->size->name ?? null,}})</td>
                                                        <td><input type="text" name=cart_quantity[] class="form-control" value="{{$item->quantity}}" disabled></td>
                                                        <td>
                                                            <select class="form-control" name="cart_is_jar[]" disabled>
                                                                <option value="1" {{$item->is_jar == 1 ? "selected" : ''}}>Yes</option>
                                                                <option value="2" {{$item->is_jar == 2 ? "selected" : ''}}>No</option>
                                                            </select>
                                                        </td>
                                                        @php
                                                            $product_mrp = $item->product->mrp * $item->quantity;
                                                            if ($item->is_jar == 1) {
                                                                $product_mrp+=$item->product->jar_mrp * $item->quantity;
                                                            }
                                                        @endphp
                                                        <td align='right'>$ {{$product_mrp}}</td>
                                                        <td align='right'><a class='btn btn-danger btn-xs' href="{{route('admin.order.invoice.cart.remove',['cart_id'=>$item->id])}}"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" align="center">No Cart Item Found</td>
                                                    </tr>
                                                @endforelse
                                               
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan='2' align='right' style="border-bottom: 1px solid #ddd;padding: 10px;">
                                                    <label for="">Select Coupon</label>
                                                    <select class="form-control" name="coupon_id" id="coupon_id">
                                                        <option selected disabled>Select Coupon</option>
                                                        @if (isset($coupons) && !empty($coupons))
                                                            @foreach ($coupons as $item)
                                                           
                                                                <option value="{{$item['id']}}"> {{$item['coupon']}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <span id="couponLoader"></span>
                                                </td>
                                                <td colspan='2' align='right' style="border-bottom: 1px solid #ddd;padding: 10px;">
                                                    <label for="">Select Delivery Date</label>
                                                    <input type="date" name="delivery_date" class="form-control" style="margin-top: 0;" required>
                                                </td>
                                                <td colspan='2' align='right' style="border-bottom: 1px solid #ddd;padding: 10px;">
                                                    <label for="">Select Slot</label>
                                                    <select class="form-control" name="delivery_slot" required>
                                                        <option selected disabled>Select Slot</option>
                                                        <option value="1">Morning</option>
                                                        <option value="2">Evening</option>
                                                        
                                                    </select>
                                                    <span id="couponLoader"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan='5' align='right'>Cart Value</td>
                                                <td align='right'>₹ {{$cart_total['total_mrp']}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan='5' align='right'>Discount</td>
                                                <td align='right'>₹ {{$cart_total['total_mrp'] - $cart_total['total_amount']}} </td>
                                            </tr>
                                            <tr>
                                                <td colspan='5' align='right'>Sub Total</td>
                                                <td align='right'>₹ {{$cart_total['total_amount']}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan='5' align='right'>Coin Used</td>
                                                <td align='right'>₹ {{$cart_total['coins']}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan='5' align='right'>Delivery Charge</td>
                                                <td align='right'>
                                                    @if ($cart_total['shipping_charge'] > 0)
                                                        {{$cart_total['shipping_charge']}}
                                                    @else
                                                        Free                                                        
                                                    @endif
                                                </td>
                                                <input type="hidden" id="totalCartPrice" value="{{$cart_total['total_amount']}}">
                                                <input type="hidden" id="totalCartPayableAmount" value="{{$cart_total['payable_amount']+$cart_total['shipping_charge']}}">
                                            </tr>
                                            <tr id='couponDiscountTr'>
                                            </tr>
                                            <tr>
                                                <td colspan='5' align='right'><strong>Total Amount</strong></td>
                                                <td align='right' id="cartPayable">₹ {{$cart_total['payable_amount'] + $cart_total['shipping_charge']}}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

    	            	<div class="form-group">    	            	
                            {{ Form::submit('Place Order', array('class'=>'btn btn-success')) }}  
    	            	</div>
    	            	
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
            $("#brand").change(function(){
                var brand = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"GET",
                    url:"{{url('admin/order/invoice/product')}}"+"/"+brand,
                    success:function(data){
                        if (data.data && data.data.length > 0) {
                            let productHtml = `<option value="">Select Product</option>`;
                            $.each(data.data, function(key, item){
                                console.log(item);
                                productHtml+=`<option value="${item.product_size_id}" data-jar="${item.jar_available_status}">${item.name} (${item.size_name})</option>`;
                            });
                            $("#product").html(productHtml);
                        }
                        console.log(data.data);
                    }
                });
            });

            $("#coupon_id").change(function(){
                let couponId = $(this).val();
                let userId = $("#order_user_id").val();
                if (couponId) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type:"GET",
                        url:"{{url('admin/order/invoice/coupon/apply')}}"+"/"+userId+"/"+couponId,
                        beforeSend : function(){
                            $("#couponLoader").html(`<i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>`);
                        },
                        success:function(data){
                            $("#couponLoader").html("");
                            $("#couponDiscountTr").html(``);
                            console.log(data);
                            if (data) {
                                let discount = parseFloat(data);
                                let payableAmount = parseFloat($("#totalCartPayableAmount").val());
                                $("#couponDiscountTr").html(`<td colspan='5' align='right'>Coupon Discount</td>
                                <td align='right'>₹ ${discount}</td>`);
                                $("#cartPayable").html(payableAmount-discount);
                            } else {
                                $('#coupon_id option:first').prop('selected',true);
                                $("#cartPayable").html($("#totalCartPayableAmount").val());
                                $("#couponLoader").html(data.message);
                            }
                            console.log(data);
                        }
                    });
                }
            });
        });

        function checkJar() {
            let isJar = $('select#product').find(':selected').data('jar');
            console.log(isJar);
            if (isJar == 1) {
                $("#is_jar").prop('disabled',false);
            } else {
                $("#is_jar").prop('disabled',true);                
            }
        }
    </script>
 @endsection


        
    