<?php

namespace App\Http\Controllers;

use App\HideRanking;
use App\Model\SRO\Shard\Char;
use App\Model\SRO\Shard\Guild;
use Illuminate\Http\Request;
use Validator;

class RankingController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $hideRanking = HideRanking::all()->pluck('charname');

        $users = Char::orderBy('ItemPoints', 'DESC')
            ->whereNotIn('CharName16', $hideRanking)
            ->with('getGuildUser')->take(150)->get();

        return view('frontend.ranking.index', [
            'data' => $users
        ]);
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search-term' => 'required|min:1|max:80',
            'search-for' => 'required'
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'errors' => $validator->errors()
            ];
        }

        if ($request->get('search-for') === __('ranking.search.search-charname')) {
            $hideRanking = HideRanking::all()->pluck('charname');

            $users = Char::orderBy('ItemPoints', 'DESC')
                ->where('CharName16', 'like', '%' . $request->get('search-term') . '%')
                ->whereNotIn('CharName16', $hideRanking)
                ->with('getGuildUser')->take(50)->get();

            return [
                'success' => true,
                'html' => view('frontend.ranking.results.chars', [
                    'data' => $users,
                ])->render()
            ];
        }

        if ($request->get('search-for') === __('ranking.search.search-guild')) {
            $guilds = Guild::orderBy('ItemPoints', 'DESC')
                ->where('Name', 'like', '%' . $request->get('search-term') . '%')
                ->take(50)->get();

            return [
                'success' => true,
                'html' => view('frontend.ranking.results.guilds', [
                    'data' => $guilds
                ])->render()
            ];
        }

        if ($request->get('search-for') === __('ranking.search.search-job')) {
            // TODO: Add job Ranking System
            //
            // Create a job integration for that ranking search.
            // Maybe all together or hunter, trader and thiefs separated
            //
            // Need's to be done asap
        }

        return [
            'success' => false,
        ];
    }
}
