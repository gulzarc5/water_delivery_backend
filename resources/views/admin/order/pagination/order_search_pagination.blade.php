<table id="category" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Sl</th>
        <th>ID</th>
        <th>Name</th>
        <th>Payable Amount</th>
        <th>Payment Type</th>
        <th>Payment Status</th>
        <th>Schedule date</th>
        <th>Schedule Type</th>
        <th>Status</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>  
      @forelse ($orders as $key => $item)
          <tr>
            <td>{{ $orders->firstItem() + $key }}</td>
            <td>{{$item->order_id}}</td>
            <td>{{$item->user->name ?? null}}</td>
            <td>{{$item->total_sale_price}}</td>
            <td>
                @if ($item->payment_type == 1) 
                    <label class='label label-success'>Online</label>
                @elseif($item->payment_type == 2) 
                    <label class='label label-warning'>COD</label>
                @else
                   <label class='label label-primary'>Subscription</label>
                @endif   
            </td>
            <td>
                @if($item->payment_status == 1)
                    <label class='label label-warning'>Pending</label>
                @elseif ($item->payment_status == 2)
                   <label class='label label-danger'>Failed</label>
                @else
                    <label class='label label-success'>Paid</label>
                @endif
            </td>
            <td>{{$item->delivery_schedule_date}}</td>
            <td>
                @if ($item->delivery_slot_id == 1)
                    Morning
                @else
                    Evening
                @endif
            </td>
            <td>
                @if ($item->status == 1)
                    <label class='label label-warning'>New</label>
                @elseif ($item->status == 2)
                    <label class='label label-primary'>Accepted</label>
                @elseif ($item->status == 3)
                    <label class='label label-info'>Out For Delivery</label>
                @elseif ($item->status == 4)
                    <label class='label label-success'>Delivered</label>
                @else
                    <label class='label label-Danger'>Cancelled</label>
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
  {!! $orders->onEachSide(2)->links('pagination::bootstrap-4') !!}  