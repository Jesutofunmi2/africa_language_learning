<?php

namespace App\Http\Controllers\User;

use App\Http\Services\ActivityService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ListActivityRequest;
use App\Http\Resources\ActivityResource;

class UserActivityController extends Controller
{
    public function __construct(protected \App\Services\ActivityService $service) {}


     /**
     * Get Activity Endpoint.
     * 
     * This endpoint handles getting user activities.
     *
     * @param  \App\Http\Requests\CreateActivityRequest  $request
     * @return \Illuminate\Http\JsonResponse
     * 
     * @queryParam from_date date Filter activities from date
     * @queryParam to_date date Filter activities to date
     * 
     * @group Activity
     * @authenticated
     * 
     */
    public function __invoke(ListActivityRequest $request): JsonResponse
    {

        $activities = $this->service->getUserActivity($request);

        return response()->json([
                'message' => 'Get user activity successful.',
                'data' => ActivityResource::collection($activities)
            ],
            status: 200
        );
    }
}
