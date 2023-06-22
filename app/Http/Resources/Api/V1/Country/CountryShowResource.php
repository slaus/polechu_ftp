<?php

namespace App\Http\Resources\Api\V1\Country;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryShowResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'plugin_id' => $this->plugin_id,
            'name' => $this->name,
            'gallery' => $this->gallery ?? [],
        ];
    }
}
