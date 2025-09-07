<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// a controller to controll Jobs of a specific Employer showing hobs for the Employer
// and creating jobs and updating destroying a job
class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAnyEmployer', Job::class);

        $jobs = Auth::user()->employer->jobs()
            ->with('employer', 'jobApplications.user')
            ->withTrashed()
            ->get();

        return view('my-job.index', ['jobs' => $jobs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Job::class);

        return view('my-job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        Gate::authorize('create', Job::class);

        Auth::user()->employer->jobs()->create($request->validated());

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job created successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $myJob)
    {
        Gate::authorize('update', $myJob);

        return view('my-job.edit', ['job' => $myJob]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $myJob)
    {
        Gate::authorize('update', $myJob);

        $myJob->update($request->validated());

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $myJob)
    {
        Gate::authorize('delete', $myJob);

        $myJob->delete();

        return redirect()->route('my-jobs.index')
            ->with('success', 'job deleted.');
    }
}
