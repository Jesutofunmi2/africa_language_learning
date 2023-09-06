<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClassRequest;
use App\Http\Resources\ClassResource;
use App\Services\ClassService;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClassController extends Controller
{

    public function __construct(protected ClassService $classService)
    {
        // $this->middleware('auth');
    }
    public function createClass(ClassRequest $classrequest): JsonResponse
    {

        $classes = $this->classService->createClass($classrequest->validated());

        abort_if(is_null($classes ), 204, 'Invalid Content or Parameter');
        $data = ClassResource::make($classes);
        return response()->json(
            [
                'message' => 'Update successful.',
                'data' => $data,
            ],
            status: 201
        );
    }

    public function show(ClassRequest $classrequest)
    {
        $Class = $this->classService->showClass($classrequest->validated());
        abort_if(is_null($Class), 204, 'Invalid Content or Parameter');
        $data = ClassResource::collection($Class);
        return response()->json(
            [
                'message' => 'GET successful.',
                'data' => $data,
            ],
            status: 201
        );
    }

    public function delete(ClassRequest $classrequest)
    {
        $deleteClass = $this->classService->deleteClass($classrequest->validated());
        abort_if(is_null($deleteClass), 204, 'Invalid Content or Parameter');
    
        return response()->json(
            [
                'message' => 'Delete successful.',   
            ],
            status: 202
        );
    }

}
