<?php

namespace App\Providers;

use App\Models\Applicants;
use App\Models\JobSchema;
use App\Models\JobType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view){
            $view->with('applicantsCount', Applicants::all()->count());
            $view->with('jobPostCount',JobSchema::all()->count());
            $view->with('userCount',User::all()->whereNotIn('id', Auth::id())->count());
            $view->with('positionsCount',JobType::all()->count());
        });
    }
}
