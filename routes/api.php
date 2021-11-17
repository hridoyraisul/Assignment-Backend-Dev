<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/all-active-jobs', [JobController::class,'getAllActiveJob']);
Route::get('/view-single-job/{job_id}', [JobController::class,'singleJobView']);
Route::post('/sign-up-user',[AuthController::class,'userSignUp']);
Route::post('/sign-in-user',[AuthController::class,'userSignIn']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/apply-job',[JobController::class,'applyJob']);
});
