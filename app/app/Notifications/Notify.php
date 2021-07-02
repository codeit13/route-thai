<?php
namespace App\Notifications;

use App\Models\User;
use App\Notifications\LaravelTelegramNotification;
use Auth;
use LINE;

use Illuminate\Http\Request;
use AWS;

use App\Exceptions\NotifyMessageException;

class Notify
{
    public static function sendMessage($user)
    {

        //  echo '<pre>';print_r($mobile);print_r($message);die;
        // $this->service = new \App\Services\SMSService();
        // $this->service->send($mobile,$message);

        if ($user['sms_notification']) {
            $sms = AWS::createClient('sns');

            try {
                    $sms->publish([
                    'Message' => $user['Message'],
                    'PhoneNumber' => $user['mobile'],
                    'MessageAttributes' => [
                        'AWS.SNS.SMS.SMSType'  => [
                            'DataType'    => 'String',
                            'StringValue' => 'Transactional',
                        ]
                    ],
                ]);
            } catch(NotifyMessageException $exception) {
                report($exception);
            }
        }

        if ($user['telegram_notification']) {
            try {
                Auth::user()->notify(new LaravelTelegramNotification([
                    'telegram_user_id' => $user['telegram_user_id'],
                    'text' => str_replace(array('_'), '\\_', $user['Message']),
                ]));
            } catch(RequestException $exception) {
                // throw new NotifyMessageException('Github API failed in Offices Controller');
                Log::debug('RequestException');
            }
        }

        if ($user['line_notification']) {
            try {
                LINE::pushmessage(
                    $user['line_user_id'],
                    new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($user['Message'])
                );
            } catch(NotifyMessageException $exception) {
                report($exception);
            }
        }

    }
}
