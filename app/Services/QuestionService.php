<?php

namespace App\Services;

use App\Models\Option;
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

            if (in_array($extention, $video_extension)) {
                $mediaType = 'video';
            } elseif (in_array($extention, $image_extension)) {
                $mediaType = 'image';
            } elseif (in_array($extention, $audio_extension)) {
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


    public function showQuestion($questionId): Question
    {
        $question = Question::whereId($questionId)->first();

        return $question;
    }

    public function updateQuestion(array $data, $image = null, $media_url = null, $questionId): Question
    {
        $url = null;
        $media = null;
        $mediaType = null;
        $mediaService = new MediaService;
        if (!is_null($image)) {

            $url = $mediaService->uploadImage($data['image_url']);
        }

        if (!is_null($media_url)) {
            $media = $mediaService->uploadAudio($data['media_url']);
        }

        $video_extension = array('mp4', 'mov', 'wmv', 'avi', 'FLV', 'F4V', 'SWF', 'MKV', 'WEBM');
        $image_extension = array('jpg', 'jpeg', 'png', 'gif');
        $audio_extension = array('mpeg', 'mpga', 'mp3', 'wav');

        $extention = $data['media_url']->extension();

        if (in_array($extention, $video_extension)) {
            $mediaType = 'video';
        } elseif (in_array($extention, $image_extension)) {
            $mediaType = 'image';
        } elseif (in_array($extention, $audio_extension)) {
            $mediaType = 'audio';
        }

        $question = new Question;
        // if user id in array, we create new edition for the user
        $question::where('id', $question)
            ->update([
                'title' => $data['title'],
                'instruction' => $data['instruction'],
                'language_id' => $data['language_id'],
                'course_id' => $data['course_id'],
                'answered_type' => $data['answered_type'],
                'media_type' => $mediaType,
                'media_url' => $media,
                'image_url' => $url
            ]);

        return $question;
    }
    public function deleteQuestion(Question $question)
    {
        $question->delete();
    }

    public function createOption(array $data)
    {

        $option = new Option;
        DB::transaction(function () use (&$option, $data) {
            $mediaService = new MediaService;
            $mediaUrl = $mediaService->uploadAudio($data['media_url']);
            $imageUrl = $mediaService->uploadImage($data['image_url']);

            $mediaType = null;

            $video_extension = array('mp4', 'mov', 'wmv', 'avi', 'FLV', 'F4V', 'SWF', 'MKV', 'WEBM');
            $image_extension = array('jpg', 'jpeg', 'png', 'gif');
            $audio_extension = array('mpeg', 'mpga', 'mp3', 'wav');

            $extention = $data['media_url']->extension();


            if (in_array($extention, $video_extension)) {
                $mediaType = 'video';
            } elseif (in_array($extention, $image_extension)) {
                $mediaType = 'image';
            } elseif (in_array($extention, $audio_extension)) {
                $mediaType = 'audio';
            }

            $option->title = $data['title'];
            $option->language_id = $data['language_id'];
            $option->question_id = $data['question_id'];
            $option->media_type = $mediaType;
            $option->media_url = $mediaUrl;
            $option->image_url = $imageUrl;
            $option->is_correct = $data['is_correct'];
            $option->save();
        });
        return $option;
    }

    public function deleteOption(Option $option)
    {
        $option->delete();
    }
}
