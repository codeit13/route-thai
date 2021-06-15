# Route Crypto P2P Website
> Join the world's largest crypto exchange. Designed for India

## Implement Telegram Notifications
In your ***Controller*** follow the following Steps
1. `    use App\Notifications\LaravelTelegramNotification;`
2. ``` php 
        if($user->telegram_notification) {
            $user->notify(new LaravelTelegramNotification([
                'text' => "Your Message here ",
                'telegram_user_id' => $user->telegram_user_id,
                ]));
            }

## Implement Line Notifications
In your ***Controller*** follow the following Steps
1. `    use LINE;`
2. ``` php 
        if($user->line_notification) {
            LINE::pushmessage(
                $user->line_user_id,
                new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('Your Message here.')
            );
        }
