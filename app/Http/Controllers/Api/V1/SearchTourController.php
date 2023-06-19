<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\SearchTour\SearchTourOptionsRequest;
use App\Http\Requests\Api\V1\SearchTour\SearchTourTownsRequest;
use App\Http\Resources\Api\V1\SearchTour\CountriesListResource;
use App\Http\Resources\Api\V1\SearchTour\OptionsListResource;
use App\Http\Resources\Api\V1\SearchTour\TownsListResource;
use App\Services\BeeFlyTour\BeeFlyTourService;
use Illuminate\Http\JsonResponse;

class SearchTourController extends Controller
{
    public function countries(BeeFlyTourService $service): JsonResponse
    {
        $countries = $service->listCountries();

        return new JsonResponse(CountriesListResource::collection($countries));
    }

    public function towns(SearchTourTownsRequest $request, BeeFlyTourService $service): JsonResponse
    {
        $payload = $request->validated();

        $towns = $service->listTownsFrom($payload['country_id']);

        return new JsonResponse(TownsListResource::collection($towns));
    }

    public function options(SearchTourOptionsRequest $request, BeeFlyTourService $service): JsonResponse
    {
        $payload = $request->validated();

        $options = $service->listOptions($payload);

        return new JsonResponse(OptionsListResource::make($options));
    }

    public function tours(): JsonResponse
    {

    }
}
