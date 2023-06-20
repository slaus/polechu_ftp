<?php

namespace App\Http\Requests\Api\V1\SearchTour;

use Illuminate\Foundation\Http\FormRequest;

class SearchTourOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tour' => ['required', 'array'],
            'tour.id' => ['required', 'integer'],
            'tour.name' => ['required', 'string'],
            'tour.state' => ['required', 'string'],
            'tour.town' => ['required', 'string'],
            'tour.price' => ['required', 'string'],
            'tour.checkin' => ['required', 'string'],
            'tour.nights' => ['required', 'string'],
            'client' => ['required', 'array'],
            'client.name' => ['required', 'string'],
            'client.phone' => ['required', 'string'],
            'client.email' => ['required', 'email'],
            'client.time' => ['required', 'string'],
            'client.note' => ['nullable', 'string'],
        ];
    }
}
