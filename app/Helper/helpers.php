<?php

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


/**
 * send mail
 *
 * @param string $to
 * @param string $subject
 * @param string $message
 * @param array $optoins
 * @return true/false
 */
if (!function_exists('send_email')) {
    function send_email($to, $message, $subject, $optoins = array())
    {

        $data['to'] = $to;
        $data['subject'] = $subject;
        $data['message'] = $message;
        $data['optoins'] = $optoins;
        $html_messages = '';
        $html_messages = '<html>
          <head>
           <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
           <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
         </head><body>';
        $html_messages .= $message;

        $html_messages .= '</body></html>';
        return  Mail::html(
            $html_messages,
            function ($message) use ($data) {
                if (is_array($data['to'])) {
                    foreach ($data['to'] as $to)
                        $message->to($to['email'], $to['name']);
                } else {
                    $message->to($data['to']);
                }
                $message->subject($data['subject']);
            }
        );
    }
}
if (!function_exists('encrypt_id')) {
    function encrypt_id($id)
    {
        $key = rand(100000, 999999);
        $encrypted = base64_encode($key . $id);
        return bin2hex($encrypted);
    }
}
if (!function_exists('decrypt_id')) {

    function decrypt_id($encrypted_id)
    {
        $encrypted_id = base64_decode(hex2bin($encrypted_id));

        $key = substr($encrypted_id, 0, 6);
        $decrypted = str_replace($key, '', $encrypted_id);
        return $decrypted;
    }
}

/**
 * send sms function
 *
 * @param  $receiver
 * @param  $message
 * @return void
 * @author Arafat Thabet <arafat.733011506@gmail.com>
 */
if (!function_exists('send_sms')) {
    function send_sms($receiver, $message)
    {

        $data = array(
            'Username' => getSetting('sms_username'),
            'Password' => getSetting('sms_password'),
            'Tagname' => getSetting('sms_sendername'),
            'RecepientNumber' => $receiver,
            'Message' => $message,
            'SendDateTime' => 0,
            'EnableDR' => false,
        );
        $data_string = json_encode($data);

        $ch = curl_init('http://api.yamamah.com/SendSMS');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        ));

        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }
}

/**
 * Get setting value
 * @param  $key
 * @return string
 */
if (!function_exists('getSetting')) {
    function getSetting($key) {
        return App\Models\Setting::select('value')->where('name',$key)->first()->value ?? null;
    }
}
