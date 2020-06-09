<?php

namespace App\Providers;

use App\Backlinks;
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
        view()->composer(
            'layouts.footer',
            static function ($view) {
                $backlinks = Backlinks::all();
                $view->with('BacklinksProvider', $backlinks);
            }
        );
    }
}
