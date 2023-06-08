<?php

namespace App\Http\Resources\Api\V1\Menu;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupMenuResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'layout' => $this->resource->pluck('layout')->first(),
            'items' => TreeItemMenuResource::collection($this->resource),
        ];
    }
}
