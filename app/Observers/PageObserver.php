<?php

namespace App\Observers;

use App\Models\Page;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class PageObserver
{
    public function created(Page $page): void
    {
        Cache::forget('posts');
        Artisan::call('sitemap:generate');
    }

    public function updated(Page $page): void
    {
        Cache::forget('posts');
        Artisan::call('sitemap:generate');
    }

    public function deleted(Page $page): void
    {
        Cache::forget('posts');
        Artisan::call('sitemap:generate');
    }
}
