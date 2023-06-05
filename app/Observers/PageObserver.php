<?php

namespace App\Observers;

use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class PageObserver
{
    public function created(Page $page): void
    {
        Cache::forget('posts');
    }

    public function updated(Page $page): void
    {
        Cache::forget('posts');
    }

    public function deleted(Page $page): void
    {
        Cache::forget('posts');
    }
}
