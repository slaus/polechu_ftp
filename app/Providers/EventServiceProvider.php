<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\Tour;
use App\Observers\SettingObserver;
use App\Observers\TourObserver;
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
        Tour::observe(TourObserver::class);
        Setting::observe(SettingObserver::class);
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
