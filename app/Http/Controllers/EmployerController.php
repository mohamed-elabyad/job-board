<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

// A controller to controll creating and storing an Employer
class EmployerController extends Controller
{


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Employer::class);

        return view('employer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Employer::class);

        Auth::user()->employer()->create([
            ...$request->validate([
                'company_name' => ['required', 'min:3', 'unique:employers,company_name']
            ])
        ]);

        return redirect()->route('jobs.index')
            ->with('success', 'Your Employer account was created.');
    }
}
