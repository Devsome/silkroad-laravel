<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\Frontend\Ranking\CharacterRankingDataTable;
use App\DataTables\Frontend\Ranking\FreePvpRankingDataTable;
use App\DataTables\Frontend\Ranking\GuildsRankingDataTable;
use App\DataTables\Frontend\Ranking\HunterRankingDataTable;
use App\DataTables\Frontend\Ranking\JobPvpRankingDataTable;
use App\DataTables\Frontend\Ranking\JobRankingDataTable;
use App\DataTables\Frontend\Ranking\ThiefRankingDataTable;
use App\DataTables\Frontend\Ranking\TraderRankingDataTable;
use App\DataTables\Frontend\Ranking\UniqueRankingDataTable;
use App\Http\Controllers\Controller;

class RankingController extends Controller
{
    /**
     * @param CharacterRankingDataTable $dataTable
     * @return mixed
     */
    public function charname(CharacterRankingDataTable $dataTable)
    {
        if (config('siteSettings.char_ranking', true)) {
            return $dataTable->render('theme::frontend.ranking.index', ['mode' => config('ranking.search-charname')]);
        }
        return abort(404);
    }

    /**
     * @param GuildsRankingDataTable $dataTable
     * @return mixed
     */
    public function guild(GuildsRankingDataTable $dataTable)
    {
        if (config('siteSettings.guild_ranking', true)) {
            return $dataTable->render('theme::frontend.ranking.index', ['mode' => config('ranking.search-guild')]);
        }
        return abort(404);
    }

    /**
     * @param JobRankingDataTable $dataTable
     * @return mixed
     */
    public function job(JobRankingDataTable $dataTable)
    {
        if (config('siteSettings.job_ranking', true)) {
            return $dataTable->render('theme::frontend.ranking.index', ['mode' => config('ranking.search-job')]);
        }
        return abort(404);
    }

    /**
     * @param TraderRankingDataTable $dataTable
     * @return mixed
     */
    public function trader(TraderRankingDataTable $dataTable)
    {
        if (config('siteSettings.trader_ranking', true)) {
            return $dataTable->render('theme::frontend.ranking.index', ['mode' => config('ranking.search-trader')]);
        }
        return abort(404);
    }

    /**
     * @param HunterRankingDataTable $dataTable
     * @return mixed
     */
    public function hunter(HunterRankingDataTable $dataTable)
    {
        if (config('siteSettings.hunter_ranking', true)) {
            return $dataTable->render('theme::frontend.ranking.index', ['mode' => config('ranking.search-hunter')]);
        }
        return abort(404);
    }

    /**
     * @param ThiefRankingDataTable $dataTable
     * @return mixed
     */
    public function thief(ThiefRankingDataTable $dataTable)
    {
        if (config('siteSettings.thief_ranking', true)) {
            return $dataTable->render('theme::frontend.ranking.index', ['mode' => config('ranking.search-thief')]);
        }
        return abort(404);
    }

    /**
     * @param UniqueRankingDataTable $dataTable
     * @return mixed
     */
    public function unique(UniqueRankingDataTable $dataTable)
    {
        if (config('siteSettings.unique_ranking', true)) {
            return $dataTable->render('theme::frontend.ranking.index', ['mode' => config('ranking.search-unique')]);
        }
        return abort(404);
    }

    /**
     * @param FreePvpRankingDataTable $dataTable
     * @return mixed
     */
    public function FreePvp(FreePvpRankingDataTable $dataTable)
    {
        if (config('siteSettings.free_pvp_ranking', true)) {
            return $dataTable->render('theme::frontend.ranking.index', ['mode' => config('ranking.search-free-pvp')]);
        }
        return abort(404);
    }

    /**
     * @param JobPvpRankingDataTable $dataTable
     * @return mixed
     */
    public function JobPvp(JobPvpRankingDataTable $dataTable)
    {
        if (config('siteSettings.job_pvp_ranking', true)) {
            return $dataTable->render('theme::frontend.ranking.index', ['mode' => config('ranking.search-job-pvp')]);
        }
        return abort(404);
    }
}
