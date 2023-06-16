<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        foreach (glob(base_path('helpers') . '/*.php') as $file) {
            require_once $file;
        }
    }
}
