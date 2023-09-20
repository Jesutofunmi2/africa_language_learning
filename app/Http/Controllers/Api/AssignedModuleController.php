<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AssignedModuleRequest;
use App\Http\Resources\AssignedModuleResource;
use App\Services\AssignedModuleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AssignedModuleController extends Controller
{
    public function __construct(protected AssignedModuleService $assignedModuleService)
    {
        // $this->middleware('auth');
    }
    public function createdTeacherAssignedModule(AssignedModuleRequest $assignedModuleRequest): JsonResponse
    {
         $this->assignedModuleService->createdTeacherAssignedModule($assignedModuleRequest->validated());
        return response()->json(
            [
                'message' => 'Created successful.',
            ],
            status: 201
        );
    }
}
