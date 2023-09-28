<?php

namespace App\Http\Requests\Api\V1\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'array', 'min:1'],
            'position' => ['nullable', 'array', 'min:1'],
            'description' => ['nullable', 'array'],
            'details' => ['nullable', 'array'],
            'image' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer'],
            'visibility' => ['nullable', 'boolean'],
        ];
    }
}
