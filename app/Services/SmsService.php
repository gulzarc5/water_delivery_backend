<?php
namespace App\Services;

class SmsService {
    public static function send($mobile,$sms,$template_id)
    {
        $username=config('services.sms.user_name');
        $api_password=config('services.sms.api_password');
        $sender=config('services.sms.sender_id');
        $entity_id = config('services.sms.entity_id');
        $domain="http://sms.webinfotech.co";
        $priority="4";// 11-Enterprise, 12- Scrub
        $method="GET";

        $mobile=$mobile;
        $message=$sms;

        $username=urlencode($username);
        $api_password=urlencode($api_password);
        $sender=urlencode($sender);
        $message=urlencode($message);

        $sms = urlencode($sms);
        
        $parameters="username=$username&api_password=$api_password&sender=$sender&to=$mobile&message=$message&priority=$priority&e_id=$entity_id&t_id=$template_id";

        // http://sms.webinfotech.co/pushsms.php?username=Pyaas&api_password=9aea6rwzfvf6yql3b&sender=PYAASS&to=9401943576&message=Your%20OTP%20is%20123456%20,%20Please%20do%20not%20share%20this%20OTP%20to%20any%20one.%0AThank%20you,%0ATEAM%20PYAAS&priority=4&e_id=1201159421346420049&t_id=1207162646623265433

        $url="$domain/pushsms.php?".$parameters;

        $ch = curl_init($url);

        if($method=="POST")
        {
            curl_setopt($ch, CURLOPT_POST,1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
        }
        else
        {
            $get_url=$url."?".$parameters;

            curl_setopt($ch, CURLOPT_POST,0);
            curl_setopt($ch, CURLOPT_URL, $get_url);
        }

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
        curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
        $return_val = curl_exec($ch);
        return $return_val;
    }
}