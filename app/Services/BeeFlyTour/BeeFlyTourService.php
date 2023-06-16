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
                        'TOWNFROMINC' => $town['id'],
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

    public function listTownsFrom(int $countryId): array
    {
        try {
            return Cache::rememberForever('towns_from', function () use ($countryId) {
                $towns = [];

                foreach ($this->listTowns() as $town) {
                    $townsByCountry = $this->api->get([
                        'samo_action' => 'api',
                        'type' => 'json',
                        'action' => 'SearchTour_CHECKIN',
                        'STATEINC' => $countryId,
                        'TOWNFROMINC' => $town['id'],
                    ])['SearchTour_CHECKIN'] ?? [];

                    foreach ($townsByCountry as $item) {
                        if (isset($item['valid']) && $item['valid'] != '') {
                            $towns[] = $town;
                        }
                    }
                }

                return $towns;
            });
        } catch (\Exception $exception) {
            Log::error('Error get list of towns from.' . $exception->getMessage());
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
