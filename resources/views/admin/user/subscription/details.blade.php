@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" id="printable">
                <p style="font-size:24px;text-align:center">Subscription Details</p>
                <div class="x_title" style="border-bottom: white;">

                    {{--//////////////////// Shipping Details And Billing Details ///////////////////--}}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="col-md-12 col-xs-12 col-sm-12" style="padding-top: 16px;">
                            <table class="table">
                            <thead>
                                <tr style="background-color: #0089ff;color:white ">
                                <th style="min-width: 125px;">Billing Info</th>
                                <th>Shipping Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td>
                                    <table>
                                        <tr>
                                            <th>Name :</th>
                                            <td>{{$subscription->user->name ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email :</th>
                                            <td>{{$subscription->user->email ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile :</th>
                                            <td>{{$subscription->user->mobile ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>State :</th>
                                            <td>{{$subscription->user->state ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>City :</th>
                                            <td>{{$subscription->user->city ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address :</th>
                                            <td>{{$subscription->user->address ?? null}}</td>
                                        </tr>
                                     
                                    </table>
                                </td>

                                <td>

                                    <table>
                                        <tr>
                                            <th>Name : </th>
                                            <td>{{$subscription->address->name ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile : </th>
                                            <td>{{$subscription->address->mobile ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>House/Flat No : </th>
                                            <td>{{$subscription->address->house_no ?? null}},{{$subscription->address->flat_no ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address One : </th>
                                            <td>{{$subscription->address->address_one ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address Two : </th>
                                            <td>{{$subscription->address->address_two ?? null}}</td>
                                        </tr>

                                        <tr>
                                            <th>LandMark : </th>
                                            <td>{{$subscription->address->landmark ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>Pin : </th>
                                            <td>{{$subscription->address->pin ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address Type :</th>
                                            <td>
                                                @if ($subscription->address->address_status == 1)
                                                    <span class='label label-success' style='color:white'>Home</span>
                                                @else
                                                    <span class='label label-info' style='color:white'>Office</span>
                                                @endif
                                            </td>
                                        </tr>
                                       
                                    </table>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                {{-- ////////////////// Order Details /////////////////////////////--}}
                <div class="x_content table-responsive">
                    <div class="col-md-12 col-xs-12 col-sm-12" style="padding-top: 16px;">                        
                        <table class="table">
                            <thead>
                                <tr style="background-color: #0089ff;color:white ">
                                    <th colspan="8" style="text-align:center">Subscription</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="left">
                                    <td class="product-name-plan" colspan="5" >
                                        <h4>{{$subscription->brand}} ( {{$subscription->size}} )</h4>
                                        <h6>{{$subscription->plan_name}} ({{$subscription->plan_duration}} Days)</h6>
                                    </td>
                                    <td class="product-name-plan" colspan="3" >
                                        <img class="sub-info-table-img" src={{asset('backend_images/thumb/'.$subscription->brandItem->image.'')}}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Product Quantity</th>
                                    <th>Product Frequency</th>
                                    <th>Is Jar added</th>
                                    <th>Plan Start</th>
                                    <th>Plan End</th>
                                </tr>
                                <tr>
                                    <th>{{$subscription->quantity}}</th>
                                    <td>
                                        @if ($subscription->frequency == 1)
                                            <label class="label label-success">Daily</label>
                                        @elseif($subscription->frequency == 2)
                                            <label class="label label-info">Alternative Days</label>
                                        @else
                                            <label class="label label-warning">Weekly</label>
                                        @endif
                                    </th>
                                    <td>
                                        @if ($subscription->is_jar == 1)
                                            <label class="label label-success">Yes</label>
                                        @elseif($subscription->is_jar == 2)
                                            <label class="label label-info">No</label>
                                        @endif
                                    </th>
                                    <td>{{$subscription->plan_start_date}}</th>
                                    <td>{{$subscription->plan_end_date}}</th>
                                </tr>
                                <tr>
                                    <th>Total Order</th>
                                    <th>Order Delivered</th>
                                    <th>Total MRP</th>
                                    <th>Total Discount</th>
                                    <th>Total Price</th>
                                </tr>
                                <tr>
                                    <th>{{$subscription->plan_start_date}}</th>
                                    <td>{{$subscription->plan_end_date}}</th>
                                    <td>₹ {{ number_format($subscription->total_mrp ,2,".",'') }}</th>
                                    <td>₹ {{ number_format($subscription->total_mrp-$subscription->total_amount ,2,".",'') }}</th>
                                    <td>₹ {{ number_format($subscription->total_amount ,2,".",'') }}</th>
                                </tr>
                                <tr>
                                    <th>Payment Id</th>
                                    <th>Payment Request Id</th>
                                    <th>Payment Status</th>
                                    <th>Status</th>
                                    <th>Refund</th>
                                    <th>Cancellation</th>
                                    <th>Order From</th>
                                    <th>Order Date</th>
                                </tr>
                                <tr>
                                    <th>{{$subscription->payment_id}}</th>
                                    <th>{{$subscription->payment_request_id}}</th>
                                    <th>
                                        @if ($subscription->payment_status == 1)
                                            <label class="label label-success">Pending</label>
                                        @elseif($subscription->payment_status == 2)
                                            <label class="label label-info">Fail</label>
                                        @else
                                            <label class="label label-warning">Paid</label>
                                        @endif
                                    </th>
                                    <th>
                                        @if ($subscription->status == 1)
                                            <label class="label label-warning">InActive</label>
                                        @elseif($subscription->status == 2)
                                            <label class="label label-info">Activated</label>
                                        @elseif($subscription->status == 3)
                                            <label class="label label-warning">Expired</label>
                                        @else
                                            <label class="label label-warning">Cancelled</label>
                                        @endif
                                    </th>
                                    <td>
                                        @if ($subscription->is_refund == 1)
                                            <label class="label label-warning">Refund Requested</label>
                                        @elseif($subscription->is_refund == 2)
                                            <label class="label label-info">Refunded</label>
                                        @endif
                                    </th>
                                    <td>
                                        @if ($subscription->is_cancellable == 1)
                                            <label class="label label-warning">Yes</label>
                                        @elseif($subscription->is_cancellable == 2)
                                            <label class="label label-info">No</label>
                                        @endif
                                    </th>
                                    <td>
                                        @if ($subscription->order_from == 1)
                                            <label class="label label-warning">App</label>
                                        @elseif($subscription->order_from == 2)
                                            <label class="label label-info">Admin</label>
                                        @endif
                                    </th>
                                    <td>{{$subscription->created_at->toDateString()}}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                        <button class="btn btn-info" id="print-btn" onclick="printDiv()">Print</button>
                            <a class="btn btn-danger" onclick="window.close()" id="backprint">Close</a>
                        </div>
                    </div>
                    <div id="thanks_msg"></div>
            </div>
          </div>
        </div>
      </div>
</div>


 @endsection

@section('script')

<script type="text/javascript">
    function printDiv() {
       var printContents = document.getElementById("printable").innerHTML;
       var originalContents = document.body.innerHTML;

       document.body.innerHTML = printContents;
      
       //document.getElementById("backprint").hide();
       element = document.getElementById('backprint');
       element.style.display = "none";

        element = document.getElementById('print-btn');
       element.style.display = "none";

       window.print();

       element.style.display = "";
       document.getElementById("thanks_msg").innerHTML ="";
       document.body.innerHTML = originalContents;
    }
  </script>

 @endsection
