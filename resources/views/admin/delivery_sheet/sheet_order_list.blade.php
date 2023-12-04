@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
    	<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
    	    <div class="x_panel">

    	        <div class="x_title">
                    <h2>Order List</h2>
                    <a href="#" class="btn btn-xs btn-primary" style="float:right" onclick="excelExport()">Export</a>
                    <a href="#" class="btn btn-xs btn-primary" style="float:right" target="_blank" onclick="receiptPrint()">Print All</a>
    	            <div class="clearfix"></div>
    	        </div>
    	        <div>
    	            <div class="x_content" id="pagination_data">                        
                        <table id="category" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>Sl</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Location</th>
                                {{-- <th>Sub Location</th> --}}
                                <th>Amount</th>
                                <th>Products</th>
                                <th>Jar Pickup</th>
                                <th>Date</th>
                              </tr>
                            </thead>
                            <tbody>  
                              @forelse ($orders as $key => $item)
                                  <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$item->order_id}}</td>
                                    <td>{{$item->user->name ?? null}}</td>
                                    <td>{{$item->user->mobile ?? null}}</td>
                                    <td>{{$item->addrees->mainLocation->name ?? null}},{{$item->addrees->subLocation->name ?? null}}</td>
                                    {{-- <td>{{$item->addrees->name ?? null}}<br>
                                        {{$item->addrees->mobile ?? null}}<br>
                                        {{$item->addrees->house_no ?? null}},
                                        {{$item->addrees->address_one ?? null}},
                                        {{$item->addrees->address_two ?? null}},
                                        {{$item->addrees->landmark ?? null}},
                                        {{$item->addrees->pin ?? null}},
                                    </td> --}}
                                    <td>
                                        @if ($item->payment_type == 1 && $item->payment_status == 3) 
                                            <label class='label label-success'>Paid</label>"
                                        @elseif($item->payment_type == 3) 
                                            <label class='label label-primary'>Paid</label>
                                        @elseif($item->payment_type == 2) 
                                            <label class='label label-warning'>{{$item->total_sale_price - ($item->coins_used+$item->coupon_discount)}}</label>
                                        @endif   
                                    </td>
                                    <td>
                                        @php
                                            $jar_count = 0;
                                        @endphp
                                        @foreach ($item->detail as $item1)
                                            <ul style="padding-left: 0;">
                                                {{$item1->productSize->product->name ?? null}}- ({{$item1->productSize->size->name ?? null}}) {{$item1->is_jar == 1 ? "( With Jar)" : null}}
                                            </ul><br>
                                            @if (($item1->productSize->jar_available_status == 1) && ($item1->is_jar == 2))
                                                @php
                                                    $jar_count+=1;
                                                @endphp
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{$jar_count}}</td>
                                    <td>{{$item->delivery_schedule_date}}</td>
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
                          {{-- {!! $orders->onEachSide(2)->links('pagination::bootstrap-4') !!}   --}}
    	            </div>
    	        </div>
    	    </div>
    	</div>
    </div>
	</div>
@endsection

@section('script')
    <script>
        function excelExport(){
            let dataArray = getUrlVars();
            let delivery_schedule_date = dataArray['delivery_schedule_date'];
            let delivery_slot = dataArray['delivery_slot'];
            let main_location = dataArray['main_location'];
            let sub_location = dataArray['sub_location'];
            let route = "{{route('admin.delivery.sheet.export')}}"+"?delivery_schedule_date="+delivery_schedule_date+"&delivery_slot="+delivery_slot+"&main_location="+main_location+"&sub_location="+sub_location;
            window.location.href = route;
            console.log(route);
        }
        function receiptPrint(){
            let dataArray = getUrlVars();
            let delivery_schedule_date = dataArray['delivery_schedule_date'];
            let delivery_slot = dataArray['delivery_slot'];
            let main_location = dataArray['main_location'];
            let sub_location = dataArray['sub_location'];
            let route = "{{route('admin.delivery.sheet.print.all')}}"+"?delivery_schedule_date="+delivery_schedule_date+"&delivery_slot="+delivery_slot+"&main_location="+main_location+"&sub_location="+sub_location;
            window.open(
                route,
                '_blank' // <- This is what makes it open in a new window.
                );
            
            console.log(route);
        }

        function getUrlVars(){
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for(var i = 0; i < hashes.length; i++)
            {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        }
    </script>
@endsection
