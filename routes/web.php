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

Route::get('/jobs', function () {
    $jobs = Job::with('employer')->paginate(3);
    // $jobs = Job::with('employer')->cursorPaginate(3);
    // $jobs = Job::with('employer')->simplePaginate(3);

    return view('jobs', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/{id}', function ($id) {

    // $job = \Illuminate\support\Arr::first($jobs, function ($job) use ($id) {
    //     return $job['id'] === $id;
    // });

    // $job = Arr::first($jobs, fn ($job) => $job['id'] == $id);

    $job = Job::find($id);

    return view('job', ['job' => $job]);
});
