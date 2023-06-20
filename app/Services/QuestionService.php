<?php

namespace App\Services;

use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class QuestionService
{

    public function createQuestion(array $data): Question
    {
        $question = new Question;

        DB::transaction(function () use (&$question, $data) {

            $mediaService = new MediaService;
            $imageUrl = $mediaService->uploadImage($data['image_url']);
            $mediaUrl = $mediaService->uploadAudio($data['media_url']);
            $mediaType = null;

            $video_extension = array('mp4', 'mov', 'wmv', 'avi', 'FLV', 'F4V', 'SWF', 'MKV', 'WEBM');
            $image_extension = array('jpg', 'jpeg', 'png', 'gif');
            $audio_extension = array('mpeg', 'mpga', 'mp3', 'wav');

            $extention = $data['media_url']->extension();

            if (in_array($extention, $video_extension)) 
            {
                $mediaType = 'video';
            } elseif (in_array($extention, $image_extension)) 
            {
                $mediaType = 'image';
            } elseif (in_array($extention, $audio_extension)) 
            {
                $mediaType = 'audio';
            }

            $question->title = $data['title'];
            $question->instruction = $data['instruction'];
            $question->language_id = $data['language_id'];
            $question->course_id = $data['course_id'];
            $question->answered_type = $data['answered_type'];
            $question->next_question_id = $data['next_question_id'] ?? '';
            $question->media_type = $mediaType;
            $question->media_url = $mediaUrl;
            $question->image_url = $imageUrl;

            $question->save();


            //@todo we fire other actions after registration
        });

        return $question;
    }

    public function deleteQuestion(Question $question)
    {
        $question->delete();
    }
}
