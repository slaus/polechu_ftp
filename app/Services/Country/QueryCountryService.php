<?php

namespace App\Services\Country;

use App\Models\Country;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class QueryCountryService
{
    public function __construct(
        private readonly User $user
    ) {}

    public function listWithPaginate(array $data): LengthAwarePaginator
    {
        $query = Country::query();

        if (! empty($data['search'])) {
            $search = $data['search'];

            $query->where(function (Builder $query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        if (! empty($data['sortBy']) && ! empty($data['sortDesc'])) {
            $orderBy = $data['sortBy'][0];
            $sortDesc = $data['sortDesc'][0];

            if ($sortDesc == 'true') {
                $query->orderByDesc($orderBy);
            } else {
                $query->orderBy($orderBy);
            }
        } else {
            $query->orderBy('name');
        }

        return $query->paginate(perPage: $data['itemsPerPage'] ?? 10);
    }

    public function show(int $id): Country
    {
        return Country::findOrFail($id);
    }
}
