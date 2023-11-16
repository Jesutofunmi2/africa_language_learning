<?php

namespace App\Services;

use App\Jobs\SendSchoolVerificationMail;
use App\Models\School;
use App\Models\SecondarySchool;
use App\Models\Section;
use App\Models\Teacher;
use Facade\FlareClient\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class SectionService
{
    public function createSection(array $data):Section
    {
        $section = new Section;

        DB::transaction(function () use (&$section, $data) {
            $section->title = $data['title'];
            $section->course_id = $data['course_id'];
            $section->level = $data['level'];
            $section->category = $data['category'];

            $section->save();
        });
     return $section;
    }


    public function showSection($sectionId): Section
    {
        $section = Section::whereId($sectionId)->first();

        return $section;
    }

    public function updateSection(array $data,  $sectionId): Section
    {
        $sections = Section::whereId($sectionId)->first();
       
        $section = new Section;
        // if user id in array, we create new edition for the user
        $section::where('id', $sectionId)
            ->update([
                'title' => $data['title']?? $sections->title,
                'level' => $data['level']?? $sections->level,
                'category' => $data['category']?? $sections->category,
                'course_id' => $data['course_id'] ?? $sections->course_id
            ]);

        return $section;
    }

    public function deleteSection($sectionId): void
    {
        Section::where('id',$sectionId)->delete();
    }
}