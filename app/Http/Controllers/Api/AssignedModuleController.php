<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AssignedModuleRequest;
use App\Http\Requests\Api\GetAssignedModuleRequest;
use App\Http\Requests\Api\GetStudentAssignedModuleRequest;
use App\Http\Requests\Api\PlayStudentAssignedModuleRequest;
use App\Http\Resources\AssignedModuleResource;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
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

    public function getTeacherAssignedModule(GetAssignedModuleRequest $getAssignedModuleRequest): JsonResponse
    {
           $modules = $this->assignedModuleService->getTeacherAssignedModules($getAssignedModuleRequest->validated());
           $data = AssignedModuleResource::collection($modules);

           return response()->json([
             'message' => 'Get Successfully',
             'data' => $data
           ]);

    }

    public function getStudentAssignedModule(GetStudentAssignedModuleRequest $getStudentAssignedModuleRequest): JsonResponse
    {
        $modules = $this->assignedModuleService->getStudentAssignedModules($getStudentAssignedModuleRequest->validated());
        $data = AssignedModuleResource::collection($modules);

        return response()->json([
          'message' => 'Get Successfully',
          'data' => $data
        ]);
    }

    public function playTeacherAssignedModule(PlayStudentAssignedModuleRequest $playStudentAssignedModuleRequest)
    {
        $type = $playStudentAssignedModuleRequest->type;
        $mudole_id = $playStudentAssignedModuleRequest->module_id;
        
        $topics = Topic::query()->orderBy('created_at', 'asc')->where('type', $type)->where('id', $mudole_id)->get();
        $data = TopicResource::collection($topics);

        return response()->json(
            [
                'message' => 'Get Topic Successful.',
                'data' => $data
            ],
            status: 200
        );
    }
}
