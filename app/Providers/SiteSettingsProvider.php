<?php

namespace App\Providers;

use App\SiteSettings;
use Illuminate\Support\ServiceProvider;

class SiteSettingsProvider extends ServiceProvider
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
        $siteSettings = SiteSettings::first();
        if (!empty($siteSettings)) {
            foreach($siteSettings->settings as $key => $value)
            {
                config([
                    'siteSettings.' . $key => $value
                ]);
            }
        }
    }
}
