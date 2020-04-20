<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\SRO\Shard\CharTrijob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class JobRankingController extends Controller
{
    public function fetch()
    {
        $oneDay = 86400;
        $jobMapping = [
            0 => __('sidebar.job-ranking.less'),
            1 => __('sidebar.job-ranking.trader'),
            2 => __('sidebar.job-ranking.thief'),
            3 => __('sidebar.job-ranking.hunter')
        ];

        $countTrader = Cache::remember('charTriJob', $oneDay * 1, static function () use ($jobMapping) {
            return CharTrijob::select(DB::raw('count(*) as job_count, JobType'))
                ->groupBy('JobType')->get()
                ->map(static function ($data) use ($jobMapping) {
                    if (array_key_exists($data->JobType, $jobMapping)) {
                        return [
                            'JobType' => $data->JobType,
                            'JobName' => $jobMapping[$data->JobType],
                            'JobCount' => $data->job_count
                        ];
                    }
                });
        });

        return $countTrader;
    }
}
