<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateTopicRequest;
use App\Models\Language;
use App\Models\Section;
use App\Models\Topic;
use App\Services\ActivityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TopicController extends Controller
{
    public function __construct(protected ActivityService $service)
    {
        $this->middleware('auth');
    }

    public function index(Request $request): View
    {
        $languages = Language::get();
        $sections = Section::all();
        return view('pages.admin.create-topic', ['languages' => $languages, 'sections' => $sections]);
    }

    public function create(CreateTopicRequest $createTopicRequest): RedirectResponse
    {

        $this->service->createTopic($createTopicRequest->validated());

        return redirect()->route('admin.topic.list')->with('success', 'Topic created successfully');
    }

    public function list(Request $request): View
    {
        $topics = Topic::orderBy('created_at', 'desc')->paginate(40);
        return view('pages.admin.list-topic')->with('topics', $topics);
    }

    public function show($topicId)
    {
        $topic = $this->service->showTopic($topicId);
        $sections = Section::all();
        return view('pages.admin.edit-topic', ['topic' => $topic, 'sections' => $sections]);
    }

    public function update(CreateTopicRequest $request, $topicId): RedirectResponse
    {
        $image = null;

        if ($request->hasFile('image_url')) {
            $image = $request->image_url;
        }

        $this->service->updateTopic($request->validated(), $image, $topicId);

        return redirect()->route('admin.topic.list')
            ->with('success', 'Course updated successfully');
    }

    public function destroy(Topic $topic): RedirectResponse
    {
        $this->service->deleteTopic($topic);

        return redirect()->route('admin.topic.list')
            ->with('success', 'deleted successfully');
    }
}
