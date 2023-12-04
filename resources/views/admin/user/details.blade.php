@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">

    <div class="">

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>User Details</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if (isset($user_details) && !empty($user_details))
                    <div class="col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5;">
                       
                        {{-- <p>{{$product->p_short_desc}}</p> --}}
                        <div class="row product-view-tag">
                            <h5 class="col-md-4 col-sm-12 col-xs-12"><strong>Name:</strong>
                                    {{$user_details->name}}
                            </h5>
                            
                            <h5 class="col-md-4 col-sm-12 col-xs-12"><strong>Mobile:</strong>
                                {{$user_details->mobile }}
                            </h5>
                            <h5 class="col-md-4 col-sm-4 col-xs-12"><strong>Status :</strong>
                                @if ($user_details->status == '1')
                                    <button class="btn btn-sm btn-primary">Enabled</button>
                                @else
                                    <button class="btn btn-sm btn-danger">Disabled</button>
                                @endif
                            </h5>
                            <h5 class="col-md-4 col-sm-4 col-xs-12"><strong>Gender :</strong>
                                @if ($user_details->gender == 'M')
                                    <button class="btn btn-sm btn-primary">Male</button>
                                @else
                                    <button class="btn btn-sm btn-warning">Female</button>
                                @endif
                            </h5>
                                               
                        </div>
                        <br/>

                    </div>
                   

                    @if (isset($user_details->addresses))
                        <div class="col-md-12">
                            <hr>
                            <h3>User Address
                                {{-- <a class="btn btn-warning" style="float:right" href="#">Edit Services</a> --}}
                            </h3>
                            <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>House No</th>
                                    <th>Flat No</th>
                                    <th>Address One</th>
                                    <th>Address Two</th>
                                    <th>Landmark</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user_details->addresses as $item)
                                    <tr>
                                        <td>{{$item->house_no}} </td>
                                        <td>{{$item->flat_no}}</td>
                                        <td>{{$item->address_one}}</td>
                                        <td>{{$item->address_two}}</td>
                                        <td>{{$item->Landmark}}</td>
                                        <td>{{$item->name}}</td>
                                        
                                        <td>{{$item->mobile}}</td>
                                        
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    @endif
                    @if (isset($subscriptions) && !empty($subscriptions))
                        <div class="col-md-12">
                            <hr>
                            <h3>User Subscriptions
                                {{-- <a class="btn btn-warning" style="float:right" href="#">Edit Services</a> --}}
                            </h3>
                            <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Plan</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Payment Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscriptions as $item)
                                    <tr>
                                        <td>{{$item->brand}} ( {{$item->size}} ) </td>
                                        <td>{{$item->plan_name}} ({{$item->plan_duration}} Days)</td>
                                        <td>{{$item->plan_start_date}}</td>
                                        <td>{{$item->plan_end_date}}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                <label class="label label-warning">InActive</label>
                                            @elseif($item->status == 2)
                                                <label class="label label-info">Activated</label>
                                            @elseif($item->status == 3)
                                                <label class="label label-warning">Expired</label>
                                            @else
                                                <label class="label label-warning">Cancelled</label>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->payment_status == 1)
                                                <label class="label label-success">Pending</label>
                                            @elseif($item->payment_status == 2)
                                                <label class="label label-info">Fail</label>
                                            @else
                                                <label class="label label-warning">Paid</label>
                                            @endif
                                        </td>
                                        
                                        <td>{{$item->created_at->toDateString()}}</td>
                                        <td><a href="{{route('admin.user.subscription.details',['subscription_id'=>$item->id])}}" class="btn btn-xs btn-info" target="_blank">View</a></td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    @endif
                @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->

 @endsection
