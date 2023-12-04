@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
                    <h2>User List</h2>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="category" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Name</th>
                              <th>Mobile</th>
                              <th>Gender</th>
                              <th>Registered From</th>
                              <th>Status</th>
                              <th>Created At</th>
                              <th>Action</th>
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
                ajax: "{{ route('admin.user.list_ajax') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false,orderable: false},
                    {data: 'name', name: 'name' ,searchable: true},        
                    {data: 'mobile', name: 'mobile' ,searchable: true},   
                    {data: 'gender', name: 'gender', render:function(data, type, row){
                      if (row.gender == 'M') {
                        return "Male"
                      }else if(row.gender == 'F'){
                        return "Female"
                      }else{
                        return "Not Selected"
                      }                      
                    }},          
                    {data: 'registered_through', name: 'registered_through', render:function(data, type, row){
                      if (row.registered_through == '1') {
                        return "App"
                      }else if(row.registered_through == '2'){
                        return "Marketing"
                      }else{
                        return "Admin"
                      }                      
                    }},          
                    
                    {data: 'status', name: 'status', render:function(data, type, row){
                      if (row.status == '1') {
                        return "<label label-success>Active</label>"
                      }else{
                        return "<label label-danger>Not Active</label>"
                      }                        
                    }},
                    {data: 'created_at', name: 'created_at' ,searchable: true},  
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });            
        });
     </script>
    
 @endsection