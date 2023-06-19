<?php

namespace App\Http\Requests\Api\V1\SearchTour;

use Illuminate\Foundation\Http\FormRequest;

class SearchToursRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'country_id' => ['required', 'integer'],
            'town_from_id' => ['required', 'integer'],
            'adult' => ['required', 'integer'],
            'child' => ['required', 'integer'],
            'child_ages' => ['nullable', 'array'],
            'checkin_beg' => ['required', 'string'],
            'checkin_end' => ['required', 'string'],
            'nights_from' => ['required', 'integer'],
            'nights_till' => ['required', 'integer'],
            'currency_id' => ['required', 'integer'],
            'cost_min' => ['nullable', 'string'],
            'cost_max' => ['nullable', 'string'],
            'towns' => ['nullable', 'array'],
            'hotels' => ['nullable', 'array'],
            'stars' => ['nullable', 'array'],
            'meals' => ['nullable', 'array'],
            'child_in_bed' => ['required', 'boolean'],
            'freight' => ['required', 'boolean'],
            'filter' => ['required', 'boolean'],
            'moment_confirm' => ['required', 'boolean'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'child_in_bed' => $this['child_in_bed'] == 'true',
            'freight' => $this['freight'] == 'true',
            'filter' => $this['filter'] == 'true',
            'moment_confirm' => $this['moment_confirm'] == 'true',
        ]);
    }
}
