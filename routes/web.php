<?php

use App\Http\Controllers\Admin\AdminActivityController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminLogoutController;
use App\Http\Controllers\Admin\AdminRegisterController;
use Illuminate\Support\Facades\Route;

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
    ->group(function () {
        Route::middleware('guest')->group(function() {
            Route::get('login', [AdminLoginController::class, 'index'])->name('login.get');
            Route::post('login', [AdminLoginController::class, 'login'])->name('login.post');

            Route::get('register', [AdminRegisterController::class, 'index'])->name('register.get');
            Route::post('register', [AdminRegisterController::class, 'register'])->name('register.post');
        });

        Route::middleware('auth', 'is_admin')->group(function() {
            Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

            Route::get('activity/create', [AdminActivityController::class, 'index'])->name('activity.index');
            Route::post('activity/create', [AdminActivityController::class, 'create'])->name('activity.create');
            Route::get('activities', [AdminActivityController::class, 'list'])->name('activity.list');
            Route::get('activity/{activity}', [AdminActivityController::class, 'show'])->name('activity.show');
            Route::put('activity/{activity}', [AdminActivityController::class, 'update'])->name('activity.update');
            Route::delete('activity/{activity}', [AdminActivityController::class, 'destroy'])->name('activity.destroy');

            Route::post('logout', [AdminLogoutController::class, 'index'])->name('logout');
        });
        
    }
);
