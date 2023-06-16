<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Auth\AuthResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function user(Request $request): JsonResponse
    {
        $user = $request->user();

        return new JsonResponse(AuthResource::make($user));
    }
}
