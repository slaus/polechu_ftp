<?php

namespace App\Services\Page;

use App\Models\Page;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class QueryPageService
{
    public function __construct(
        private readonly User $user
    ) {}

    public function listWithPaginate(array $data): LengthAwarePaginator
    {
        $query = Page::query();

        if (! empty($data['search'])) {
            $search = $data['search'];

            $query->where(function (Builder $query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
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
            $query->orderByDesc('created_at');
        }

        return $query->paginate(perPage: $data['itemsPerPage'] ?? 10);
    }

    public function list(array $data): Collection
    {
        $query = Page::where('visibility', true);

        return $query->get();
    }

    public function show(int $id): Page
    {
        return Page::findOrFail($id);
    }
}
