<?php

namespace App\Http\Resources\Api\V1\Page;

use Illuminate\Http\Resources\Json\JsonResource;

class PagePaginationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name ?? [],
            'visibility' => $this->visibility,
        ];
    }
}
