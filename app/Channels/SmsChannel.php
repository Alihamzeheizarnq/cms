<?php
/**
 * Created by PhpStorm.
 * User: alihamzehei
 * Date: 2/13/2021
 * Time: 1:55 PM
 */

namespace App\Channels;


use Illuminate\Notifications\Notification;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;

class SmsChannel
{
    public function send($notification, Notification $notifiable)
    {
        try {
            $message = "سلام {$notification->name} عزیز . کد ورود به سایت : {$notifiable->code}";
            $lineNumber = "10008566";
            $receptor = "{$notifiable->phone}";
            $api = new \Ghasedak\GhasedakApi('98a2142e6cacb6335fed5b6568345f3fb01222f2a7b20910ca00760f75e82632');
            $api->SendSimple($receptor, $message, $lineNumber);
        } catch (\Ghasedak\Exceptions\ApiException $e) {
            throw $e;
        } catch (\Ghasedak\Exceptions\HttpException $e) {
            throw $e;
        }
    }

}
