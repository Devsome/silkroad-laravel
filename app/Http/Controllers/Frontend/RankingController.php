<?php

namespace App\Http\Controllers\Frontend;

use App\HideRanking;
use App\HideRankingGuild;
use App\Http\Controllers\Controller;
use App\Model\SRO\Shard\Char;
use App\Model\SRO\Shard\CharTrijob;
use App\Model\SRO\Shard\Guild;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    /**
     * @param Request $request
     * @param null|string $mode
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Request $request, $mode = null)
    {
        $hideRanking = HideRanking::all()->pluck('charname');
        $hideRankingGuild = HideRankingGuild::all()->pluck('guild_id');
        $search = $request->get('search');
        $type = $request->get('type');

        if ($mode !== null) {
            $data = $this->mode(
                $mode,
                $hideRanking,
                $hideRankingGuild
            );
        } else if ($search && $type) {
            $data = $this->searching(
                $type,
                $search,
                $hideRanking,
                $hideRankingGuild
            );
        } else {
            $chars = Char::orderBy('ItemPoints', 'DESC')
                ->whereNotIn('CharName16', $hideRanking)
                ->whereNotIn('GuildID', $hideRankingGuild)
                ->with('getGuildUser')
                ->paginate(150);
            $data = view('frontend.ranking.results.chars', [
                'data' => $chars,
            ])->render();
        }

        return view('frontend.ranking.index', [
            'data' => $data,
            'mode' => $mode
        ]);
    }

    /**
     * @param $type
     * @param $search
     * @param $hideRanking
     * @param $hideRankingGuild
     * @return array|void
     */
    private function searching($type, $search, $hideRanking, $hideRankingGuild)
    {
        if ($type === __('ranking.search.search-charname')) {
            $chars = Char::orderBy('ItemPoints', 'DESC')
                ->where('CharName16', 'like', '%' . $search . '%')
                ->whereNotIn('CharName16', $hideRanking)
                ->whereNotIn('GuildID', $hideRankingGuild)
                ->with('getGuildUser')
                ->paginate(150);
            return view('frontend.ranking.results.chars', [
                'data' => $chars,
            ])->render();
        }

        if ($type === __('ranking.search.search-guild')) {
            $guilds = Guild::orderBy('ItemPoints', 'DESC')
                ->where('Name', 'like', '%' . $search . '%')
                ->whereNotIn('ID', $hideRankingGuild)
                ->paginate(150);
            return view('frontend.ranking.results.guilds', [
                'data' => $guilds,
            ])->render();
        }

        if ($type === __('ranking.search.search-job')) {
            $jobs = CharTrijob::whereHas('getCharacter', static function ($q) use ($search, $hideRanking, $hideRankingGuild) {
                $q->where('NickName16', 'like', '%' . $search . '%');
                $q->whereNotIn('CharName16', $hideRanking);
                $q->whereNotIn('GuildID', $hideRankingGuild);
            })
                ->with('getCharacter')
                ->whereIn('JobType', [1, 2, 3])
                ->orderBy('Level', 'DESC')
                ->orderBy('Exp', 'DESC')
                ->paginate(150);
            return view('frontend.ranking.results.jobs', [
                'data' => $jobs
            ])->render();
        }
    }

    /**
     * @param $mode
     * @param $hideRanking
     * @param $hideRankingGuild
     * @return void|array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    private function mode($mode, $hideRanking, $hideRankingGuild)
    {
        if ($mode === __('ranking.search.search-charname')) {
            $chars = Char::orderBy('ItemPoints', 'DESC')
                ->whereNotIn('CharName16', $hideRanking)
                ->whereNotIn('GuildID', $hideRankingGuild)
                ->with('getGuildUser')
                ->paginate(150);
            return view('frontend.ranking.results.chars', [
                'data' => $chars,
            ])->render();
        }

        if ($mode === __('ranking.search.search-guild')) {
            $guilds = Guild::orderBy('ItemPoints', 'DESC')
                ->whereNotIn('ID', $hideRankingGuild)
                ->paginate(150);
            return view('frontend.ranking.results.guilds', [
                'data' => $guilds,
            ])->render();
        }

        if ($mode === __('ranking.search.search-trader')) {
            $jobs = CharTrijob::whereHas('getCharacter', static function ($q) use ($hideRanking, $hideRankingGuild) {
                $q->whereNotIn('CharName16', $hideRanking);
                $q->whereNotIn('GuildID', $hideRankingGuild);
            })
                ->with('getCharacter')
                ->where('JobType', 1)
                ->orderBy('Level', 'DESC')
                ->orderBy('Exp', 'DESC')
                ->paginate(150);
            return view('frontend.ranking.results.jobs', [
                'data' => $jobs
            ]);
        }

        if ($mode === __('ranking.search.search-hunter')) {
            $jobs = CharTrijob::whereHas('getCharacter', static function ($q) use ($hideRanking, $hideRankingGuild) {
                $q->whereNotIn('CharName16', $hideRanking);
                $q->whereNotIn('GuildID', $hideRankingGuild);
            })
                ->with('getCharacter')
                ->where('JobType', 3)
                ->orderBy('Level', 'DESC')
                ->orderBy('Exp', 'DESC')
                ->paginate(150);
            return view('frontend.ranking.results.jobs', [
                'data' => $jobs
            ]);
        }

        if ($mode === __('ranking.search.search-thief')) {
            $jobs = CharTrijob::whereHas('getCharacter', static function ($q) use ($hideRanking, $hideRankingGuild) {
                $q->whereNotIn('CharName16', $hideRanking);
                $q->whereNotIn('GuildID', $hideRankingGuild);
            })
                ->with('getCharacter')
                ->where('JobType', 2)
                ->orderBy('Level', 'DESC')
                ->orderBy('Exp', 'DESC')
                ->paginate(150);
            return view('frontend.ranking.results.jobs', [
                'data' => $jobs
            ]);
        }

        if ($mode === __('ranking.search.search-job')) {
            $jobs = CharTrijob::whereHas('getCharacter', static function ($q) use ($hideRanking, $hideRankingGuild) {
                $q->whereNotIn('CharName16', $hideRanking);
                $q->whereNotIn('GuildID', $hideRankingGuild);
            })
                ->with('getCharacter')
                ->whereIn('JobType', [1, 2, 3])
                ->orderBy('Level', 'DESC')
                ->orderBy('Exp', 'DESC')
                ->paginate(150);
            return view('frontend.ranking.results.jobs', [
                'data' => $jobs
            ]);
        }
    }
}
