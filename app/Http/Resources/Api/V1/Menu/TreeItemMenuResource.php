<?php

namespace App\Http\Resources\Api\V1\Menu;

use Illuminate\Http\Resources\Json\JsonResource;

class TreeItemMenuResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'layout' => $this->layout,
            'name' => $this->name,
            'parent_id' => $this->parent_id,
            'properties' => $this->properties ?? [],
            'visibility' => $this->visibility,
            'children' => TreeItemMenuResource::collection($this->children),
        ];
    }
}
