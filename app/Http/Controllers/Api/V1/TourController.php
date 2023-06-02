<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Tour\TourStoreRequest;
use App\Http\Requests\Api\V1\Tour\TourUpdateRequest;
use App\Http\Resources\Api\V1\Tour\TourPaginationResource;
use App\Http\Resources\Api\V1\Tour\TourShowResource;
use App\Services\Tour\CommandTourService;
use App\Services\Tour\QueryTourService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $queryService = new QueryTourService($request->user());
        $tours = $queryService->listWithPaginate($request->all());

        return new JsonResponse(TourPaginationResource::collection($tours)->response()->getData(true));
    }

    public function store(TourStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $commandService = new CommandTourService($request->user());
        $commandService->store($data);
        $tour = $commandService->tour();

        return new JsonResponse(TourShowResource::make($tour));
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $queryService = new QueryTourService($request->user());
        $tour = $queryService->show($id);

        return new JsonResponse(TourShowResource::make($tour));
    }

    public function update(TourUpdateRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();

        $commandService = new CommandTourService($request->user());
        $commandService->update($id, $data);
        $tour = $commandService->tour();

        return new JsonResponse(TourShowResource::make($tour));
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $queryService = new CommandTourService($request->user());
        $queryService->delete($id);

        return new JsonResponse(status: 204);
    }
}
