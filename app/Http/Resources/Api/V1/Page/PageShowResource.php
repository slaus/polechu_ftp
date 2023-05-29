<?php

namespace App\Http\Resources\Api\V1\Page;

use Illuminate\Http\Resources\Json\JsonResource;

class PageShowResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'content' => $this->content,
            'seo' => $this->seo,
            'visibility' => $this->visibility,
        ];
    }
}
