<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;

Route::get('/', [AuthController::class,'authPage'])->name('login');
Route::post('/sign-in',[AuthController::class,'signInAdmin'])->name('sign.in');
Route::get('/sign-out',[AuthController::class,'signOutAdmin'])->name('sign.out');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/home', function () {
        return view('pages.dashboard');
    })->name('dashboard');
    Route::get('/add-new-job', [JobController::class,'addJobPage']);
    Route::post('/add-job-type', [JobController::class,'addJobType'])->name('add.job.type');
    Route::post('/add-job', [JobController::class,'addNewJob'])->name('add.job');
    Route::get('/job-list', [JobController::class,'jobListPage'])->name('job.list');
    Route::get('/change-status/{slug}/{status}',[JobController::class,'changeJobStatus'])->name('change.status');
    Route::get('/view-job/{job_id}',[JobController::class,'viewJob'])->name('view.job');
    Route::post('/update-job',[JobController::class,'updateJob'])->name('update.job');
    Route::get('/applicants', [JobController::class,'applicantList'])->name('applicants');
    Route::get('/cover-letter/{applicant_id}',[JobController::class,'coverLetterView']);
    Route::get('/resume-download/{file}', [JobController::class,'downloadResume']);
});
