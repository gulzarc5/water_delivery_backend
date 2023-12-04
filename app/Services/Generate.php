<?php
namespace App\Services;

class Generate {
    public static function orderId($order_id,$type)
    {
        // Type 1 = Normal Order, 2 = Membership order

        // $length = intval(strlen((string) $order_id));
        
        $id = null;
        if ($type == 1) {
            $id = "PS";
        } else {
            $id = "PM";
        }
        
        $id .= str_pad($order_id, 6, '0', STR_PAD_LEFT);
       return $id;
    }
}