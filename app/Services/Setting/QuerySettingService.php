<?php

namespace App\Services\Setting;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class QuerySettingService
{
    public function __construct(
        private readonly User $user
    ) {}

    public function list(string $group): Collection
    {
        return Setting::where('group', $group)->get();
    }
}
