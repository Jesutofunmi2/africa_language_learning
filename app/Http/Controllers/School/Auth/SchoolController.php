<?php

namespace App\Http\Controllers\School\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\School\CreateSchoolRequest;
use App\Http\Requests\School\SecondaryRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\SchoolResource;
use App\Models\SecondarySchool;
use App\Services\TokenService;
use App\Services\SchoolService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SchoolController extends Controller
{
  public function __construct(protected TokenService $tokenService, protected SchoolService $schoolService)
  {
  }

  public function __invoke(CreateSchoolRequest $request): JsonResponse
  {
    $school = $this->schoolService->createSchool($request->validated());

    $ip = $request->ip();
    $user_agent = $request->userAgent();
    $data = SchoolResource::make($school);

    $token = $this->tokenService->createTokenSchool($school, 'test', $ip, $user_agent);

    return response()->json(
      [
        'message' => 'Registration successful.',
        'data' =>  $data,
        'token' => LoginResource::make($school->withAccessToken($token))
      ],
      status: 201
    );
  }

  public function index()
  {
    return view('pages.admin.create-school');
  }

  public function create(SecondaryRequest $secondaryRequest)
  {
    $school = $this->schoolService->createSecondarySchool($secondaryRequest->validated());
    return redirect()->route('admin.school.list',  ['schools' => $school])->with('success', 'School created successfully');
  }

  public function list(): View
  {
    $school = SecondarySchool::orderBy('created_at', 'desc')->paginate(15);
    return view('pages.admin.list-school')->with('schools', $school);
  }

  public function show($schoolId)
  {
    $school = $this->schoolService->showschool($schoolId);
    return view('pages.admin.edit-school', ['school' => $school]);
  }

  public function update(SecondarySchool $secondarySchool, SecondaryRequest $request, $schoolId): RedirectResponse
  {
    $image = null;

    if ($request->hasFile('image_url')) {
      $image = $request->image_url;
    }

    $this->schoolService->update($secondarySchool, $request->validated(), $image, $schoolId);

    return redirect()->route('admin.school.list')
      ->with('success', 'School updated successfully');
  }


  public function destroy($secondaryId): RedirectResponse
  {
    $this->schoolService->deleteSchool($secondaryId);

    return redirect()->route('admin.school.list')
      ->with('success', 'School deleted successfully');
  }
}
