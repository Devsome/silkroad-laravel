<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Model\SRO\Account\SkSilk;
use App\Voteforsilk;
use App\VoteforsilkVoted;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoteforsilkController extends Controller
{

    /**
     * Whitelist ips from that voting sites
     * @var array
     */
    private $whitelist = [
        '199.59.161.214' => 'xtremetop100',
        '184.154.46.76' => 'arena-top100',
        '198.148.82.98' => 'gtop100',
        '198.148.82.99' => 'gtop100',
        '116.203.217.217' => 'silkroad-servers',
        '116.203.205.23' => 'private-server',
        '192.99.101.31' => 'topg',
        '104.24.8.79' => 'top100arena',
        '209.59.143.11' => 'top100arena',
        '185.176.40.63' => 'gamestop100',
        '50.51.52.1' => 'test'
    ];

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = Voteforsilk::with('getVoted')
            ->get();

        return view('theme::frontend.account.voteforsilk', [
            'data' => $data
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function voting($id): \Illuminate\Http\RedirectResponse
    {
        $data = Voteforsilk::findOrFail($id);
        $url = str_replace('{JID}', \Auth::user()->jid, $data->pingback);

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

        return back()->with('error', 'error');
    }

    /**
     * IPN for that Voting sites, called from api route
     * @param Request $request
     */
    public function pingback(Request $request): void
    {
        $requestMethod = null;
        switch ($request->method()) {
            case 'GET':
                $requestMethod = &$_GET;
                break;

            case 'POST':
                $requestMethod = &$_POST;
                break;
        }

        //store requesting IP in a variable | compatibility with CloudFlare
        $votingIp = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'];

        if (!array_key_exists($votingIp, $this->whitelist)) {
            echo 'Using wrong ip from that Server: ' . $votingIp;
            return;
        }

        $result = $this->checkVotePingback($requestMethod, $votingIp);
        // log $result
        echo $result;
    }

    /**
     * @param $jid
     * @param $ip
     * @return bool
     */
    private function doReward($jid, $ip): bool
    {
        $voteReward = Voteforsilk::where('ip', '=', $ip)
            ->firstOrFail();

        SkSilk::where('JID', $jid)
            ->increment(
                'silk_own',
                $voteReward->reward
            );
        return true;
    }

    /**
     * Checking the IPN ip and reward the player
     * @param $request
     * @param $ip
     * @return string
     */
    private function checkVotePingback($request, $ip): string
    {
        switch ($ip) {
            case '199.59.161.214': //xtremetop100
                $result = $this->doReward($request['custom'], $ip);
                break;
            case '198.148.82.98': //gtop100
            case '198.148.82.99': //gtop100
                if (abs($request['Successful']) === 0) {
                    $result = $this->doReward($request['pingUsername'], $ip);
                } else {
                    $result = $request['Reason'];
                }
                break;
            case '192.99.101.31': //topg
                $result = $this->doReward($request['p_resp'], $ip);
                break;

            case '104.24.8.79': //top100arena
            case '209.59.143.11': //top100arena
                $result = $this->doReward($request['postback'], $ip);
                break;
            case '184.154.46.76': //arena-top100
                if ($request['voted'] === 1) {
                    $result = $this->doReward($request['userid'], $ip);
                } else {
                    $result = 'User ' . $request['userid'] . ' voted already today!' . PHP_EOL;
                }
                break;
            case '193.70.3.149': //silkroad-servers
                if ($request['voted'] === 1) {
                    $result = $this->doReward($request['userid'], $ip);
                } else {
                    $result = 'User ' . $request['userid'] . ' voted already today!' . PHP_EOL;
                }
                break;
            case '79.137.80.26': //private-server
                if ($request['voted'] === 1) {
                    $result = $this->doReward($request['userid'], $ip);
                } else {
                    $result = 'User ' . $request['userid'] . ' voted already today!' . PHP_EOL;
                }
                break;

            case '185.176.40.63': //gamestop100
                $result = $this->doReward($request['custom'], $ip);
                break;
            case '50.51.52.1':
                $result = $this->doReward($request['userid'], $ip);
                break;
            default:
                $result = 'Wrong IP called!';
                break;
        }
        return $result;
    }

    /**
     * @param $voteId
     * @return bool
     */
    private function checkVoted($voteId): bool
    {
        $voted = VoteforsilkVoted::where('user_id', \Auth::id())
            ->where('voteforsilks_id', '=', $voteId)
            ->first();

        if (!$voted) {
            return true;
        }

        $isPast = Carbon::create($voted->vote_again_at)->isPast();

        if ($isPast) {
            $voted->delete();
        }

        return $isPast;
    }
}
