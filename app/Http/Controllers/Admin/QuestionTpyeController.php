<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\QuestionTypeRequest;
use App\Http\Requests\Api\QuestionRequest;
use App\Models\Question;
use App\Models\QuestionType;
use App\Models\Topic;
use App\Services\ActivityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
class QuestionTpyeController extends Controller
{
    public function __construct(protected ActivityService $service)
    {
        $this->middleware('auth');
    }

    public function index(Request $request): View
    {
        $topics = Topic::all();
        return view('pages.admin.create-question-type', ['topics'=> $topics]);
    }

    public function create(QuestionTypeRequest $questionRequest): RedirectResponse
    {
        $validated = $questionRequest->safe()->only(['name']);
        if ($this->service->questionTypeNameExists($validated) == true) {
            return back()->with('error', 'You can not add same question-type');
        }

        $this->service->createQuestionType($questionRequest->validated());

        return redirect()->route('admin.question.type.list')->with('success', 'created successfully');
    }

    public function list(Request $request): View
    {
        $type = QuestionType::orderBy('created_at', 'desc')->paginate(40);
        return view('pages.admin.list-question-type')->with('questionTypes', $type);
    }

    public function show($Id)
    {
        
        $questionType = $this->service->showQuestionType($Id);
        $topics = Topic::all();

        return view('pages.admin.edit-question-type', ['questionType' => $questionType, 'topics' => $topics]);
    }

    public function update(QuestionTypeRequest $request, $Id): RedirectResponse
    {
        $this->service->updateQuestionType($request->validated(), $Id);

        return redirect()->route('admin.question.type.list')
            ->with('success', 'updated successfully');
    }


    public function destroy($Id): RedirectResponse
    {
        $this->service->deleteQuestionTyp($Id);

        return redirect()->route('admin.question.type.list')
            ->with('success', 'deleted successfully');
    }
}