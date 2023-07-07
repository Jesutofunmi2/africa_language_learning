<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\TeacherRequest;
use App\Models\School;
use App\Models\Teacher;
use App\Services\TeacherService;
use App\Services\TokenService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function __construct(protected TokenService $tokenService, protected TeacherService $teacherService)
  {
  }

  //teacher create page 
  public function index()
  {
    $schools = School::all();
    return view('pages.admin.create-teacher', ['schools' => $schools]);
  }

//teacher create logic
public function create(TeacherRequest $teacherRequest)
  {
    $teacher = $this->teacherService->createTeacher($teacherRequest->validated());
    return redirect()->route('admin.teacher.list',  ['teacher' => $teacher])->with('success', 'Teacher created successfully');
  }


  public function list(): View
  {
    $teachers = Teacher::orderBy('created_at', 'desc')->paginate(15);
    return view('pages.admin.list-teacher')->with('teachers', $teachers);
  }

  public function show($teacherId)
  {
    $schools = School::all();
    $teacher = $this->teacherService->showTeacher($teacherId);
    return view('pages.admin.edit-teacher', ['teacher' => $teacher , 'schools'=> $schools]);
  }

  public function update(TeacherRequest $teacherRequest, $teacherId): RedirectResponse
  {
    $image = null;

    if ($teacherRequest->hasFile('image_url')) {
      $image = $teacherRequest->image_url;
    }

    $this->teacherService->updateTeacher( $teacherRequest->validated(), $image, $teacherId);

    return redirect()->route('admin.teacher.list')
      ->with('success', 'Teacher updated successfully');
  }


  public function destroy($teacherId): RedirectResponse
  {
    $this->teacherService->deleteTeacher($teacherId);

    return redirect()->route('admin.teacher.list')
      ->with('success', 'Teacher deleted successfully');
  }


}
