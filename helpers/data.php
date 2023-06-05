<?php

use App\Models\Post;
use App\Models\Tour;
use Illuminate\Support\Facades\Cache;

if (! function_exists('tours')) {

    function tours(int $limit = 3): mixed {
        $tours = Cache::rememberForever('tours', function () use ($limit) {
            return Tour::where('visibility', true)
                ->limit($limit)
                ->orderBy('order')
                ->get()
                ->toArray();
        });

        return $tours ?? [];
    }

}

if (! function_exists('posts')) {

    function posts(int $limit = 10): mixed {
        $posts = Cache::rememberForever('posts', function () use ($limit) {
            return Post::where('visibility', true)
                ->limit($limit)
                ->orderByDesc('created_at')
                ->get()
                ->toArray();
        });

        return $posts ?? [];
    }

}
