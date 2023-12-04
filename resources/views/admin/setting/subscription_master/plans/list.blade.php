@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
                    <h2>Plan List</h2>
                    <a class="btn btn-sm btn-info" style="float: right" href="{{route('admin.setting.plan_details_form')}}">Add New</a>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="category" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Plan Name</th>
                              <th>Plan Type</th>
                              <th>Plan Duration</th>
                              <th>Brand</th>
                              <th>Size</th>
                              <th>MRP</th>
                              <th>Price</th>
                              <th>Jar MRP</th>
                              <th>Jar Price</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>  
                              @isset($plans)
                                  @forelse ($plans as $item)
                                    <tr class="">
                                      <td class="">{{$loop->iteration}}</td>
                                      <td class="">{{$item->planMaster->name ?? null}}</td>
                                      <td class="">
                                        @if (($item->planMaster->type ?? null) == 1)
                                            <label for="" class="label label-success"> By Duration</label>
                                        @else
                                          <label for="" class="label label-danger"> By Refil</label>
                                        @endif
                                      </td>
                                      <td class="">{{$item->planMaster->duration ?? null}} Days</td>
                                      <td class="">{{$item->brand->name ?? null}}</td>
                                      <td class="">{{$item->size->name ?? null}}</td>
                                      <td class="">{{$item->mrp }}</td>
                                      <td class="">{{$item->price }}</td>
                                      <td class="">{{$item->jar_mrp }}</td>
                                      <td class="">{{$item->jar_price }}</td>
                                     
                                      <td class="">
                                        @if ($item->status == 1)
                                            <label for="" class="label label-success"> Enabled</label>
                                        @else
                                          <label for="" class="label label-danger"> Disabled</label>
                                        @endif
                                      </td>
                                      <td>
                                        @if ($item->status == 1)
                                          <a href="{{route('admin.setting.plan_details_status',['plan_id'=>$item->id])}}" class="label label-danger"> Disabled</a>
                                        @else
                                          <a href="{{route('admin.setting.plan_details_status',['plan_id'=>$item->id])}}" class="label label-success"> Enabled</a>
                                        @endif
                                        <a href="{{route('admin.setting.plan_details_form',['plan_id'=>$item->id])}}" class="label label-warning"> Edit</a>
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