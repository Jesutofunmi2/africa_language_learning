<?php

namespace App\Services;

use App\Models\AssignedModule;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class AssignedModuleService
{

    public function createdTeacherAssignedModule(array $data) //AssignedModules
    {
        $school_id = $data['school_id'];
        $teacher_id = $data['teacher_id'];
        $class_id = $data['class_id'];

        $moduleDatas = collect($data['data'])->map(function ($mudoleData) use ($school_id, $teacher_id, $class_id) {
            $assigned = new AssignedModule;
            $assigned->school_id = $school_id;
            $assigned->teacher_id = $teacher_id;
            $assigned->class_id = $class_id;
            $assigned->module = $mudoleData['module'];
            $assigned->deadline = $mudoleData['deadline'];
            $assigned->no_attempt = $mudoleData['no_attempt'];
            $assigned->time = $mudoleData['time'];
            //$assigned->notification = $mudoleData['notification'];
            $assigned->mark = $mudoleData['mark'];

            $assigned->save();
        });
    }

    public function getTeacherAssignedModules(array $data)
    {
        $AssignedModules = AssignedModule::where('school_id', $data['school_id'])->where('teacher_id', $data['teacher_id'])->get();

        return $AssignedModules;
    }
    public function getStudentAssignedModules(array $data)
    {
        $AssignedModules = AssignedModule::where('school_id', $data['school_id'])->where('class_id', $data['class_id'])->get();

        return $AssignedModules;
    }

    public function playModule(array $data)
    {
        $topic_id = $data['topic_id'];
        $language_id = $data['language_id'];

        $question = Question::query()
            ->where('status', true)
            ->when($topic_id, fn ($query) => $query->where('topic_id', $topic_id))
            ->when(
                $language_id,
                fn ($query) => $query->whereRelation('options', 'language_id', '=', $language_id)
            )->inRandomOrder()->get();

        return $question;
    }

    public function deleteAssignedModules(array $data)
    {
        AssignedModule::where('school_id', $data['school_id'])->where('teacher_id', $data['teacher_id'])->where('id', $data['id'])->delete();
    }
}
