<?php

use App\Http\Controllers\User\UserActivityController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserLogoutController;
use App\Http\Controllers\User\UserRegisterController;
use App\Http\Controllers\School\Auth\CreateSchoolController;
use App\Http\Controllers\School\Auth\SchoolLoginController;
use App\Http\Controllers\School\Auth\SchoolLogoutController;
use App\Http\Controllers\Student\Auth\CreateStudentController;
use App\Http\Controllers\Student\Auth\StudentLoginController;
use Illuminate\Support\Facades\Route;

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
    Route::post('/email/verification-notification', function (Request $request) {
       $request->user()->sendEmailVerificationNotification();
         
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');


    Route::prefix('auth')->name('auth.')
        ->group(function () {
            Route::post('/login', UserLoginController::class)->name('login');
            Route::post('/register', UserRegisterController::class)->name('register');

            //schoool endpoint
            Route::post('/createSchool', CreateSchoolController::class)->name('createSchool');
            Route::post('/schoolLogin', SchoolLoginController::class)->name('schoolLogin');
            Route::post('/schoolLogout', SchoolLogoutController::class)->middleware('auth:sanctum')->name('logout_for_school');

            //student endpoint
            Route::post('/createStudent', CreateStudentController::class)->name('createStudent');
            Route::post('/studentLogin', StudentLoginController::class)->name('studentLogin');

            Route::post('/logout', UserLogoutController::class)->middleware('auth:sanctum')->name('logout');
    });

    Route::prefix('/activity')
        ->middleware('auth:sanctum')
        ->name('activity.')
        ->group(function() {
            Route::get('/', UserActivityController::class)->name('activities');
    });
});