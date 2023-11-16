<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClassRequest;
use App\Http\Requests\Api\DeleteClassRequest;
use App\Http\Requests\Api\GetClassRequest;
use App\Http\Resources\ClassArmResource;
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

        abort_if(is_null($classes), 204, 'Invalid Content or Parameter');
        //$data = ClassResource::make($classes);
        return response()->json(
            [
                'message' => 'Created successful.',
                //'data' => $data,
            ],
            status: 201
        );
    }

    public function showSchool(ClassRequest $classrequest)
    {
        $Class = $this->classService->showClassSchool($classrequest->validated());
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

    public function showTeacher(ClassRequest $classrequest)
    {
        $Class = $this->classService->showTeacheClasses($classrequest->validated());
        abort_if(is_null($Class), 204, 'Invalid Content or Parameter');
        $data = ClassArmResource::collection($Class);
        return response()->json(
            [
                'message' => 'GET successful.',
                'data' => $data,
            ],
            status: 200
        );
    }

    public function showSingle(GetClassRequest $getClassrequest)
    {
        $class = $this->classService->showSingleClass($getClassrequest->validated());
        abort_if(is_null($class), 204, 'Invalid Content or Parameter');
        $data = ClassResource::collection($class);
        return response()->json(
            [
                'message' => 'GET successful.',
                'data' => $data,
            ],
            status: 201
        );
    }

    public function session()
    {
        $startingYear = date('Y') ;
        $endingYear = date('Y') + 3;

        for ($i = $startingYear; $i <= $endingYear; $i++) {
            return response()->json(
                [
                    'message' => 'GET Year successful.',
                    'data' => $i.'/'.$i+1,
                ],
                status: 201
            );
        }
    }
    public function deleteTeacherClass(DeleteClassRequest $deleteClassRequest)
    {

        $deleteClass = $this->classService->deleteTeacherClass($deleteClassRequest->validated());
        abort_if(is_null($deleteClass), 204, 'Invalid Content or Parameter');

        return response()->json(
            [
                'message' => 'Delete successful.',
            ],
            status: 202
        );
    }

    public function deleteSchoolClass(DeleteClassRequest $deleteClassRequest)
    {
        $deleteClass = $this->classService->deleteSchoolClass($deleteClassRequest->validated());
        abort_if(is_null($deleteClass), 204, 'Invalid Content or Parameter');

        return response()->json(
            [
                'message' => 'Delete successful.',
            ],
            status: 202
        );
    }
}
