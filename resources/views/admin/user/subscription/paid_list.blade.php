@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
                    <h2>User Paid Subscription List</h2>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="category" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>User Name</th>
                              <th>User Mobile</th>
                              <th>Plan Name</th>
                              <th>Brand</th>
                              <th>Size</th>
                              <th>Plan Type</th>
                              <th>Quantity</th>
                              <th>Frequency</th>
                              <th>Plan Start Date</th>
                              <th>Total Order</th>
                              <th>Order Consumed</th>
                              <th>Total MRP</th>
                              <th>Total Price</th>
                              <th>Total Discount</th>
                              <th>Payment Request ID</th>
                              <th>Payment ID</th>
                              <th>Status</th>
                              <th>Date</th>
                              <th>Acion</th>
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
                ajax: "{{ route('admin.user.subscription.paid_list_ajax') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false,orderable: false},
                    {data: 'user.name', name: 'user.name' ,searchable: true},
                    {data: 'user.mobile', name: 'user.mobile' ,searchable: true},            
                    {data: 'plan_name', name: 'plan_name' ,searchable: true},   
                    {data: 'brand', name: 'brand' ,searchable: true},   
                    {data: 'size', name: 'size' ,searchable: true},   
                    {data: 'plan_type', name: 'plan_type', render:function(data, type, row){
                      if (row.plan_type == '1') {
                        return "By Duration"
                      }else{
                        return "By Refils"
                      }                        
                    }},  
                    {data: 'quantity', name: 'quantity' ,searchable: true},   
                    {data: 'frequency', name: 'frequency', render:function(data, type, row){
                      if (row.frequency == '1') {
                        return "Daily"
                      }else if(row.frequency == '2'){
                        return "Alternative Days"
                      }else if(row.frequency == '3'){
                        return "Weekly"
                      }else{
                        return "By Refil"
                      }                       
                    }},
                    {data: 'plan_start_date', name: 'plan_start_date' ,searchable: true},   
                    {data: 'total_order', name: 'total_order' ,searchable: true},   
                    {data: 'order_consumed', name: 'order_consumed' ,searchable: true},   
                    {data: 'total_mrp', name: 'total_mrp' ,searchable: true},   
                    {data: 'total_amount', name: 'total_amount' ,searchable: true},   
                    {data: 'discount', name: 'discount' ,searchable: true},   
                    {data: 'payment_request_id', name: 'payment_request_id' ,searchable: true},   
                    {data: 'payment_id', name: 'payment_id' ,searchable: true},   
                    {data: 'status', name: 'status', render:function(data, type, row){
                      if (row.status == '1') {
                        return "In Active"
                      }else if (row.status == '2'){
                        return "Active"
                      }  else{
                        return "Expired"
                      }                        
                    }},  
                    {data: 'created_at', name: 'created_at' ,searchable: true},  
                    {data: 'action', name: 'action' ,searchable: true},  
                ]
            });            
        });
     </script>
    
 @endsection