<?php

namespace App\Http\Controllers;

use App\Models\Job;

class JobController extends Controller
{
    // Index
    public function index() {
        $jobs = Job::with('employer')->latest()->paginate(3);
    // $jobs = Job::with('employer')->cursorPaginate(3);
    // $jobs = Job::with('employer')->simplePaginate(3);

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
    }

    // Create Job
    public function create() {
       return view('jobs.create');
    }

    // Show Jobs
    public function show(Job $job) {
       return view('jobs.show', ['job' => $job]);
    }

    // Save Job to DB
       public function store() {
       request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
    }

    // Edit Job
    public function edit(Job $job) {
        return view('jobs.edit', ['job' => $job]);
    }

    // Update Job
    public function update(Job $job) {
        request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    return redirect('/jobs/' . $job->id);
    }

    // Delete Job
       public function destroy(Job $job) {
         $job->delete();

    return redirect('/jobs');
    }
}