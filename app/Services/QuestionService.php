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
            $question->topic_id = $data['topic_id'];
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

    public function questionStatus($id)
    {
        $new_question = new Question;
        $question = Question::whereId($id)->first();
        if ($question->status == true) {
            $new_question::whereId($id)->update([
                'status' => false
            ]);
        } else {
            $new_question::whereId($id)->update([
                'status' => true
            ]);
        }

        return $new_question;
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
        }
        $question = Question::whereId($questionId)->first();
        
        if($url == null){
            $url = $question->image_url;
        }

        if($media == null){
            $media = $question->media_url;
        }

        if($mediaType == null){
            $mediaType = $question->media_type;
        }
        $new_question = new Question;
        // if user id in array, we create new edition for the user

        $new_question::where('id', $questionId)
            ->update([
                'title' => $data['title'] ?? $question->title,
                'instruction' => $data['instruction'] ?? $question->instruction,
                'language_id' => $data['language_id'] ?? $question->language_id,
                'topic_id' => $data['topic_id'] ?? $question->topic_id,
                'answered_type' => $data['answered_type'] ?? $question->answered_type,
                'media_type' => $mediaType,
                'media_url' => $media,
                'image_url' => $url
            ]);

        return $new_question;
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

            $option->title = str_replace('  ', ' ', $data['title']);
            $option->language_id = $data['language_id'];
            $option->question_id = $data['question_id'];
            $option->hint = $data['hint'];
            $option->media_type = $mediaType;
            $option->media_url = $mediaUrl ?? null;
            $option->image_url = $imageUrl ?? null;
            $option->is_correct = $data['is_correct'];
            $option->save();
        });
        return $option;
    }

    public function showOption($questionId): Option
    {
        $option = Option::whereId($questionId)->first();

        return $option;
    }

    public function updateOption(array $data, $image = null, $media_url = null, $optionId): Option
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
        }
        $option = Option::whereId($optionId)->first();
    
        
        if($url == null){
            $url = $option->image_url;
        }

        if($media == null){
            $media = $option->media_url;
        }

        if($mediaType == null){
            $mediaType = $option->media_type;
        }
        $new_option = new Option;
        // if user id in array, we create new edition for the user

        $new_option::where('id', $optionId)
            ->update([
                'title' => $data['title'] ?? $option->title,
                'language_id' => $data['language_id'] ?? $option->language_id,
                'question_id' => $data['question_id'] ?? $option->question_id,
                'hint' => $data['hint'] ?? $option->hint,
                'is_correct' => $data['is_correct'] ?? $option->is_correct,
                'media_type' => $mediaType,
                'media_url' => $media,
                'image_url' => $url
            ]);

        return $new_option;
    }

    public function questionNameExists($name)
    {
        return Question::where('title', '=', $name)->exists();
    }

    public function deleteOption(Option $option)
    {
        $option->delete();
    }
}
