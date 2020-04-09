<?php

namespace App\Http\Controllers\Frontend;

use App\HideRanking;
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
        $search = $request->get('search');
        $type = $request->get('type');

        if ($mode !== null) {
            $data = $this->mode(
                $mode,
                $hideRanking
            );
        } else if ($search && $type) {
            $data = $this->searching(
                $type,
                $search,
                $hideRanking
            );
        } else {
            $chars = Char::orderBy('ItemPoints', 'DESC')
                ->whereNotIn('CharName16', $hideRanking)
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
     * @return array|void
     * @throws \Throwable
     */
    private function searching($type, $search, $hideRanking)
    {
        if ($type === __('ranking.search.search-charname')) {
            $chars = Char::orderBy('ItemPoints', 'DESC')
                ->where('CharName16', 'like', '%' . $search . '%')
                ->whereNotIn('CharName16', $hideRanking)
                ->with('getGuildUser')
                ->paginate(150);
            return view('frontend.ranking.results.chars', [
                'data' => $chars,
            ])->render();
        }

        if ($type === __('ranking.search.search-guild')) {
            $guilds = Guild::orderBy('ItemPoints', 'DESC')
                ->where('Name', 'like', '%' . $search . '%')
                ->paginate(150);
            return view('frontend.ranking.results.guilds', [
                'data' => $guilds,
            ])->render();
        }

        if ($type === __('ranking.search.search-job')) {
            $jobs = CharTrijob::whereHas('getCharacter', function ($q) use ($search, $hideRanking) {
                $q->where('NickName16', 'like', '%' . $search . '%');
                $q->whereNotIn('CharName16', $hideRanking);
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

    /**
     * @param $mode
     * @param $hideRanking
     * @return void|array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     * @throws \Throwable
     */
    private function mode($mode, $hideRanking)
    {
        if ($mode === __('ranking.search.search-charname')) {
            $chars = Char::orderBy('ItemPoints', 'DESC')
                ->whereNotIn('CharName16', $hideRanking)
                ->with('getGuildUser')
                ->paginate(150);
            return view('frontend.ranking.results.chars', [
                'data' => $chars,
            ])->render();
        }

        if ($mode === __('ranking.search.search-guild')) {
            $guilds = Guild::orderBy('ItemPoints', 'DESC')
                ->paginate(150);
            return view('frontend.ranking.results.guilds', [
                'data' => $guilds,
            ])->render();
        }

        if ($mode === __('ranking.search.search-job')) {
            $jobs = CharTrijob::whereHas('getCharacter', function ($q) use ($hideRanking) {
                $q->whereNotIn('CharName16', $hideRanking);
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
