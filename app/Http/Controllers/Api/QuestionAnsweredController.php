<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\QuestionAnsweredRequest;
use App\Http\Resources\QuestionAnsweredResource;
use App\Services\QuestionAnsweredService;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuestionAnsweredController extends Controller
{
    public function __construct(protected QuestionAnsweredService $questionAnswered)
    {
       // $this->middleware('auth');
    }
 
    public function create(QuestionAnsweredRequest $questionAnsweredRequest):JsonResponse
    {
        abort_if(is_null($questionAnsweredRequest), 408, 'Request Timeout');
        $questionAnswered = $this->questionAnswered->addQuestionAnswered($questionAnsweredRequest->validated());
       
        abort_if(is_null($questionAnswered), 400, 'The server cannot or will not process the request due to something that is perceived to be a client error');

        $data = QuestionAnsweredResource::make($questionAnswered); 
        return response()->json(
            [
                'message' => 'Answered Add Successful.',
                'data' => $data
            ],
            status: 200
        );
    }

}
