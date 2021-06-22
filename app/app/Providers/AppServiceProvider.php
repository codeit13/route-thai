<?php

namespace App\Providers;

use Aws\Sns\SnsClient;
use App\Channels\SmsChannel;
use Aws\Credentials\Credentials;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;

use Revolution\Line\Contracts\WebhookHandler;
use Revolution\Line\Facades\Bot;
use Revolution\Line\Messaging\Http\Actions\WebhookLogHandler;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Notification::resolved(function (ChannelManager $service) {
            $service->extend('sms', function ($app) {
                return new SmsChannel(
                    new SnsClient([
                        'version' => '2010-03-31',
                        'credentials' => new Credentials(
                            config('services.sns.key'),
                            config('services.sns.secret')
                        ),
                        'region' => config('services.sns.region'),
                    ])
                );
            });
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Bot::macro('verifyWebhook', function (): array {
            return Http::line()->post('/v2/bot/channel/webhook/test', [
                'endpoint' => '',
            ])->json();
        });

        Bot::macro('friendshipStatus', function (string $access_token): array {
            return Http::line()
                ->withToken($access_token)
                ->get('/friendship/v1/status')
                ->json();
        });
    }
}