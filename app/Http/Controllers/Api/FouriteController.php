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
 
    public function create(FouriteRequest $fouriteRequest):JsonResponse
    {
        
        $fourite = $this->fouriteService->addFourite($fouriteRequest->validated());
        abort_if( $fourite== null, 400, 'No Favourite');
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
       $fourites = $this->fouriteService->getFourite($fouriteRequest->student_id);
       abort_if( $fourites== null, 400, 'No Favourite');
       $data = FouriteResource::collection($fourites);
        return response()->json(
            [
                'message' => 'Get Fourites Successful.',
                'data' => $data
            ],
            status: 200
        );
    }
}
