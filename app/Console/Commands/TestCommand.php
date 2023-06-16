<?php

namespace App\Console\Commands;

use App\Services\BeeFlyTour\BeeFlyTourService;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'app:test-command';

    protected $description = '';

    public function handle(BeeFlyTourService $service): void
    {
        $towns = $service->listTowns();

        foreach ($towns as $town) {
            dump($service->listCountries($town['id']));
        }


    }
}
