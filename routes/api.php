<?php

use App\Http\Controllers\Api\QuestionAnsweredController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\AssignedModuleController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\FouriteController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserLogoutController;
use App\Http\Controllers\User\UserActivityController;
use App\Http\Controllers\User\UserRegisterController;
use App\Http\Controllers\School\Auth\SchoolController;
use App\Http\Controllers\School\Auth\SchoolLoginController;
use App\Http\Controllers\School\Auth\SchoolLogoutController;
use App\Http\Controllers\Teacher\Auth\TeacherLoginController;
use App\Http\Controllers\Teacher\Auth\TeacherLogoutController;
use App\Http\Controllers\Student\Auth\StudentLoginController;
use App\Http\Controllers\Student\Auth\CreateStudentController;
use App\Http\Controllers\Teacher\Auth\CreateTeacherController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\ClassWorkController;
use App\Http\Controllers\Api\SurveyController;
use App\Http\Controllers\Api\TeacherSurveyController;
use App\Models\QuestionAnswered;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('/v1')
    ->group(function () {

        Route::prefix('auth')->name('auth.')
            ->group(function () {
                //student endpoint
                // Route::post('/login', UserLoginController::class)->name('login');
                Route::post('/register', UserRegisterController::class)->name('register');
                Route::post('/studentLogin', StudentLoginController::class)->name('studentLogin');

                //schoool endpoint
                Route::post('/createSchool', SchoolController::class)->name('createSchool');
                Route::post('/schoolLogin', SchoolLoginController::class)->name('schoolLogin');
                Route::post('/schoolLogout', SchoolLogoutController::class)->middleware('auth:sanctum')->name('logout_for_school');

                //teacher endpoint
                //Route::post('/createTeacher', TeacherController::class)->name('createTeacher');
                Route::post('/teacherLogin', TeacherLoginController::class)->name('teacherLogin');
                Route::post('/teacherLogout', TeacherLogoutController::class)->middleware('auth:sanctum')->name('logout_for_teacher');

                Route::post('/logout', UserLogoutController::class)->middleware('auth:sanctum')->name('logout');
            });

        Route::middleware('auth:sanctum')
            ->group(function () {
                Route::get('/language', [LanguageController::class, 'list'])->name('language.list');
                Route::get('/topic', [TopicController::class, 'list'])->name('topic.list');
                Route::get('/type', [TopicController::class, 'type'])->name('topic.type');
                Route::get('/section', [SectionController::class, 'list'])->name('section.list');
                Route::get('/section/{id}', [SectionController::class, 'show'])->name('section.show');
                Route::get('/course', [CourseController::class, 'list'])->name('course.list');
                Route::get('/getCourse', [CourseController::class, 'getCourse'])->name('course.getCourse');
                Route::get('/question', [QuestionController::class, 'list'])->name('question.list');
                Route::post('/option', [AnswerController::class, 'checkAnswer'])->name('answer.check');

                //fourites endpoint
                Route::post('/createFourite', [FouriteController::class, 'create'])->name('fourite.create');
                Route::get('/getFourites', [FouriteController::class, 'list'])->name('fourite.list');
                Route::delete('/removeFourites', [FouriteController::class, 'remove'])->name('fourite.remove');

                //student endpoint
                Route::post('/createStudent', CreateStudentController::class)->name('createStudent');
                Route::get('/students', [StudentController::class, 'list'])->name('student.list');
                Route::get('/getStudent', [StudentController::class, 'getStudent'])->name('student.show');
                Route::put('/updateStudent', [StudentController::class, 'update'])->name('student.update');
                Route::delete('/deleteStudent', [StudentController::class, 'destroy'])->name('student.destroy');

                //teacher endpoint
                Route::post('/addTeacher', [TeacherController::class, 'addTeacher'])->name('addTeacher');
                Route::get('/teachers', [TeacherController::class, 'list'])->name('teacher.list');
                Route::get('/getTeacher', [TeacherController::class, 'getTeacher'])->name('teacher.show');
                Route::post('/updateTeacher', [TeacherController::class, 'createTeacher'])->name('createTeacher');
                Route::delete('/deleteTeacher', [TeacherController::class, 'destroy'])->name('teacher.destroy');

                //classes endpoint
                Route::post('/addClass', [ClassController::class, 'createClass'])->name('createClass');
                Route::get('/showClass', [ClassController::class, 'show'])->name('showClass');
                Route::delete('/deleteClass', [ClassController::class, 'delete'])->name('deleteClass');

                //classwork endpoint
                Route::post('/addClassWork', [ClassWorkController::class, 'createClassWork'])->name('createClassWork');
                Route::get('/ClassWork', [ClassWorkController::class, 'list'])->name('getClassWork');
                Route::delete('/deleteClassWork', [ClassWorkController::class, 'delete'])->name('deleteClassWork');

                // Question Answered
                Route::post('/questionAnswered', [QuestionAnsweredController::class, 'create'])->name('questionAnswered.create');
                Route::get('/questionAnswered', [QuestionAnsweredController::class, 'list'])->name('questionAnswered.list');

                //Survey
                Route::get('/StudentsSurvey', [SurveyController::class, 'getStudentSurvey'])->name('studentSurvey.list');
                Route::get('/TeachersSurvey', [SurveyController::class, 'getTeacherSurvey'])->name('teacherSurvey.list');
                Route::post('/createStudentSurvey', [SurveyController::class, 'createStudentSurvey'])->name('studentSurvey.create');
                Route::post('/create/TeacherSurvey', [SurveyController::class, 'createTeacherSurvey'])->name('teacherSurvey.create');

                //Assigned Module
                Route::post('/teacher/assignedModule', [AssignedModuleController::class, 'createdTeacherAssignedModule'])->name('assignedModule.teacher');
                
               

            });

        Route::prefix('/activity')
            ->middleware('auth:sanctum')
            ->name('activity.')
            ->group(function () {
                Route::get('/', UserActivityController::class)->name('activities');
            });
    });
