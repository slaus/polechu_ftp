<?php

namespace App\Services\Country;

use App\Models\Country;
use App\Models\User;

class CommandCountryService
{
    private readonly Country $country;

    public function __construct(
        private readonly User $auth
    ) {}

    public function store(array $data): void
    {
        $country = Country::create($data);

        $this->country = $country;
    }

    public function update(int $id, array $data): void
    {
        $country = Country::findOrFail($id);
        $country->update($data);

        $this->country = $country;
    }

    public function delete(int $id): void
    {
        $country = Country::findOrFail($id);
        $country->delete();
    }

    public function country(): Country
    {
        return $this->country;
    }
}
