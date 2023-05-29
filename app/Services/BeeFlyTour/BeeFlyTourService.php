<?php

namespace App\Services\BeeFlyTour;

class BeeFlyTourService
{
    public function __construct(
        private readonly BeeFlyTourApi $api
    ) {}

    public function listTowns(): array
    {
        dd($this->api->get([
            'samo_action' => 'api',
            'type' => 'json',
            'action' => 'SearchTour_TOWNFROMS',
        ]));
    }
}
