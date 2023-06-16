<?php

namespace App\Http\ViewModels;

use App\Models\Page;

class PageViewModel extends ViewModel
{
    public function __construct(
        private readonly Page $page
    ) {}

    public function page(): Page
    {
        return $this->page;
    }

    public function content(): array
    {
        return $this->page->content ?? [];
    }

    public function posts(): array
    {
        $payload = $this->page->posts?->toArray();

        return ! empty($payload) ? [
            'data' => $payload['data'],
            'meta' => [
                'current_page' => $payload['current_page'],
                'last_page' => $payload['last_page'],
                'per_page' => $payload['per_page'],
                'total' => $payload['total'],
                'links' => $payload['links'],
                'next_page_url' => $payload['next_page_url'],
                'path' => $payload['path'],
                'first_page_url' => $payload['first_page_url'],
                'last_page_url' => $payload['last_page_url'],
            ]] : [];
    }

    public function seo(): array
    {
        $seo = $this->page->seo ?? [];

        foreach ($this->page->name ?? [] as $locale => $value) {
            $seo['title'][$locale] = $seo['title'][$locale] ?? $value . ' | ' . config('app.name');
        }

        return $seo;
    }
}
