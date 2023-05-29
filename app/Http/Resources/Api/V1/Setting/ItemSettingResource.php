<?php

namespace App\Http\Resources\Api\V1\Setting;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemSettingResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'group' => $this->group,
            'name' => $this->name,
            'value' => $this->value,
        ];
    }
}
