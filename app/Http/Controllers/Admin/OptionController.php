<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateOptionRequest;
use App\Http\Requests\Admin\EditOptionRequest;
use App\Http\Requests\Admin\QuestionBatchUploadRequest;
use App\Models\Topic;
use App\Services\QuestionService;
use Illuminate\Http\RedirectResponse;
use App\Models\Language;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class OptionController extends Controller
{
    public function __construct(protected QuestionService $service)
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $languages = Language::orderBy('created_at', 'desc')->get();
        $questions = Question::orderBy('created_at', 'desc')->get();

        return view('pages.admin.create-option', ['languages' => $languages, 'questions' => $questions]);
    }

    public function create(CreateOptionRequest $createOptionRequest): RedirectResponse
    {
        $this->service->createOption($createOptionRequest->validated());
        return redirect()->route('admin.option.list')->with('success', 'Option created successfully');
    }

    public function list()
    {
        $options = Option::orderBy('created_at', 'desc')->paginate(40);
        Session::put('option_url', request()->fullUrl());

        return view('pages.admin.list-option', ['options' => $options]);
    }

    public function show($Id)
    {
        $languages = Language::all();
        $topics = Topic::all();
        $option = $this->service->showOption($Id);
        $question = Question::all();

        return view('pages.admin.edit-option', ['questions' => $question, 'option' => $option, 'languages' => $languages, 'topics' => $topics]);
    }

    public function update(EditOptionRequest $editoptionrequest, $questionId)
    {


        $image = null;
        $media_url = null;
        Session::put('option_url', request()->fullUrl());

        if ($editoptionrequest->hasFile('image_url')) {
            $image = $editoptionrequest->image_url;
        }
        if ($editoptionrequest->hasFile('media_url')) {
            $media_url = $editoptionrequest->media_url;
        }
        $this->service->updateOption($editoptionrequest->validated(), $image, $media_url, $questionId);
        // if (session(key: 'option_url')) {
        //     return redirect(session(key: 'option_url'))->with('success', 'Option updated successfully');
        // }

        return redirect()->route('admin.option.list')
            ->with('success', 'Option updated successfully');
    }
    public function is_correct_update($id)
    {
        $new_option = new Option;
        $options = Option::whereId($id)->first();
        if ($options->is_correct == 1) {
            $new_option::whereId($id)->update([
                'is_correct' => 0
            ]);
        } else {
            $new_option::whereId($id)->update([
                'is_correct' => 1
            ]);
        }
        return redirect()->route('admin.option.list')
            ->with('success', 'Updated successfully');
    }



    public function search(Request $request)
    {
        $outputoption = '';
        $alloptions  = Option::orderBy('created_at', 'desc')->get();
        Session::put('option_url', request()->fullUrl());

        if ($request->option != '') {
            $options = Option::where('title', 'LIKE', '%' . $request->option . '%')->orderBy('title', 'desc')->get()->load('question', 'language');

            foreach ($options  as $index => $options) {
                $count = $index + 1;
                $outputoption .=
                    '<tr>
               <td> ' . $count . '</td>
               <td> ' . $options->title . '</td>
               <td> ' . $options->language->name . ' </td>
               <td> ' . $options->question->title . ' </td>
               <td><a href="' . $options->media_url . '"> Media Link</a></td>
               <td><img src="' . asset($options->image_url) . '" width="40px" height="40px" /></td>

               <td> ' . '
               <a href="options/is_correct/' . $options->id . '" class="btn btn-success">' . 'Yes</a>
                ' . '</td>

                <td> ' . '
                ' . $options->created_at->diffForHumans() . '
                ' . '</td>

                <td> ' . '
                <a href="options/' . $options->id . '" class="btn">' . 'Edit</a>
                ' . '</td>

                <td> ' . '
                <a href="options/delete/' . $options->id . '" class="btn btn-danger">' . 'Delete</a>
                ' . '</td>

              </tr>';
            }

            return response($outputoption);
        } elseif ($request->search == '') {
            return view('pages.admin.list-option', ['options' => $alloptions]);
        }

        return view('pages.admin.list-option', ['options' => $alloptions]);
    }

    public function batch()
    {
        $languages = Language::orderBy('name')->get();
        $questions = Question::orderBy('title')->get();
        return view('pages.admin.create-batch-upload-option', ['languages' => $languages, 'questions' => $questions]);
    }

    public function batchUpload(QuestionBatchUploadRequest $questionBatchUploadRequest)
    {
        $dataTime = date('Ymd_His');
        $file = $questionBatchUploadRequest->file('file');
        $fileName = $dataTime . '-' . $file->getClientOriginalName();
        //$excel =  Excel::import(new ImportQuestion, $questionBatchUploadRequest->file('file')->store('files'));
    }
    public function destroy(Request $request, Option $option)
    {
        $this->service->deleteOption($option);
        return redirect()->route('admin.option.list', ['page' => $request->page])
            ->with('success', 'deleted successfully');
    }
}
