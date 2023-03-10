<?php

namespace App\Providers;

use App\HideRanking;
use App\HideRankingGuild;
use App\Http\Model\SRO\Log\UniqueKillLog;
use App\Http\Model\SRO\Shard\Char;
use Illuminate\Support\Facades\File;
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
            'theme::layouts.latestkills',
            static function ($view) {
                /** @var array $unique_names */
                /** @var array $unique_codes */
                $all_uniques = app('config')->get('unique');

                // If the unique example is not copied - Fallback
                if (File::exists(config_path() . '/unique.php')) {
                    if(isset($all_uniques['example'])){
                        unset($all_uniques['example']);
                    }
                } else{
                    $all_uniques = config('unique.example');
                }

                foreach ($all_uniques as $key => $unique) {
                    $unique_names[] = $unique['name'];
                    $unique_codes[] = $key;
                }
                //set all uniques whether it's name or code in the array.
                $uniques = array_merge($unique_names, $unique_codes);

                // check for hide ranking and add deleted_chars to it
                $hideRanking = HideRanking::all()
                    ->pluck('charname');

                $hideRankingGuild = HideRankingGuild::all()
                    ->pluck('guild_id')
                    ->diff([0]);

                $UniquesKills = UniqueKillLog::whereNotIn('CharName16', $hideRanking)
                    ->whereIn('UniqueName', $uniques)
                    ->with([
                        'getCharacter' => static function ($query) use ($hideRankingGuild) {
                            $query->whereNotIn('GuildID', $hideRankingGuild)
								->where('Deleted', false);
                        }
                    ])
                    ->with('getCharacter')
                    ->orderBy('killed_at', 'desc')
                    ->limit(10)
                    ->get();

                foreach ($UniquesKills as $key => $UniqueKill) {
                    $UniquesKills[$key]['unique_name'] = (isset($all_uniques[$UniqueKill->UniqueName]) ? $all_uniques[$UniqueKill->UniqueName]['name'] : $UniqueKill->UniqueName);
                }
                $view->with('UniqueKillsProvider', $UniquesKills);
            }
        );
    }
}
