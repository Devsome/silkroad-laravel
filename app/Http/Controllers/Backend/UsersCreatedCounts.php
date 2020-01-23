<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class UsersCreatedCounts extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $start = new Carbon('first day of this month');
        $start = $start->startOfMonth();
        $end = new Carbon('last day of this month');
        $end = $end->endOfMonth();
        $endDate = $end->daysInMonth;

        $firstDayCached = \App\UsersCreatedCounts::whereBetween('cached_at', [$start, $end])->orderBy('cached_at', 'ASC')->pluck('cached_at')->first();

        return view('backend.logging.users', [
            'users' => \App\UsersCreatedCounts::whereBetween('cached_at', [$start, $end])->orderBy('cached_at', 'ASC')->get(),
            'firstDate' => $firstDayCached ? Carbon::parse($firstDayCached)->day : 1,
            'endDate' => $endDate
        ]);
    }
}
