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
            'tour.tour_id' => ['required', 'integer'],
            'tour.hotel_id' => ['required', 'integer'],
            'tour.name' => ['required', 'string'],
            'tour.state' => ['required', 'string'],
            'tour.town' => ['required', 'string'],
            'tour.price' => ['required', 'string'],
            'tour.currency' => ['required', 'string'],
            'tour.checkin' => ['required', 'string'],
            'tour.nights' => ['required', 'integer'],
            'tour.town_from' => ['required', 'string'],
            'client' => ['required', 'array'],
            'client.name' => ['required', 'string'],
            'client.phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'client.email' => ['required', 'email'],
            'client.time' => ['required', 'string'],
            'client.note' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'tour.*.required' => __('The field is required'),
            'client.*.required' => __('The field is required'),
            'client.*.email' => __('Wrong email format'),
            'client.phone.regex' => __('Wrong phone format'),
            'client.phone.min' => __('Wrong phone format'),
        ];
    }
}
