<?php

namespace App\Http\Requests\Api\V1\Page;

use Illuminate\Foundation\Http\FormRequest;

class PageStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'slug' => ['required', 'alpha_dash', 'string', 'max:255', 'unique:pages,slug'],
            'name' => ['required', 'array', 'min:1'],
            'content' => ['nullable', 'array'],
            'visibility' => ['nullable', 'boolean'],
        ];
    }
}
