<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function list()
    {
        $section = Section::orderBy('created_at', 'desc')->get();
        $data = SectionResource::collection($section);

        return response()->json(
            [
                'message' => 'Get Section Successful.',
                'data' => $data
            ],
            status: 200
        );
    }
}
