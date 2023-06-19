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
                $towns = $response['CURRENCIES'];
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

    public function listTours(array $payload)
    {
        try {
            return $this->api->get([
                'samo_action' => 'api',
                'type' => 'json',
                'action' => 'SearchTour_PRICES',

                'STATEINC' => $country_id,
                'TOWNFROMINC' => $townfrom,
                'ADULT' => $adult,
                'CHILD' => $child,
                'AGES' => $child_ages,
                'CHECKIN_BEG' => $checkin_beg,
                'CHECKIN_END' => $checkin_end,
                'NIGHTS_FROM' => $nights_from,
                'NIGHTS_TILL' => $nights_till,
                'CURRENCY' => $currency_id,
                'COSTMIN' => $costmin,
                'COSTMAX' => $costmax,
                'TOWNS' => $towns,
                'HOTELS' => $hotels,
                'STARS' => $stars,
                'MEALS' => $meals,
                'CHILD_IN_BED' => $child_in_bed,
                'FREIGHT' => $freight,
                'FILTER' => $filter,
                'MOMENT_CONFIRM' => $moment_confirm,
                'PARTITION_PRICE' => $partition_price,
                'PRICEPAGE' => $pricepage,
                'PERPAGE' => 6,
            ])['SearchTour_PRICES'] ?? [];
        } catch (\Exception $exception) {
            Log::error('Error get list of towns.' . $exception->getMessage());
        }

        return [];
    }

    private function listTowns(): array
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
