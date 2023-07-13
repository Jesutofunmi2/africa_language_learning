<?php

namespace App\Services;

use App\Models\Fourite;
use Illuminate\Support\Facades\DB;

class FouriteService {

    public function addFourite(array $data):Fourite
    {
        $fourite = new Fourite;
        
        DB::transaction(function () use (&$fourite, $data,) {

            $fourite->question_name = $data['question_name']??'';
            $fourite->student_id = $data['student_id'];
            $fourite->question_id = $data['question_id'];

            $fourite->save();

        });
    
        return $fourite;
    }

    public function getFourite($id)
    {
        $fourite = Fourite::where('student_id',$id)->get();
        
        return $fourite;
    }

    public function removeFourite(array $data):void
    {
         
        Fourite::where('student_id',$data['student_id'])->where('question_id', $data['question_id'])->delete();
    
    }
}