<?php

use App\Models\Post;
use App\Models\Tag;
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

    function posts(int $limit = 10, array $except = []): mixed {
        if (! empty($except)) {
            $posts = Post::where('visibility', true)
                ->whereNotIn('id', $except)
                ->limit($limit)
                ->orderByDesc('created_at')
                ->get()
                ->toArray();
        } else {
            $posts = Cache::rememberForever('posts', function () use ($limit) {
                return Post::where('visibility', true)
                    ->limit($limit)
                    ->orderByDesc('created_at')
                    ->get()
                    ->toArray();
            });
        }

        return $posts ?? [];
    }

}

if (! function_exists('tags')) {

    function tags(string $type, int $limit = 30): mixed {
        return Tag::select('tags.*')
            ->join('taggables', 'taggables.tag_id', '=', 'tags.id')
            ->where('taggable_type', Post::class)
            ->where('type', $type)
            ->limit($limit)
            ->distinct()
            ->get()
            ->filter(fn (Tag $tag) => $tag->hasTranslation('name'))
            ->toArray();
    }

}
