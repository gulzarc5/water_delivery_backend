<?php

namespace App\Exports;

use App\Models\SignupOtp;
use Maatwebsite\Excel\Concerns\FromArray;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;

class SignupOtpExport  implements FromArray,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return SignupOtp::all();
    // }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A2:c2'; // All headers
                $style_head = array(
                    'font'  => array(
                        'bold'  => true,
                        'name'  => 'Verdana'
                    ),
                    'alignment' => array('horizontal' => 'center') ,
                );
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style_head);
                $event->sheet->mergeCells('A1:C1');
                $styleArray = array(
                    'font'  => array(
                        'bold'  => true,
                        'size'  => 15,
                        'name'  => 'Verdana'
                    ),
                    'alignment' => array('horizontal' => 'center') ,
                );
                $event->sheet->getDelegate()->getStyle('A1:C1')->applyFromArray($styleArray);
            },
        ];
    }
    
    public function array(): array
    {
        $users = SignupOtp::latest()->get();

        $data [] = ["Pyaas Unregistered User List"];
        $data[] = ['Sl No','Mobile Number','Date']; 
        $count = 1;
        foreach ($users as $item) {
    
            $data[] = [ 
                $count,
                $item->mobile, 
                $item->created_at ? $item->created_at->format('d-m-Y') : '',
            ];
            $count++;
        }
        return $data;
    }
}
