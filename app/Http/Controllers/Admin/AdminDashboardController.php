<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ActivityType;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Admin;
use App\Models\Course;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Language;
use App\Models\Option;
use App\Models\Question;
use App\Models\SecondarySchool;
use App\Models\Student;

class AdminDashboardController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Admin Dashboard Page.
     * 
     * This method return a view for admin dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     * 
     */
    public function index(Request $request): View
    {
        $users = Admin::where('is_admin', true)->get();
        $types = Activity::TYPES;
        $languages = Language::count();
        $courses = Course::count();
        $students = Student::count();
        $schools = SecondarySchool::count();
        $questions = Question::count();
        $options = Option::count();

        return view(
            'pages.dashboard',
            [
                'users' => $users,
                'types' => $types,
                'languages' => $languages,
                'courses' => $courses,
                'students' => $students,
                'schools' => $schools,
                'questions' => $questions,
                'options' => $options
            ]
        );
    }
}
