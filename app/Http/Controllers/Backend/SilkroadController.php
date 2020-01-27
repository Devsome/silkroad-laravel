<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\SRO\Account\SkSilk;
use App\Model\SRO\Account\SkSilkBuyList;
use App\Model\SRO\Account\TbUser;
use App\Model\SRO\Shard\Char;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
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

    /**
     * @param $jid
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sroUserSilkAdd($jid, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'silk' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        SkSilkBuyList::create([
            'UserJID' => $jid,
            'Silk_Type' => SkSilkBuyList::SilkTypeWeb,
            'Silk_Reason' => SkSilkBuyList::SilkReasonWeb,
            'Silk_Offset' => SkSilk::where('JID', $jid)->pluck('silk_own')->first(),
            'Silk_Remain' => SkSilk::where('JID', $jid)->pluck('silk_own')->first() + $request->get('silk'),
            'ID' => $jid,
            'BuyQuantity' => $request->get('silk'),
            'OrderNumber' => 0,
            'AuthDate' => Carbon::now()->format('Y-m-d H:i:s'),
            'SlipPaper' => 'dunno',
            'IP' => $request->ip(),
            'RegDate' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        SkSilk::where('JID', $jid)
            ->increment(
                'silk_own', $request->get('silk')
            );

        return back()->with('success', trans('backend/notification.form-submit.success'));
    }
}
