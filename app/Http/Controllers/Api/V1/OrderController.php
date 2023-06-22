<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Order\OrderStoreRequest;
use App\Http\Requests\Api\V1\Order\OrderUpdateRequest;
use App\Http\Resources\Api\V1\Order\OrderPaginationResource;
use App\Http\Resources\Api\V1\Order\OrderShowResource;
use App\Services\Order\CommandOrderService;
use App\Services\Order\QueryOrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $queryService = new QueryOrderService($request->user());
        $orders = $queryService->listWithPaginate($request->all());

        return new JsonResponse(OrderPaginationResource::collection($orders)->response()->getData(true));
    }

    public function store(OrderStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $commandService = new CommandOrderService($request->user());
        $commandService->store($data);
        $order = $commandService->order();

        return new JsonResponse(OrderShowResource::make($order));
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $queryService = new QueryOrderService($request->user());
        $order = $queryService->show($id);

        return new JsonResponse(OrderShowResource::make($order));
    }

    public function update(OrderUpdateRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();

        $commandService = new CommandOrderService($request->user());
        $commandService->update($id, $data);
        $order = $commandService->order();

        return new JsonResponse(OrderShowResource::make($order));
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $queryService = new CommandOrderService($request->user());
        $queryService->delete($id);

        return new JsonResponse(status: 204);
    }
}
