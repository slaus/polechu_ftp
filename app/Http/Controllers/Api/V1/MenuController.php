<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Menu\MenuRebuildRequest;
use App\Http\Requests\Api\V1\Menu\MenuStoreRequest;
use App\Http\Requests\Api\V1\Menu\MenuUpdateRequest;
use App\Http\Resources\Api\V1\Menu\GroupMenuResource;
use App\Http\Resources\Api\V1\Menu\MenuShowResource;
use App\Services\Menu\CommandMenuService;
use App\Services\Menu\QueryMenuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $queryService = new QueryMenuService($request->user());
        $menus = $queryService->treeList();

        return new JsonResponse(GroupMenuResource::collection($menus));
    }

    public function store(MenuStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $commandService = new CommandMenuService($request->user());
        $commandService->store($data);
        $menu = $commandService->menu();

        return new JsonResponse(MenuShowResource::make($menu));
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $queryService = new QueryMenuService($request->user());
        $menu = $queryService->show($id);

        return new JsonResponse(MenuShowResource::make($menu));
    }

    public function update(MenuUpdateRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();

        $commandService = new CommandMenuService($request->user());
        $commandService->update($id, $data);
        $menu = $commandService->menu();

        return new JsonResponse(MenuShowResource::make($menu));
    }

    public function rebuild(MenuRebuildRequest $request): JsonResponse
    {
        $data = $request->validated();

        $commandService = new CommandMenuService($request->user());
        $commandService->rebuild($data);

        return new JsonResponse(['status' => 'Success']);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $queryService = new CommandMenuService($request->user());
        $queryService->delete($id);

        return new JsonResponse(status: 204);
    }
}
