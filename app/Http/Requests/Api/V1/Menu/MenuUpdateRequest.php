<?php

namespace App\Http\Requests\Api\V1\Menu;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'layout' => ['required', 'integer', Rule::in(Menu::MENU_LAYOUTS)],
            'name' => ['required', 'array', 'min:1'],
            'properties' => ['nullable', 'array'],
            'visibility' => ['required', 'boolean'],
        ];
    }
}
