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
            return Cache::rememberForever('towns_from_' . $countryId, function () use ($countryId) {
                $towns = [];

                foreach ($this->listTowns() as $town) {
                    $townsByCountry = $this->api->get([
                        'samo_action' => 'api',
                        'type' => 'json',
                        'action' => 'SearchTour_CHECKIN',
                        'STATEINC' => $countryId,
                        'TOWNFROMINC' => $town['id'],
                    ])['SearchTour_CHECKIN'] ?? [];

                    if (isset($townsByCountry['valid']) && $townsByCountry['valid'] != '') {
                        $towns[] = $town;
                    }
                }

                return $towns;
            });
        } catch (\Exception $exception) {
            Log::error('Error get list of towns from.' . $exception->getMessage());
        }

        return [];
    }

    public function listOptions(array $payload): array
    {
        try {
            $response = $this->api->get([
                'samo_action' => 'api',
                'type' => 'json',
                'action' => 'SearchTour_ALL',
                'STATEINC' => $payload['country'],
                'TOWNFROMINC' => $payload['town'],
            ])['SearchTour_ALL'] ?? [];

            if (isset($response['CHECKIN_BEG'], $response['CHECKIN_BEG']['startDate'], $response['CHECKIN_BEG']['validDates'])) {
                $dateFormat = 'd.m.Y';
                $tourDateBegin = $response['CHECKIN_BEG']['startDate'];
                $tourDays = str_split($response['CHECKIN_BEG']['validDates']);

                if (count($tourDays) > 0) {
                    foreach ($tourDays as $day => $type) {
                        if ($type == '0' || $type == '') {
                            continue;
                        }

                        $checkin[] = date($dateFormat, strtotime($tourDateBegin . ' + ' . $day  . ' days'));
                    }
                }
            }

            $nights = $this->api->get([
                'samo_action' => 'api',
                'type' => 'json',
                'action' => 'SearchTour_NIGHTS',
                'STATEINC' => $payload['country'],
                'TOWNFROMINC' => $payload['town'],
            ])['SearchTour_NIGHTS'] ?? [];

            if (isset($response['CURRENCIES'])) {
                $currencies = $response['CURRENCIES'];
            }

            if (isset($response['TOWNS'])) {
                $towns = $response['TOWNS'];
            }

            if (isset($response['STARS'])) {
                $stars = $response['STARS'];
            }

            if (isset($response['HOTELS'])) {
                $hotels = $response['HOTELS'];
            }

            foreach ($response['MEALS'] ?? [] as $meal) {
                $meal['name'] = $this->mealName($meal['name']);
                $meals[] = $meal;
            }

            return [
                'checkin' => $checkin ?? [],
                'currencies' => $currencies ?? [],
                'hotels' => $hotels ?? [],
                'meals' => $meals ?? [],
                'nights' => $nights ?? [],
                'stars' => $stars ?? [],
                'towns' => $towns ?? [],
            ];
        } catch (\Exception $exception) {
            Log::error('Error get list of options.' . $exception->getMessage());
        }

        return [];
    }

    public function listTours(array $payload): array
    {
        try {
            $response = $this->api->get([
                'samo_action' => 'api',
                'type' => 'json',
                'action' => 'SearchTour_PRICES',
                'STATEINC' => $payload['country_id'],
                'TOWNFROMINC' => $payload['town_from_id'],
                'ADULT' => $payload['adult'],
                'CHILD' => $payload['child'] > 0 ? $payload['child'] : '',
                'AGES' => implode(',', array_filter($payload['child_ages'] ?? [])),
                'CHECKIN_BEG' => $payload['checkin_beg'],
                'CHECKIN_END' => $payload['checkin_end'],
                'NIGHTS_FROM' => $payload['nights_from'],
                'NIGHTS_TILL' => $payload['nights_till'],
                'CURRENCY' => $payload['currency_id'],
                'COSTMIN' => $payload['cost_min'] ?? '',
                'COSTMAX' => $payload['cost_max'] ?? '',
                'TOWNS' => implode(',', array_filter($payload['towns'])),
                'HOTELS' => implode(',', array_filter($payload['hotels'])),
                'STARS' => implode(',', array_filter($payload['stars'])),
                'MEALS' => implode(',', array_filter($payload['meals'])),
                'CHILD_IN_BED' => $payload['child_in_bed'],
                'FREIGHT' => $payload['freight'],
                'FILTER' => $payload['filter'],
                'MOMENT_CONFIRM' => $payload['moment_confirm'],
                'PARTITION_PRICE' => 255,
                'PRICEPAGE' => 1,
                'PERPAGE' => 6,
            ])['SearchTour_PRICES']['prices'] ?? [];

            return array_map(function ($item) {
                $item['checkIn'] = isset($item['checkIn']) ? date('d.m.Y', strtotime($item['checkIn'])) : '';
                $item['price'] = isset($item['price']) ? number_format((int) $item['price'], 0, ',', ' ') : '';
                $item['meal'] = $this->mealName($item['meal'] ?? '');
                $item['town_from'] = array_filter($this->listTowns(), fn ($item) => $item['id'] == $item['townFromKey'])['name'] ?? $item['townFromKey'];

                return $item;
            }, $response);
        } catch (\Exception $exception) {
            Log::error('Error get list of tours.' . $exception->getMessage());
        }

        return [];
    }

    private function listTowns(): array
    {
        try {
            return Cache::rememberForever('towns', function () {
                return $this->api->get([
                    'samo_action' => 'api',
                    'type' => 'json',
                    'action' => 'SearchTour_TOWNFROMS',
                ])['SearchTour_TOWNFROMS'] ?? [];
            });
        } catch (\Exception $exception) {
            Log::error('Error get list of towns.' . $exception->getMessage());
        }

        return [];
    }

    private function mealName(string $meal): string
    {
        return match ($meal) {
            'AI' => __('все включено'),
            'BB' => __('сніданок'),
            'HB' => __('сніданок та вечеря'),
            'RO' => __('без харчування'),
            'FB' => __('сніданок, обід, вечеря'),
            'RO+лечение' => __('RO+лікування'),
            'UAI' => __('ультра все включено'),
            default => '',
        };
    }
}
