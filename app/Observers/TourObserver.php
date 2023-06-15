<?php

namespace App\Observers;

use App\Models\Tour;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class TourObserver
{
    public function created(Tour $tour): void
    {
        Cache::forget('tours');
        Artisan::call('sitemap:generate');
    }

    public function updated(Tour $tour): void
    {
        Cache::forget('tours');
        Artisan::call('sitemap:generate');
    }

    public function deleted(Tour $tour): void
    {
        Cache::forget('tours');
        Artisan::call('sitemap:generate');
    }
}
