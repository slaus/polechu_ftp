<?php

namespace App\Services\Menu;

use App\Models\Menu;
use App\Models\User;

class CommandMenuService
{
    private readonly Menu $menu;

    public function __construct(
        private readonly User $auth
    ) {}

    public function store(array $data): void
    {
        $menu = Menu::create($data);

        $this->menu = $menu;
    }

    public function update(int $id, array $data): void
    {
        $menu = Menu::findOrFail($id);
        $menu->update($data);

        $this->menu = $menu;
    }

    public function delete(int $id): void
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
    }

    public function rebuild(array $data): void
    {
        Menu::rebuildTree($data['items']);
    }

    public function menu(): Menu
    {
        return $this->menu;
    }
}
