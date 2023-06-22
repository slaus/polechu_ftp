<?php

namespace App\Observers;

use App\Models\Setting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class SettingObserver
{
    public function created(Setting $setting): void
    {
        Cache::forget('settings');
        Artisan::call('cache:clear');
    }

    public function updated(Setting $setting): void
    {
        Cache::forget('settings');
        Artisan::call('cache:clear');
    }
}
