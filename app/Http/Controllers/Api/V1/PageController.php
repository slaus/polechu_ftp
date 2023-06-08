<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Page\PageStoreRequest;
use App\Http\Requests\Api\V1\Page\PageUpdateRequest;
use App\Http\Resources\Api\V1\Page\PageListResource;
use App\Http\Resources\Api\V1\Page\PagePaginationResource;
use App\Http\Resources\Api\V1\Page\PageShowResource;
use App\Services\Page\CommandPageService;
use App\Services\Page\QueryPageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $queryService = new QueryPageService($request->user());
        $pages = $queryService->listWithPaginate($request->all());

        return new JsonResponse(PagePaginationResource::collection($pages)->response()->getData(true));
    }

    public function list(Request $request): JsonResponse
    {
        $queryService = new QueryPageService($request->user());
        $pages = $queryService->list($request->all());

        return new JsonResponse(PageListResource::collection($pages));
    }

    public function store(PageStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $commandService = new CommandPageService($request->user());
        $commandService->store($data);
        $page = $commandService->page();

        return new JsonResponse(PageShowResource::make($page));
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $queryService = new QueryPageService($request->user());
        $page = $queryService->show($id);

        return new JsonResponse(PageShowResource::make($page));
    }

    public function update(PageUpdateRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();

        $commandService = new CommandPageService($request->user());
        $commandService->update($id, $data);
        $page = $commandService->page();

        return new JsonResponse(PageShowResource::make($page));
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $queryService = new CommandPageService($request->user());
        $queryService->delete($id);

        return new JsonResponse(status: 204);
    }
}
