<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StudentSurveyRequest;
use App\Http\Requests\Api\TeacherSurveyRequest;
use App\Http\Resources\StudentSurveyResource;
use App\Http\Resources\TeacherSurveyResource;
use App\Models\Teacher;
use App\Services\SurveyService;
use Illuminate\Http\Request;


class SurveyController extends Controller
{
    public function __construct(protected SurveyService $surveyService)
    {}

    public function createStudentSurvey(StudentSurveyRequest $studentSurveyRequest)
    {
        $studentSurvey = $this->surveyService->createStudentSurvey($studentSurveyRequest->validated());
        abort_if(!$studentSurvey, 204, 'Already Exits');
        //$data = StudentSurveyResource::make($studentSurvey);
        return response()->json(
            [
                'message' => 'Create successful.',
               // 'data' => $data,
            ],
            status: 201
        );
    }

    public function createTeacherSurvey(TeacherSurveyRequest $teacherSurveyRequest)
    { 
        $teacherSurvey = $this->surveyService->createTeacherSurvey($teacherSurveyRequest->validated());
        abort_if(!$teacherSurvey, 204, 'Already Exits');
        // $data = TeacherSurveyResource::make($teacherSurvey);
        return response()->json(
            [
                'message' => 'Create successful.',
               // 'data' => $data,
            ],
            status: 201
        );
    }

    public function getStudentSurvey()
    {
        $studentsSurvey = $this->surveyService->getStudentSurvey();
        abort_if(!$studentsSurvey, 204, 'Already Exits');
        $data = StudentSurveyResource::collection($studentsSurvey);
        return response()->json(
            [
                'message' => 'Create successful.',
                'data' => $data,
            ],
            status: 201
        );
    }

    public function getTeacherSurvey()
    {
        $studentsSurvey = $this->surveyService->getTeacherSurvey();
        abort_if(!$studentsSurvey, 204, 'Already Exits');
        $data = TeacherSurveyResource::collection($studentsSurvey);
        return response()->json(
            [
                'message' => 'Create successful.',
                'data' => $data,
            ],
            status: 201
        );
    }
}
