<?php

namespace App\Http\Resources\Api\V1\Menu;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuShowResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'layout' => $this->layout,
            'name' => $this->name,
            'properties' => $this->properties,
            'parent_id' => $this->parent_id,
            'visibility' => $this->visibility,
        ];
    }
}
