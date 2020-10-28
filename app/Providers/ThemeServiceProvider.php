<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
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
        $getConfigThemeName = env('APP_THEME', 'default') === 'default' ?
            'views' : env('APP_THEME');

        if ($getConfigThemeName === 'views') {
            $views = resource_path('views');
        } else {
            $views = [
                resource_path('themes/' . $getConfigThemeName),
                resource_path('views')
            ];
        }

        $this->loadViewsFrom($views, 'theme');
    }
}
