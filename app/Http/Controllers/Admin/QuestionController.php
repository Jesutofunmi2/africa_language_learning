<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateQuestionRequest;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Course;
use App\Services\QuestionService;

class QuestionController extends Controller
{

    public function __construct(protected QuestionService $service)
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $languages = Language::all();
        $courses = Course::all();

        return view('pages.admin.create-question', ['languages' => $languages, 'courses' => $courses]);
    }

    public function create(CreateQuestionRequest $createQuestionRequest): RedirectResponse
    {
        $this->service->createQuestion($createQuestionRequest->validated());

        return redirect()->route('admin.question.list')->with('success', 'Question created successfully');
    }

    public function list()
    {
        $questions = Question::orderBy('created_at', 'desc')->paginate(15);

        return view('pages.admin.list-question', ['questions' => $questions]);
    }


    public function show($questionId)
    {
        $languages = Language::all();
        $courses = Course::all();
        $question = $this->service->showQuestion($questionId);

        return view('pages.admin.edit-question', ['question' => $question, 'languages' => $languages, 'courses' => $courses]);
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

        return redirect()->route('admin.question.list')
            ->with('success', 'Question updated successfully');
    }
    public function status($id)
    {

        $this->service->questionStatus($id);

        return redirect()->route('admin.question.list')
            ->with('success', 'Updated successfully');
    }


    public function destroy(Question $question)
    {
        $this->service->deleteQuestion($question);

        return redirect()->route('admin.question.list')
            ->with('success', 'deleted successfully');
    }
}
