<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Employee\EmployeeStoreRequest;
use App\Http\Requests\Api\V1\Employee\EmployeeUpdateRequest;
use App\Http\Resources\Api\V1\Employee\EmployeePaginationResource;
use App\Http\Resources\Api\V1\Employee\EmployeeShowResource;
use App\Services\Employee\CommandEmployeeService;
use App\Services\Employee\QueryEmployeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $queryService = new QueryEmployeeService($request->user());
        $employees = $queryService->listWithPaginate($request->all());

        return new JsonResponse(EmployeePaginationResource::collection($employees)->response()->getData(true));
    }

    public function store(EmployeeStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $commandService = new CommandEMployeeService($request->user());
        $commandService->store($data);
        $employee = $commandService->employee();

        return new JsonResponse(EmployeeShowResource::make($employee));
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $queryService = new QueryEmployeeService($request->user());
        $employee = $queryService->show($id);

        return new JsonResponse(EmployeeShowResource::make($employee));
    }

    public function update(EmployeeUpdateRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();

        $commandService = new CommandEmployeeService($request->user());
        $commandService->update($id, $data);
        $employee = $commandService->employee();

        return new JsonResponse(EmployeeShowResource::make($employee));
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $queryService = new CommandEmployeeService($request->user());
        $queryService->delete($id);

        return new JsonResponse(status: 204);
    }
}
