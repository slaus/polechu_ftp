<?php

namespace App\Http\Resources\Api\V1\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'token' => $this->createToken('api')->plainTextToken,
            'locale' => app()->getLocale(),
        ];
    }
}
