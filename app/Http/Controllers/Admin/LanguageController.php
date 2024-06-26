<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateLanguageRequest;
use App\Models\Language;
use App\Services\ActivityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LanguageController extends Controller
{
    public function __construct(protected ActivityService $service)
    {
        $this->middleware('auth');
    }

    public function index(Request $request): View
    {
        return view('pages.admin.create-language');
    }

    public function create(CreateLanguageRequest $createLanguageRequest): RedirectResponse
    {
        $validated = $createLanguageRequest->safe()->only(['name']);
        if ($this->service->languageNameExists($validated) == true) {
            return back()->with('error', 'You can not add same language');
        }
        $this->service->createLanguage($createLanguageRequest->validated());

        return redirect()->route('admin.language.list')->with('success', 'Language created successfully');
    }

    public function list(Request $request): View
    {
        $language = Language::orderBy('created_at', 'desc')->paginate(40);
        return view('pages.admin.list-language')->with('languages', $language);
    }

    public function show($languageId)
    {
        $language = $this->service->showLanguage($languageId);
        return view('pages.admin.edit-language', ['language' => $language]);
    }

    public function update(CreateLanguageRequest $request, $languageId): RedirectResponse
    {
        $image = null;

        if ($request->hasFile('image_url')) {
            $image = $request->image_url;
        }

        $this->service->updateLanguage($request->validated(), $image, $languageId);

        return redirect()->route('admin.language.list')
            ->with('success', 'Language updated successfully');
    }

    public function status(Request $request, $id)
    {
        $this->service->languageStatus($id);
        return redirect()->route('admin.language.list', ['page' => $request->page])
            ->with('success', 'Updated successfully');
    }

    public function destroy(Language $language): RedirectResponse
    {
        $this->service->deleteLanguage($language);

        return redirect()->route('admin.language.list')
            ->with('success', 'Language deleted successfully');
    }
}
