<?php

namespace App\Providers;

use App\Http\Controllers\Frontend\JobRankingController;
use Illuminate\Support\ServiceProvider;

class JobRankingProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'theme::layouts.jobranking',
            static function ($view) {
                $jobRankingController = new JobRankingController();
                $data = $jobRankingController->fetch();
                $view->with('JobRankingProvider', $data);
            }
        );
    }
}
