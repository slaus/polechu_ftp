<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (! function_exists('settings')) {

    function settings(string $name, mixed $default = null): mixed {
        $settings = Cache::rememberForever('settings', function () {
            return Setting::all()->mapWithKeys(function (Setting $setting) {
                return [$setting->name => $setting->value];
            })->toArray();
        });

        foreach (explode('.', $name) as $element) {
            $settings = $settings[$element] ?? $default;
        }

        return $settings;
    }

}
