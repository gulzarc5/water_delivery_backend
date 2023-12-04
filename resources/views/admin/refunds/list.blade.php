@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
                    <h2>Refund List</h2>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content" id="pagination_data">                        
                        <table id="category" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>Sl</th>
                                <th>Action</th>
                                <th>Order Id</th>
                                <th>Order Type</th>
                                <th>Customer Name</th>
                                <th>Refund Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                              </tr>
                            </thead>
                            <tbody>  
                              @forelse ($refunds as $key => $item)
                                  <tr>
                                    <td>{{ $refunds->firstItem() + $key }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <a href="{{route('admin.refund.status',['refund_id'=>$item->id,'status'=>2])}}" onclick="return confirm('Are You Sure To Processed The Refund')" class='label label-primary'>Refund Processed</a>
                                            <a href="{{route('admin.refund.status',['refund_id'=>$item->id,'status'=>3])}}" onclick="return confirm('Are You Sure To Reject The Refund')" class='label label-danger'>Refund Reject</a>
                                        @endif
                                        

                                            <a href="{{route('admin.order.view',['order_id'=>$item->order_id])}}" class='label label-warning' target='_blank'>View Order</a>
                                    </td>
                                    <td>{{$item->order_id}}</td>
                                    <td>
                                        @if ($item->type == 1)
                                            <label class='label label-warning'>Water</label>
                                        @elseif ($item->type == 2)
                                            <label class='label label-primary'>Membership</label>
                                        @endif  
                                    </td>
                                    <td><a href="{{route('admin.user.details',['user_id'=>$item->user_id])}}"    target='_blank' style="color: #00a1ff;text-decoration: underline;">{{$item->user->name ?? null}}</a></td>
                                    <td>{{$item->amount}}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            <label class='label label-warning'>Requested</label>
                                        @elseif ($item->status == 2)
                                            <label class='label label-primary'>Refund Processed</label>
                                            <p>{{$item->refund_process_date}}</P>
                                        @elseif ($item->status == 3)
                                            <label class='label label-danger'>Rejected</label>
                                            <p>{{$item->refund_process_date}}</P>
                                        @endif  
                                    </td>
                                    <td>{{$item->created_at->toDateString()}}</td>
                                  </tr>
                              @empty                                
                                <tr>
                                  <td colspan="10" style="text-align: center">
                                    No Data Found
                                  </td>
                                </tr>
                              @endforelse
                            </tbody>
                          </table>
                          {!! $refunds->onEachSide(2)->links('pagination::bootstrap-4') !!}  
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