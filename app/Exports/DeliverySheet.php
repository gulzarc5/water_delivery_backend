<?php
namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromArray;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;

class DeliverySheet implements FromArray,ShouldAutoSize,WithEvents
{
    private $delivery_schedule_date;
    private $delivery_slot;
    private $main_location;
    private $sub_location;
    public function __construct($request)
    {
        $this->delivery_schedule_date = $request->input('delivery_schedule_date');
        $this->delivery_slot = $request->input('delivery_slot');
        $this->main_location = $request->input('main_location');
        $this->sub_location = $request->input('sub_location');
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A2:J2'; // All headers
                $style_head = array(
                    'font'  => array(
                        'bold'  => true,
                        'name'  => 'Verdana'
                    ),
                    'alignment' => array('horizontal' => 'center') ,
                );
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style_head);
                $event->sheet->mergeCells('A1:J1');
                $styleArray = array(
                    'font'  => array(
                        'bold'  => true,
                        'size'  => 15,
                        'name'  => 'Verdana'
                    ),
                    'alignment' => array('horizontal' => 'center') ,
                );
                $event->sheet->getDelegate()->getStyle('A1:J1')->applyFromArray($styleArray);
            },
        ];
    }
    
    public function array(): array
    {
        $orders = Order::where('orders.delivery_schedule_date', $this->delivery_schedule_date)->where('orders.status',2)
        ->where(function($q){
            $q->where(function($s){
                $s->where('orders.payment_type', 1)
                ->where('orders.payment_status',3);
            })->orWhere('orders.payment_type',2)
            ->orWhere('orders.payment_type',3);
        });

        if (($this->delivery_slot == 1) || ($this->delivery_slot == 2)) {
            $orders->where('orders.delivery_slot_id',$this->delivery_slot);
        }

        if($this->main_location){
            $orders->leftjoin('addresses','addresses.id','orders.address_id')
            ->where('addresses.main_location_id',$this->main_location);
            if ($this->sub_location) {
                $orders->where('addresses.sub_location_id',$this->sub_location);               
            }
        }

        $orders = $orders->get();
        $data [] = ["Pyaas Delivery Sheet"];
        $data[] = ['Sl No','Order Id','Name','Mobile','Location','Delivery Address','Amount','Products','Jar Pickup	','Delivery Date']; 
        $count = 1;
        foreach ($orders as $item) {
            $amount = 0;
            if ($item->payment_type == 1 && $item->payment_status == 3){
                $amount = "Paid";
            }elseif($item->payment_type == 3){
                $amount = "Paid";
            }elseif($item->payment_type == 2){
                $amount = $item->total_sale_price - ($item->coins_used+$item->coupon_discount);
            }  

            $products = "";
            $jarCount = 0;
            foreach ($item->detail as $item1){
                $products .= ($item1->productSize->product->name ?? null)."(".($item1->productSize->size->name ?? null).")".($item1->is_jar == 1 ? "( With Jar)" : null)."\n";
                if (($item1->productSize->jar_available_status == 1) && ($item1->is_jar == 2)){
                    $jarCount+=1;
                }
            }
            $data[] = [ 
                $count,
                $item->id, 
                $item->user->name ?? null,  
                $item->user->mobile ?? null,  
                ($item->addrees->mainLocation->name ?? null).",".($item->addrees->subLocation->name ?? null),
                ($item->addrees->name ?? null)."\n".($item->addrees->mobile ?? null)."\n".($item->addrees->house_no ?? null).",".($item->addrees->address_one ?? null).",".($item->addrees->address_two ?? null).",".($item->addrees->landmark ?? null)."-".($item->addrees->pin ?? null),
                $amount,
                $products,
                $jarCount,
                $item->delivery_schedule_date
            ];
            $count++;
        }
        return $data;
    }
}