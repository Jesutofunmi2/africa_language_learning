<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateLanguageRequest;
use App\Models\Language;
use App\Services\ActivityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CreateLanguageController extends Controller
{
    public function __construct(protected ActivityService $service)
    {
        $this->middleware('auth');
    }

    public function index(Request $request): View
    {
        return view('pages.create-language');
    }

   public function create(CreateLanguageRequest $createLanguageRequest): RedirectResponse
   {
    $this->service->createLanguage($createLanguageRequest->validated());

    return redirect()->route('admin.language.list')->with('success', 'Language created successfully');
   }

   public function list(Request $request):View
   {
    $language = Language::paginate();
    return view('pages.list-language')->with('languages', $language);
   }
  

   public function destroy(Language $language): RedirectResponse
   {
       $this->service->deleteLanguage($language);

       return redirect()->route('admin.language.list')
               ->with('success', 'Language deleted successfully');
   }
}
