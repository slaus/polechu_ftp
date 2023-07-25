<?php

namespace App\Http\Requests\Web\Form;

use App\Rules\PhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class TourFormRequest extends FormRequest
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
            'phone' => ['required',  'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'text' => ['nullable', 'string', 'max:10000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('The name field is required'),
            'email.required' => __('The email field is required'),
            'phone.required' => __('The phone field is required'),
            'phone.regex' => __('Wrong phone format'),
            'phone.min' => __('Wrong phone format'),
            'text.required' => __('The text field is required'),
            '*.email' => __('Wrong email format'),
        ];
    }
}
