<?php

namespace App\Http\Controllers\Backend;

use App\Model\SRO\Account\Punishment;
use App\Model\SRO\Account\SkSilk;
use App\Model\SRO\Account\SmcLog;
use App\Model\SRO\Account\TbUser;
use App\User;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

/**
 * Class BackendController
 * @package App\Http\Controllers\Backend
 */
class BackendController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('backend.index', [
            'userCount' => User::count(),
            'playerCount' => TbUser::count(),
            'silkCount' => SkSilk::all()->sum('silk_own')
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function smclogIndex()
    {
        return view('backend.logging.smc');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function smclogDatatables()
    {
        return DataTables::of(SmcLog::query())->make(true);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function blockedAccountsIndex()
    {
        return view('backend.logging.blocked');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function blockedAccountsDatatables()
    {
        return DataTables::of(Punishment::query())->make(true);
    }
}
