<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Language;
use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
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

    public function languageNameExists($name)
    {
        return Language::where('name', '=', $name)->exists();
    }

    /**
     * Create Course.
     * 
     */
    public function createCourse(array $data): void
    {
        $mediaService = new MediaService;
        $mediaUrl = $mediaService->uploadImage($data['image_url']);

        $course = new Course;
        $course->title = $data['title'];
        $course->description = $data['description'];
        $course->image_url = $mediaUrl;
        $course->save();
    }

    /**
     * Delete a language.
     * 
     */
    public function deleteLanguage(Language $language): void
    {
        $language->delete();
    }

    public function deleteCourse(Course $course): void
    {
        $course->delete();
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
