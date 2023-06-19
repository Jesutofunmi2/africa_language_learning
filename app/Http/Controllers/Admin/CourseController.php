<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCourseRequest;
use App\Services\ActivityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Language;
use App\Models\Course;

class CourseController extends Controller
{
    //

    public function __construct(protected ActivityService $service)
    {
        $this->middleware('auth');
    }

    public function index(Request $request): View
    {
        $languages = Language::get();
        return view('pages.create-course', ['languages' => $languages]);
    }

    public function create(CreateCourseRequest $createCourseRequest): RedirectResponse
    {
     $this->service->createCourse($createCourseRequest->validated());
 
     return redirect()->route('admin.course.list')->with('success', 'Course created successfully');
    }

    public function list(Request $request):View
    {
     $courses = Course::paginate();
     return view('pages.list-course')->with('courses', $courses);
    }

    public function destroy(Course $course): RedirectResponse
    {
        $this->service->deleteCourse($course);
 
        return redirect()->route('admin.course.list')
                ->with('success', 'deleted successfully');
    }
}
