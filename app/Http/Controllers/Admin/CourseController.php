<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseRequest;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function __construct(protected CourseService $service)
    {
        $this->middleware('auth');
    }
    public function index(): View
    {
        return view('pages.admin.create-course');
    }
    public function create(CourseRequest $courseRequest): RedirectResponse
    {
     $this->service->createCourse($courseRequest->validated());
 
     return redirect()->route('admin.course.list')->with('success', 'Course created successfully');
    }
    public function list():View
    {
     $courses = Course::orderBy('created_at', 'desc')->paginate(40);
     return view('pages.admin.list-course')->with('courses', $courses);
    }

    public function show($courseId)
    {
        $course = $this->service->showCourse($courseId);
        return view('pages.admin.edit-course', ['course' => $course]);
    }

    public function update(CourseRequest $request, $sectionId): RedirectResponse
    {
        $this->service->updateCourse($request->validated(), $sectionId);

        return redirect()->route('admin.course.list')
            ->with('success', 'Course updated successfully');
    }

    public function destroy($courseId): RedirectResponse
    {
        
        $this->service->deleteCourse($courseId);
        
        return redirect()->route('admin.course.list')
                ->with('success', 'deleted successfully');
    }

}
