@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
                    <h2>Product Sizes List</h2>
                    {{-- <a class="btn btn-sm btn-info" style="float: right" href="{{route('admin.setting.brand_form')}}">Add New</a> --}}
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="category" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl No</th>
                              <th>Product Name</th>
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
                              @isset($product_sizes)
                                  @forelse ($product_sizes as $item)
                                    <tr class="">
                                      <td class="">{{$loop->iteration}}</td>
                                      <td>{{$item->product->name ?? null}} </td>
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
                                  @empty
                                      
                                  @endforelse
                              @endisset
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