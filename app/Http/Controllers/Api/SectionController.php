<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SectionRequest;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function list(SectionRequest $sectionRequest)
    {
        $section = Section::orderBy('created_at', 'asc')
                            ->when($sectionRequest->course_id, fn($query) => $query->where('course_id', $sectionRequest->course_id))
                            ->has('topics')->paginate(50);
        $data = SectionResource::collection($section);

        return response()->json(
            [
                'message' => 'Get Section Successful.',
                'data' => $data
            ],
            status: 200
        );
    }



    public function show($id)
    {
        $section = Section::findOrFail($id);
        $data = SectionResource::make($section);

        return response()->json(
            [
                'message' => 'Get Section Successful.',
                'data' => $data
            ],
            status: 200
        );
    }
}
