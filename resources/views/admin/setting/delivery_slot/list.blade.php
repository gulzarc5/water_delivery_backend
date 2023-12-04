@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
                    <h2>Delivery Slot List</h2>
                    <a class="btn btn-sm btn-info" style="float: right" href="{{route('admin.setting.slot_form')}}">Add New</a>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="category" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Name</th>
                              <th>Description</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>  
                              @isset($slots)
                                  @forelse ($slots as $item)
                                    <tr class="">
                                      <td class="">{{$loop->iteration}}</td>
                                      <td class="">{{$item->name}}</td>
                                      <td class="">{{$item->description}}</td>
                                      <td class="">
                                        @if ($item->status == 1)
                                            <label for="" class="label label-success"> Enabled</label>
                                        @else
                                          <label for="" class="label label-danger"> Disabled</label>
                                        @endif
                                      </td>
                                      <td>
                                        @if ($item->status == 1)
                                          <a href="{{route('admin.setting.slot_status',['slot_id'=>$item->id])}}" class="label label-danger"> Disabled</a>
                                        @else
                                          <a href="{{route('admin.setting.slot_status',['slot_id'=>$item->id])}}" class="label label-success"> Enabled</a>
                                        @endif
                                        <a href="{{route('admin.setting.slot_form',['slot_id'=>$item->id])}}" class="label label-warning"> Edit</a>
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