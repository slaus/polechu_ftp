<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Setting\SettingStoreRequest;
use App\Http\Resources\Api\V1\Setting\ItemSettingResource;
use App\Services\Setting\CommandSettingService;
use App\Services\Setting\QuerySettingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request, string $group): JsonResponse
    {
        $queryService = new QuerySettingService($request->user());
        $settings = $queryService->list($group);

        return new JsonResponse(ItemSettingResource::collection($settings));
    }

    public function store(SettingStoreRequest $request, string $group): JsonResponse
    {
        $data = $request->validated();

        $commandService = new CommandSettingService($request->user());
        $commandService->store($group, $data['data'] ?? []);

        return new JsonResponse(['status' => 'Success']);
    }
}
