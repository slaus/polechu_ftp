<?php

namespace App\Services\Employee;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class QueryEmployeeService
{
    public function __construct(
        private readonly User $user
    ) {}

    public function listWithPaginate(array $data): LengthAwarePaginator
    {
        $query = Employee::query();

        if (! empty($data['search'])) {
            $search = $data['search'];

            $query->where(function (Builder $query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
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

    public function show(int $id): Employee
    {
        return Employee::findOrFail($id);
    }
}
