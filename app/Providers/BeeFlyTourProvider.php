<?php

namespace App\Providers;

use App\Services\BeeFlyTour\BeeFlyTourApi;
use App\Services\BeeFlyTour\BeeFlyTourService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class BeeFlyTourProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BeeFlyTourApi::class, function (Application $app) {
            return new BeeFlyTourApi(
                $app['config']->get('services.bee_fly_tour.base_url'),
                $app['config']->get('services.bee_fly_tour.token')
            );
        });

        $this->app->singleton(BeeFlyTourService::class, function (Application $app) {
            return new BeeFlyTourService($app->make(BeeFlyTourApi::class));
        });
    }
}
