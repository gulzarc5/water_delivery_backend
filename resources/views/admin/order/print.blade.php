<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{asset('web/fonts/revivalisem.otf')}}">
  <title>Document</title>
  <script src="{{asset('admin/vendors/jquery/dist/jquery.min.js')}}"></script>
  <style>
    body{background: #333;margin: 0;}.print-area{width: 58mm;background: #fff;padding: 10px 5px;padding-top:0;border-bottom: 3px dashed #777;}.print-head h3{text-align: center;margin: 0;font-family: revivalisem;font-size: 35px;}.print-head{margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px dashed #333;text-align:center}.order-info{margin-bottom: 5px}.order-info, .order-item{border-bottom: 1px dashed #333;padding-bottom: 5px}table{width: 100%;}td{font-size: 12px;font-family: Arial, Helvetica, sans-serif}table tr td:last-child{text-align: right;}.line{border-top: 1px solid #777;padding: 5px;transform: translateY(5px);}.print-foot {text-align: center}.print-foot h3{font-size: 12px;margin: 0;font-family: Arial, Helvetica, sans-serif;}.order-info td, .order-summery td {font-size: 10px}.order-summery.lg td{font-size: 14px;font-weight: 900;}.date-para{margin: 0;font-size: 10px;}.print-foot>div{margin: 5px auto;}.order-info td {width: 50%;}
  </style>
</head>
<body>
  @if (isset($orders) && !empty($orders))
      @foreach ($orders as $item)
        <section class="print-area">
          <div class="print-head">      
            <h3 style="font-family: revivalisem">Pyaas</h3>
          </div>
          <div class="order-info">
            <table>
              <tr>
                <td>Order Id.</td>
                <td><strong>{{$item->order_id}}</strong></td>
              </tr>
              <tr>
                <td>Order Date</td>
                <td>{{$item->created_at->toDateString()}}</td>
              </tr>
              <tr>
                <td>Delivery Date</td>
                <td>{{$item->delivery_schedule_date}}</td>
              </tr>
              <tr>
                <td>Customer Name</td>
                <td>{{$item->user->name ?? null}}</td>
              </tr>
              <tr>
                <td>Phone</td>
                <td>{{$item->user->mobile ?? null}}</td>
              </tr>
              <tr>
                <td colspan="2" style="width:100%;text-align: left;font-weight: 600;">Address</td>
              </tr>
              <tr>
                <td colspan="2" style="width:100%;text-align: left;">H/No:{{$item->addrees->house_no ?? null}},{{$item->addrees->flat_no ?? null}}, {{$item->addrees->address_one ?? null}},{{$item->addrees->landmark ?? null}}, Pin- {{$item->addrees->pin ?? null}}</td>
              </tr>
            </table>
          </div>
          <div class="order-item">
            <table>
              <tr>
                <td><strong>Sl.</strong></td>
                <td><strong>Product & Quantity</strong></td>
                <td><strong>Amount</strong></td>
              </tr>
              {{-- Number Start --}}
              @forelse ($item->detail as $product)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$product->productSize->product->name ?? null}} {{$product->is_jar == '1' ? "with jar" : ""}}<br><small>{{$product->quantity}} x {{$product->mrp + ($product->is_jar == '1' ? $product->jar_mrp : 0)}}</small></td>
                  <td>₹ {{$product->quantity * ($product->mrp + ($product->is_jar == '1' ? $product->jar_mrp : 0))}}</td>
                </tr>
              @empty
              @endforelse
                {{-- Number End --}}
                <tr>
                  <td colspan="3" class="line"></td>
                </tr>
                
                <tr class="order-summery">
                  <td colspan="2">Sub Total</td>
                  <td>₹ {{$item->total_mrp}}</td>
                </tr>
                <tr class="order-summery">
                  <td colspan="2">Discount</td>
                  <td>- ₹ {{$item->total_mrp - $item->total_sale_price}}</td>
                </tr>
                <tr class="order-summery">
                  <td colspan="2">Delivery </td>
                  <td>
                    @if ($item->shipping_charge > 0)
                    + ₹ {{ number_format($item->shipping_charge,2,".",'') }}
                    @else                                            
                        Free
                    @endif
                  </td>
                </tr>
                <tr class="order-summery">
                  <td colspan="2">Net Total </td>
                  <td>
                    @if ($item->shipping_charge > 0)
                      ₹ {{ number_format($item->total_sale_price+$item->shipping_charge,2,".",'') }}
                    @else                                            
                        Free
                    @endif
                  </td>
                </tr>
                
                @if ($item->coins_used > 0)
                  <tr class="order-summery">
                    <td colspan="2">Coin Used</td>
                    <td>- ₹ {{$item->coins_used}}</td>
                  </tr>
                @endif
                @if ($item->coupon_discount > 0)
                  <tr class="order-summery">
                    <td colspan="2">Coupon Discount</td>
                    <td>- ₹ {{$item->coupon_discount}}</td>
                  </tr>
                @endif
              
                <tr class="order-summery lg">
                  <td colspan="2">AMT</td>
                  <td>₹ {{($item->total_sale_price+$item->shipping_charge) - ($item->coins_used+$item->coupon_discount)}}</td>
                </tr>
            
            </table>
          </div>
          <div class="print-foot">
            {{-- <img src="{{asset('web/images/barcode.png')}}" alt="" style="margin-top: 10px;width: 90%;height: 50px;"> --}}
            @if ($item->order_id)                
              {!!DNS1D::getBarcodeHTML($item->order_id, 'C128')!!}
            @endif
            <h3>Thank You for shoping at Pyaas</h3>
            <p class="date-para"><span id="datetime">{{$date}}</span></p>
          </div>
        </section>
        
      @endforeach
  @endif
</body>
<script>
  // Auto Print
  window.print();
  window.onafterprint = function(event) {
    window.close();
    window.location.href = "{{ url()->previous() }}";
  };
</script>
</html>