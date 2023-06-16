<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    public function created(Post $post): void
    {
        Cache::forget('posts');
        Artisan::call('sitemap:generate');
    }

    public function updated(Post $post): void
    {
        Cache::forget('posts');
        Artisan::call('sitemap:generate');
    }

    public function deleted(Post $post): void
    {
        Cache::forget('posts');
        Artisan::call('sitemap:generate');
    }
}
