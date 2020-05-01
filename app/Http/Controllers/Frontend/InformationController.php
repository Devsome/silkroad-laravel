<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\Services\SRO\Shard\InventoryService;
use App\Model\SRO\Shard\Char;
use App\Model\SRO\Shard\Guild;

class InformationController extends Controller
{
    /**
     * @param $CharName16
     * @param InventoryService $inventoryService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function player(
        $CharName16,
        InventoryService $inventoryService
    )
    {
        $player = Char::where('CharName16', $CharName16)
            ->with('getCharOnlineOfflineLoggedIn')
            ->with('getGuildUser')
            ->with('getAccountUser')
            ->with('getAccountUser.getTbUser')
            ->with('getAccountUser.getTbUser.getWebUser')
            ->with('getAccountUser.getSkSilk')
            ->firstOrFail();

        $playerInventory = $inventoryService->getInventorySet(
            $player->CharID,
            13,
            0
        );

        $playerAvatar = $inventoryService->getInventoryAvatar(
            $player->CharID
        );

        $jobItem = $inventoryService->getInventorySlot($player->CharID, 8);

        return view('frontend.information.player', [
            'player' => $player,
            'playerInventory' => $playerInventory,
            'playerAvatar' => $playerAvatar,
            'playerUnderJob' => $jobItem ? false : true
        ]);
    }

    /**
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function guild($name)
    {
        $guild = Guild::where('Name', $name)
            ->with('getGuildMembers')
            ->with('getGuildMembers.getCharItemPoints')
            ->firstOrFail();

        return view('frontend.information.guild', [
            'guild' => $guild
        ]);
    }
}
