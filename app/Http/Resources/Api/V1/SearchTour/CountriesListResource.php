<?php

namespace App\Http\Resources\Api\V1\SearchTour;

use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\Tags\Tag;

class CountriesListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource['id'],
            'name' => $this->resource['name'],
        ];
    }
}
