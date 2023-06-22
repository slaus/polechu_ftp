<?php

namespace App\Services\Order;

use App\Enums\OrderTypeEnum;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class QueryOrderService
{
    public function __construct(
        private readonly User $user
    ) {}

    public function listWithPaginate(array $data): LengthAwarePaginator
    {
        $query = Order::where('type', $data['type'] ?? OrderTypeEnum::TOUR_FORM->value);

        if (! empty($data['search'])) {
            $search = $data['search'];

            $query->where(function (Builder $query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
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

    public function show(int $id): Order
    {
        return Order::findOrFail($id);
    }
}
