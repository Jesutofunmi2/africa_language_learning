<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Resources\LanguageResource;

class LanguageController extends Controller
{
    public function list()
    {
        $languages = Language::orderBy('created_at', 'asc')->get();
        $data = LanguageResource::collection($languages);

        return response()->json(
            [
                'message' => 'Get Language successful.',
                'data' => $data
            ],
            status: 200
        );
    }
}
