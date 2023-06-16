<?php

namespace App\Http\Requests\Api\V1\Tour;

use Illuminate\Foundation\Http\FormRequest;

class TourUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'slug' => ['required', 'alpha_dash', 'string', 'max:255', 'unique:tours,slug,' . $this->route('tour') . ',id'],
            'name' => ['required', 'array', 'min:1'],
            'image' => ['nullable', 'string', 'max:255'],
            'gallery' => ['nullable', 'array'],
            'price' => ['nullable', 'array'],
            'description' => ['nullable', 'array'],
            'content' => ['nullable', 'array'],
            'seo' => ['nullable', 'array'],
            'visibility' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
        ];
    }
}
