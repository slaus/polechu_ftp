<?php

namespace App\Http\Requests\Api\V1\SearchTour;

use Illuminate\Foundation\Http\FormRequest;

class SearchTourOptionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'country_id' => ['required', 'integer'],
            'town_id' => ['required', 'integer'],
        ];
    }
}
