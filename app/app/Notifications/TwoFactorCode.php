<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage; 

class TwoFactorCode extends Notification
{

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Your two factor code is '.$notifiable->two_factor_code)
            ->action('Verify Here', route('verify.2f'))
            ->line('The code will expire in 10 minutes')
            ->line('If you have not tried to login, ignore this message.');
    }

    public function via($notifiable)
    {
        return ['mail','database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => ''
        ];
    }
}