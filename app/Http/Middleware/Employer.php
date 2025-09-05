<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// A middleware to make sure that the job an employer is viewing
//is the one they created, and that they only one allowed to edit or delete it
class Employer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() === null || $request->user()->employer === null) {
            return redirect()->route('employer.create')
                ->with('error', 'You need to register as an Employer first!');
        }

        return $next($request);
    }
}
