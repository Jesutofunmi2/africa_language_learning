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
        return view('pages.admin.create-course', ['languages' => $languages]);
    }

    public function create(CreateCourseRequest $createCourseRequest): RedirectResponse
    {
     $this->service->createCourse($createCourseRequest->validated());
 
     return redirect()->route('admin.course.list')->with('success', 'Course created successfully');
    }

    public function list(Request $request):View
    {
     $courses = Course::orderBy('created_at', 'desc')->paginate(40);
     return view('pages.admin.list-course')->with('courses', $courses);
    }

    public function show($courseId)
    {
        $course = $this->service->showCourse($courseId);
        return view('pages.admin.edit-course', ['course' => $course ]);
    }

    public function update(CreateCourseRequest $request, $courseId): RedirectResponse
    {
        $image = null;

        if ($request->hasFile('image_url')) {
            $image = $request->image_url;
        }

        $this->service->updateCourse($request->validated(), $image, $courseId);

        return redirect()->route('admin.course.list')
            ->with('success', 'Course updated successfully');
    }

    public function destroy(Course $course): RedirectResponse
    {
        $this->service->deleteCourse($course);
 
        return redirect()->route('admin.course.list')
                ->with('success', 'deleted successfully');
    }
}
