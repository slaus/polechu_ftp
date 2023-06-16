<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Post\PostStoreRequest;
use App\Http\Requests\Api\V1\Post\PostUpdateRequest;
use App\Http\Resources\Api\V1\Post\PostPaginationResource;
use App\Http\Resources\Api\V1\Post\PostShowResource;
use App\Services\Post\CommandPostService;
use App\Services\Post\QueryPostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $queryService = new QueryPostService($request->user());
        $tours = $queryService->listWithPaginate($request->all());

        return new JsonResponse(PostPaginationResource::collection($tours)->response()->getData(true));
    }

    public function store(PostStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $commandService = new CommandPostService($request->user());
        $commandService->store($data);
        $post = $commandService->post();

        return new JsonResponse(PostShowResource::make($post));
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $queryService = new QueryPostService($request->user());
        $post = $queryService->show($id);

        return new JsonResponse(PostShowResource::make($post));
    }

    public function update(PostUpdateRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();

        $commandService = new CommandPostService($request->user());
        $commandService->update($id, $data);
        $post = $commandService->post();

        return new JsonResponse(PostShowResource::make($post));
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $queryService = new CommandPostService($request->user());
        $queryService->delete($id);

        return new JsonResponse(status: 204);
    }
}
