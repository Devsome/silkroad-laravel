<?php

namespace App\Providers;

use App\Library\Services\TimersService;
use Illuminate\Support\ServiceProvider;

class TimersProvider extends ServiceProvider
{
    /**
     * @var TimersService
     */
    protected $timersService;

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
        $this->timersService = new TimersService(
            app('config')->get('timers')
        );

        $data = [
            'timer' => $this->timersService->getTimer(),
        ];

        view()->composer(
            'layouts.timers',
            static function ($view) use ($data) {
                $view->with('TimersProvider', $data);
            }
        );
    }
}
