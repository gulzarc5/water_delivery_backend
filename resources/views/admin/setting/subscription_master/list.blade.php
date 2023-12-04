@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
                    <h2>Subscription Master List</h2>
                    <a class="btn btn-sm btn-info" style="float: right" href="{{route('admin.setting.plan_master_form')}}">Add New</a>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="category" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Name</th>
                              <th>Image</th>
                              <th>Duration</th>
                              <th>Type</th>
                              <th>Status</th>
                              <th>Description</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>  
                              @isset($masters)
                                  @forelse ($masters as $item)
                                    <tr class="">
                                      <td class="">{{$loop->iteration}}</td>
                                      <td class="">{{$item->name}}</td>
                                      <td class=""><img height="100" src="{{asset('backend_images/thumb/'.$item->image.'')}}" alt="" class=""></td>
                                      <td class="">{{$item->duration}}</td>
                                      <td class="">
                                        @if ($item->type == 1)
                                            <label for="" class="label label-success">By Duration</label>
                                        @else
                                          <label for="" class="label label-info"> By Refil </label>
                                        @endif
                                      </td>
                                      <td class="">
                                        @if ($item->status == 1)
                                            <label for="" class="label label-success"> Enabled</label>
                                        @else
                                          <label for="" class="label label-danger"> Disabled</label>
                                        @endif
                                      </td>
                                      <td class="">{!!$item->description!!}</td>
                                      <td>
                                        @if ($item->status == 1)
                                          <a href="{{route('admin.setting.plan_master_status',['master_id'=>$item->id])}}" class="label label-danger"> Disabled</a>
                                        @else
                                          <a href="{{route('admin.setting.plan_master_status',['master_id'=>$item->id])}}" class="label label-success"> Enabled</a>
                                        @endif
                                        <a href="{{route('admin.setting.plan_master_form',['master_id'=>$item->id])}}" class="label label-warning"> Edit</a>
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