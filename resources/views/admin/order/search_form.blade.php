
@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Order Serach</h2>
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
                   
                        {{ Form::open(['method' => 'get','route'=>'admin.order.search_form_submit']) }}
                        <div class="form-group">
                            {{ Form::label('delivery_schedule_date', 'Delivery Shchdule Date')}} 
                            {{ Form::date('delivery_schedule_date',null,array('class' => 'form-control')) }}
                            @if($errors->has('delivery_schedule_date'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('delivery_schedule_date') }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <h1 style="text-align: center;">Or</h1>
                        <div class="form-group col-md-6">
                            {{ Form::label('from_date', 'Order From date')}} 
                            {{ Form::date('from_date',null,array('class' => 'form-control')) }}
                            @if($errors->has('from_date'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('from_date') }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            {{ Form::label('to_date', 'Order To date')}} 
                            {{ Form::date('to_date',null,array('class' => 'form-control')) }}
                            @if($errors->has('to_date'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('to_date') }}</strong>
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
                            <label for="payment_type">Payment Type</label>
                            <select class="form-control" name="payment_type" id="payment_type">
                                <option value="">Select Payment Type</option>
                                <option value="1">Online</option>
                                <option value="2">COD</option>
                                <option value="3">Subscription</option>
                                <option value="A">All</option>
                            </select>
                            @if($errors->has('payment_type'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('payment_type') }}</strong>
                                </span>
                            @enderror
                        </div> 
                        <div class="form-group col-md-6">
                            <label for="payment_status">Payment Status</label>
                            <select class="form-control" name="payment_status" id="payment_status">
                                <option value="">Select Payment Status</option>
                                <option value="1">Pending</option>
                                <option value="2">Failed</option>
                                <option value="3">Paid</option>
                                <option value="A">All</option>
                            </select>
                            @if($errors->has('payment_status'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('payment_status') }}</strong>
                                </span>
                            @enderror
                        </div> 
                        <div class="form-group col-md-6">
                            <label for="order_status">Order Status</label>
                            <select class="form-control" name="order_status" id="order_status">
                                <option value="">Select Order Status</option>
                                <option value="1">New</option>
                                <option value="2">Accepted</option>
                                <option value="3">Out For delivery</option>
                                <option value="4">Delivered</option>
                                <option value="5">Cancelled</option>
                                <option value="A">All</option>
                            </select>
                            @if($errors->has('order_status'))
                                <span class="invalid-feedback" role="alert" style="color:red">
                                    <strong>{{ $errors->first('order_status') }}</strong>
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
@endsection