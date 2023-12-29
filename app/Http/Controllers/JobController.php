<?php

namespace App\Http\Controllers;
use App\Models\Job;
use Illuminate\Support\Facades\Session;
use App\Models\Candidate;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function getJobs()
{
    $jobs = Job::all();
    $loggedInUser = Session::get('loggedInUser');
    return view('dashboard', compact('jobs', 'loggedInUser'));
}

}
