<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\SRO\Account\TbUser;
use App\Model\SRO\Shard\Char;
use Yajra\DataTables\DataTables;

/**
 * Class SilkroadController
 * @package App\Http\Controllers\Backend
 */
class SilkroadController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexSroUser()
    {
        return view('backend.silkroad.tbuser.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function sroUserDatatables()
    {
        return DataTables::of(TbUser::query())->make(true);
    }

    /**
     * @param $jid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sroUserEdit($jid)
    {
        $tbuser = TbUser::with('getShardUser')
            ->with('getPunishmentUser')
            ->with('getSkSilk')
            ->with('getIsBlockedUser')
            ->findOrFail($jid);
        return view('backend.silkroad.tbuser.edit', [
            'tbuser' => $tbuser
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexSroPlayer()
    {
        return view('backend.silkroad.chars.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function sroPlayerDatatables()
    {
        return DataTables::of(Char::query())->make(true);
    }

    /**
     * @param $char
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sroPlayerEdit($char)
    {
        $char = Char::findOrFail($char);
        return view('backend.silkroad.chars.edit', [
            'char' => $char
        ]);
    }
}
