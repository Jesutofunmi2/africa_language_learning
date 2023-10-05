<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\School\SecondaryRequest;
use App\Http\Resources\Api\SecondarySchoolResource;
use App\Http\Resources\SchoolResource;
use App\Models\School;
use Facade\FlareClient\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function list()
    {
        $schools = School::orderBy('created_at', 'desc')->paginate(15);
        $data = SchoolResource::collection($schools);
        return response()->json(
            [
                'message' => "Get Successful",
                'data' => $data
            ],
            status: 200
        );
    }
}
