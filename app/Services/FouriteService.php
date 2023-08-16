<?php

namespace App\Services;

use App\Models\Fourite;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class FouriteService {

    public function addFourite(array $data):Fourite
    {
        $fourite = new Fourite;
    
        $answered = Fourite::where('student_id', '=', $data['student_id'])
            ->where('question_id', '=', $data['question_id'])->exists();

        if ($answered == true) {
            return $fourite;
        }
        DB::transaction(function () use (&$fourite, $data,) {
           
            $fourite->student_id = $data['student_id'];
            $fourite->question_id = $data['question_id'];

            $fourite->save();

        });
    
        return $fourite;
    }

    public function getFourite($student_id, $question_id, $language_id)
    {
        
        $fourite = Fourite::where('student_id', $student_id)->get();

        return $fourite; 
    }

    public function removeFourite(array $data):void
    {
         
        Fourite::where('student_id',$data['student_id'])->where('question_id', $data['question_id'])->delete();
    
    }
}