<?php

namespace App\Http\ViewModels;

use App\Models\Post;

class PostViewModel extends ViewModel
{
    public function __construct(
        private readonly Post $post
    ) {}

    public function post(): Post
    {
        return $this->post;
    }

    public function content(): array
    {
        return $this->post->content ?? [];
    }

    public function seo(): array
    {
        $seo = $this->post->seo ?? [];

        foreach ($this->post->name ?? [] as $locale => $value) {
            $seo['title'][$locale] = $seo['title'][$locale] ?? $value . ' | ' . config('app.name');
        }

        return $seo;
    }
}
