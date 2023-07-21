<?php

namespace App\Services;
use App\Models\Activity;
use App\Models\Language;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class ActivityService
{
    /**
     * Create an activity.
     * 
     * @param array
     * @return \App\Models\Activity
     */
    public function createActivity(array $data, $image): Activity
    {
        $activity = new Activity;

        $ext = $image->extension();

        $manager = new ImageManager(array('driver' => 'gd'));
        $image = $manager->make($image);
        $image->encode(null, 90);

        $file_name = 'images/' . Str::random(15) . '.' . $ext;

        Storage::put($file_name, (string) $image, 'public');
        $url = Storage::url($file_name);

        $activity->title = $data['title'];
        $activity->description = $data['description'];
        $activity->type = $data['type'];
        $activity->date = $data['date'];
        $activity->image_url = $url;
        $activity->admin_id = $data['admin_id'] ?? null;
        $activity->save();

        return $activity;
    }

    /**
     * update an activity.
     * 
     * @param array
     * @param \App\Models\Activity
     * @return \App\Models\Activity
     */
    public function updateActivity(Activity $activity, array $data, $image = null): Activity
    {
        $url = null;

        if (!is_null($image)) {
            $ext = $image->extension();

            $manager = new ImageManager(array('driver' => 'gd'));
            $image = $manager->make($image);
            $image->encode(null, 90);

            $file_name = 'images/' . Str::random(15) . '.' . $ext;

            $url = Storage::put($file_name, (string) $image, 'public');
            $url = Storage::url($file_name);
        }

        // if user id in array, we create new edition for the user
        if (array_key_exists('user_id', $data) && !is_null($data['user_id'])) {
            $new_activity = new Activity;

            $new_activity->ref = $activity->ref;
            $new_activity->title = $data['title'] ?? $activity->title;
            $new_activity->description = $data['description'] ?? $activity->description;
            $new_activity->image_url = $url ? $url : $activity->image_url;
            $new_activity->user_id = $data['user_id'];
            $new_activity->type = 'personal';
            $new_activity->date = $activity->date;
            $new_activity->save();

            return $new_activity;
        }

        $activity->title = $data['title'] ?? $activity->title;
        $activity->description = $data['description'] ?? $activity->description;
        $activity->image_url = $url ? $url : $activity->image_url;
        $activity->save();

        return $activity;
    }

    /**
     * Create Language.
     * 
     */

    public function createLanguage(array $data): void
    {
        $mediaService = new MediaService;
        $mediaUrl = $mediaService->uploadImage($data['image_url']);
        $language = new Language;
        $language->name = $data['name'];
        $language->image_url = $mediaUrl;
        $language->save();
    }

    public function showLanguage($languageId): Language
    {
        $language = Language::whereId($languageId)->first();

        return $language;
    }

    public function updateLanguage(array $data, $image = null, $languageId): Language
    {
        $url = null;
        
        if (!is_null($image)) {
            $mediaService = new MediaService;
            $url = $mediaService->uploadImage($data['image_url']);
        }

        $languages = Language::whereId($languageId)->first();
        if($url == null){
            $url = $languages->image_url;
        }
        $language = new Language;
        // if user id in array, we create new edition for the user
        $language::where('id', $languageId)
            ->update([
                'name' => $data['name']?? $languages->name,
                'image_url' => $url ?? $languages->image_url
            ]);

        return $language;
    }

    public function languageNameExists($name)
    {
        return Language::where('name', '=', $name)->exists();
    }
    
    public function createTopic(array $data): void
    {
        $mediaService = new MediaService;
        $mediaUrl = null;
        $mediaType = null;

        $video_extension = array('mp4', 'mov', 'wmv', 'avi', 'FLV', 'F4V', 'SWF', 'MKV', 'WEBM');
        $image_extension = array('jpg', 'jpeg', 'png', 'gif');
        $audio_extension = array('mpeg', 'mpga', 'mp3', 'wav');

        $extention = $data['image_url']->extension();


        if (in_array($extention, $video_extension)) {
            $mediaType = 'video';
           $mediaUrl= $mediaService->uploadAudio($data['image_url']);
        } elseif (in_array($extention, $image_extension)) {
            $mediaType = 'image';
            $mediaUrl= $mediaService->uploadImage($data['image_url']);
        } elseif (in_array($extention, $audio_extension)) {
            $mediaType = 'audio';
            $mediaUrl= $mediaService->uploadAudio($data['image_url']);
        }

        $topic = new Topic;
        $topic->title = $data['title'];
        $topic->description = $data['description'];
        $topic->section_id = $data['section_id'];
        $topic->content = $data['content']?? null;
        $topic->objective = $data['objective']?? null;
        $topic->type = $data['type'];
        $topic->media_type = $mediaType;
        $topic->image_url = $mediaUrl;
        $topic->save();
    }


    public function showTopic($topicId): Topic
    {
        $topic = Topic::whereId($topicId)->first();

        return $topic;
    }

    public function updateTopic(array $data, $image = null, $topicId): Topic
    {
        $url = null;
        $mediaUrl = null;
        $mediaType = null;
        if (!is_null($image)) {
            $mediaService = new MediaService;
            $video_extension = array('mp4', 'mov', 'wmv', 'avi', 'FLV', 'F4V', 'SWF', 'MKV', 'WEBM');
            $image_extension = array('jpg', 'jpeg', 'png', 'gif');
            $audio_extension = array('mpeg', 'mpga', 'mp3', 'wav');
    
            $extention = $image->extension();
    
    
            if (in_array($extention, $video_extension)) {
                $mediaType = 'video';
               $mediaUrl= $mediaService->uploadAudio($image);
            } elseif (in_array($extention, $image_extension)) {
                $mediaType = 'image';
                $mediaUrl= $mediaService->uploadImage($image);
            } elseif (in_array($extention, $audio_extension)) {
                $mediaType = 'audio';
                $mediaUrl= $mediaService->uploadAudio($image);
            }

        }

        $topics = Topic::whereId($topicId)->first();
        if($mediaUrl  == null){
            $mediaUrl =$topics->image_url;
        }
        $topic = new Topic;
        // if user id in array, we create new edition for the user
        $topic::where('id', $topicId)
            ->update([
                'title' => $data['title']?? $topics->title,
                'description' => $data['description'] ?? $topics->description,
                'content' => $data['content'] ?? $topics->content,
                'objective' => $data['objective'] ?? $topics->objective,
                'section_id' => $data['section_id']?? $topics->section_id,
                'type' => $data['type'] ?? $topics->type,
                'image_url' => $mediaUrl,
                'media_type' => $mediaType,
            ]);

        return $topic;
    }

    public function deleteLanguage(Language $language): void
    {
        $language->delete();
    }

    public function deleteTopic(Topic $topic): void
    {
        $topic->delete();
    }
    /**
     * Delete an activity.
     * 
     */
    public function deleteActivity(Activity $activity): void
    {
        $activity->delete();
    }

    /**
     * Get user activities.
     * 
     */
    public function getUserActivity($request): Collection
    {
        $user = $request->user();

        $activities = Activity::query()
            ->userActivity($user->id)
            ->globalActivity()
            ->when(
                $request->query('from_date'),
                fn (Builder $query) => $query->dateBetween($request->query('from_date'), $request->query('to_date'))
            )
            ->orderBy('created_at', 'desc')
            ->groupBy('ref')
            ->get();

        return $activities;
    }
}
