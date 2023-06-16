<?php

namespace App\Http\Resources\Api\V1\Post;

use Illuminate\Http\Resources\Json\JsonResource;

class PostPaginationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name ?? [],
            'visibility' => $this->visibility,
            'created_at' => $this->created_at?->format('d.m.Y'),
        ];
    }
}
