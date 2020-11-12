<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Voteforsilk;
use App\VoteforsilkVoted;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoteforsilkController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = Voteforsilk::with('getVoted')
            ->get();

        return view('frontend.account.voteforsilk', [
            'data' => $data
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function voting($id)
    {
        $data = Voteforsilk::findOrFail($id);
        $url = str_replace('{TID}', \Auth::id(), $data->pingback);

        if ($this->checkVoted($data->id)) {
            VoteforsilkVoted::create([
                'voteforsilks_id' => $data->id,
                'user_id' => \Auth::id(),
                'voted_at' => Carbon::now(),
                'vote_again_at' => Carbon::now()->addHours($data->waiting_hours),
            ]);

            return \Redirect::to(
                $url,
                '307'
            );
        }

        //
        $reqIP = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'];
        // check it later

        dd('erorr');

//        return back()->with('error', 'error');
    }

    /**
     * @param $voteId
     * @return bool
     */
    private function checkVoted($voteId): bool
    {
        $voted = VoteforsilkVoted::where('user_id', \Auth::id())
            ->where('voteforsilks_id', '=', $voteId)
            ->firstOrFail();

        $isPast = Carbon::create($voted->vote_again_at)->isPast();

        if ($isPast) {
            $voted->delete();
        }

        return $isPast;
    }
}
