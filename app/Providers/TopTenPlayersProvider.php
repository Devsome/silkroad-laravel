<?php

namespace App\Providers;

use App\HideRanking;
use App\HideRankingGuild;
use App\Http\Model\SRO\Shard\Char;
use Illuminate\Support\ServiceProvider;

class TopTenPlayersProvider extends ServiceProvider
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
            'theme::layouts.toptenplayers',
            static function ($view) {
                // check for hide ranking and add deleted_chars to it
                $hideRanking = HideRanking::all()
                    ->pluck('charname');

                // get hide guild rank
                $hideRankingGuild = HideRankingGuild::all()
                    ->pluck('guild_id')
                    ->diff([0]);

                // get pvp kills (Free PVP Only)
                $chars = Char::orderBy('ItemPoints', 'DESC')
					->where('Deleted', false)
                    ->whereNotIn('CharName16', $hideRanking)
                    ->whereNotIn('GuildID', $hideRankingGuild)
                    ->with('getGuildUser')
                    ->limit(10)
                    ->get();
                $view->with('TopTenPlayersProvider', $chars);
            }
        );
    }
}
