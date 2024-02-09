<?php

namespace App\View\Components;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\View\Component;
use Illuminate\View\View;

class MenuComponent extends Component
{
    public function __construct(
        public string $layout,
        public string $searchButton = "true",
    ) {}

    public function render(): View
    {
        $query = Menu::where('visibility', true)
            ->where('layout', Menu::MENU_LAYOUTS[$this->layout] ?? 1)
            ->defaultOrder()
            ->withDepth();

        $items = $query->get();

        $pageIds = array_filter(array_map(function ($item) {
            if (isset($item['type']) && $item['type'] == 'page') {
                return $item['id'] ?? null;
            }

            return null;
        }, $items->pluck('properties.target')->toArray()));

        $pages = Page::where('visibility', true)->whereIn('id', $pageIds)->get();

        $items = $items->map(function (Menu $menu) use ($pages) {
            $target = $menu->properties['target'] ?? [];

            if (! isset($target['type'])) {
                $properties['url'] = '#';
            } else if ($target['type'] == 'page') {
                $page = $pages->where('id', (int) ($target['id'] ?? 0))->first();
                $properties['url'] = $page ? route('page', $page->slug != 'home' ? $page->slug : '') : '#';
            } else if ($target['type'] == 'link') {
                $properties['url'] = $target['name'] ?? '#';
                $properties['target'] = '_blank';
            }

            $menu->properties = $properties;

            return $menu;
        })->toTree()->toArray();

        return view('components.menu.' . $this->layout . '.index', [
            'items' => $items,
            'searchButton' => $this->searchButton,
        ]);
    }
}
