<?php

namespace App\Providers;

use App\Backlinks;
use App\Notification;
use Illuminate\Support\Facades\Auth;
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

        view()->composer(
            'layouts.navbar',
            static function ($view) {
                if (Auth::id()) {
                    $notificationsCount = Notification::where('user_id', Auth::user()->id)
                        ->get()->count();
                    $view->with('NotificationsCountProvider', $notificationsCount);
                }
            }
        );
    }
}
