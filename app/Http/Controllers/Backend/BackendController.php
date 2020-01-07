<?php

namespace App\Http\Controllers\Backend;

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
            'playerCount' => TbUser::count()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function smclogIndex()
    {
        return view('backend.smc.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function smclogDatatables()
    {
        return DataTables::of(SmcLog::query())->make(true);
    }
}