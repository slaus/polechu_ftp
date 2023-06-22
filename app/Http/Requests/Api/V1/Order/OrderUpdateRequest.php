<?php

namespace App\Http\Requests\Api\V1\Order;

use App\Enums\OrderTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', Rule::in(array_column(OrderTypeEnum::cases(), 'value'))],
            'title' => ['nullable', 'array', 'min:1'],
            'content' => ['nullable', 'array'],
        ];
    }
}
