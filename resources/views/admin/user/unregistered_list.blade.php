@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
                    <h2>Unregistered User List</h2>
                    <a href="{{route('admin.unregistered.user.list_export')}}" style="float:right">Export And Download</a>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="category" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Mobile</th>
                              <th>Created At</th>
                            </tr>
                          </thead>
                          <tbody>  
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
    
            var table = $('#category').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.unregistered.user.list_ajax') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false,orderable: false},
                    {data: 'mobile', name: 'mobile' ,searchable: true},   
                    {data: 'created_date', name: 'created_date' ,searchable: true},
                ]
            });            
        });
     </script>
    
 @endsection