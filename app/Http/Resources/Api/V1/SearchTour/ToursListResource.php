<?php

namespace App\Http\Resources\Api\V1\SearchTour;

use Illuminate\Http\Resources\Json\JsonResource;

class ToursListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => $this->resource['hotel'] ?? '',
            'hotel_id' => $this->resource['hotelKey'] ?? '',
            'town' => $this->resource['town'] ?? '',
            'price' => $this->resource['price'] ?? '',
            'currency' => $this->resource['currency'] ?? '',
            'nights' => $this->resource['nights'] ?? '',
            'star' => $this->resource['star'] ?? '',
            'checkin' => $this->resource['checkIn'] ?? '',
            'moment_confirm' => $this->resource['momentConfirm'] ?? '',
            'meal' => $this->resource['meal'] ?? '',
            'room' => $this->resource['room'] ?? '',
            'ht_place' => $this->resource['htPlace'] ?? '',
            'freights' => $this->resource['freights']['econom'] ?? '',
            'tour' => $this->resource['tour'] ?? '',
            'tour_id' => $this->resource['tourKey'] ?? '',
            'state_key' => $this->resource['stateKey'] ?? '',
            'state' => $this->resource['stateKey'] ?? '',
            'town_from' => $this->resource['townFromKey'] ?? '',
        ];
    }
}
