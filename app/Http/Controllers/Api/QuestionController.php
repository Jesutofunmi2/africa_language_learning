<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    
    public function list()
    {
        $question = Question::all();
        $data = QuestionResource::collection($question);

        return response()->json(
            [
                'message' => 'Get Question Successful.',
                'data' => $data
            ],
            status: 200
        );
    }
}
