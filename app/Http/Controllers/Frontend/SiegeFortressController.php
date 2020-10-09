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
            6 => __('sidebar.fortress.bandit'),
            9 => __('sidebar.fortress.constantinople'),
        ];
        $siteSettings = config('siteSettings');

        // @ToDo put the Fortress war timer here, so after Fortress war caching new Guilds.
        $fortress = Cache::remember('siegeFortress', $oneDay * 1, static function () use ($fortressMapping, $siteSettings) {
            return SiegeFortress::whereNotNull('GuildID')
                ->with('getGuildName')
                ->get()
                ->map(static function ($data) use ($fortressMapping, $siteSettings) {
                    $data->FortressName = __('sidebar.fortress.unknown');
                    if (array_key_exists($data->FortressID, $fortressMapping)) {
                        $data->FortressName = $fortressMapping[$data->FortressID];

                        if($siteSettings) {
                            foreach ($siteSettings as $key => $val) {
                                if ($val && stripos($key, $data->FortressName) !== false) {
                                    return [];
                                }
                            }
                        }
                        if ($data->FortressID === 1) {
                            $data->FortressImage = asset('image/sro/etc/fort_jangan.jpg');
                        }
                        if ($data->FortressID === 3) {
                            $data->FortressImage = asset('image/sro/etc/fort_hotan.jpg');
                        }
                        if ($data->FortressID === 6) {
                            $data->FortressImage = asset('image/sro/etc/fort_bijeokdan.jpg');
                        }
                        if ($data->FortressID === 4) {
                            $data->FortressImage = asset('image/sro/etc/fort_constantinople.jpg');
                        }
                    }
                    return $data;
                });
        });
        return $fortress->filter()->all();
    }
}
