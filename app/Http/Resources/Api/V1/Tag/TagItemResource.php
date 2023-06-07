<?php

namespace App\Http\Resources\Api\V1\Tag;

use Illuminate\Http\Resources\Json\JsonResource;

class TagItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return $this->getOriginal('name');
    }
}
