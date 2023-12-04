<table id="category" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Sl</th>
        <th>ID</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Brand</th>
        <th>Size</th>
        <th>Status</th>
        <th>Quantity</th>
        <th>Address</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>  
      @forelse ($bulk_orders as $key => $item)
          <tr>
            <td>{{ $bulk_orders->firstItem() + $key }}</td>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->mobile}}</td>
            <td>{{$item->brand->name ?? null}}</td>
            <td>{{$item->size->name ?? null}}</td>
            <td>
                @if ($item->status == 1) 
                    <label class='label label-primary'>New</label>
                @elseif($item->status == 2) 
                    <label class='label label-info'>Accepted</label>
                @elseif($item->status == 3) 
                    <label class='label label-warning'>Processing</label>
                @elseif($item->status == 4) 
                    <label class='label label-success'>Completed</label>
                @elseif($item->status == 5) 
                    <label class='label label-success'>Cancelled</label>
                @endif   
            </td>
            <td>{{$item->quantity}}</td>
            <td>{{$item->address}}</td>            
            <td>{{$item->created_at->toDateString()}}</td>
            <td>
              @if ($item->status == 1) 
                  <a href="{{route('admin.bulk.order_status',['id'=>$item->id,'status'=>2])}}" class='label label-info' onclick="return confirm('Are You Sure To Accept')">Accept</a>
                  <a href="{{route('admin.bulk.order_status',['id'=>$item->id,'status'=>5])}}" class='label label-danger' onclick="return confirm('Are You Sure To Cancel')">Cancel</a>
              @elseif($item->status == 2) 
                  <a href="{{route('admin.bulk.order_status',['id'=>$item->id,'status'=>3])}}" class='label label-warning' onclick="return confirm('Are You Sure To Processing')">Processing</a>
                  <a href="{{route('admin.bulk.order_status',['id'=>$item->id,'status'=>5])}}" class='label label-danger' onclick="return confirm('Are You Sure To Cancel')">Cancel</a>
              @elseif($item->status == 3) 
                  <a href="{{route('admin.bulk.order_status',['id'=>$item->id,'status'=>4])}}" class='label label-success' onclick="return confirm('Are You Sure To Completed')">Completed</a>
                  <a href="{{route('admin.bulk.order_status',['id'=>$item->id,'status'=>5])}}" class='label label-danger' onclick="return confirm('Are You Sure To Cancel')">Cancel</a>
              @endif   
            </td>
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
  {!! $bulk_orders->onEachSide(2)->links('pagination::bootstrap-4') !!}  