<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClassArmRequest;
use App\Http\Requests\Api\GetClassArmRequest;
use App\Http\Resources\ClassArmResource;
use App\Services\ClassArmService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClassArmController extends Controller
{
    public function __construct(protected ClassArmService $classarmService)
    {
        // $this->middleware('auth');
    }
    public function create(ClassArmRequest $classarmrequest): JsonResponse
    {
         $this->classarmService->createClassArm($classarmrequest->validated());
        return response()->json(
            [
                'message' => 'Created successful.',
            ],
            status: 201
        );
    }

    public function show(GetClassArmRequest $classarmrequest)
    {
        $Classarm = $this->classarmService->showClassArm($classarmrequest->validated());
        abort_if(is_null($Classarm), 204, 'Invalid Content or Parameter');
        $data = ClassArmResource::collection($Classarm);
        return response()->json(
            [
                'message' => 'GET successful.',
                'data' => $data,
            ],
            status: 201
        );
    }

    public function delete(ClassArmRequest $classarmrequest)
    {
        $deleteClassArm = $this->classarmService->deleteClassArm($classarmrequest->validated());
        abort_if(is_null($deleteClassArm), 204, 'Invalid Content or Parameter');
        return response()->json(
            [
                'message' => 'Delete successful.',
            ],
            status: 202
        );
    }
}
