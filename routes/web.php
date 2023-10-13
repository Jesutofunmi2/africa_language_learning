<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TopicController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\AdminLogoutController;
use App\Http\Controllers\School\Auth\SchoolController;
use App\Http\Controllers\Admin\AdminActivityController;
use App\Http\Controllers\Admin\AdminRegisterController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\QuestionTpyeController;
use App\Http\Controllers\Student\Auth\CreateStudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('admin.login.get');
});

Route::prefix('admin')->name('admin.')
    ->group(
        function () {
            Route::middleware('guest')->group(function () {
                Route::get('login', [AdminLoginController::class, 'index'])->name('login.get');
                Route::post('login', [AdminLoginController::class, 'login'])->name('login.post');
            });

            Route::middleware('auth')->group(function () {

                Route::get('/getStudents', [CreateStudentController::class, 'list'])->name('list.student');

                Route::get('register', [AdminRegisterController::class, 'index'])->name('register.get');
                Route::post('register', [AdminRegisterController::class, 'register'])->name('register.post');

                Route::get('registers', [AdminRegisterController::class, 'list'])->name('users.list');
                Route::get('register/{registerId}', [AdminRegisterController::class, 'show'])->name('user.show');
                Route::delete('register/{registerId}', [AdminRegisterController::class, 'destroy'])->name('user.destroy');
                Route::put('register/{registerId}', [AdminRegisterController::class, 'update'])->name('user.update');
                Route::post('/users/{user}/roles', [AdminRegisterController::class, 'assignRole'])->name('users.roles');
                Route::delete('/users/{user}/roles/{role}', [AdminRegisterController::class, 'removeRole'])->name('users.roles.remove');
                Route::post('/users/{user}/permissions', [AdminRegisterController::class, 'givePermission'])->name('users.permissions');
                Route::delete('/users/{user}/permissions/{permission}', [AdminRegisterController::class, 'revokePermission'])->name('users.permissions.revoke');

                Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

                Route::get('activity/create', [AdminActivityController::class, 'index'])->name('activity.index');
                Route::post('activity/create', [AdminActivityController::class, 'create'])->name('activity.create');
                Route::get('activities', [AdminActivityController::class, 'list'])->name('activity.list');
                Route::get('activity/{activity}', [AdminActivityController::class, 'show'])->name('activity.show');
                Route::put('activity/{activity}', [AdminActivityController::class, 'update'])->name('activity.update');
                Route::delete('activity/{activity}', [AdminActivityController::class, 'destroy'])->name('activity.destroy');

                Route::get('language/create', [LanguageController::class, 'index'])->name('language.index');
                Route::post('language/create', [LanguageController::class, 'create'])->name('language.create');
                Route::get('languages', [LanguageController::class, 'list'])->name('language.list');
                Route::get('language/{language}', [LanguageController::class, 'show'])->name('language.show');
                Route::put('language/{language}', [LanguageController::class, 'update'])->name('language.update');
                Route::delete('language/{language}', [LanguageController::class, 'destroy'])->name('language.destroy');
                Route::get('languages/status/{id}', [LanguageController::class, 'status'])->name('language.status');

                Route::get('topic/create', [TopicController::class, 'index'])->name('topic.index');
                Route::post('topic/create', [TopicController::class, 'create'])->name('topic.create');
                Route::get('topics', [TopicController::class, 'list'])->name('topic.list');
                Route::get('topic/{topic}', [TopicController::class, 'show'])->name('topic.show');
                Route::put('topic/{topic}', [TopicController::class, 'update'])->name('topic.update');
                Route::delete('topic/{topic}', [TopicController::class, 'destroy'])->name('topic.destroy');

                Route::get('question/create', [QuestionController::class, 'index'])->name('question.index');
                Route::get('question/search', [QuestionController::class, 'search'])->name('question.search');
                Route::post('question/create', [QuestionController::class, 'create'])->name('question.create');
                Route::get('questions', [QuestionController::class, 'list'])->name('question.list');
                Route::get('questions/{question}', [QuestionController::class, 'show'])->name('question.show');
                Route::get('questions/status/{id}', [QuestionController::class, 'status'])->name('question.status');
                Route::put('question/{questionId}', [QuestionController::class, 'update'])->name('question.update');
                Route::get('questions/delete/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');
                Route::get('question/media', [QuestionController::class, 'media'])->name('question.media');
                Route::post('media/create', [QuestionController::class, 'mediaCreate'])->name('question.media-create');
                Route::get('question/batch-create', [QuestionController::class, 'batch'])->name('question.batch-cretate');
                Route::post('question/batchUpload', [QuestionController::class, 'batchUpload'])->name('question.batchUpload');

                Route::get('option/create', [OptionController::class, 'index'])->name('option.index');
                Route::post('option/create', [OptionController::class, 'create'])->name('option.create');
                Route::get('options/search', [OptionController::class, 'search'])->name('options.search');
                Route::get('option', [OptionController::class, 'list'])->name('option.list');
                Route::get('options/{id}', [OptionController::class, 'show'])->name('option.show');
                Route::put('optionUpdate/{id}', [OptionController::class, 'update'])->name('option.update');
                Route::get('options/is_correct/{id}', [OptionController::class, 'is_correct_update'])->name('option.is_correct_update');
                Route::get('/options/delete/{option}', [OptionController::class, 'destroy'])->name('option.destroy');
                Route::get('option/batch-create', [OptionController::class, 'batch'])->name('option.batch-cretate');
                Route::post('option/batchUpload', [OptionController::class, 'batchUpload'])->name('option.batchUpload');

                Route::get('school/create', [SchoolController::class, 'index'])->name('school.index');
                Route::post('school/create', [SchoolController::class, 'create'])->name('school.create');
                Route::get('schools', [SchoolController::class, 'list'])->name('school.list');
                Route::get('schools/{secondaryId}', [SchoolController::class, 'show'])->name('school.show');
                Route::get('school/{secondaryId}', [SchoolController::class, 'filter'])->name('school.filter.show');
                Route::get('school/students/{schoolId}', [SchoolController::class, 'schoolStudent'])->name('school.student.list');
                Route::get('school/teachers/{schoolId}', [SchoolController::class, 'schoolTeacher'])->name('school.teacher.list');
                Route::put('school/{secondaryId}', [SchoolController::class, 'update'])->name('school.update');
                Route::get('schools/status/{id}', [SchoolController::class, 'status'])->name('school.status');
                Route::delete('schools/{secondaryId}', [SchoolController::class, 'destroy'])->name('school.destroy');

                Route::get('teacher/create', [TeacherController::class, 'index'])->name('teacher.index');
                Route::post('teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
                Route::get('teachers', [TeacherController::class, 'list'])->name('teacher.list');
                Route::get('teacher/{id}', [TeacherController::class, 'show'])->name('teacher.show');
                Route::put('teachers/{id}', [TeacherController::class, 'update'])->name('teacher.update');
                Route::delete('teachers/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');

                Route::get('role/create', [RoleController::class, 'index'])->name('role.index');
                Route::post('role/create', [RoleController::class, 'create'])->name('role.create');
                Route::get('roles', [RoleController::class, 'list'])->name('role.list');
                Route::get('role/{roleId}', [RoleController::class, 'show'])->name('role.show');
                Route::put('role/{roleId}', [RoleController::class, 'update'])->name('role.update');
                Route::delete('role/{roleId}', [RoleController::class, 'destroy'])->name('role.destroy');
                Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('role.permissions');
                Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('role.permissions.revoke');

                Route::get('permission/create', [PermissionController::class, 'index'])->name('permission.index');
                Route::post('permission/create', [PermissionController::class, 'create'])->name('permission.create');
                Route::get('permissions', [PermissionController::class, 'list'])->name('permission.list');
                Route::get('permission/{permissionId}', [PermissionController::class, 'show'])->name('permission.show');
                Route::put('permission/{permissionId}', [PermissionController::class, 'update'])->name('permission.update');
                Route::delete('permission/{permissionId}', [PermissionController::class, 'destroy'])->name('permission.destroy');
                Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
                Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');

                Route::get('section/create', [SectionController::class, 'index'])->name('section.index');
                Route::post('section/create', [SectionController::class, 'create'])->name('section.create');
                Route::get('sections', [SectionController::class, 'list'])->name('section.list');
                Route::get('section/{id}', [SectionController::class, 'show'])->name('section.show');
                Route::put('sections/{id}', [SectionController::class, 'update'])->name('section.update');
                Route::delete('sections/{id}', [SectionController::class, 'destroy'])->name('section.destroy');

                Route::get('course/create', [CourseController::class, 'index'])->name('course.index');
                Route::post('course/create', [CourseController::class, 'create'])->name('course.create');
                Route::get('courses', [CourseController::class, 'list'])->name('course.list');
                Route::get('course/{course}', [CourseController::class, 'show'])->name('course.show');
                Route::put('course/{course}', [CourseController::class, 'update'])->name('course.update');
                Route::delete('course/{course}', [CourseController::class, 'destroy'])->name('course.destroy');
                Route::get('course/status/{id}', [CourseController::class, 'status'])->name('course.status');

                Route::get('question-type/create', [QuestionTpyeController::class, 'index'])->name('question.type.index');
                Route::post('question-type/create', [QuestionTpyeController::class, 'create'])->name('question.type.create');
                Route::get('question-types', [QuestionTpyeController::class, 'list'])->name('question.type.list');
                Route::get('question-type/{Id}', [QuestionTpyeController::class, 'show'])->name('question.type.show');
                Route::put('question-type/{Id}', [QuestionTpyeController::class, 'update'])->name('question.type.update');
                Route::delete('question-type/{Id}', [QuestionTpyeController::class, 'destroy'])->name('question.type.destroy');
    

                Route::post('logout', [AdminLogoutController::class, 'index'])->name('logout');
            });
        }
    );
