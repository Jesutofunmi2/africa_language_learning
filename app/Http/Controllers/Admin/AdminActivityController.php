<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateActivityRequest;
use App\Http\Requests\EditActivityRequest;
use App\Http\Services\ActivityService;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminActivityController extends Controller
{
    public function __construct(protected ActivityService $service)
    {
        $this->middleware('auth');
    }

    /**
     * Admin create activity page.
     * 
     * This method return view to create activity.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     * 
     */
    public function index(Request $request): View
    {
        return view('pages.create-activity');
    }


     /**
     * Create Activity Method.
     * 
     * This method handles creating of activity.
     *
     * @param  \App\Http\Requests\CreateActivityRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     * 
     */
    public function create(CreateActivityRequest $request): RedirectResponse
    {
        $activities_count = Activity::whereDate('date', $request->date)->count();

        if($activities_count >= config('app.max_activities_per_day')) {
            return back()->with('error', 'You can not add more than per day activity set');
        }
        
        $image = $request->image;

        $this->service->createActivity($request->validated(), $image);

        return redirect()->route('admin.dashboard')->with('success', 'Activity created successfully');
    }

    /**
     * Get Activities Method.
     * 
     * This method handles getting list of activities.
     *
     * @param  \App\Http\Requests\CreateActivityRequest  $request
     * @return \Illuminate\View\View
     * 
     */
    public function list(Request $request): View
    {
        $activities = Activity::paginate();

        return view('pages.list-activity')->with('activities', $activities);
    }

    /**
     * Get single activity Method.
     * 
     * This method handles getting a single activity.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\View\View
     * 
     */
    public function show(Activity $activity): View
    {
        $users = User::where('is_admin', false)->get();
        $types = Activity::TYPES;
        
        return view('pages.edit-activity')->with([
            'activity' => $activity,
            'users' => $users,
            'types' => $types]
        );
    }

    /**
     * Delete single activity Method.
     * 
     * This method handles deleting a single activity.
     *
     * @param  \App\Models\Activity  $activity
     * @param  \App\Http\Requests\EditActivityRequest $request;
     * @return \Illuminate\Http\RedirectResponse
     * 
     */
    public function update(Activity $activity, EditActivityRequest $request): RedirectResponse
    {
        $image = null;

        if($request->hasFile('image')) {
            $image = $request->image;
        }

        $this->service->updateActivity($activity, $request->validated(), $image);

        return redirect()->route('admin.activity.list')
                ->with('success', 'Activity updated successfully');
    }

    /**
     * Delete single activity Method.
     * 
     * This method handles deleting a single activity.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\RedirectResponse
     * 
     */
    public function destroy(Activity $activity): RedirectResponse
    {
        $this->service->deleteActivity($activity);

        return redirect()->route('admin.activity.list')
                ->with('success', 'Activity deleted successfully');
    }
}