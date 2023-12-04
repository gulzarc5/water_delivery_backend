<?php
namespace App\Services;

class PushService {
    public static function notification($token, $title,$body,$type,$image=null)
    {
        //type 1= single,2=all
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

        $notification = [
            'title' => $title,
            'sound' => true,
            "body" => $body,
            "data" => ["type" => "order"],
            'android_channel_id' => 'ghypyaas2021',
            // "image"=>$image,
        ];
        
        if ($type==1) {
            $fcmNotification = [
                //'registration_ids' => $tokenList, //multple token array
                'to'        => "dgwZ2jUiTA6QGJKsbTdtLP:APA91bGgJXod33jIDwNPRLh1-hCr8qIBA-6wNZ6H4O6fRyYCK6qTgirhKoINEmkzt7tqJ5k_AbaYcSAkHPJcolXYORvXchtJ6_zEqZRlXbVBDsVFYq_ZHJ38Xwpc0e0SkyI3b1hHbu9d", //single token
                'notification' => $notification
            ];
        } else {
            $fcmNotification = [
                'registration_ids' => $token, //multple token array
                // 'to'        => $token, //single token
                'notification' => $notification
            ];
        }
        
        
        $headers = [
            'Authorization:key=AAAAs_2BFSQ:APA91bHtokmbcZYW187yNpIKeEcnpxas8NSBvEWFFiFI_JVnABkqEQtsTnr5N2l96Xtk5t1o_oV7Fh0wDtMwRiEu-KHC_xPlTI9BNEsT6-gjUdqKGEgTaJu0v8qrkQFaBrenAk28Pvvk',
            'Content-Type: application/json'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}