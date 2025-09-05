<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

// A controller to controll jobs [index, show]
class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Job::class);

        $filters = $request->only(['search', 'max_salary', 'min_salary', 'experience', 'category']);

        $jobs = Job::with('employer')->filter($filters)->latest()->get();


        return view('jobs.index', ['jobs' => $jobs]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        Gate::authorize('view', $job);

        return view('jobs.show', ['job' => $job->load('employer.jobs')]);
    }
}
