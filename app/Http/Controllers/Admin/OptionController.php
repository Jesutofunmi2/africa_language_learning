<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateOptionRequest;
use App\Models\Course;
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

        return view('pages.admin.create-option', ['languages' => $languages, 'questions' => $questions]);
    }

    public function create(CreateOptionRequest $createQuestionRequest): RedirectResponse
    {
        $this->service->createOption($createQuestionRequest->validated());
        return redirect()->route('admin.option.list')->with('success', 'Option created successfully');
    }

    public function list()
    {
        $options = Option::orderBy('created_at', 'desc')->paginate();
        return view('pages.admin.list-option', ['options' => $options]);
    }

    public function show($Id)
    {
        $languages = Language::all();
        $courses = Course::all();
        $option = $this->service->showOption($Id);
        $question = Question::all();

        return view('pages.admin.edit-option', ['questions'=> $question, 'option' => $option, 'languages' => $languages, 'courses' => $courses]);
    }
    


    public function update(CreateOptionRequest $createoptionrequest, $questionId)
    {
        $image = null;
        $media_url = null;

        if ($createoptionrequest->hasFile('image_url')) {
            $image = $createoptionrequest->image_url;
        }
        if ($createoptionrequest->hasFile('media_url')) {
            $media_url = $createoptionrequest->media_url;
        }

        $this->service->updateOption($createoptionrequest->validated(), $image, $media_url, $questionId);

        return redirect()->route('admin.option.list')
            ->with('success', 'Option updated successfully');
    }
    public function is_correct_update($id)
    {
        $new_option = new Option;
        $options = Option::whereId($id)->first();
        if($options->is_correct == 1){
            $new_option::whereId($id)->update([
                'is_correct' => 0
             ]);
        }else{
            $new_option::whereId($id)->update([
                'is_correct' => 1
             ]);
        }
        return redirect()->route('admin.option.list')
            ->with('success', 'Updated successfully');
    }
    public function destroy(Option $option)
    {
        $this->service->deleteOption($option);

        return redirect()->route('admin.option.list')
            ->with('success', 'deleted successfully');
    }
}
