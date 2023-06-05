<?php

namespace App\Services\Tag;

use App\Models\User;
use Illuminate\Support\Collection;
use Spatie\Tags\Tag;

class QueryTagService
{
    public function __construct(
        private readonly User $user
    ) {}

    public function list(array $data): Collection
    {
        return Tag::where('type', $data['type'] ?? null)->get();
    }
}
