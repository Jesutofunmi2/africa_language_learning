<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateQuestionRequest;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Topic;
use App\Services\QuestionService;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    public function __construct(protected QuestionService $service)
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $languages = Language::all();
        $topics = Topic::all();

        return view('pages.admin.create-question', ['languages' => $languages, 'topics' => $topics]);
    }

    public function create(CreateQuestionRequest $createQuestionRequest): RedirectResponse
    {
        $validated = $createQuestionRequest->safe()->only(['title']);
        if ($this->service->questionNameExists($validated) == true) {
            return redirect()->route('admin.question.list')->with('danger', 'You can not add same Question');
        }
        $this->service->createQuestion($createQuestionRequest->validated());

        return redirect()->route('admin.question.list')->with('success', 'Question created successfully');
    }

    public function list()
    {
        $questions = Question::orderBy('created_at', 'desc')->paginate(40);
        Session::put('question_url', request()->fullUrl());
        return view('pages.admin.list-question', ['questions' => $questions]);
    }


    public function show($questionId)
    {
        $languages = Language::all();
        $topics = Topic::all();
        $question = $this->service->showQuestion($questionId);

        return view('pages.admin.edit-question', ['question' => $question, 'languages' => $languages, 'topics' => $topics]);
    }

    public function update(CreateQuestionRequest $createquestionrequest, $questionId)
    {
        $image = null;
        $media_url = null;

        if ($createquestionrequest->hasFile('image_url')) {
            $image = $createquestionrequest->image_url;
        }
        if ($createquestionrequest->hasFile('media_url')) {
            $media_url = $createquestionrequest->media_url;
        }

        $this->service->updateQuestion($createquestionrequest->validated(), $image, $media_url, $questionId);

        if (session(key: 'question_url')) {
            return redirect(session(key: 'question_url'))->with('success', 'Question updated successfully');
        }

        return redirect()->route('admin.question.list')
            ->with('success', 'Question updated successfully');
    }
    public function status($id)
    {

        $this->service->questionStatus($id);

        return redirect()->route('admin.question.list')
            ->with('success', 'Updated successfully');
    }


    public function destroy(Request $request, Question $question)
    {
        $this->service->deleteQuestion($question);

        return redirect()->route('admin.question.list', ['page' => $request->page])
            ->with('success', 'deleted successfully');
    }
}
