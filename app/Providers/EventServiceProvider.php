<?php

namespace App\Providers;

use App\Models\Setting;
use App\Observers\SettingObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    public function boot(): void
    {
        Setting::observe(SettingObserver::class);
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
