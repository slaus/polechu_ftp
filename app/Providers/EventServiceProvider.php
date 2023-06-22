<?php

namespace App\Providers;

use App\Models\Country;
use App\Models\Page;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Tour;
use App\Observers\CountryObserver;
use App\Observers\PageObserver;
use App\Observers\PostObserver;
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
        Page::observe(PageObserver::class);
        Tour::observe(TourObserver::class);
        Post::observe(PostObserver::class);
        Country::observe(CountryObserver::class);
        Setting::observe(SettingObserver::class);
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
