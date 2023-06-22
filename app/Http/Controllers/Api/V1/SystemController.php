<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;

class SystemController extends Controller
{
    public function clearCache(): JsonResponse
    {
        Artisan::call('cache:clear');

        return new JsonResponse(status: 204);
    }
}
