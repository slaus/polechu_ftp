<?php

use App\Models\Tour;
use Illuminate\Support\Facades\Cache;

if (! function_exists('tours')) {

    function tours(int $limit = 3): mixed {
        $tours = Cache::rememberForever('tours', function () use ($limit) {
            return Tour::where('visibility', true)->limit($limit)->orderBy('order')->get()->toArray();
        });

        return $tours ?? [];
    }

}
