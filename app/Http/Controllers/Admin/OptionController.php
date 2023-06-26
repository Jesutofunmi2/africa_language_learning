<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateOptionRequest;
use App\Services\QuestionService;
use Illuminate\Http\RedirectResponse;
use App\Models\Language;
use App\Models\Option;
use App\Models\Question;


class OptionController extends Controller
{
    public function __construct(protected QuestionService $service)
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $languages = Language::all();
        $questions = Question::all();

        return view('pages.create-option', ['languages' => $languages, 'questions' => $questions]);
    }

    public function create(CreateOptionRequest $createQuestionRequest): RedirectResponse
    {
        $this->service->createOption($createQuestionRequest->validated());
        return redirect()->route('admin.option.list')->with('success', 'Option created successfully');
    }

    public function list()
    {
        $options = Option::orderBy('created_at', 'desc')->paginate();
        return view('pages.list-option', ['options' => $options]);
    }

    public function destroy(Option $option)
    {
        $this->service->deleteOption($option);

        return redirect()->route('admin.option.list')
            ->with('success', 'deleted successfully');
    }
}
