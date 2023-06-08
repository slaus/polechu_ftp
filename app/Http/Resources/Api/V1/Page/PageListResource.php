<?php

namespace App\Http\Resources\Api\V1\Page;

use Illuminate\Http\Resources\Json\JsonResource;

class PageListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
