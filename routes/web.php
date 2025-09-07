<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MyJobController;
use Illuminate\Auth\Events\Logout;
use Illuminate\Container\Attributes\Log;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => to_route('jobs.index'));

Route::resource('jobs', JobController::class)
    ->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    // A route to show all jobs to any user
    Route::resource('jobs.applications', ApplicationsController::class)
        ->scoped()
        ->only(['create', 'store']);

    // a route to show application to a specific user
    Route::resource('my-applications', ApplicationsController::class)
        ->only('index', 'show', 'destroy');

    // to create a Employer
    Route::resource('employer', EmployerController::class)
        ->only(['create', 'store']);

    // to show jobs of a specific Employer with a special middleware
    Route::resource('my-jobs', MyJobController::class)->middleware('employer');
});


Route::get('login', [LoginController::class, 'loginPage'])->middleware('guest')->name('login');
Route::post('login', [LoginController::class, 'login'])->middleware('guest')->name('login.store');

Route::post('logout', LogoutController::class)->middleware('auth')->name('logout');

Route::resource('register', RegisterController::class)
    ->only(['create', 'store'])
    ->middleware('guest');
