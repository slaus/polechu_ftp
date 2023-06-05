<?php

namespace App\Services\Page;

use App\Models\Page;
use App\Models\User;

class CommandPageService
{
    private readonly Page $page;

    public function __construct(
        private readonly User $auth
    ) {}

    public function store(array $data): void
    {
        $page = Page::create($data);

        $this->page = $page;
    }

    public function update(int $id, array $data): void
    {
        $page = Page::findOrFail($id);
        unset($data['slug']);
        $page->update($data);

        $this->page = $page;
    }

    public function delete(int $id): void
    {
        $page = Page::findOrFail($id);
        $page->delete();
    }

    public function page(): Page
    {
        return $this->page;
    }
}
