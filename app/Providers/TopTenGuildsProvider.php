<?php

namespace App\Providers;

use App\HideRankingGuild;
use App\Http\Model\SRO\Shard\Guild;
use Illuminate\Support\ServiceProvider;

class TopTenGuildsProvider extends ServiceProvider
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
                // get hide guild rank
                $hideRankingGuild = HideRankingGuild::all()
                    ->pluck('guild_id')
                    ->diff([0]);

                // get pvp kills (Free PVP Only)
                $guilds = Guild::orderBy('ItemPoints', 'DESC')
                    ->whereNotIn('ID', $hideRankingGuild)
                    ->where('ID', '!=', 0)
                    ->limit(10)
                    ->get();

                $view->with('TopTenGuildsProvider', $guilds);
            }
        );
    }
}
