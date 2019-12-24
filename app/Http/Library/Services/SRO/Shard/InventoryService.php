<?php

namespace App\Library\Services\SRO\Shard;
use App\Model\SRO\Shard\Inventory;

class InventoryService
{
    /**
     * @param $characterId
     * @param $slot
     * @return mixed
     */
    public function getInventorySlot($characterId, $slot)
    {
        return Inventory::where('CharID', '=', $characterId)->where('Slot', '=', $slot)->where('ItemID', '>', '0')->first();
    }
}