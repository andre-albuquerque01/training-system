<?php

namespace App\Providers;

use App\Events\RecoverPasswordEvent;
use App\Events\Registered;
use App\Jobs\SendVerifyEmail;
use App\Listeners\SendTokenRecoverPassword;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendVerifyEmail::class
        ],
        RecoverPasswordEvent::class => [
            SendTokenRecoverPassword::class
        ],
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
