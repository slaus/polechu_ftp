<?php

namespace App\Providers;

use App\Services\BeeFlyTour\BeeFlyTourApi;
use App\Services\BeeFlyTour\BeeFlyTourService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class BeeFlyTourProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(BeeFlyTourApi::class, function (Application $app) {
            return new BeeFlyTourApi(
                settings('api.join_up.base_url', $app['config']->get('services.bee_fly_tour.base_url')),
                settings('api.join_up.token', $app['config']->get('services.bee_fly_tour.token'))
            );
        });

        $this->app->singleton(BeeFlyTourService::class, function (Application $app) {
            return new BeeFlyTourService($app->make(BeeFlyTourApi::class));
        });
    }
}
