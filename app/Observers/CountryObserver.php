<?php

namespace App\Observers;

use App\Models\Country;
use Illuminate\Support\Facades\Cache;

class CountryObserver
{
    public function created(Country $country): void
    {
        Cache::forget('countries');
    }

    public function updated(Country $country): void
    {
        Cache::forget('countries');
    }

    public function deleted(Country $country): void
    {
        Cache::forget('countries');
    }
}
