<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Tag\TagItemResource;
use App\Services\Tag\QueryTagService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $queryService = new QueryTagService($request->user());
        $tags = $queryService->list($request->all());

        return new JsonResponse(TagItemResource::collection($tags));
    }
}
