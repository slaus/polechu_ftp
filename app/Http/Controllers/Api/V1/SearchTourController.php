<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\SearchTour\SearchTourOptionsRequest;
use App\Http\Requests\Api\V1\SearchTour\SearchTourOrderRequest;
use App\Http\Requests\Api\V1\SearchTour\SearchToursRequest;
use App\Http\Requests\Api\V1\SearchTour\SearchTourTownsRequest;
use App\Http\Resources\Api\V1\SearchTour\CountriesListResource;
use App\Http\Resources\Api\V1\SearchTour\OptionsListResource;
use App\Http\Resources\Api\V1\SearchTour\ToursListResource;
use App\Http\Resources\Api\V1\SearchTour\TownsListResource;
use App\Notifications\TourOrderNotification;
use App\Services\BeeFlyTour\BeeFlyTourService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

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

    public function tours(SearchToursRequest $request, BeeFlyTourService $service): JsonResponse
    {
        $payload = $request->validated();

        $tours = $service->listTours($payload);

        return new JsonResponse(ToursListResource::collection($tours));
    }

    public function order(SearchTourOrderRequest $request): JsonResponse
    {
        try {
            $payload = $request->validated();

            Notification::route('mail', settings('emails.order_form', config('mail.from.address')))
                ->notify(new TourOrderNotification($payload));

            return new JsonResponse(['status' => 'success']);
        } catch (\Exception $exception) {
            Log::error('Error send щквук form notification.' . $exception->getMessage());
        }

        return new JsonResponse(['status' => 'error']);
    }
}
