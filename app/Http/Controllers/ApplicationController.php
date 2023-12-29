<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function submitApplication(Request $request)
{
    $request->validate([
        'job_id' => 'required|exists:jobs,id',
        'candidate_id' => 'required|exists:candidates,id',
        'resume' => 'required',
        'exp' => 'required|string',
        'notice' => 'required|string',
        'status' => 'required|in:pending,approved,rejected',
    ]);


    Application::create([
        'job_id' => $request->input('job_id'),
        'candidate_id' => $request->input('candidate_id'),
        'resume' => $request->input('resume'),
        'exp' => $request->input('exp'),
        'notice' => $request->input('notice'),
        'status' => $request->input('status'),
        
    ]);
    

    return back()->with('success', 'Application submitted successfully!',200);
}

}
