<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Revolution\Line\Facades\Bot;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Bot::macro('foo', function () {
            return $this->bot()->
        });
    }
}
