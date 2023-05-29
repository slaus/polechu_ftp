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

    public function seo(): array
    {
        $seo = $this->page->seo ?? [];

        foreach ($this->page->name ?? [] as $locale => $value) {
            $seo['title'][$locale] = $seo['title'][$locale] ?? $value . ' | ' . config('app.name');
        }

        return $seo;
    }
}
