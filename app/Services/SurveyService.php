<?php

namespace App\Services;

use App\Models\StudentSurveies;
use App\Models\StudentSurvey;
use App\Models\TeacherSurveies;
use App\Models\TeacherSurvey;
use Illuminate\Support\Facades\DB;

class SurveyService
{

    public function createStudentSurvey(array $data)
    {

        if (StudentSurveies::where('student_id', $data['student_id'])
            ->where('school_id', $data['school_id'])->exists()
        ) {
            return null;
        }

        DB::transaction(function () use (&$studentSurvey, $data) {
            $studentSurvey = new StudentSurveies;
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
        return $studentSurvey;

        //@todo we fire other actions after registration
    }



    public function createTeacherSurvey(array $data)
    {
        if (TeacherSurveies::where('teacher_id', $data['teacher_id'])->exists()) {
            return null;
        }

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
            $teacherSurvey->save();
        });
        return $teacherSurvey;

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
