<?php

namespace App\Providers;

use App\Http\Model\SRO\Log\OnlineOfflineLog;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class PlayerCountProvider extends ServiceProvider
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
            'theme::*',
            static function ($view) {
                $playerCount = Cache::remember('playerCount', 60 * 5, static function () {
                    return OnlineOfflineLog::where('status', '!=', OnlineOfflineLog::STATUS_LOGGED_OUT)->count();
                });
                $data = [
                    'count' => $playerCount
                ];
                $view->with('PlayerCountProvider', $data);
            }
        );
    }
}
