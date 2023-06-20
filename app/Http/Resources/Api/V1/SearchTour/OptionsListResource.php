<?php

namespace App\Http\Resources\Api\V1\SearchTour;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionsListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'checkin' => $this->resource['checkin'] ?? [],
            'currencies' => $this->resource['currencies'] ?? [],
            'hotels' => $this->resource['hotels'] ?? [],
            'meals' => $this->resource['meals'] ?? [],
            'nights' => $this->resource['nights']['nights'] ?? [],
            'stars' => $this->resource['stars'] ?? [],
            'towns' => $this->resource['towns'] ?? [],
        ];
    }
}
