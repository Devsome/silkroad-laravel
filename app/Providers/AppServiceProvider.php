<?php

namespace App\Providers;

use App\Backlinks;
use App\Notification;
use App\Pages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

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
            'theme::layouts.footer',
            static function ($view) {
                $backlinks = Backlinks::all();
                $view->with('BacklinksProvider', $backlinks);
            }
        );


        view()->composer(
            'theme::layouts.navbar',
            static function ($view) {
                $notificationsCount = 0;
                if (Auth::id()) {
                    $notificationsCount = Notification::where('user_id', Auth::user()->id)
                        ->get()->count();
                }
                $view->with('NotificationsCountProvider', $notificationsCount);
            }
        );

        view()->composer(
            'theme::layouts.navbar',
            static function ($view) {
                $pagesContent = Cache::remember('pagesCache', 60 * 5, static function () {
                    return Pages::where('state', '=', Pages::PAGE_ACTIVE)->get();
                });
                $view->with('NavbarPagesProvider', $pagesContent);
            }
        );
    }
}
