@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
                    <h2>Order Search List</h2>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content" id="pagination_data">                        
                    @include('admin.order.pagination.order_search_pagination')
    	            </div>
    	        </div>
    	    </div>
    	</div>
    </div>
	</div>


 @endsection

 @section('script')
 <script>
     $(document).ready(function () {
         $(document).on('click','.pagination a',function(event){
             event.preventDefault();
             var page = $(this).attr('href').split('page=')[1];
             // alert(page);
             fetchData(page);
         });
     });

     function GetParameterValues(param){
         var url = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&'); 
         for (var i = 0; i < url.length; i++) {  
             var urlparam = url[i].split('=');  
             if (urlparam[0] == param) {  
                 return urlparam[1];  
             }  
         }
     }

     function fetchData(page) {
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
         let delivery_schedule_date = GetParameterValues('delivery_schedule_date');
         let from_date = GetParameterValues('from_date');
         let to_date = GetParameterValues('to_date');
         let delivery_slot = GetParameterValues('delivery_slot');
         let payment_type = GetParameterValues('payment_type');
         let payment_status = GetParameterValues('payment_status');
         let order_status = GetParameterValues('order_status');
         $.ajax({
             type:"GET",
             url:"{{route('admin.order.search_form_submit')}}",
             data:{
                 delivery_schedule_date:delivery_schedule_date,
                 from_date:from_date,
                 to_date:to_date,
                 delivery_slot:delivery_slot,
                 payment_type:payment_type,
                 payment_status:payment_status,
                 order_status:order_status,
                 page:page,
             },
             success:function(data){
                 $("#pagination_data").html(data);
             }
         });
     }
 </script>
@endsection