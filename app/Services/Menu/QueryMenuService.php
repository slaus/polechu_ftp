<?php

namespace App\Services\Menu;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Collection;

class QueryMenuService
{
    public function __construct(
        private readonly User $user
    ) {}

    public function treeList(): Collection
    {
        $menus = Menu::defaultOrder()->with(['ancestors'])
            ->withDepth()
            ->get();

        return $menus->groupBy('layout')->map(function (Collection $menus) {
            return $menus->toTree();
        })->sortKeys();
    }

    public function show(int $id): Menu
    {
        return Menu::findOrFail($id);
    }
}
