<?php

namespace App\Http\Resources\Api\V1\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeePaginationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name ?? [],
            'order' => $this->order,
            'visibility' => $this->visibility,
        ];
    }
}
