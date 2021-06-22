# Route Crypto P2P Website
> Join the world's largest crypto exchange. Designed for India

## How to Implement Notifications
In your ***Controller*** follow the following Steps
1. `    use App\Notifications\Notify;`
2. ``` php 
        $Message = "Your Message";
        Notify::sendMessage([
            'sms_notification' => $user->sms_notification,
            'mobile' => $user->mobile,
            'telegram_notification' => $user->telegram_notification,
            'telegram_user_id' => $user->telegram_user_id,
            'line_notification' => $user->line_notification,
            'line_user_id' => $user->line_user_id,
            'email_notification' => $user->email_notification,
            'email_id' => $user->email,
            'Message' => $Message,
        ]);