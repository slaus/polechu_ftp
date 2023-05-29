<?php

namespace App\Services\Setting;

use App\Models\Setting;
use App\Models\User;

class CommandSettingService
{
    public function __construct(
        private readonly User $auth
    ) {}

    public function store(string $group, array $data): void
    {
        foreach ($data as $setting) {
            Setting::updateOrCreate(['group' => $group, 'name' => $setting['name']], [
                'value' => $setting['value'],
            ]);
        }
    }
}
