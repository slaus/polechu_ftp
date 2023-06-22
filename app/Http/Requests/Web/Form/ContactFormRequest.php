<?php

namespace App\Http\Requests\Web\Form;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'text' => ['required', 'string', 'max:10000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('The name field is required'),
            'email.required' => __('The email field is required'),
            'text.required' => __('The text field is required'),
            '*.email' => __('Wrong email format'),
        ];
    }
}
