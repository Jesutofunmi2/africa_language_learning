<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AssignedModuleRequest;
use App\Http\Requests\Api\AssignmentFileRequest;
use App\Http\Requests\Api\ClassWorkRequest;
use App\Http\Requests\Api\DeleteAssignedModuleRequest;
use App\Http\Requests\Api\GetAssignedModuleRequest;
use App\Http\Requests\Api\GetStudentAssignedModuleRequest;
use App\Http\Requests\Api\PlayStudentAssignedModuleRequest;
use App\Http\Resources\AssignmentFileResource;
use App\Http\Resources\AssignedModuleResource;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\TopicResource;
use App\Models\AssignedModule;
use App\Models\Question;
use App\Models\Topic;
use App\Services\AssignedModuleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AssignedModuleController extends Controller
{
    public function __construct(protected AssignedModuleService $assignedModuleService)
    {
    }

    //Crreat Teacher Assigned Module
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

    //Get Teacher Assigned Module from the teacher dashBoard
    public function getTeacherAssignedModule(GetAssignedModuleRequest $getAssignedModuleRequest): JsonResponse
    {
        $modules = $this->assignedModuleService->getTeacherAssignedModules($getAssignedModuleRequest->validated());
        $data = AssignedModuleResource::collection($modules);

        return response()->json([
            'message' => 'Get Successfully',
            'data' => $data
        ]);
    }

    // Get all assigned Module to the class from the student side 
    public function getStudentAssignedModule(GetStudentAssignedModuleRequest $getStudentAssignedModuleRequest): JsonResponse
    {
        $modules = $this->assignedModuleService->getStudentAssignedModules($getStudentAssignedModuleRequest->validated());
        $data = AssignedModuleResource::collection($modules);

        return response()->json([
            'message' => 'Get Successfully',
            'data' => $data
        ]);
    }

    //Play game for student depend on module assigned to the class
    public function playTeacherAssignedModule(PlayStudentAssignedModuleRequest $playStudentAssignedModuleRequest)
    {
        $id =  $playStudentAssignedModuleRequest->id;

        $assignedModule = AssignedModule::find($id);
        $question = $this->assignedModuleService->playModule($playStudentAssignedModuleRequest->validated());
        $data = QuestionResource::collection($question)->additional([
            'assignedModule' => AssignedModuleResource::make($assignedModule)
        ]);
        return response()->json(
            [
                'message' => 'Get Question Successful.',
                'data' => $data
            ],
            status: 200
        );
    }

    // Create Assignment file From the Teacher dashBoard
    public function createAssignmentFile(AssignmentFileRequest $assignmentFileRequest)
    {
        $assignmentFile = $this->assignedModuleService->createAssignmentFile($assignmentFileRequest->validated());
        abort_if(is_null($assignmentFile), 204, 'Invalid Content or Parameter');
        //$data = ClassWorkResource::make($classwork);
        return response()->json(
            [
                'message' => 'Created successful.',
            ],
            status: 201
        );
    }

    //Get Assignment File
    public function getAssignmentFile(ClassWorkRequest $classworkrequest): JsonResponse
    {
        $file = $this->assignedModuleService->showAssignmentFile($classworkrequest->validated());
        abort_if(is_null($file), 204, 'Invalid Content or Parameter');
        $data = AssignmentFileResource::collection($file);
        return response()->json(
            [
                'message' => 'GET successful.',
                'data' => $data,
            ],
            status: 201
        );
    }

    //Delete Assignment File
    public function deleteAssignmentFile(DeleteAssignedModuleRequest $deleteAssignedModuleRequest)
    {
        $this->assignedModuleService->deleteAssignmentFile($deleteAssignedModuleRequest->validated());
        return response()->json([
            'message' => 'Deleted Successfully',
        ]);
    }

    //Delete Assigned Module
    public function deleteTeacherAssignedModule(DeleteAssignedModuleRequest $deleteAssignedModuleRequest)
    {
        $this->assignedModuleService->deleteAssignedModules($deleteAssignedModuleRequest->validated());
        return response()->json([
            'message' => 'Deleted Successfully',
        ]);
    }
}
