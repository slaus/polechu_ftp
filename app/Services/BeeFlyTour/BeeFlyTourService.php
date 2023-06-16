<?php

namespace App\Services\BeeFlyTour;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class BeeFlyTourService
{
    public function __construct(
        private readonly BeeFlyTourApi $api
    ) {}

    public function listCountries(): array
    {
        try {
            return Cache::rememberForever('countries', function () {
                $countries = [];

                foreach ($this->listTowns() as $town) {
                    $countriesByTown = $this->api->get([
                        'samo_action' => 'api',
                        'type' => 'json',
                        'action' => 'SearchTour_STATES',
                        'TOWNFROMINC' => $townId,
                    ])['SearchTour_STATES'] ?? [];

                    foreach ($countriesByTown as $country) {
                        if (! in_array($country['id'], $countries)) {
                            $countries[$country['id']] = $country;
                        }
                    }
                }

                return $countries;
            });
        } catch (\Exception $exception) {
            Log::error('Error get list of countries.' . $exception->getMessage());
        }

        return [];
    }

    public function listTowns(): array
    {
        try {
            return $this->api->get([
                'samo_action' => 'api',
                'type' => 'json',
                'action' => 'SearchTour_TOWNFROMS',
            ])['SearchTour_TOWNFROMS'] ?? [];
        } catch (\Exception $exception) {
            Log::error('Error get list of towns.' . $exception->getMessage());
        }

        return [];
    }
}
