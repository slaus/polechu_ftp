<?php

namespace App\Services\Tour;

use App\Models\Tour;
use App\Models\User;

class CommandTourService
{
    private readonly Tour $tour;

    public function __construct(
        private readonly User $auth
    ) {}

    public function store(array $data): void
    {
        $tour = Tour::create($data);

        $this->tour = $tour;
    }

    public function update(int $id, array $data): void
    {
        $tour = Tour::findOrFail($id);
        $tour->update($data);

        $this->tour = $tour;
    }

    public function delete(int $id): void
    {
        $tour = Tour::findOrFail($id);
        $tour->delete();
    }

    public function tour(): Tour
    {
        return $this->tour;
    }
}
