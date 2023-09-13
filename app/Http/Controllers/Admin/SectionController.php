<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Services\SectionService;
use App\Http\Requests\Admin\SectionRequest;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SectionController extends Controller
{
    public function __construct(protected SectionService $service)
    {
        $this->middleware('auth');
    }
    public function index(): View
    {
        $courses = Course::all();
        return view('pages.admin.create-section', ['courses' => $courses]);
    }

    public function create(SectionRequest $sectionRequest): RedirectResponse
    {
        $this->service->createSection($sectionRequest->validated());

        return redirect()->route('admin.section.list')->with('success', 'Section created successfully');
    }

    public function list(): View
    {
        $sections = Section::orderBy('created_at', 'desc')->paginate(40);
        return view('pages.admin.list-section')->with('sections', $sections);
    }

    public function show($sectionId)
    {
        $section = $this->service->showSection($sectionId);
        $courses = Course::all();
        return view('pages.admin.edit-section', ['section' => $section, 'courses' => $courses]);
    }

    public function update(SectionRequest $request, $sectionId): RedirectResponse
    {
        $this->service->updateSection($request->validated(), $sectionId);

        return redirect()->route('admin.section.list')
            ->with('success', 'Section updated successfully');
    }


    public function destroy($sectionId): RedirectResponse
    {
        $this->service->deleteSection($sectionId);

        return redirect()->route('admin.section.list')
            ->with('success', 'deleted successfully');
    }
}
