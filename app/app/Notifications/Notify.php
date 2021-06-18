<?php
namespace App\Notifications;

use App\Notifications\LaravelTelegramNotification;
use LINE;

class Notify {
    public static function sendMessage($user) {

            //  echo '<pre>';print_r($mobile);print_r($message);die;
            // $this->service = new \App\Services\SMSService();
            // $this->service->send($mobile,$message);

            if($user['telegram_notification']) {
                $user->notify(new LaravelTelegramNotification([
                    'telegram_user_id' => $user['telegram_user_id'],
                    'text' => $user['Message'],
                    ]));
                }

            if($user['line_notification']) {
                LINE::pushmessage(
                    $user['line_user_id'],
                    new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($user['Message'])
                );
            }

    }
}