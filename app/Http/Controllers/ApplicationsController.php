<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\Job;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


// A controller to controll Job applications
class ApplicationsController extends Controller
{
    public function index()
    {
        $applications =  Auth::user()->jobApplications()
            ->with([
                'job' => fn($query) => $query->withCount('jobApplications')
                    ->withAvg('jobApplications', 'expected_salary')
                    ->withTrashed(),
                'job.employer'
            ])
            ->latest()->get();

        return view('job-application.index', ['applications' => $applications]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Job $job)
    {
        Gate::authorize('apply', $job);

        return view('job-application.create', ['job' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Job $job, Request $request)
    {
        Gate::authorize('apply', $job);

        $data = $request->validate([
            'expected_salary' => ['required', 'numeric', 'min:1', 'max:1000000'],
            'cv' => ['required', 'file', 'mimes:pdf', 'max:2048']
        ]);

        $file = $data['cv'];
        $path = $file->store('cvs', 'local');

        $job->JobApplications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $data['expected_salary'],
            'cv_path' => $path
        ]);

        return redirect()->route('jobs.show', $job)
            ->with('success', 'Job application submitted.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $myApplication, Job $job)
    {
        Gate::authorize('apply', $job);

        $myApplication->delete();

        return redirect()->back()->with('success', 'Job Application Removed.');
    }
}
