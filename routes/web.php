<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MyJobController;
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

Route::middleware('guest')->group(function () {
    Route::resource('login', LoginController::class)
        ->only(['create', 'store']);

    Route::resource('register', RegisterController::class)
        ->only(['create', 'store']);
});

Route::delete('logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');
