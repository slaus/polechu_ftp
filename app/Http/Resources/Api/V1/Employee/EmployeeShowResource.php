<?php

namespace App\Http\Resources\Api\V1\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeShowResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'position' => $this->position,
            'description' => $this->description,
            'details' => $this->details,
            'image' => $this->image,
            'order' => $this->order,
            'visibility' => $this->visibility,
        ];
    }
}
