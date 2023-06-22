<?php

namespace App\Http\Resources\Api\V1\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderShowResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'content' => $this->content ?? [],
            'created_at' => $this->created_at?->format('d.m.Y H:i'),
        ];
    }
}
