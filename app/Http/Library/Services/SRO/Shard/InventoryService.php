<?php

namespace App\Http\Library\Services\SRO\Shard;

use App\Http\Model\SRO\Shard\CharCos;
use App\Http\Model\SRO\Shard\ItemPoolName;
use App\Http\Model\SRO\Shard\MagOpt;
use App\Model\Frontend\CharInventory;
use App\Http\Model\SRO\Shard\Inventory;
use App\Http\Model\SRO\Shard\InventoryForAvatar;
use App\Http\Model\SRO\Shard\Items;
use Illuminate\Support\Facades\Cache;

class InventoryService
{

    const WEAPON = 6;
    const SHIELD = 4;
    const ACC = 5;
    const SET = 1;

    /**
     * @param $characterId
     * @param $slot
     * @return mixed
     */
    public function getInventorySlot($characterId, $slot)
    {
        return Inventory::where('CharID', '=', $characterId)
            ->where('Slot', '=', $slot)
            ->where('ItemID', '>', '0')
            ->first();
    }

    /**
     * Counting all that Server sox parts
     * @param null $filter
     * @return array
     */
    public function getServerSoxCount($filter = null): array
    {
        $soxMapping = [
            '_A_' => 'Seal of Star',
            '_B_' => 'Seal of Moon',
            '_C_' => 'Seal of Sun'
        ];

        $soxCount = [
            '_A_' => 0,
            '_B_' => 0,
            '_C_' => 0
        ];

        $items = Items::join('_RefObjCommon as Common', static function ($join) use ($filter) {
            $join->on('Common.ID', 'RefItemID');
            if ($filter) {
                $join->where('Common.CodeName128', 'like', 'ITEM_%' . $filter . '_%_RARE');
            } else {
                $join->where('Common.CodeName128', 'like', 'ITEM_%_RARE');
            }
        })->get();

        foreach ($items as $item) {
            foreach ($soxMapping as $key => $itemTest) {
                if (preg_match('/' . $key . '/', $item->CodeName128)) {
                    $test[$key] = ++$soxCount[$key];
                }
            }
        }

        return $soxCount;
    }

    /**
     * Returning stats for the sox filter - Server
     * @param null $filter
     * @return mixed
     */
    public function getServerSoxFilter($filter = null)
    {
        if ($filter === '0') {
            $filter = 0;
        } elseif (strlen($filter) === 1) {
            $filter = '0' . $filter;
        }

        $getWebInventoryItemId64 = CharInventory::all()->pluck('item_id64');

        $items = Items::join('_RefObjCommon as Common', static function ($join) use ($filter) {
            $join->on('Common.ID', 'RefItemID');
            if ($filter) {
                $join->where('Common.CodeName128', 'like', 'ITEM_%' . $filter . '_%_RARE');
            } else {
                $join->where('Common.CodeName128', 'like', 'ITEM_%_RARE');
            }
        })
            ->join('_RefObjItem as ObjItem', 'Common.Link', 'ObjItem.ID')
            ->leftJoin('_BindingOptionWithItem as Binding', static function ($join) {
                $join->on('Binding.nItemDBID', 'ID64');
                $join->where('Binding.nOptValue', '>', '0');
            })
            ->leftJoin('_Inventory as Inventory', '_Items.ID64', 'Inventory.ItemID')
            ->leftJoin('_Char as Char', 'Inventory.CharID', 'Char.CharID')
            ->leftJoin('_Chest as Storage', '_Items.ID64', 'Storage.ItemID')
            ->get();

        return [
            'inventory' => $this->getInventorySetStats($items, true),
            'webInventory' => $getWebInventoryItemId64
        ];
    }

    /**
     * Get from the Serial64 the Item Data
     * @param $serial64
     * @return array
     */
    public function getInventorySlotData($serial64): array
    {
        $item = Items::where('Serial64', '=', $serial64)
            ->leftJoin('_BindingOptionWithItem as Binding', static function ($join) {
                $join->on('Binding.nItemDBID', 'ID64');
                $join->where('Binding.nOptValue', '>', '0');
            })
            ->join('_RefObjCommon as Common', 'RefItemId', 'Common.ID')
            ->join('_RefObjItem as ObjItem', 'Common.Link', 'ObjItem.ID')
            ->get();

        return $this->getInventorySetStats($item);
    }

    /**
     * @param $characterId
     * @param $maxSlot
     * @param $minSlot
     * @return array
     */
    public function getInventorySet($characterId, $maxSlot, $minSlot): array
    {
        $inventory = Inventory::where('CharID', '=', $characterId)
            ->where('ItemID', '>', '0')
            ->where('slot', '<', $maxSlot)
            ->where('slot', '>=', $minSlot)
//            ->where('slot', '!=', 8) // For Job Flag
            ->join('_Items as Items', 'Items.ID64', '_Inventory.ItemID')
            ->leftJoin('_BindingOptionWithItem as Binding', static function ($join) {
                $join->on('Binding.nItemDBID', 'Items.ID64');
                $join->where('Binding.nOptValue', '>', '0');
            })
            ->join('_RefObjCommon as Common', 'Items.RefItemId', 'Common.ID')
            ->join('_RefObjItem as ObjItem', 'Common.Link', 'ObjItem.ID')
            ->get();

        return $this->getInventorySetStats($inventory);
    }

    /**
     * @param $characterId
     * @return array
     */
    public function getInventoryAvatar($characterId): array
    {
        $avatar = InventoryForAvatar::where('CharID', '=', $characterId)
            ->where('ItemID', '>', 1)
            ->join('_Items as Items', 'Items.ID64', 'ItemID')
            ->leftJoin('_BindingOptionWithItem as Binding', static function ($join) {
                $join->on('Binding.nItemDBID', 'Items.ID64');
                $join->where('Binding.nOptValue', '>', '0');
            })
            ->join('_RefObjCommon as Common', 'Items.RefItemId', 'Common.ID')
            ->join('_RefObjItem as ObjItem', 'Common.Link', 'ObjItem.ID')
            ->get();

        return $this->getInventorySetStats($avatar);
    }

    /**
     * @param $iPetId
     * @return mixed
     */
    public function getPetInformation($iPetId)
    {
        return CharCos::where('_CharCOS.ID', '=', $iPetId)
            ->leftJoin('_TimedJobForPet as TimedJob', static function ($join) {
                $join->on('TimedJob.CharID', '_CharCOS.ID');
                $join->where('TimedJob.Category', '=', 5);
                $join->where('TimedJob.JobID', '=', 22926);
            })
            ->join('_Items as Items', 'Items.Serial64', 'TimedJob.Serial64')
            ->join('_RefObjCommon as Common', 'Items.RefItemId', 'Common.ID')
            ->join('_RefObjItem as ObjItem', 'Common.Link', 'ObjItem.ID')
            ->select(
                '_CharCOS.*',
                'TimedJob.*',
                'TimedJob.Data3 as inventorysize',
                'TimedJob.TimeToKeep as inventorykeep',
                'Items.*',
                'Common.*',
                'ObjItem.*'
            )
            ->get()->first();
    }

    /**
     * @param $inventory
     * @param bool $filter
     * @return array
     */
    public function getInventorySetStats($inventory, $filter = false): array
    {
        $aSet = [];
        if (!$inventory) {
            return [];
        }
        foreach ($inventory as $iKey => $aCurItem) {
            $aSpecialInfo = [];
            $aInfo = $aCurItem;
            $aInfo['info'] = $this->getItemInfo($aCurItem);
            $aInfo['blues'] = $this->getBluesStats($aCurItem, $aSpecialInfo);
            $aInfo['whitestats'] = $this->getWhiteStats($aCurItem, $aSpecialInfo);

            if (array_key_exists('Slot', $aInfo['info'])) {
                //
                $i = $aInfo['info']['Slot'];
            } else {
                $i = $aCurItem['Slot'] ?? $aCurItem['ID64'];
            }

            if (!isset($aCurItem['MaxStack'])) {
                $aInfo['MaxStack'] = 0;
            }

            if ($aCurItem['MaxStack'] > 1) {
                $aSet[$i]['amount'] = $aCurItem['Data'];
                $aInfo['amount'] = $aCurItem['Data'];
            } else {
                $aSet[$i]['amount'] = false;
                $aInfo['amount'] = 0;
            }

            $aSet[$i]['Slot'] = $i;
            $aSet[$i]['Serial64'] = data_get($aInfo,'Serial64', null);
            $aSet[$i]['TypeID2'] = data_get($aInfo,'TypeID2', 0);
            $aSet[$i]['OptLevel'] = data_get($aInfo,'OptLevel', 0);
            $aSet[$i]['RefItemID'] = data_get($aCurItem,'RefItemID', 0);
            $aSet[$i]['special'] = data_get($aInfo['info'],'sox', null);
            $aSet[$i]['ItemID'] = data_get($aCurItem,'ID64', 0);
            $aSet[$i]['ItemName'] = data_get($aInfo['info'],'WebName', 'Unknown');
            $aSet[$i]['imgpath'] = $this->getItemIcon($aCurItem['AssocFileIcon128']);
            $aSet[$i]['WebInventory'] = $aInfo['info'];

            if ($filter) {
                $aSet[$i]['CharID'] = $aCurItem['CharID'];
                $aSet[$i]['CharName'] = $aCurItem['CharName16'];
                $aSet[$i]['StorageState'] = $aCurItem['UserJID'];
            }
            try {
                $aSet[$i]['data'] = view('frontend.information.information.inventorypopup', [
                    'aItem' => $aInfo
                ])->render();
            } catch (\Throwable $e) {
//                 Throw error
            }
        }
        return $aSet;
    }

    /**
     * @param $aItem
     * @return string
     */
    public function getItemIcon($aItem): string
    {
        $path = '/image/sro/' . str_replace(['ddj', '\\'], ['jpg', '/'], strtolower($aItem));

        $icon = asset($path);
        $iconDefault = asset('/image/sro/icon_default.jpg');

        if (file_exists(public_path($path))) {
            return $icon;
        }
        return $iconDefault;
    }

    /**
     * @param $aItem
     * @return array
     */
    protected function getItemInfo($aItem): array
    {
        $aData = [];
        $aData['ReqLevel1'] = $aItem['ReqLevel1'];
        $aData['CanSell'] = $aItem['CanSell'];
        $aData['CanTrade'] = $aItem['CanTrade'];
        $aData['CanBuy'] = $aItem['CanBuy'];
        $aData['TypeID2'] = $aItem['TypeID2'];
        $aData['TypeID3'] = $aItem['TypeID3'];
        $aData['TypeID4'] = $aItem['TypeID4'];
        $aData['Price'] = $aItem['Price']; // Npc Price
        $aData['sox'] = ''; // For Blade
        $aData['OptLevel'] = data_get($aItem, 'OptLevel', 0);
        $aData['Degree'] = data_get($aItem, 'ItemClass', '0'); // For Blade
        $aData['WebName'] = $this->getItemRealName(
            str_replace(['_W_', '_M_'], ['_', '_'], $aItem['CodeName128'])
        );

        if ($this->isPet($aItem)) {
            $aData['PetState'] = true;
            $aData['Type'] = 'Pet';
            if (!isset($aItem['RentEndTime'])) {
                $aPet = $this->getPetInformation($aItem['Data']);

                if (!(bool)$aPet) {
                    return $aData;
                }
            } else {
                $aPet = $aItem;
            }
            $aData['PetType'] = $aData['TypeID4'];
            $aData['PetName'] = $aPet['CharName'];
            $aTime = self::diffTime(strtotime($aPet['RentEndTime']) - time() - 60 * 60 * 24);
            $aData['PetEndTime'] = ((time() > strtotime($aPet['RentEndTime'])) ? '0Day 0Hour 0Minute' : (int)$aTime['day'] . 'Day ' . (int)$aTime['hour'] . 'Hour ' . (int)$aTime['min'] . 'Minute');
            $aData['PetLevel'] = $aPet['Lvl'];
            if ($aPet['inventorysize'] !== null) {
                $aTime = self::diffTime($aPet['inventorykeep'] - time() - 60 * 60 * 24);
                $aData['inventorySize'] = $aPet['inventorysize'];
                $aData['inventoryEndTime'] = ((time() > $aPet['inventorykeep']) ? '0Day 0Hour 0Minute' : (int)$aTime['day'] . 'Day ' . (int)$aTime['hour'] . 'Hour ' . (int)$aTime['min'] . 'Minute');
            }
        }
        if ($aData['TypeID2'] !== 1) {
            return $aData;
        }
        $aStats = explode('_', $aItem['CodeName128']);
        $aSEX = [0 => 'Female', 1 => 'Male'];
        $aClothDetail = [
            'FA' => 'Foot',
            'HA' => 'Head',
            'CA' => 'Head',
            'SA' => 'Shoulder',
            'BA' => 'Chest',
            'LA' => 'Legs',
            'AA' => 'Hands'
        ];
        $aClothType = [
            'CH' => ['CLOTHES' => 'Garment', 'HEAVY' => 'Armor', 'LIGHT' => 'Protector'],
            'EU' => ['CLOTHES' => 'Robe', 'HEAVY' => 'Heavy armor', 'LIGHT' => 'Light armor']
        ];
        $aWeaponType = [
            'CH' => [
                'TBLADE' => 'Glavie',
                'SPEAR' => 'Spear',
                'SWORD' => 'Sword',
                'BLADE' => 'Blade',
                'BOW' => 'Bow',
                'SHIELD' => 'Shield'
            ],
            'EU' => [
                'AXE' => 'Dual axe',
                'CROSSBOW' => 'Crossbow',
                'DAGGER' => 'Dagger',
                'DARKSTAFF' => 'Dark staff',
                'HARP' => 'Harp',
                'SHIELD' => 'Shield',
                'STAFF' => 'Light staff',
                'SWORD' => 'Onehand sword',
                'TSTAFF' => 'Twohand staff',
                'TSWORD' => 'Twohand sword'
            ]
        ];
        if ($aStats[1] === 'CH') {
            $aData['Race'] = 'Chinese';
        } elseif ($aStats[1] === 'EU') {
            $aData['Race'] = 'European';
        }

        switch ($aItem['TypeID3']) {
            case self::WEAPON:
                $aData['Type'] = $aWeaponType[$aStats[1]][$aStats[2]] ?? '';
                $aData['Degree'] = self::getDegree4ItemClass($aItem['ItemClass']);
                $aData['sox'] = self::getSOXRate4ItemClass($aItem['ItemClass'], $aItem['Rarity']);
                break;
            case self::SHIELD:
                $aData['Type'] = $aWeaponType[$aStats[1]][$aStats[2]] ?? '';
                $aData['Degree'] = self::getDegree4ItemClass($aItem['ItemClass']);
                $aData['sox'] = self::getSOXRate4ItemClass($aItem['ItemClass'], $aItem['Rarity']);
                break;
            case 12:
            case self::ACC:
                $aData['Type'] = $aStats[2];
                $aData['Degree'] = self::getDegree4ItemClass($aItem['ItemClass']);
                $aData['sox'] = self::getSOXRate4ItemClass($aItem['ItemClass'], $aItem['Rarity']);
                break;
            /**
             * DEVIL
             */
            case 14:
                $aData['Type'] = 'Devil´s Spirit';
                $aData['Degree'] = 'devil';
                $aData['Sex'] = $aSEX[$aItem['ReqGender']];
                $aTime = self::diffTime($aItem['Data'] - time());
                $buffer = ((time() > $aItem['Data']) ? '0Day 0Hour 0Minute' : $aTime['day'] . 'Day ' . $aTime['hour'] . 'Hour ' . $aTime['min'] . 'Minute');
                $aData['timeEnd'] = $aItem['Data'] === 0 ? '28Day' : $buffer;
                $aData['Slot'] = 0;
                break;
            /**
             * DRESS
             */
            case 13:
                $aData['Type'] = $aStats[2] . ' ' . ((!isset($aStats[5]) || is_numeric($aStats[5])) ? 'dress' : $aStats[5]);
                $aData['Degree'] = $aStats[3];
                $aData['Sex'] = $aSEX[$aItem['ReqGender']];
                $aData['Slot'] = $aItem['TypeID4'];
                break;
            default:
                $aData['Degree'] = self::getDegree4ItemClass($aItem['ItemClass']);
                if (isset($aSEX[$aItem['ReqGender']])) {
                    $aData['Sex'] = $aSEX[$aItem['ReqGender']];
                }
                if (isset($aClothType[$aStats[1]][$aStats[3]])) {
                    $aData['Type'] = $aClothType[$aStats[1]][$aStats[3]];
                }
                if (isset($aClothDetail[$aStats[5]])) {
                    $aData['Detail'] = $aClothDetail[$aStats[5]];
                }
                $aData['sox'] = self::getSOXRate4ItemClass($aItem['ItemClass'], $aItem['Rarity']);
                break;
        }

        $aData['Type'] = array_key_exists('Type', $aData) ? ucfirst(strtolower($aData['Type'])) : '';
        return $aData;
    }

    /**
     * @param $aRefData
     * @return bool
     */
    public function isPet($aRefData): bool
    {
        return $aRefData['TypeID2'] === 2 && $aRefData['TypeID3'] === 1;
    }

    /**
     * @param $iItemClass
     * @return float
     */
    protected static function getDegree4ItemClass($iItemClass): float
    {
        $iDegree = $iItemClass / 3;
        return ceil($iDegree);
    }

    /**
     * @param $iItemClass
     * @param $iRarity
     * @return mixed|string
     */
    protected static function getSOXRate4ItemClass($iItemClass, $iRarity)
    {
        if ($iRarity <= 1) {
            return '';
        }
        $aSOX = [
            0 => 'Seal of Sun',
            1 => 'Seal of Moon',
            2 => 'Seal of Star',
            3 => 'Seal of Heavy Storm'
        ];
        $iDegree = self::getDegree4ItemClass($iItemClass);
        $iSOXRate = (int)(($iDegree * 3) - $iItemClass);
        $iSOXRate = ($iDegree === 12 && $iSOXRate === 2) ? 3 : $iSOXRate;
        return $aSOX[$iSOXRate];
    }

    /**
     * @param $iDifferenz
     * @return array
     */
    public static function diffTime($iDifferenz): array
    {
        $iDay = floor($iDifferenz / (3600 * 24));
        $iH = self::lengthCheck(floor($iDifferenz / 3600 % 24));
        $iM = self::lengthCheck(floor($iDifferenz / 60 % 60));
        $iS = self::lengthCheck(floor($iDifferenz % 60));

        return [
            'day' => $iDay,
            'hour' => $iH,
            'min' => $iM,
            's' => $iS,
        ];
    }

    /**
     * @param $iInteger
     * @return string
     */
    public static function lengthCheck($iInteger): string
    {
        return (strlen($iInteger) === 1) ? '0' . $iInteger : $iInteger;
    }

    /**
     * @param $CodeName128
     * @return mixed
     */
    protected function getItemRealName($CodeName128): string
    {
        // Caching for one the day the magOpt Table
        $oneDay = 86400;
        $mappingList = Cache::remember('itemPoolName', $oneDay * 7, static function () {
            $q = ItemPoolName::all();

            $aList = [];
            foreach ($q as $iKey => $aCurData) {
                $aList[$aCurData['CodeName']] = [
                    'realName' => $aCurData['RealName'],
                    'codeName' => $aCurData['CodeName']
                ];
            }
            return $aList;
        });

        if (array_key_exists($CodeName128, $mappingList)) {
            return $mappingList[$CodeName128]['realName'];
        }

        return $CodeName128;
    }

    /**
     * @param $aItem
     * @param $aSpecialInfo
     * @return array
     */
    protected function getBluesStats($aItem, &$aSpecialInfo): array
    {
        // Caching for one the day the magOpt Table
        $oneDay = 86400;
        $_aMagOptLevel = Cache::remember('magOpt', $oneDay * 1, static function () {
            $q = MagOpt::all()->sortBy('id');
            $aList = [];
            foreach ($q as $iKey => $aCurData) {
                $aList[$aCurData['id']] = [
                    'name' => $aCurData['name'],
                    'desc' => $aCurData['desc'],
                    'mLevel' => $aCurData['mLevel'],
                    'extension' => $aCurData['extension'],
                    'sortkey' => $aCurData['sortkey'],
                ];
            }
            return $aList;
        });

        $aBlues = [];
        for ($i = 1; $i <= $aItem['MagParamNum']; $i++) {
            $magParam = 'MagParam' . $i;

            if (isset($aItem[$magParam]) && $aItem[$magParam] > 1) {
                $aData = self::convertBlue($aItem[$magParam], $_aMagOptLevel, $aSpecialInfo);
                if ($aData) {
                    $aBlues[$aData['sortkey'] . '_' . $aData['id']] = $aData;
                }
            }
        }
        ksort($aBlues);
        return $aBlues;
    }

    /**
     * @param $iMagParam
     * @param $_aMagOptLevel
     * @param $aSpecialInfo
     * @return array
     */
    protected static function convertBlue($iMagParam, $_aMagOptLevel, &$aSpecialInfo): array
    {
        if ($iMagParam === 65) {
            $aSpecialInfo['MATTR_DUR'] = (isset($aSpecialInfo['MATTR_DUR'])) ? ($aSpecialInfo['MATTR_DUR'] + 400) : 400;
            return [
                'name' => 'Repair invalid (Maximum durability 400% increase)',
                'color' => 'ff2f51',
                'sortkey' => 0,
                'extension' => '',
                'id' => 0
            ];
        }
        $hMagParam = (string)dechex($iMagParam);
        $aString = str_split($hMagParam);
        if (($iNumber = count($aString)) < 11) {
            $iNumber++;
            for ($i = $iNumber; $i <= 11; $i++) {
                array_unshift($aString, 0);
            }
        }
        $i = $aString[0] . $aString[1] . $aString[2];
        $aData = str_split($i);

        for ($i = 0; $i <= 5; $i++) {
            unset($aString[$i]);
        }

        $iState = hexdec(implode('', $aString));
        if (!isset($_aMagOptLevel[$iState])) {
            return [

            ];
        }

        // Durability Fix for 160%
        if ($_aMagOptLevel[$iState]['name'] === 'MATTR_DUR') {
            $iValue = implode('', $aData);
        } else {
            $iValue = implode('', $aData);
        }

        $iValue = hexdec($iValue);
        if ($_aMagOptLevel[$iState]['name'] === 'MATTR_REPAIR') {
            $iValue--;
        }
        $aSpecialInfo[$_aMagOptLevel[$iState]['name']] = (isset($aSpecialInfo[$_aMagOptLevel[$iState]['name']])) ? ($aSpecialInfo[$_aMagOptLevel[$iState]['name']] + $iValue) : $iValue;

        return [
            'name' => str_replace('%desc%', $iValue, $_aMagOptLevel[$iState]['desc']),
            'color' => $_aMagOptLevel[$iState]['name'] === 'MATTR_DEC_MAXDUR' ? 'ff2f51' : '50cecd',
            'sortkey' => $_aMagOptLevel[$iState]['sortkey'],
            'id' => $iState
        ];
    }

    /**
     * @param $aItem
     * @param $aSpecialInfo
     * @return array
     */
    protected function getWhiteStats($aItem, $aSpecialInfo): array
    {
        if ($aItem['TypeID2'] !== 1 || $aItem['TypeID3'] === 7) {
            return [];
        }
        $aWhiteStats = [];
        $iBinar = self::bin($aItem['Variance']);
        $aStats = strrev($iBinar);
        $aStats = str_split($aStats, 5);
        foreach ($aStats as $iBinar) {
            $iDezimal = bindec(strrev($iBinar));
            if ($iDezimal === 0) {
                $aWhiteStats[] = 0;
                continue;
            }
            $aWhiteStats[] = (int)($iDezimal * 100 / 31);
        }
        return self::convertToStats($aItem, $aWhiteStats, $aSpecialInfo);
    }

    /**
     * @param $int
     * @return string
     */
    protected static function bin($int): string
    {
        $i = 0;
        $binair = '';
        while ($int >= (2 ** $i)) {
            $i++;
        }

        if ($i !== 0) {
            --$i;
        }

        while ($i >= 0) {
            if ($int - (2 ** $i) < 0) {
                $binair = '0' . $binair;
            } else {
                $binair = '1' . $binair;
                $int -= (2 ** $i);
            }
            $i--;
        }
        return strrev($binair);
    }

    /**
     * @param $aItem
     * @param $aWhiteStats
     * @param $aSpecialInfo
     * @return array
     */
    protected static function convertToStats($aItem, $aWhiteStats, $aSpecialInfo): array
    {
        for ($i = 0; $i <= 6; $i++) {
            $aWhiteStats[$i] = $aWhiteStats[$i] ?? 0;
        }

        $aItem['nOptValue'] = $aItem['nOptValue'] ?? 0;

        switch ($aItem['TypeID3']) {
            case self::WEAPON:
                $aStats = [
                    0 => 'Phy. atk. pwr. ' . self::calcOPTValue(self::getValue($aItem['PAttackMin_L'],
                            $aItem['PAttackMin_U'], $aWhiteStats[4]), $aItem['PAttackInc'],
                            ((int)$aItem['nOptValue'] + (int)$aItem['OptLevel'])) . ' ~ ' . self::calcOPTValue(self::getValue($aItem['PAttackMax_L'],
                            $aItem['PAttackMax_U'], $aWhiteStats[4]), $aItem['PAttackInc'],
                            ((int)$aItem['nOptValue'] + (int)$aItem['OptLevel'])) . ' (+' . $aWhiteStats[4] . '%)',
                    1 => 'Mag. atk. pwr. ' . self::calcOPTValue(self::getValue($aItem['MAttackMin_L'],
                            $aItem['MAttackMin_U'], $aWhiteStats[5]), $aItem['MAttackInc'],
                            ((int)$aItem['nOptValue'] + (int)$aItem['OptLevel'])) . ' ~ ' . self::calcOPTValue(self::getValue($aItem['MAttackMax_L'],
                            $aItem['MAttackMax_U'], $aWhiteStats[5]), $aItem['MAttackInc'],
                            ((int)$aItem['nOptValue'] + (int)$aItem['OptLevel'])) . ' (+' . $aWhiteStats[5] . '%)',
                    2 => 'Durability ' . $aItem['Data'] . '/' . self::getDuraMaxValue(self::getValue($aItem['Dur_L'],
                            $aItem['Dur_U'], $aWhiteStats[0]), $aSpecialInfo) . ' (+' . $aWhiteStats[0] . '%)',
                    3 => 'Attack rating ' . self::calcOPTValue(self::getBlueValue(self::getValue($aItem['HR_L'],
                            $aItem['HR_U'], $aWhiteStats[3]),
                            $aSpecialInfo['MATTR_HR'] ?? 0), $aItem['HRInc'],
                            ((int)$aItem['nOptValue'] + (int)$aItem['OptLevel'])) . ' (+' . $aWhiteStats[3] . '%)',
                    4 => 'Critical ' . self::getValue($aItem['CHR_L'], $aItem['CHR_U'],
                            $aWhiteStats[6]) . ' (+' . $aWhiteStats[6] . '%)',
                    5 => 'Phy. reinforce ' . self::getValue($aItem['PAStrMin_L'], $aItem['PAStrMin_U'],
                            $aWhiteStats[1]) / 10 . ' % ~ ' . self::getValue($aItem['PAStrMax_L'], $aItem['PAStrMax_U'],
                            $aWhiteStats[1]) / 10 . ' % (+' . $aWhiteStats[1] . '%)',
                    6 => 'Mag. reinforce ' . self::getValue($aItem['MAInt_Min_L'], $aItem['MAInt_Min_U'],
                            $aWhiteStats[2]) / 10 . ' % ~ ' . self::getValue($aItem['MAInt_Max_L'],
                            $aItem['MAInt_Max_U'], $aWhiteStats[2]) / 10 . ' % (+' . $aWhiteStats[2] . '%)'
                ];
                if ($aItem['PAttackMin_L'] === 0) {
                    unset($aStats[0], $aStats[5]);
                    $aStats[4] = 'Critical 2 (+100%)';
                }
                if ($aItem['MAttackMin_L'] === 0) {
                    unset($aStats[1], $aStats[6]);
                }
                break;
            case self::SHIELD:
                $aStats = [
                    0 => 'Phy. def. pwr. ' . self::calcOPTValue(self::getValue($aItem['PD_L'] * 10, $aItem['PD_U'] * 10,
                            $aWhiteStats[4]), $aItem['PDInc'] * 10,
                            ((int)$aItem['nOptValue'] + (int)$aItem['OptLevel'])) / 10 . ' (+' . $aWhiteStats[4] . '%)',
                    1 => 'Mag. def. pwr. ' . self::calcOPTValue(self::getValue($aItem['MD_L'] * 10, $aItem['MD_U'] * 10,
                            $aWhiteStats[5]), $aItem['MDInc'] * 10,
                            ((int)$aItem['nOptValue'] + (int)$aItem['OptLevel'])) / 10 . ' (+' . $aWhiteStats[5] . '%)',
                    2 => 'Durability ' . $aItem['Data'] . '/' . self::getDuraMaxValue(self::getValue($aItem['Dur_L'],
                            $aItem['Dur_U'], $aWhiteStats[0]), $aSpecialInfo) . ' (+' . $aWhiteStats[0] . '%)',
                    3 => 'Blocking rate ' . self::getValue($aItem['BR_L'], $aItem['BR_U'],
                            $aWhiteStats[3]) . ' (+' . $aWhiteStats[3] . '%)',
                    4 => 'Phy. reinforce ' . self::getValue($aItem['PDStr_L'], $aItem['PDStr_U'],
                            $aWhiteStats[1]) / 10 . ' % (+' . $aWhiteStats[1] . '%)',
                    5 => 'Mag. reinforce ' . self::getValue($aItem['MDInt_L'], $aItem['MDInt_U'],
                            $aWhiteStats[2]) / 10 . ' % (+' . $aWhiteStats[2] . '%)'
                ];
                break;
            case 12:
            case self::ACC:
                $aStats = [
                    0 => 'Phy. absorption ' . self::calcOPTValue(self::getValue($aItem['PAR_L'] * 10,
                            $aItem['PAR_U'] * 10, $aWhiteStats[0]), $aItem['PARInc'] * 10,
                            ((int)$aItem['nOptValue'] + (int)$aItem['OptLevel'])) / 10 . ' (+' . $aWhiteStats[0] . '%)',
                    1 => 'Mag. absorption ' . self::calcOPTValue(self::getValue($aItem['MAR_L'] * 10,
                            $aItem['MAR_U'] * 10, $aWhiteStats[1]), $aItem['MARInc'] * 10,
                            ((int)$aItem['nOptValue'] + (int)$aItem['OptLevel'])) / 10 . ' (+' . $aWhiteStats[1] . '%)'
                ];
                break;
            default:
                $aStats = [
                    0 => 'Phy. def. pwr. ' . self::calcOPTValue(self::getValue($aItem['PD_L'] * 10, $aItem['PD_U'] * 10,
                            $aWhiteStats[3]), $aItem['PDInc'] * 10,
                            ((int)$aItem['nOptValue'] + (int)$aItem['OptLevel'])) / 10 . ' (+' . $aWhiteStats[3] . '%)',
                    1 => 'Mag. def. pwr. ' . self::calcOPTValue(self::getValue($aItem['MD_L'] * 10, $aItem['MD_U'] * 10,
                            $aWhiteStats[4]), $aItem['MDInc'] * 10,
                            ((int)$aItem['nOptValue'] + (int)$aItem['OptLevel'])) / 10 . ' (+' . $aWhiteStats[4] . '%)',
                    2 => 'Durability ' . $aItem['Data'] . '/' . self::getDuraMaxValue(self::getValue($aItem['Dur_L'],
                            $aItem['Dur_U'], $aWhiteStats[0]), $aSpecialInfo) . ' (+' . $aWhiteStats[0] . '%)',
                    3 => 'Parry rate ' . self::calcOPTValue(self::getBlueValue(self::getValue($aItem['ER_L'],
                            $aItem['ER_U'], $aWhiteStats[5]),
                            $aSpecialInfo['MATTR_ER'] ?? 0), $aItem['ERInc'],
                            ((int)$aItem['nOptValue'] + (int)$aItem['OptLevel'])) . ' (+' . $aWhiteStats[5] . '%)',
                    4 => 'Phy. reinforce ' . self::getValue($aItem['PDStr_L'], $aItem['PDStr_U'],
                            $aWhiteStats[1]) / 10 . ' % (+' . $aWhiteStats[1] . '%)',
                    5 => 'Mag. reinforce ' . self::getValue($aItem['MDInt_L'], $aItem['MDInt_U'],
                            $aWhiteStats[2]) / 10 . ' % (+' . $aWhiteStats[2] . '%)'
                ];
                break;
        }
        return $aStats;
    }

    /**
     * @param $iValue
     * @param $iBonus
     * @param $iOptLvl
     * @return float
     */
    protected static function calcOPTValue($iValue, $iBonus, $iOptLvl): float
    {
        return round($iValue + $iBonus * $iOptLvl);
    }

    /**
     * @param $iMin
     * @param $iMax
     * @param $iProzent
     * @return float
     */
    protected static function getValue($iMin, $iMax, $iProzent): float
    {
        return round($iMin + ((($iMax - $iMin) / 100) * $iProzent));
    }

    /**
     * @param $iValue
     * @param $aSpecialInfo
     * @return float
     */
    protected static function getDuraMaxValue($iValue, $aSpecialInfo): float
    {
        if (isset($aSpecialInfo['MATTR_DUR'])) {
            $iValue = self::getBlueValue($iValue, $aSpecialInfo['MATTR_DUR']);
        }
        if (isset($aSpecialInfo['MATTR_DEC_MAXDUR'])) {
            $iValue = self::getBlueValueNegative($iValue, $aSpecialInfo['MATTR_DEC_MAXDUR']);
        }
        return $iValue;
    }

    /**
     * @param $iValue
     * @param $iProzent
     * @return float
     */
    protected static function getBlueValue($iValue, $iProzent): float
    {
        return round($iValue + (($iValue / 100) * $iProzent));
    }

    /**
     * @param $iValue
     * @param $iProzent
     * @return float
     */
    protected static function getBlueValueNegative($iValue, $iProzent): float
    {
        return round($iValue - ($iValue / 100 * $iProzent));
    }
}
