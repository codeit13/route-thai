<?php

namespace App\Listeners\Message;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use Revolution\Line\Messaging\Bot;

class TextMessageListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TextMessage  $event
     * @return void
     */
    public function handle(TextMessage $event)
    {   $url = "You can connect your this LIne Account with Route Thai Account via below url\n" . env('APP_URL') . "/user/linelogin";
        Bot::reply($event->getReplyToken())->text($url);
    }
}