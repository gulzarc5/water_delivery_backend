@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
                    <h2>Slider List</h2>
                    <a class="btn btn-sm btn-info" style="float: right" href="{{route('admin.setting.slider_form')}}">Add New</a>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="sliders" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Caption</th>
                              <th style="width:237px">Image</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>  
                              @isset($sliders)
                                  @forelse ($sliders as $item)
                                    <tr class="">
                                      <td class="">{{$loop->iteration}}</td>
                                      <td class="">{{$item->caption}}</td>
                                      <td class=""><img src="{{asset('backend_images/'.$item->image)}}" style="width:auto;height:150px"></td>
                                      <td class="">
                                        @if ($item->status == 1)
                                            <label for="" class="label label-success"> Enabled</label>
                                        @else
                                          <label for="" class="label label-danger"> Disabled</label>
                                        @endif
                                      </td>
                                      <td>
                                        @if ($item->status == 1)
                                          <a href="{{route('admin.setting.slider_status',['slider_id'=>$item->id])}}" class="btn btn-danger btn-xs"> Disable</a>
                                        @else
                                          <a href="{{route('admin.setting.slider_status',['slider_id'=>$item->id])}}" class="label label-success"> Enable</a>
                                        @endif
                                        <a onclick="return confirm('Are you Sure? This Action Irreversible');" href="{{route('admin.setting.slider_delete',['slider_id'=>$item->id])}}" class="btn btn-danger btn-xs"> Delete</a>
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
            var table = $('#sliders').DataTable();
        });
     </script>
    
 @endsection