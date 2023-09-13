<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FouriteRequest;
use App\Http\Resources\FouriteResource;
use App\Models\Fourite;
use App\Services\FouriteService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class FouriteController extends Controller
{
    public function __construct(protected FouriteService $fouriteService)
    {
        // $this->middleware('auth');
    }

    public function create(FouriteRequest $fouriteRequest): JsonResponse
    {
        abort_if(is_null($fouriteRequest), 408, 'Request Timeout');

        $fourite = $this->fouriteService->addFourite($fouriteRequest->validated());
        abort_if(is_null($fourite), 400, 'The server cannot or will not process the request due to something that is perceived to be a client error');

        $data = FouriteResource::make($fourite);
        return response()->json(
            [
                'message' => 'Fourite Add Successful.',
                'data' => $data
            ],
            status: 200
        );
    }

    public function list(FouriteRequest $fouriteRequest): JsonResponse
    {
        abort_if(is_null($fouriteRequest->student_id), 404, 'Student Id not found');
        $fourites = $this->fouriteService->getFourite($fouriteRequest->student_id,  $fouriteRequest->question_id, $fouriteRequest->language_id,);
        abort_if($fourites == null, 204, 'No Favourite content');
        $data = FouriteResource::collection($fourites);
        return response()->json(
            [
                'message' => 'Get Fourites Successful.',
                'data' => $data
            ],
            status: 200
        );
    }


    public function remove(FouriteRequest $fouriteRequest): JsonResponse
    {
        abort_if(is_null($fouriteRequest), 408, 'Request Timeout');

        $this->fouriteService->removeFourite($fouriteRequest->validated());

        return response()->json(
            [
                'message' => 'Fourite Removed Successful.',
            ],
            status: 200
        );
    }
}
