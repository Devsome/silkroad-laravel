<?php

namespace App\Library\Services\SRO\Shard;
use App\Model\SRO\Shard\Char;
use Illuminate\Support\Facades\DB;

class CharService
{
    /**
     * @param $charId int
     * @return Char[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getChar($charId)
    {
        $char = Char::select('_Char.*', 'SRO_VT_PROXY.dbo._Players.cur_status' )->
        leftJoin('SRO_VT_PROXY.dbo._Players', '_Char.CharName16', '=', 'SRO_VT_PROXY.dbo._Players.CharName16')
            ->where('CharID', '=', $charId)
            ->get();
        return $char;
    }

    /**
     * @param $charId
     * @return \Illuminate\Support\Collection
     */
    public function getInventory($charId)
    {
       return DB::connection('shard')->table('_Char')
            ->select('_Char.CharID',
                '_Inventory.ItemID', '_Inventory.Slot',
                '_RefObjCommon.NameStrID128', '_RefObjCommon.AssocFileIcon128', '_RefObjCommon.ReqLevel1',
                '_Items.OptLevel',
                'SRO_VT_PROXY.dbo._ItemPoolNameCopy.RealName',
                '_RefObjCommon.CodeName128')
            ->join('_Inventory', '_Char.CharID', '=', '_Inventory.CharID')
            ->join('_Items', '_Inventory.ItemID', '=', '_Items.ID64')
            ->join('_RefObjCommon', '_Items.RefItemID', '=', '_RefObjCommon.ID')
            ->leftJoin('SRO_VT_PROXY.dbo._ItemPoolNameCopy', '_RefObjCommon.NameStrID128', '=',
                DB::raw('SRO_VT_PROXY.dbo._ItemPoolNameCopy.CodeName collate SQL_Latin1_General_CP1_CI_AS'))
            ->where('_Char.CharID', '=', $charId)
            ->whereBetween('_Inventory.Slot', [0, 12])
            ->where('_Items.RefItemID', '!=', 2)
            ->where('_Inventory.Slot', '!=', 8)
            ->orderBy('_Inventory.Slot', 'ASC')
            ->get()
           ->map(function ($item) {
               $item->AssocFileIcon128 = str_replace('ddj', 'PNG', $item->AssocFileIcon128);
               return $item;
           })
           ->map(function ($item) {
               $item->AssocFileIcon128 = str_replace('\\', '/', $item->AssocFileIcon128);
               return $item;
           });
    }

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