<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

$jobs =  [
    [
        'id' => 1,
        'title' => 'Director',
        'salary' => '$50,000'
    ],
    [
        'id' => 2,
        'title' => 'Programmer',
        'salary' => '$70,000'
    ],
    [
        'id' => 3,
        'title' => 'Teacher',
        'salary' => '$50,000'
    ],
];

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/jobs', function () use ($jobs) {
    return view('jobs', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/{id}', function ($id) use ($jobs) {

    // $job = \Illuminate\support\Arr::first($jobs, function ($job) use ($id) {
    //     return $job['id'] === $id;
    // });

    $job = Arr::first($jobs, fn ($job) => $job['id'] == $id);

    return view('job', ['job' => $job]);
});
