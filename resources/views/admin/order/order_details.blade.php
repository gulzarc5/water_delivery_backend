@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel" id="printable">
              <?php
                  // if (isset($_GET['msg'])) {
                  //   showMessage($_GET['msg']);
                  // }
              ?>
                <div class="x_title" style="border-bottom: white;">

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        {{--///////////////////// Company Address ///////////////////////--}}
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <img src="{{ asset('images/logo.jpeg')}}" height="150" style="height: 76px;margin-bottom: 18px; margin-right: -9px;">
                            {{-- <b style="font-size: 35px;color: #0194ea;">Ash</b>
                            <b style="font-size: 35px;color: #262161;">ia</b> --}}
                            <table>
                                <tr>
                                <th>Address : </th>
                                    <td>{{$invoice_setting->address}}</td>
                                </tr>

                                <tr>
                                <th>Phone : </th>
                                    <td>{{$invoice_setting->phone}}</td>
                                </tr>
                                @if (!empty($invoice_setting->gst))
                                    <tr>
                                        <th>GST No : </th>
                                        <td>{{$invoice_setting->gst}}</td>
                                    </tr>
                                @endif
                                <tr>
                                <th>Email Id : </th>
                                    <td>{{$invoice_setting->email}}</td>
                                </tr>
                            </table>
                        </div>

                        {{--///////////////// Invoice Details ////////////////////--}}
                        <div class="col-md-4 col-sm-4 col-xs-4">
                            <span style="font-size: 38px;color: black;font-weight: bold;">INVOICE</span>
                            <table>
                                <tr>
                                    <th>Invoice No : </th>
                                    <td>{{$order->order_id}}</td>
                                </tr>
                                <tr>
                                    <th>Invoice Date : </th>
                                    <td>{{$order->created_at}}</td>
                                </tr>
                                <tr>
                                    <th>Delivery Scheduled Date : </th>
                                    <td>{{$order->delivery_schedule_date}}</td>
                                </tr>
                                <tr>
                                    <th>Delivery Slot : </th>
                                    <td>
                                        @if ($order->deliverySlot->id == 1)
                                            <label class="label label-success">Morning</label>
                                        @else
                                            <label class="label label-info">Evening</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                <tr>
                                    <th>Payment Type : </th>
                                    <td>
                                        @if ($order->payment_type == 1)
                                            <label class="label label-success">Online</label>
                                        @elseif ($order->payment_type == 2)
                                            <label class="label label-primary">COD</label>
                                        @else
                                            <label class="label label-info">Subscription</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Payment Status : </th>
                                    <td>
                                        @if ($order->payment_status == 1)
                                            <label class="label label-warning">Pending</label>
                                        @elseif ($order->payment_status == 2)
                                            <label class="label label-danger">Failed</label>
                                        @elseif ($order->payment_status == 3)
                                            <label class="label label-info">Paid</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Order Status : </th>
                                    <td>
                                        @if ($order->status == 1)
                                            <label class="label label-warning">New</label>
                                        @elseif ($order->status == 2)
                                            <label class="label label-primary">Accepted</label>
                                        @elseif ($order->status == 3)
                                            <label class="label label-info">Out For Delivery</label>
                                        @elseif ($order->status == 4)
                                            <label class="label label-success">Delivered</label>
                                        @elseif ($order->status == 5)
                                            <label class="label label-danger">Cancelled</label>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Total Amount : </th>
                                    <td> Rs.{{ number_format(($order->total_mrp+$order->shipping_charge),2,".",'') }}</td>
                                </tr>
                                <tr>
                                    <th>Total Save : </th>
                                    <td> Rs.{{ number_format($order->total_mrp - $order->total_sale_price ,2,".",'') }}</td>
                                </tr>
                                @if ($order->coins_used > 0)                                    
                                    <tr>
                                        <th>Coin Used : </th>
                                        <td> Rs.{{ $order->coins_used}}</td>
                                    </tr>
                                @endif
                                @if ($order->coupon_discount > 0)                                    
                                    <tr>
                                        <th>Coupon Discount : </th>
                                        <td> Rs.{{ $order->coupon_discount}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Net Total : </th>
                                    <td> Rs.{{ number_format((($order->total_sale_price+$order->shipping_charge) -($order->coins_used+$order->coupon_discount)) ,2,".",'') }}</td>
                                </tr>

                            </table>
                        </div>
                    </div>

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
                                            <td>{{$order->user->name ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email :</th>
                                            <td>{{$order->user->email ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile :</th>
                                            <td>{{$order->user->mobile ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>State :</th>
                                            <td>{{$order->user->state ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>City :</th>
                                            <td>{{$order->user->city ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address :</th>
                                            <td>{{$order->user->address ?? null}}</td>
                                        </tr>
                                    </table>
                                </td>

                                <td>

                                    <table>
                                        <tr>
                                            <th>Name : </th>
                                            <td>{{$order->addrees->name ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile : </th>
                                            <td>{{$order->addrees->mobile ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>House/Flat No : </th>
                                            <td>{{$order->addrees->house_no ?? null}},{{$order->addrees->flat_no ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address One : </th>
                                            <td>{{$order->addrees->address_one ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address Two : </th>
                                            <td>{{$order->addrees->address_two ?? null}}</td>
                                        </tr>

                                        <tr>
                                            <th>LandMark : </th>
                                            <td>{{$order->addrees->landmark ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <th>Pin : </th>
                                            <td>{{$order->addrees->pin ?? null}}</td>
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
                                <th style="min-width: 125px;">Product</th>
                                <th>Brand</th>
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>Toatal Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($order_items) && (count($order_items) > 0))
                                    @foreach ($order_items as $item)

                                        <tr>
                                            <td>
                                                {{$item->productSize->product->name ?? null}} ( {{$item->productSize->size->name ?? null}} )
                                                @if ($item->is_jar == 1)
                                                    (With Empty Jar)
                                                @endif
                                                {{-- @if ($item->order_status == '5')
                                                    <button disabled type="button" class="btn btn-sm btn-danger"> Cancelled </button>
                                                    @php
                                                        $discount_item = (($item->quantity*$item->price)*$item->discount)/100;
                                                        $cancellation_amount += ($item->quantity*$item->price) - $discount_item;
                                                    @endphp
                                                @endif --}}
                                            </td>
                                            <td>{{$item->productSize->product->brand->name ?? null}}</td>
                                            <td>{{$item->quantity}} </td>
                                            <td>{{$item->mrp}} {{$item->is_jar == 1 ? '+ '.$item->jar_mrp : ''}}</td>
                                            <td>{{($item->mrp+ ($item->is_jar == 1 ? $item->jar_mrp : 0))*$item->quantity}} </td>
                                        </tr>

                                    @endforeach
                                @endif


                                <tr>
                                    <td colspan='4' align='right'>Sub Total : </td>
                                    <td>{{ number_format($order->total_mrp,2,".",'') }}</td>
                                </tr>
                                <tr>
                                    <td colspan='4' align='right'>Save : (-) </td>
                                    <td>{{ number_format($order->total_mrp - $order->total_sale_price ,2,".",'') }}</td>
                                </tr>
                                <tr>
                                    <td colspan='4' align='right'>Shipping & Handling: (+) </td>
                                    <td>
                                        @if ($order->shipping_charge > 0)
                                            {{ number_format($order->shipping_charge,2,".",'') }}
                                        @else                                            
                                            Free
                                        @endif
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan='4' align='right' >Net Total : (-)</td>
                                    <td>{{ number_format($order->total_sale_price+$order->shipping_charge,2,".",'') }}</td>
                                </tr>
                                @if ($order->coins_used > 0)                                    
                                    <tr>
                                        <td colspan='4' align='right' >Coin Discount : </td>
                                        <td>{{ $order->coins_used }}</td>
                                    </tr>
                                @endif
                                @if ($order->coupon_discount > 0)                                    
                                    <tr>
                                        <td colspan='4' align='right' >Coupon Discount : </th>
                                        <td> {{ number_format($order->coupon_discount,2,".",'') }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan='4' align='right' >Grand Total : </td>
                                    <td>{{ number_format((($order->total_sale_price+$order->shipping_charge) - ($order->coins_used+$order->coupon_discount)),2,".",'') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="col-md-5 col-xs-5 col-sm-5">
                        <table class="table">
                            <thead>
                            <tr style="background-color: #0089ff;color:white ">
                                <td>Notes</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td> * {{$invoice_setting->note1}}</td>
                            </tr>
                            <tr>
                                <td> * {{$invoice_setting->note2}}</td>
                            </tr>
                            <tr>
                                <td> * {{$invoice_setting->note3}} </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                        <div class="col-md-7 col-xs-7 col-sm-7">
                        <table class="table">
                            <thead>
                            <tr>
                                <td style=" text-align: center;">
                                <b style="color: #00adff;font-size: 25px;">Thanks</b><br>
                                <b>for shopping with us</b>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td> <img src="{{asset('images/'.$invoice_setting->image.'')}}" style="height: 169px;width: 543px;"></td>
                            </tr>

                            </tbody>
                        </table>
                        </div>

                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <a class="btn btn-info" href="{{route('admin.order.print',['id'=>$order->id])}}" target="_blank">Print</a>
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
