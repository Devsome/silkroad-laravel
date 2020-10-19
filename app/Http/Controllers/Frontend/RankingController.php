<?php

namespace App\Http\Controllers\Frontend;

use App\HideRanking;
use App\HideRankingGuild;
use App\Http\Controllers\Controller;
use App\Library\Services\SRO\Log\UniqueService;
use App\Model\SRO\Account\UniqueKillLog;
use App\Model\SRO\Shard\Char;
use App\Model\SRO\Shard\CharTrijob;
use App\Model\SRO\Shard\Guild;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    /**
     * @var UniqueService
     */
    public $uniqueService;

    /**
     * RankingController constructor.
     * @param UniqueService $uniqueService
     */
    public function __construct(UniqueService $uniqueService)
    {
        $this->uniqueService = $uniqueService;
    }

    /**
     * @param Request $request
     * @param null|string $mode
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function index(Request $request, $mode = null)
    {
        $hideRanking = HideRanking::all()
            ->pluck('charname');
        $hideRankingGuild = HideRankingGuild::all()
            ->pluck('guild_id')
            ->diff([0]);
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
            $data = view('theme::frontend.ranking.results.chars', [
                'data' => $chars,
            ])->render();
        }

        return view('theme::frontend.ranking.index', [
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
        if ($type === config('ranking.search-charname')) {
            $chars = Char::orderBy('ItemPoints', 'DESC')
                ->where('CharName16', 'like', '%' . $search . '%')
                ->whereNotIn('CharName16', $hideRanking)
                ->whereNotIn('GuildID', $hideRankingGuild)
                ->with('getGuildUser')
                ->paginate(150);
            return view('theme::frontend.ranking.results.chars', [
                'data' => $chars,
            ])->render();
        }

        if ($type === config('ranking.search-guild')) {
            $guilds = Guild::orderBy('ItemPoints', 'DESC')
                ->where('Name', 'like', '%' . $search . '%')
                ->whereNotIn('ID', $hideRankingGuild)
                ->where('ID', '!=', 0)
                ->paginate(150);
            return view('theme::frontend.ranking.results.guilds', [
                'data' => $guilds,
            ])->render();
        }

        if ($type === config('ranking.search-job')) {
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
            return view('theme::frontend.ranking.results.jobs', [
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
        if ($mode === config('ranking.search-charname')) {
            $chars = Char::orderBy('ItemPoints', 'DESC')
                ->whereNotIn('CharName16', $hideRanking)
                ->whereNotIn('GuildID', $hideRankingGuild)
                ->with('getGuildUser')
                ->paginate(150);
            return view('theme::frontend.ranking.results.chars', [
                'data' => $chars,
            ])->render();
        }

        if ($mode === config('ranking.search-guild')) {
            $guilds = Guild::orderBy('ItemPoints', 'DESC')
                ->whereNotIn('ID', $hideRankingGuild)
                ->where('ID', '!=', 0)
                ->paginate(150);
            return view('theme::frontend.ranking.results.guilds', [
                'data' => $guilds,
            ])->render();
        }

        if ($mode === config('ranking.search-trader')) {
            $jobs = CharTrijob::whereHas('getCharacter', static function ($q) use ($hideRanking, $hideRankingGuild) {
                $q->whereNotIn('CharName16', $hideRanking);
                $q->whereNotIn('GuildID', $hideRankingGuild);
            })
                ->with('getCharacter')
                ->where('JobType', 1)
                ->orderBy('Level', 'DESC')
                ->orderBy('Exp', 'DESC')
                ->paginate(150);
            return view('theme::frontend.ranking.results.jobs', [
                'data' => $jobs
            ]);
        }

        if ($mode === config('ranking.search-hunter')) {
            $jobs = CharTrijob::whereHas('getCharacter', static function ($q) use ($hideRanking, $hideRankingGuild) {
                $q->whereNotIn('CharName16', $hideRanking);
                $q->whereNotIn('GuildID', $hideRankingGuild);
            })
                ->with('getCharacter')
                ->where('JobType', 3)
                ->orderBy('Level', 'DESC')
                ->orderBy('Exp', 'DESC')
                ->paginate(150);
            return view('theme::frontend.ranking.results.jobs', [
                'data' => $jobs
            ]);
        }

        if ($mode === config('ranking.search-thief')) {
            $jobs = CharTrijob::whereHas('getCharacter', static function ($q) use ($hideRanking, $hideRankingGuild) {
                $q->whereNotIn('CharName16', $hideRanking);
                $q->whereNotIn('GuildID', $hideRankingGuild);
            })
                ->with('getCharacter')
                ->where('JobType', 2)
                ->orderBy('Level', 'DESC')
                ->orderBy('Exp', 'DESC')
                ->paginate(150);
            return view('theme::frontend.ranking.results.jobs', [
                'data' => $jobs
            ]);
        }

        if ($mode === config('ranking.search-unique')) {
            $jobs = UniqueKillLog::whereNotIn('CharName16', $hideRanking)
                ->with([
                    'getCharacter' => static function($query) use ($hideRankingGuild){
                        $query->whereNotIn('GuildID', $hideRankingGuild);
                    }
                ])
                ->with('getCharacter')
                ->paginate(50);

            $this->uniqueService->getUniquePoints(
                $jobs
            );
            return view('theme::frontend.ranking.results.unique', [
                'data' => $jobs
            ]);
        }

        if ($mode === config('ranking.search-job')) {
            $jobs = CharTrijob::whereHas('getCharacter', static function ($q) use ($hideRanking, $hideRankingGuild) {
                $q->whereNotIn('CharName16', $hideRanking);
                $q->whereNotIn('GuildID', $hideRankingGuild);
            })
                ->with('getCharacter')
                ->whereIn('JobType', [1, 2, 3])
                ->orderBy('Level', 'DESC')
                ->orderBy('Exp', 'DESC')
                ->paginate(150);
            return view('theme::frontend.ranking.results.jobs', [
                'data' => $jobs
            ]);
        }
    }
}
