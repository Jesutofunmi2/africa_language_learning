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
      return $this->surveyService->createStudentSurvey($studentSurveyRequest->validated()); 
    }

    public function createTeacherSurvey(TeacherSurveyRequest $teacherSurveyRequest)
    { 
        $teacherSurvey = $this->surveyService->createTeacherSurvey($teacherSurveyRequest->validated());

        if($teacherSurvey){
            $data = TeacherSurveyResource::make($teacherSurvey);
            return response()->json(
                [
                    'message' => 'Create successful.',
                    'data' => $data,
                ],
                status: 201
            );
        }

       return response()->json(['message' => 'Already Exits']);
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
