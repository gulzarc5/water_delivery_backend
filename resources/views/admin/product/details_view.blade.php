@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">

    <div class="">

      <div class="clearfix"></div>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Client Details</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if (isset($product) && !empty($product))
                    <div class="col-md-12 col-sm-12 col-xs-12" style="border:0px solid #e5e5e5;">
                        <h3 class="prod_title">{{$product->name}} 
                            <a href="{{route('admin.product.from',['product_id'=>$product->id])}}" class="btn btn-warning" style="float:right;margin-top: -8px;"><i class="fa fa-edit"></i></a>
                        </h3>
                        {{-- <p>{{$product->p_short_desc}}</p> --}}
                        <div class="row product-view-tag">
                            <h5 class="col-md-4 col-sm-12 col-xs-12"><strong>Name:</strong>
                                    {{$product->name}}
                            </h5>
                            
                            <h5 class="col-md-4 col-sm-12 col-xs-12"><strong>Brand:</strong>
                                {{$product->brand->name ?? null}}
                            </h5>
                            <h5 class="col-md-4 col-sm-4 col-xs-12"><strong>Status :</strong>
                                @if ($product->status == '1')
                                    <button class="btn btn-sm btn-primary">Enabled</button>
                                @else
                                    <button class="btn btn-sm btn-danger">Disabled</button>
                                @endif
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Short Description:</strong>
                                {{$product->short_description}}
                            </h5>
                            <h5 class="col-md-12 col-sm-12 col-xs-12"><strong>Long Description:</strong>
                                {!!$product->long_description!!}
                            </h5>                           
                        </div>
                        <br/>

                    </div>
                    @if (isset($product->images))
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3 class="prod_title">Images 
                                <a href="{{route('admin.product.images.view',['product'=>$product->id])}}" class="btn btn-warning" style="float:right;margin-top: -8px;"><i class="fa fa-edit"></i></a>
                            </h3>
                            <div class="product-image" style="text-align: center">
                                <img src="{{asset('backend_images/thumb/'.$product->image.'')}}" alt="..." style="height: 200px;width: 300px;"/>
                            </div>

                            <div class="product_gallery">
                                @foreach ($product->images as $item)
                                    @if ($product->image != $item->image)
                                    <a>
                                        <img src="{{asset('backend_images/thumb/'.$item->image.'')}}" alt="..." />
                                    </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if (isset($product->sizes))
                        <div class="col-md-12">
                            <hr>
                            <h3>Product Sizes
                                {{-- <a class="btn btn-warning" style="float:right" href="#">Edit Services</a> --}}
                            </h3>
                            <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Size</th>
                                    <th>MRP</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Coin Use</th>
                                    <th>Coin Generate</th>
                                    <th>Is jar Available</th>
                                    <th>Jar MRP</th>
                                    <th>Jar Price</th>
                                    <th>Jar Discount</th>
                                    <th>Status</th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->sizes as $item)
                                    <tr>
                                        <td>{{$item->size->name ?? null}} </td>
                                        <td>{{$item->mrp}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>{{$item->product_discount}}</td>
                                        <td>{{$item->coin_use}}</td>
                                        <td>{{$item->coin_generate}}</td>
                                        <td>
                                            @if($item->jar_available_status == 1)
                                               <label class="label label-success">Yes</label>
                                           @else
                                            <label class="label label-danger">No</label>
                                           @endif
                                        </td>
                                        <td>{{$item->jar_mrp}}</td>
                                        <td>{{$item->jar_price}}</td>
                                        <td>{{$item->jar_discount}}</td>                                       
                                        <td>
                                            @if($item->status == 1)
                                               <label class="label label-success">Enabled</label>
                                           @else
                                            <label class="label label-danger">Disabled</label>
                                           @endif
                                        </td>
                                        <td>
                                            @if($item->status == 1)
                                                <a href="{{route('admin.size.status',['size'=>$item->id])}}" class="label label-danger">Disable</a>
                                            @else
                                                <a href="{{route('admin.size.status',['size'=>$item->id])}}" class="label label-success">Enable</a>
                                            @endif
                                            <a href="{{route('admin.size.from',['product_id' => $item->product_id,'size_id'=>$item->id])}}" class="label label-warning">Edit</a>
                                        </td>
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
