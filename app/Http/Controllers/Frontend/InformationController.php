<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\SRO\Shard\Char;
use App\Model\SRO\Shard\Guild;

class InformationController extends Controller
{
    /**
     * @param $CharName16
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function player($CharName16)
    {
        $player = Char::where('CharName16', $CharName16)
            ->with('getCharOnlineOfflineLoggedIn')
            ->with('getGuildUser')
            ->with('getAccountUser')
            ->with('getAccountUser.getTbUser')
            ->with('getAccountUser.getTbUser.getWebUser')
            ->with('getAccountUser.getSkSilk')
            ->firstOrFail();

        return view('frontend.information.player', [
            'player' => $player
        ]);
    }

    /**
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function guild($name)
    {
        $guild = Guild::where('Name', $name)->firstOrFail();

        return view('frontend.information.guild', [
            'guild' => $guild
        ]);
    }
}
