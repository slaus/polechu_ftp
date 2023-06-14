<?php

namespace App\Http\Requests\Api\V1\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'slug' => ['required', 'alpha_dash', 'string', 'max:255', 'unique:posts,slug,' . $this->route('post') . ',id'],
            'name' => ['required', 'array', 'min:1'],
            'image' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'array'],
            'content' => ['nullable', 'array'],
            'author' => ['required', 'array'],
            'seo' => ['nullable', 'array'],
            'tags' => ['nullable', 'array'],
            'visibility' => ['nullable', 'boolean'],
        ];
    }
}
