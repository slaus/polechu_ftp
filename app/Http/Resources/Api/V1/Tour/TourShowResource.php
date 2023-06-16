<?php

namespace App\Http\Resources\Api\V1\Tour;

use Illuminate\Http\Resources\Json\JsonResource;

class TourShowResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'image' => $this->image,
            'gallery' => $this->gallery ?? [],
            'price' => $this->price,
            'description' => $this->description,
            'content' => $this->content,
            'seo' => $this->seo,
            'visibility' => $this->visibility,
            'order' => $this->order,
        ];
    }
}
