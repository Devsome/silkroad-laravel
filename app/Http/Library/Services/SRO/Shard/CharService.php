<?php

namespace App\Http\Library\Services\SRO\Shard;

use App\Http\Model\SRO\Shard\Char;

class CharService
{

    /**
     * @param $charID
     * @return mixed
     */
    public function setCharUnstuckNewPosition($charID)
    {
        return Char::where('CharID', '=', $charID)
            ->update(['LatestRegion' => '25000',
                'PosX' => '969',
                'PosY' => '0',
                'PosZ' => '1369',
                'AppointedTeleport' => '2094',
                'TelPosX' => '0',
                'TelPosY' => '0',
                'TelPosZ' => '0',
                'DiedPosX' => '0',
                'DiedPosY' => '0',
                'DiedPosZ' => '0',
                'WorldID' => '1',
                'TelWorldID' => '1',
                'DiedWorldID' => '1']);
    }
}
