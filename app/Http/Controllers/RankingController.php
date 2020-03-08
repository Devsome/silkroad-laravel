<?php

namespace App\Http\Controllers;

use App\HideRanking;
use App\Model\SRO\Shard\Char;
use Illuminate\Http\Request;

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
            ->with('getGuildUser')->paginate(50);

        return view('frontend.ranking.index', [
            'users' => $users
        ]);
    }
}
