<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Model\SRO\Shard\SiegeFortress;
use Illuminate\Support\Facades\Cache;

class SiegeFortressController extends Controller
{
    public function fetch()
    {
        $oneDay = 86400;
        $fortressMapping = [
            1 => __('sidebar.fortress.jangan'),
            3 => __('sidebar.fortress.hotan'),
            6 => __('sidebar.fortress.bandit')
        ];

        // @ToDo put the Fortress war timer here, so after Fortress war caching new Guilds.
        $fortress = Cache::remember('siegeFortress', $oneDay * 1, static function () use ($fortressMapping) {
            return SiegeFortress::whereNotNull('GuildID')
                ->with('getGuildName')
                ->get()
                ->map(static function ($data) use ($fortressMapping) {
                    $data->FortressName = __('sidebar.fortress.unknown');
                    if (array_key_exists($data->FortressID, $fortressMapping)) {
                        $data->FortressName = $fortressMapping[$data->FortressID];

                        if ($data->FortressID === 1) {
                            $data->FortressImage = asset('image/icon/etc/fort_jangan.PNG');
                        }
                        if ($data->FortressID === 3) {
                            $data->FortressImage = asset('image/icon/etc/fort_hotan.PNG');
                        }
                        if ($data->FortressID === 6) {
                            $data->FortressImage = asset('image/icon/etc/fort_donwhang.PNG');
                        }
                    }
                    return $data;
                });
        });

        return $fortress;
    }
}
