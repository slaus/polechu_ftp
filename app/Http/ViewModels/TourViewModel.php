<?php

namespace App\Http\ViewModels;

use App\Models\Page;
use App\Models\Tour;

class TourViewModel extends ViewModel
{
    public function __construct(
        private readonly Tour $tour,
        private readonly Page $page,
    ) {}

    public function tour(): Tour
    {
        return $this->tour;
    }

    public function content(): array
    {
        return $this->tour->content ?? [];
    }

    public function search(): array
    {
        return [
            'form' => $this->page->content['search']['text'] ?? [],
            'content' => $this->page->content['content'] ?? [],
        ];
    }

    public function seo(): array
    {
        $seo = $this->tour->seo ?? [];

        foreach ($this->tour->name ?? [] as $locale => $value) {
            $seo['title'][$locale] = $seo['title'][$locale] ?? $value . ' | ' . config('app.name');
        }

        return $seo;
    }
}
