<?php

namespace App\Http\Controllers\School\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\School\CreateSchoolRequest;
use App\Http\Requests\School\SecondaryRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\SchoolResource;
use App\Models\ClassArm;
use App\Models\Classes;
use App\Models\School;
use App\Models\SecondarySchool;
use App\Models\Student;
use App\Models\Teacher;
use App\Services\TokenService;
use App\Services\SchoolService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

  public function create(CreateSchoolRequest $request)
  {
    $school = $this->schoolService->createSchool($request->validated());
    return redirect()->route('admin.school.list',  ['schools' => $school])->with('success', 'School created successfully');
  }

  public function list(): View
  {
    $schools = School::orderBy('created_at', 'desc')->paginate(15);
    return view('pages.admin.list-school')->with('schools', $schools);
  }

  public function show($schoolId)
  {
    $school= $this->schoolService->showschool($schoolId);

  
    return view('pages.admin.edit-school', ['school' => $school]);
  }

  public function filter($schoolId)
  {
    $students = Student::where('school_id', $schoolId)->count();
    $teachers = Teacher::where('school_id', $schoolId)->count();
    $classs = Classes::where('school_id', $schoolId)->count();
    $class_arms = ClassArm::where('school_id', $schoolId)->count();
    $school_name = School::where('id', $schoolId)->get();
  
    return view('pages.admin.filter-school', ['students' => $students, 'teachers' => $teachers, 'classes'=>$classs, 'class_arms'=> $class_arms, 'school_name'=> $school_name ]);
  }

  public function schoolStudent($schoolId)
  {
    $students = Student::where('school_id', $schoolId)->paginate(40);
   
    return view('pages.admin.list-school-student', ['students' => $students ]);
  }

  public function schoolTeacher($schoolId)
  {
    $teachers = Teacher::where('school_id', $schoolId)->paginate(40);
   
    return view('pages.admin.list-school-teacher', ['teachers' => $teachers ]);
  }

  public function update(School $secondarySchool, SecondaryRequest $request, $schoolId): RedirectResponse
  {

    $image = null;
    if ($request->hasFile('image_url')) {
      $image = $request->image_url;
    }

    $this->schoolService->update($secondarySchool, $request->validated(), $image, $schoolId);

    return redirect()->route('admin.school.list')
      ->with('success', 'School updated successfully');
  }

  public function search(Request $request)
  {
      $outputoption = '';
      $alloptions  = School::orderBy('created_at', 'desc')->get();
      Session::put('school_url', request()->fullUrl());

      if ($request->school != '') {
          $schools = School::where('name', 'LIKE', '%' . $request->school . '%')->orderBy('name', 'desc')->get();

          foreach ($schools  as $index => $schools) {
              $count = $index + 1;
              $outputoption .=
                  '<tr>
             <td> ' . $count . '</td>
             <td> ' . $schools->name . '</td>
             <td> ' . $schools->phone_number. ' </td>
             <td> ' . $schools->email . ' </td>
             <td> ' . substr($schools->future, 14) . ' </td>
             <td><img src="' . asset($schools->image_url) . '" width="40px" height="40px" /></td>
             <td> ' . $schools->created_at->diffForHumans() . ' </td>

             <td> ' . '
             <a href="schools/status/' . $schools->id . '" class="btn btn-success">' . 'Status</a>
              ' . '</td>

              <td> ' . '
              <a href="schools/' . $schools->id . '" class="btn">' . 'Edit</a>
              ' . '</td>

              <td> ' . '
              <a href="#' . $schools->id . '" class="btn btn-primary">' . 'Analytics</a>
              ' . '</td>

              <td> ' . '
              <a href="#' . $schools->id . '" class="btn btn-danger">' . 'Delete</a>
              ' . '</td>

              <td> ' . '
              <a href="#' . $schools->id . '" class="btn btn-warning">' . 'ResetPassword</a>
              ' . '</td>

            </tr>';
          }

          return response($outputoption);
      } elseif ($request->school == '') {
          return view('pages.admin.list-school', ['schools' => $alloptions]);
      }

      return view('pages.admin.list-school', ['schools' => $alloptions]);
  }


  public function status(Request $request, $id)
  {
    $this->schoolService->schoolStatus($id);

    return redirect()->route('admin.school.list', ['page' => $request->page])
      ->with('success', 'Updated successfully');
  }

  public function reset(Request $request, $id){
    $this->schoolService->schoolPasswordReset($id);

    return redirect()->route('admin.school.list', ['page' => $request->page])
      ->with('success', 'Reset successfully');
  }

  public function destroy($secondaryId): RedirectResponse
  {
    $this->schoolService->deleteSchool($secondaryId);

    return redirect()->route('admin.school.list')
      ->with('success', 'School deleted successfully');
  }
}
