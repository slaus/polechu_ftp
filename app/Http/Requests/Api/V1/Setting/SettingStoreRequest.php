<?php

namespace App\Http\Requests\Api\V1\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'data.*.name' => ['required', 'string', 'max:255'],
            'data.*.value' => ['nullable', 'array'],
        ];
    }
}
