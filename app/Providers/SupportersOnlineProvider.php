<?php

namespace App\Providers;

use App\Model\SRO\Account\OnlineOfflineLog;
use App\SupportersOnline;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class SupportersOnlineProvider extends ServiceProvider
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
            'layouts.supportersonline',
            static function ($view) {
                $supportersOnline = Cache::remember('supportersOnline', 60 * 1, static function () {
                    return SupportersOnline::with('getCharOnlineOffline')
                        ->get();
                });
                $view->with('SupportersOnlineProvider', $supportersOnline);
            }
        );
    }
}
