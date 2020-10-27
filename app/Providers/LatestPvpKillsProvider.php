<?php

namespace App\Providers;

use App\HideRanking;
use App\HideRankingGuild;
use App\Model\SRO\Log\PvpRecordsLog;
use Illuminate\Support\ServiceProvider;

class LatestPvpKillsProvider extends ServiceProvider
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
            'theme::layouts.sidebar',
            static function ($view) {

                // get hide rank
                $hideRanking = HideRanking::all()
                    ->pluck('charname');

                // get hide guild rank
                $hideRankingGuild = HideRankingGuild::all()
                    ->pluck('guild_id')
                    ->diff([0]);

                // get pvp kills (Free PVP Only)
                $pvp_kills = PvpRecordsLog::whereType(0)
                    ->whereNotIn('CharName', $hideRanking)
                    ->whereNotIn('KilledCharName', $hideRanking)
                    ->with([
                        'getKillerCharacter' => static function ($query) use ($hideRankingGuild) {
                            $query->whereNotIn('GuildID', $hideRankingGuild);
                        }
                    ])
                    ->with([
                        'getKilledCharacter' => static function ($query) use ($hideRankingGuild) {
                            $query->whereNotIn('GuildID', $hideRankingGuild);
                        }
                    ])
                    ->select('CharName', 'KilledCharName', 'killed_at')
                    ->orderBy('killed_at', 'desc')
                    ->limit(10)
                    ->get();
                $view->with('PvpRecordsProvider', $pvp_kills);
            }
        );
    }
}
