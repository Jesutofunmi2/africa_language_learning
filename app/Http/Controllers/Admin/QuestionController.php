<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateQuestionRequest;
use App\Http\Requests\Admin\QuestionBatchUploadRequest;
use App\Http\Requests\Media\MediaRequest;
use App\Imports\ImportQuestion;
use App\Models\Question;
use App\Services\MediaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Topic;
use App\Services\QuestionService;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Importer;


class QuestionController extends Controller
{
    public function __construct(protected QuestionService $service)
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $languages = Language::orderBy('name')->get();
        $topics = Topic::orderBy('title')->get();

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
       // $allquestions = Question::orderBy('created_at', 'desc')->get();

        if ($createquestionrequest->hasFile('image_url')) {
            $image = $createquestionrequest->image_url;
        }
        if ($createquestionrequest->hasFile('media_url')) {
            $media_url = $createquestionrequest->media_url;
        }

        $this->service->updateQuestion($createquestionrequest->validated(), $image, $media_url, $questionId);

        // if (session(key: 'question_url')) {
        //     return redirect(session(key: 'question_url'))->with('success', 'Question updated successfully');
        // }

       // return view('pages.admin.list-question', ['questions' => $allquestions]);
        return redirect()->route('admin.question.list')
            ->with('success', 'Question updated successfully');
    }
    public function status(Request $request, $id)
    {
        $this->service->questionStatus($id);
        return redirect()->route('admin.question.list', ['page' => $request->page])
            ->with('success', 'Updated successfully');
    }

    public function search(Request $request)
    {
        $output = '';
        $allquestions = Question::orderBy('created_at', 'desc')->get();

        if ($request->search != '') {
            $questions = Question::where('title', 'LIKE', '%' . $request->search . '%')->orderBy('title', 'desc')->get()->load('topic', 'language');

            foreach ($questions as $index => $questions) {
                $count = $index + 1;
                $output .=
             '<tr>
               <td> ' . $count . '</td>
               <td> ' . $questions->title . '</td>
               <td> ' . $questions->topic->title . ' </td>
               <td> ' . $questions->language->name . ' </td>
               <td><a href="' . $questions->media_url . '"> Media Link</a></td>
               <td><img src="' . asset($questions->image_url) . '" width="40px" height="40px" /></td>

               <td> '.'
               <a href="questions/status/'.$questions->id.'" class="btn btn-success">'.'Online</a>
                '.'</td>

                <td> '.'
                '.$questions->created_at->diffForHumans() .'
                '.'</td>

                <td> '.'
                <a href="questions/'.$questions->id.'" class="btn">'.'Edit</a>
                '.'</td>

                <td> '.'
                <a href="questions/delete/'.$questions->id.'" class="btn btn-danger">'.'Delete</a>
                '.'</td>

              </tr>';
            }

            return response($output);
        } elseif ($request->search == '') {
            return view('pages.admin.list-question', ['questions' => $allquestions]);
        }

        return view('pages.admin.list-question', ['questions' => $allquestions]);
    }

    public function media()
    {
        return view('pages.admin.create-mediaUpload');
    }

    public function mediaCreate(MediaRequest $mediaRequest)
    {
        $mediaService = new MediaService;
        $imageUrl = $mediaService->uploadImage($mediaRequest['image_url']);
        $mediaUrl = $mediaService->uploadAudio($mediaRequest['media_url']);

        return view('pages.admin.list-mediaUpload', ['imageUrl' => $imageUrl, 'mediaUrl' => $mediaUrl]);
    }

    public function batch()
    {
        $languages = Language::orderBy('name')->get();
        $topics = Topic::orderBy('title')->get();
        return view('pages.admin.create-batch-upload-question', ['languages' => $languages, 'topics' => $topics]);
    }

    public function batchUpload(QuestionBatchUploadRequest $questionBatchUploadRequest)
    {
        $dataTime = date('Ymd_His');
        $file = $questionBatchUploadRequest->file('file');
        $fileName = $dataTime . '-' . $file->getClientOriginalName();
        $excel =  Excel::import(new ImportQuestion, $questionBatchUploadRequest->file('file')->store('files'));
    }
    public function destroy(Request $request, Question $question)
    {
        $this->service->deleteQuestion($question);

        return redirect()->route('admin.question.list', ['page' => $request->page])
            ->with('success', 'deleted successfully');
    }
}
