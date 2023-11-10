<?php

namespace App\Services;

use App\Models\Student;
use App\Models\StudentSurveies;
use App\Models\StudentSurvey;
use App\Models\Teacher;
use App\Models\TeacherSurveies;
use App\Http\Resources\StudentSurveyResource;
use App\Models\TeacherSurvey;
use Illuminate\Support\Facades\DB;

class SurveyService
{

    public function createStudentSurvey(array $data)
    {

        $studentSurvey = new StudentSurveies;
        $survey = StudentSurveies::where('student_id', $data['student_id'])->first();

        //dd($student);
        if ($survey) {
            return response()->json(
                [
                    'message' => 'Already Exits.',
                ],

            );
        } else {

            DB::transaction(function () use (&$studentSurvey, $data) {

                $studentSurvey->interested = $data['interested'];
                $studentSurvey->scale_of_1_5 = $data['scale_of_1_5'] ?? null;
                $studentSurvey->school_id = $data['school_id'];
                $studentSurvey->student_id = $data['student_id'];
                $studentSurvey->opportunity = $data['opportunity'];
                $studentSurvey->ability = $data['ability'];
                $studentSurvey->prefer = $data['prefer'];
                $studentSurvey->schools_app = $data['schools_app'];
                $studentSurvey->motivates = $data['motivates'];
                $studentSurvey->save();
            });
            $data =  StudentSurveyResource::make($studentSurvey);
            return response()->json(
                [
                    'message' => 'Create successful.',
                    'data' => $data,
                ],
                status: 201
            );
        }


        //@todo we fire other actions after registration
    }
    public function createTeacherSurvey(array $data)
    {

        $survey = DB::table('teacher_surveies')->where('teacher_id', $data['teacher_id'])->first();
        //dd($student);
        if ($survey === null) {
            DB::transaction(function () use (&$teacherSurvey, $data) {
                $teacherSurvey = new TeacherSurveies;
                $teacherSurvey->school_id = $data['school_id'];
                $teacherSurvey->teacher_id = $data['teacher_id'];
                $teacherSurvey->years = $data['years'];
                $teacherSurvey->hours = $data['hours'] ?? null;
                $teacherSurvey->challenges = $data['challeges'];
                $teacherSurvey->opinion = $data['opinion'];
                $teacherSurvey->resources = $data['resources'];
                $teacherSurvey->confident = $data['confident'];
                $teacherSurvey->method = $data['method'];
                $teacherSurvey->tools = $data['tools'];
                $teacherSurvey->strategies = $data['strategies'];
                $teacherSurvey->familiar = $data['familiar'];

                $teacher = Teacher::query()->where('teacher_id', $data['teacher_id'])->first();

                if ($teacher->survey_status == 0) {
                    DB::table('teachers')
                        ->where('teacher_id', $data['teacher_id'])
                        ->update(['survey_status' => 1]);
                } else {
                    // DB::table('teachers')
                    //     ->where('teacher_id', $data['teacher_id'])
                    //     ->update(['survey_status' => 1]);
                }

                $teacherSurvey->save();
            });

            return $teacherSurvey;
        }
        //@todo we fire other actions after registration
    }


    public function getStudentSurvey()
    {
        return StudentSurveies::all();
    }

    public function getTeacherSurvey()
    {
        return TeacherSurveies::all();
    }
}
