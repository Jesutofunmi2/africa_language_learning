<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Course;

class CreateQuestionController extends Controller
{
    public function index(){
     $languages = Language::all();
     $courses = Course::all();

     return view('pages.create-question', ['languages'=> $languages, 'courses'=> $courses]);
    }
}
