<?php

namespace App\Providers;

use App\Backlinks;
use App\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

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
        if (!Session::has('locale')) {
            Session::put('locale', 'en');
        }

        view()->composer(
            'theme::*',
            static function ($view) {
                $backlinks = Backlinks::all();
                $view->with('BacklinksProvider', $backlinks);
            }
        );


        view()->composer(
            'theme::*',
            static function ($view) {
                $notificationsCount = 0;
                if (Auth::id()) {
                    $notificationsCount = Notification::where('user_id', Auth::user()->id)
                        ->get()->count();
                }
                $view->with('NotificationsCountProvider', $notificationsCount);
            }
        );

    }
}
