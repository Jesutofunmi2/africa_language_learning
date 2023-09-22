<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClassWorkRequest;
use App\Http\Resources\ClassWorkResource;
use App\Services\ClassWorksService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClassWorkController extends Controller
{
    public function __construct(protected ClassWorksService $classworkService)
    {
        // $this->middleware('auth');
    }
    public function createClassWork(ClassWorkRequest $classworkrequest)
    {
        $classwork = $this->classworkService->createClassWork($classworkrequest->validated());
        abort_if(is_null($classwork), 204, 'Invalid Content or Parameter');
        //$data = ClassWorkResource::make($classwork);
        return response()->json(
            [
                'message' => 'Created successful.',
                //'data' => $data,
            ],
            status: 201
        );
    }

    public function list(ClassWorkRequest $classworkrequest): JsonResponse
    {
        $Class = $this->classworkService->showClassWork($classworkrequest->validated());
        abort_if(is_null($Class), 204, 'Invalid Content or Parameter');
        $data = ClassWorkResource::collection($Class);
        return response()->json(
            [
                'message' => 'GET successful.',
                'data' => $data,
            ],
            status: 201
        );
    }

    public function delete(ClassWorkRequest $classworkrequest)
    {
        $deleteClassWork = $this->classworkService->deleteClassWork($classworkrequest->validated());

        abort_if($deleteClassWork == 0, 204, 'Invalid Content or Parameter');

        return response()->json(
            [
                'message' => 'Delete successful.',
            ],
            status: 202
        );
    }
}
