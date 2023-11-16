<?php

namespace App\Services;

use App\Models\AssignedModule;
use App\Models\AssignmentFile;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class AssignedModuleService
{

    //Classwork start here
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

    //Classwork End Here//

    //Assignment start 

    public function createAssignmentFile(array $data): AssignmentFile
    {
        DB::transaction(function () use (&$assignmentFile, $data) {
            $assignmentFile = new AssignmentFile;
            $mediaService = new MediaService;
            if ($data['media_url'] != null) {
                $mediaUrl = $mediaService->uploadImage($data['media_url']);
            }
            $assignmentFile->name = $data['name'];
            $assignmentFile->school_id = $data['school_id'];
            $assignmentFile->teacher_id = $data['teacher_id'];
            $assignmentFile->class_id = $data['class_id'];
            $assignmentFile->media_url = $mediaUrl;
            $assignmentFile->deadline = $data['date'];
            $assignmentFile->notification = $data['notification'];
            $assignmentFile->mark = $data['mark'];
            $assignmentFile->save();
        });

        return $assignmentFile;  
    }


    public function showAssignmentFile(array $data)
    {
        $assignment = AssignmentFile::where('teacher_id',$data['teacher_id'])
        ->where('school_id', $data['school_id'])
        ->where('class_id', $data['class_id'])
        ->get();

         return $assignment;
    }

    public function deleteAssignmentFile(array $data)
    {
        AssignmentFile::where('school_id', $data['school_id'])->where('teacher_id', $data['teacher_id'])->where('id', $data['id'])->delete();
    }
 

}
