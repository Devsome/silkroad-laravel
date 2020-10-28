<?php

namespace App\Providers;

use App\Http\Controllers\Frontend\SiegeFortressController;
use Illuminate\Support\ServiceProvider;

class FortressProvider extends ServiceProvider
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
            'theme::layouts.fortress',
            static function ($view) {
                $siegeFortress = new SiegeFortressController();
                $data = $siegeFortress->fetch();
                $view->with('SiegeFortressProvider', $data);
            }
        );
    }
}
