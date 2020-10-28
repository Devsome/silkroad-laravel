<?php

namespace App\Providers;

use App\HideRanking;
use App\HideRankingGuild;
use App\Http\Model\SRO\Log\UniqueKillLog;
use App\Http\Model\SRO\Shard\Char;
use Illuminate\Support\ServiceProvider;

class LatestUniqueKillsProvider extends ServiceProvider
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
                /** @var array $uniques */
                $all_uniques = app('config')->get('unique');
                foreach ($all_uniques as $key => $unique) {
                    $uniques[] = $key;
                }

                //check for deleted Characters
                $deleted_chars = Char::where('Deleted', true)
                    ->pluck('CharName16');
                // check for hide ranking and add deleted_chars to it
                $hideRanking = HideRanking::all()
                    ->pluck('charname')
                    ->union($deleted_chars);

                $hideRankingGuild = HideRankingGuild::all()
                    ->pluck('guild_id')
                    ->diff([0]);

                $UniquesKills = UniqueKillLog::whereNotIn('CharName16', $hideRanking)
                    ->whereIn('UniqueName', $uniques)
                    ->with([
                        'getCharacter' => static function ($query) use ($hideRankingGuild) {
                            $query->whereNotIn('GuildID', $hideRankingGuild);
                        }
                    ])
                    ->with('getCharacter')
                    ->orderBy('killed_at', 'desc')
                    ->limit(10)
                    ->get();

                foreach ($UniquesKills as $key => $UniqueKill) {
                    $UniquesKills[$key]['unique_name'] = $all_uniques[$UniqueKill->UniqueName]['name'];
                }
                $view->with('UniqueKillsProvider', $UniquesKills);
            }
        );
    }
}
