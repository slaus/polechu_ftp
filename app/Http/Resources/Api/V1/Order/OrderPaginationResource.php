<?php

namespace App\Http\Resources\Api\V1\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderPaginationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => $this->created_at?->format('d.m.Y H:i'),
        ];
    }
}
