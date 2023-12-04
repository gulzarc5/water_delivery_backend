@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">

    <div class="">

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Coupon Details</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if (isset($coupon) && !empty($coupon))
                    <div class="col-md-6 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5;">
                        <h3 class="prod_title">{{$coupon->brand->name ?? null}} - {{$coupon->size->name ?? null}} 
                        </h3>
                        {{-- <p>{{$product->p_short_desc}}</p> --}}
                        <div class="row product-view-tag">
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Coupon Code:</strong>
                                    {{$coupon->coupon}}
                            </h5>
                            
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Discount:</strong>
                                {{$coupon->discount}}
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Max Discount :</strong>
                                {{$coupon->max_discount}}
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>User Type :</strong>
                                @if ($coupon->user_type == '1')
                                    <button class="btn btn-sm btn-primary">News</button>
                                @elseif ($coupon->user_type == '2')
                                    <button class="btn btn-sm btn-info">Old</button>
                                @else
                                    <button class="btn btn-sm btn-success">Both</button>
                                @endif
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Coupon Type :</strong>
                                @if ($coupon->coupon_type== 'P')
                                    <span class="label label-primary">Product</span>
                                @else
                                    <span class="label label-success">Shipping</span>
                                @endif
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Expire Date:</strong>
                                {{$coupon->expire_date}}
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Status :</strong>
                                @if ($coupon->user_type == '1')
                                    <button class="btn btn-sm btn-primary">Enabled</button>
                                @else
                                    <button class="btn btn-sm btn-danger">Disabled</button>
                                @endif
                            </h5>                         
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Description :</strong>
                                {{$coupon->description}}
                            </h5>                         
                        </div>
                        <br/>

                    </div>
                    @if (isset($coupon->image))
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <h3 class="prod_title">Image</h3>
                            <div class="product-image" style="text-align: center">
                                <img src="{{asset('backend_images/thumb/'.$coupon->image.'')}}" alt="..." style="height: 200px;width: 300px;"/>
                            </div>
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
