<?php

namespace App\Http\Requests\Api\V1\Country;

use Illuminate\Foundation\Http\FormRequest;

class CountryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'plugin_id' => ['nullable', 'integer'],
            'name' => ['required', 'array', 'min:1'],
            'gallery' => ['nullable', 'array'],
        ];
    }
}
