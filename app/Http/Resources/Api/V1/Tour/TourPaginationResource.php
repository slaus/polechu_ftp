<?php

namespace App\Http\Resources\Api\V1\Tour;

use Illuminate\Http\Resources\Json\JsonResource;

class TourPaginationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name ?? [],
            'visibility' => $this->visibility,
            'order' => $this->order,
        ];
    }
}
