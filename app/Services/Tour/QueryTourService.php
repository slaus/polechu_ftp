<?php

namespace App\Services\Tour;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class QueryTourService
{
    public function __construct(
        private readonly User $user
    ) {}

    public function listWithPaginate(array $data): LengthAwarePaginator
    {
        $query = Tour::query();

        if (! empty($data['search'])) {
            $search = $data['search'];

            $query->where(function (Builder $query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        if (! empty($data['sortBy']) && ! empty($data['sortDesc'])) {
            $orderBy = $data['sortBy'][0];
            $sortDesc = $data['sortDesc'][0];

            if ($orderBy == 'name') {
                $orderBy = 'name->' . app()->getLocale();
            }

            if ($sortDesc == 'true') {
                $query->orderByDesc($orderBy);
            } else {
                $query->orderBy($orderBy);
            }
        } else {
            $query->orderByDesc('created_at');
        }

        return $query->paginate(perPage: $data['itemsPerPage'] ?? 10);
    }

    public function show(int $id): Tour
    {
        return Tour::findOrFail($id);
    }
}
