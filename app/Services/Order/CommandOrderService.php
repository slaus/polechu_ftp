<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\User;

class CommandOrderService
{
    private readonly Order $order;

    public function __construct(
        private readonly User $auth
    ) {}

    public function store(array $data): void
    {
        $order = Order::create($data);

        $this->order = $order;
    }

    public function update(int $id, array $data): void
    {
        $order = Order::findOrFail($id);
        $order->update($data);

        $this->order = $order;
    }

    public function delete(int $id): void
    {
        $order = Order::findOrFail($id);
        $order->delete();
    }

    public function order(): Order
    {
        return $this->order;
    }
}
