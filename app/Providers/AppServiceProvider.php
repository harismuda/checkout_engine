<?php

namespace App\Providers;

use App\Contracts\EmailNotifierInterface;
use App\Contracts\SmsNotifierInterface;
use App\Services\Notifications\EmailNotifier;
use App\Services\Notifications\SmsNotifier;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Dependency Inversion: Service Container otomatis meng-inject konkrit saat interface diminta
        $this->app->bind(EmailNotifierInterface::class, EmailNotifier::class);
        $this->app->bind(SmsNotifierInterface::class, SmsNotifier::class);
    }

    public function boot(): void
    {
        /*
         * This provider only registers interface bindings; no boot-time
         * application configuration is required.
         */
    }
}

