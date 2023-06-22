<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Country\CountryStoreRequest;
use App\Http\Requests\Api\V1\Country\CountryUpdateRequest;
use App\Http\Resources\Api\V1\Country\CountryPaginationResource;
use App\Http\Resources\Api\V1\Country\CountryShowResource;
use App\Services\Country\CommandCountryService;
use App\Services\Country\QueryCountryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $queryService = new QueryCountryService($request->user());
        $countries = $queryService->listWithPaginate($request->all());

        return new JsonResponse(CountryPaginationResource::collection($countries)->response()->getData(true));
    }

    public function store(CountryStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $commandService = new CommandCountryService($request->user());
        $commandService->store($data);
        $country = $commandService->country();

        return new JsonResponse(CountryShowResource::make($country));
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $queryService = new QueryCountryService($request->user());
        $country = $queryService->show($id);

        return new JsonResponse(CountryShowResource::make($country));
    }

    public function update(CountryUpdateRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();

        $commandService = new CommandCountryService($request->user());
        $commandService->update($id, $data);
        $country = $commandService->country();

        return new JsonResponse(CountryShowResource::make($country));
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $queryService = new CommandCountryService($request->user());
        $queryService->delete($id);

        return new JsonResponse(status: 204);
    }
}
