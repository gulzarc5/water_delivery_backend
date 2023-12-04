@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
                    <h2>Coupon List</h2>
                    <a class="btn btn-sm btn-info" style="float: right" href="{{route('admin.coupon_add_form')}}">Add New Coupon</a>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                    <table id="category" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sl</th>
                          <th>Coupon</th>
                          <th>Brand</th>
                          <th>Discount</th>
                          <th>Max Discount</th>
                          <th>User Type</th>
                          <th>Coupon Type</th>
                          <th>Expire Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if (isset($coupons) && !empty($coupons))
                        @php
                          $count=1;
                        @endphp
                            @foreach ($coupons as $item)
                                <tr>
                                    <td>{{$count++}}</td>
                                    <td>{{$item->coupon}}</td>
                                    <td>{{$item->brand->name ?? null}} - {{$item->size->name ?? null}}</td>
                                    <td>{{$item->discount}} %</td>
                                    <td>{{$item->max_discount}}</td>
                                    <td>
                                        @if ($item->user_type== '1')
                                          <span class="label label-primary">New</span>
                                        @elseif ($item->user_type== '2')
                                          <span class="label label-warning">Old</span>
                                        @else
                                        <span class="label label-success">Both</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->coupon_type== 'P')
                                          <span class="label label-primary">Product</span>
                                        @else
                                        <span class="label label-success">Shipping</span>
                                        @endif
                                    </td>
                                    <td>{{$item->expire_date}}</td>

                                    <td>
                                        @if ($item->status == '1')
                                        <a  class="btn btn-sm btn-primary" aria-disabled="true">Enabled</a>
                                        @else
                                        <a  class="btn btn-sm btn-danger" aria-disabled="true">Disabled</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('admin.coupon_view',['id'=>$item->id])}}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{route('admin.coupon_edit',['id'=>$item->id])}}" class="btn btn-sm btn-warning">Edit</a>
                                        @if ($item->status == '1')
                                        <a href="{{route('admin.coupon_status',['coupon'=>$item->id])}}" class="btn btn-sm btn-danger">Disable</a>
                                        @else
                                        <a href="{{route('admin.coupon_status',['coupon'=>$item->id])}}" class="btn btn-sm btn-primary">Enable</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                          <tr>
                            <td colspan="6" style="text-align: center">No Sub Category Found</td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
    	            </div>
    	        </div>
    	    </div>
    	</div>
    </div>
	</div>


 @endsection

@section('script')

     <script type="text/javascript">
         $(function () {
            var table = $('#category').DataTable();
        });
     </script>

 @endsection
