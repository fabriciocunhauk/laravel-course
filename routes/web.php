<?php

// use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Job;



Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

// Index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->paginate(3);
    // $jobs = Job::with('employer')->cursorPaginate(3);
    // $jobs = Job::with('employer')->simplePaginate(3);

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

// Create Job
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

// Show Jobs
Route::get('/jobs/{id}', function ($id) {

    // $job = \Illuminate\support\Arr::first($jobs, function ($job) use ($id) {
    //     return $job['id'] === $id;
    // });

    // $job = Arr::first($jobs, fn ($job) => $job['id'] == $id);

    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

// Save Job to DB
Route::post('/jobs', function () {
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
});

Route::get('/jobs/{id}/edit', function ($id) {

    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
});

// Update Job
Route::patch('/jobs/{id}', function ($id) {
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    $job = Job::findOrFail($id);
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    return redirect('/jobs/' . $job->id);
});

// Delete Job
Route::delete('/jobs/{id}', function ($id) {

    $job = Job::findOrFail($id);
    $job->delete();

    return redirect('/jobs');
});
