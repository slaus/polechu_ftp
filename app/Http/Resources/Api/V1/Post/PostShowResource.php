<?php

namespace App\Http\Resources\Api\V1\Post;

use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\Tags\Tag;

class PostShowResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'image' => $this->image,
            'description' => $this->description,
            'content' => $this->content,
            'seo' => $this->seo,
            'visibility' => $this->visibility,
            'tags' => $this->tags->map(fn (Tag $tag) => $tag->getOriginal('name'))->toArray()
        ];
    }
}
