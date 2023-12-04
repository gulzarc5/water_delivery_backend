@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
     <!-- top tiles -->
     <div class="row tile_count">
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count" style="text-align: center">
        <span class="count_top"><i class="fa fa-archive"></i> Total Users</span>
        <div class="count green">{{$data->total_user}}</div>
      </div>
   
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"  style="text-align: center">
          <span class="count_top"><i class="fa fa-user"></i> Total Sizes</span>
          <div class="count green">{{$data->total_sizes}}</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"  style="text-align: center">
          <span class="count_top"><i class="fa fa-user"></i> Total Products</span>
          <div class="count green">{{$data->products}}</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"  style="text-align: center">
          <span class="count_top"><i class="fa fa-user"></i> New Orders</span>
          <div class="count green">{{ $data->newOrders}}</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"  style="text-align: center">
        <span class="count_top"><i class="fa fa-briefcase"></i>Bulk Orders New</span>
        <div class="count green">{{$data->bulkOrders}}</div>
      </div>
      <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"  style="text-align: center">
          <span class="count_top"><i class="fa fa-user"></i> Refund Request</span>
          <div class="count green">{{ $data->refund_request}}</div>
      </div>
    </div> 
    <!-- /top tiles -->
  @if (Auth::guard('admin')->user()->user_type == 1 || Auth::guard('admin')->user()->user_type == 2)
    <div class="row">
      <div class="col-md-12">
        <div class="x_panel">
          <div class="x_title">
              <h2>Recent Orders</h2>
              <div class="clearfix"></div>
          </div>
          <div>
            <div class="x_content">
              <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr>
                      <th>Sl No</th>
                      <th>Order ID</th>
                      <th>Total Amount</th>
                      <th>Payment Type</th>
                      <th>Payment Status</th>
                      <th>Order Status</th>
                      <th>Delivery Date</th>
                      <th>Order Date</th>
                  </tr>
                </thead>
                <tbody class="form-text-element">
                  @foreach($recentOrders as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->order_id }}</td>
                      <td>{{$item->total_sale_price - ($item->coins_used+$item->coupon_discount)}}</td>
                      <td>
                        @if ($item->payment_type == 1) 
                            <label class='label label-success'>Online</label>
                        @elseif($item->payment_type == 2) 
                            <label class='label label-warning'>COD</label>
                        @else
                          <label class='label label-primary'>Subscription</label>
                        @endif   
                      </td>
                      <td>
                        @if($item->payment_status == 1)
                            <label class='label label-warning'>Pending</label>
                        @elseif ($item->payment_status == 2)
                          <label class='label label-danger'>Failed</label>
                        @else
                            <label class='label label-success'>Paid</label>
                        @endif
                      </td>
                      <td>
                        @if ($item->status == 1)
                            <label class='label label-warning'>New</label>
                        @elseif ($item->status == 2)
                            <label class='label label-primary'>Accepted</label>
                        @elseif ($item->status == 3)
                            <label class='label label-info'>Out For Delivery</label>
                        @elseif ($item->status == 4)
                            <label class='label label-success'>Delivered</label>
                        @else
                            <label class='label label-danger'>Cancelled</label>
                        @endif  
                    </td>
                      <td>{{$item->delivery_schedule_date}}</td>
                      <td>{{$item->created_at->toDateString()}}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
              <a href="{{route('admin.order.new_list')}}" class="btn btn-round btn-primary btn-xs">ViewMore</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif

  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
            <h2>Bulk Orders</h2>
            <div class="clearfix"></div>
        </div>
        <div>
          <div class="x_content">
            <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action">
              <thead>
                <tr>
                    <th>Sl No</th>
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Brand</th>
                    <th>Size</th>
                    <th>Status</th>
                    <th>Quantity</th>
                    <th>Address</th>
                    <th>Date</th>
                </tr>
              </thead>
              <tbody class="form-text-element">
                @foreach($bulk_orders as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->mobile}}</td>
                    <td>{{$item->brand->name ?? null}}</td>
                    <td>{{$item->size->name ?? null}}</td>
                    <td>
                      @if ($item->status == 1) 
                          <label class='label label-primary'>New</label>
                      @elseif($item->status == 2) 
                          <label class='label label-info'>Accepted</label>
                      @elseif($item->status == 3) 
                          <label class='label label-warning'>Processing</label>
                      @elseif($item->status == 4) 
                          <label class='label label-success'>Completed</label>
                      @elseif($item->status == 5) 
                          <label class='label label-success'>Cancelled</label>
                      @endif   
                  </td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->address}}</td>    
                    <td>{{$item->created_at->toDateString()}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            </div>
            <a href="{{route('admin.bulk.order_list')}}" class="btn btn-round btn-primary btn-xs">ViewMore</a>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
