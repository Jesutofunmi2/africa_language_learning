<?php

use App\Http\Controllers\User\UserActivityController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserLogoutController;
use App\Http\Controllers\User\UserRegisterController;
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
    
    Route::prefix('auth')->name('auth.')
        ->group(function () {
            Route::post('/login', UserLoginController::class)->name('login');
            Route::post('/register', UserRegisterController::class)->name('register');
            Route::post('/logout', UserLogoutController::class)->middleware('auth:sanctum')->name('logout');
    });

    Route::prefix('/activity')
        ->middleware('auth:sanctum')
        ->name('activity.')
        ->group(function() {
            Route::get('/', UserActivityController::class)->name('activities');
    });
});