<?php

namespace App\Services;

use App\Models\AssignedModule;
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
            $assigned->notification = $mudoleData['notification'];

            $assigned->save();
        });
    }
}
