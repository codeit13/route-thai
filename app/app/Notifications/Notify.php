<?php
namespace App\Notifications;

use App\Models\User;
use App\Notifications\LaravelTelegramNotification;
use Auth;
use LINE;

use Illuminate\Http\Request;
use AWS;

class Notify
{
    public static function sendMessage($user)
    {

        //  echo '<pre>';print_r($mobile);print_r($message);die;
        // $this->service = new \App\Services\SMSService();
        // $this->service->send($mobile,$message);

        if ($user['sms_notification']) {
            $sms = AWS::createClient('sns');

            $sms->publish([
                'Message' => 'Hello, This is just a test Message',
                'PhoneNumber' => $phone_number,
                'MessageAttributes' => [
                    'AWS.SNS.SMS.SMSType'  => [
                        'DataType'    => 'String',
                        'StringValue' => 'Transactional',
                    ]
                ],
            ]);
        }

        if ($user['telegram_notification']) {
            Auth::user()->notify(new LaravelTelegramNotification([
                'telegram_user_id' => $user['telegram_user_id'],
                'text' => str_replace(array('_'), '\\_', $user['Message']),
            ]));
        }

        if ($user['line_notification']) {
            LINE::pushmessage(
                $user['line_user_id'],
                new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($user['Message'])
            );
        }

    }
}
