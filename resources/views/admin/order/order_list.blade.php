@extends('admin.template.admin_master')

@section('content')
<link rel="stylesheet" href="{{asset('admin/dialog_master/simple-modal.css')}}">
<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
                    <h2>Order List</h2>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content">
                        <table id="category" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Sl</th>
                              <th>Status</th>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Total Amount</th>
                              <th>Coin Used</th>
                              <th>Coupon Discount</th>
                              <th>Payable Amount</th>
                              <th>Payment Type</th>
                              <th>Payment Status</th>
                              <th>Schedule date</th>
                              <th>Schedule Type</th>
                              <th>Status</th>
                              <th>Order date</th>
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
      ajax: "{{ route('admin.order.new_list_ajax') }}",
      columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false,orderable: false},
          {data: 'status_data', name: 'status_data' ,searchable: true},
          {data: 'order_id', name: 'order_id' ,searchable: true},
          {data: 'user.name', name: 'user.name' ,searchable: true},            
          {data: 'total_sale_price', name: 'total_sale_price' ,searchable: true,render:function(data, type, row){
           
              return row.total_sale_price+row.shipping_charge
                             
          }}, 
          {data: 'coins_used', name: 'coins_used' ,searchable: true},   
          {data: 'coupon_discount', name: 'coupon_discount' ,searchable: true},   
          {data: 'payable_amount', name: 'payable_amount' ,searchable: true,render:function(data, type, row){
           
           return row.payable_amount+row.shipping_charge
                          
       }},   
          {data: 'payment_type', name: 'payment_type', render:function(data, type, row){
            if (row.payment_type == '1') {
              return "<label class='label label-success'>Online</label>"
            }else if (row.payment_type == '2'){
              return "<label class='label label-warning'>COD</label>"
            }else{
              return "<label class='label label-primary'>Subscription</label>"
            }                        
          }},  
          {data: 'payment_status', name: 'payment_status', render:function(data, type, row){
            if (row.payment_status == '1') {
              return "<label class='label label-warning'>Pending</label>"
            }else if (row.payment_status == '2'){
              return "<label class='label label-danger'>Failed</label>"
            }else{
              return "<label class='label label-success'>Paid</label>"
            }                        
          }},   
          {data: 'delivery_schedule_date', name: 'delivery_schedule_date' ,searchable: true},     
          {data: 'delivery_slot_id', name: 'delivery_slot_id', render:function(data, type, row){
            if (row.delivery_slot_id == '1') {
              return "Morning"
            }else{
              return "Evening"
            }                       
          }},
          {data: 'status', name: 'status', render:function(data, type, row){
            if (row.status == '1') {
              return "<label class='label label-warning'>New</label>"
            }else if (row.status == '2'){
              return "<label class='label label-primary'>Accepted</label>"
            } else if (row.status == '3'){
              return "<label class='label label-info'>Out For Delivery</label>"
            } else if (row.status == '4'){
              return "<label class='label label-success'>Delivered</label>"
            }else {
              return "<label class='label label-danger'>Cancelled</label>"
            }                        
          }},  
          {data: 'created_at', name: 'created_at' ,searchable: true},  
      ]
    });        
  });
</script>
<script src="{{asset('admin/dialog_master/simple-modal.js')}}"></script> 
<script>
  async function openModal(order_id,status,msg) {
    this.myModal = new SimpleModal("Attention!", msg);
      try {
        const modalResponse = await myModal.question();
        if (modalResponse) {
          $.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
          $.ajax({
              type:"GET",
              url:"{{url('admin/order/status/update/')}}"+"/"+order_id+"/"+status,
  
              beforeSend: function() {
                    // setting a timeout
                    if (status == 2) {
                      $("#status_"+order_id).html('<i class="fa fa-spinner fa-spin"></i>');             
                    }else if(status == 5){
                      $("#cancel_"+order_id).html('<i class="fa fa-spinner fa-spin"></i>');    
                    }else if(status == 3){
                      $("#status_"+order_id).html('<i class="fa fa-spinner fa-spin"></i>');    
                    }else if(status == 4){
                      $("#status_"+order_id).html('<i class="fa fa-spinner fa-spin"></i>');    
                    }
                },
              success:function(data){
                if (data) {
                  if (status == 2) {
                      $("#status_"+order_id).html('<button class="btn btn-info btn-xs"  onclick="openModal('+order_id+',3,'+"'Are You Sure Update Order On The Way'"+')">On The Way</button>');             
                  }else if(status == 5){
                    $("#status_"+order_id).html(''); 
                    $("#cancel_"+order_id).html('<span class="btn btn-xs btn-danger">Cancelled</span>'); 
                    $("#status_"+order_id).html('');
                  }else if(status == 3){
                    $("#status_"+order_id).html('<button class="btn btn-info btn-xs"  onclick="openModal('+order_id+',4,'+"'Are You Sure Update Order As Delivered'"+')">Delivered</button>'); 
                  }else if(status == 4){
                    $("#status_"+order_id).html(''); 
                    $("#status_"+order_id).html(''); 
                    $("#cancel_"+order_id).html('');
                  }
                }
              }
            });
        }
      } catch(err) {
        console.log(err);
      }
  }
</script>
@endsection