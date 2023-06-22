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

        return view('pages.create-question', ['languages' => $languages, 'courses' => $courses]);
    }

    public function create(CreateQuestionRequest $createQuestionRequest): RedirectResponse
    {
        $this->service->createQuestion($createQuestionRequest->validated());

        return redirect()->route('admin.question.list')->with('success', 'Question created successfully');
    }

    public function list()
    {
        $questions = Question::orderBy('created_at', 'desc')->paginate(15);

        return view('pages.list-question', ['questions' => $questions]);
    }

    public function show()
    {
    }

    public function destroy(Question $question)
    {
        $this->service->deleteQuestion($question);
 
        return redirect()->route('admin.question.list')
                ->with('success', 'deleted successfully');
    }
}
