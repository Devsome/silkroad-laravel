<?php

namespace App\Providers;

use App\Http\Controllers\Frontend\DiscordController;
use Illuminate\Support\ServiceProvider;

class DiscordProvider extends ServiceProvider
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
            'layouts.discord',
            function ($view) {
                $discord = new DiscordController;
                $data = $discord->fetch();
                $view->with('DiscordProvider', $data);
            }
        );
    }
}
