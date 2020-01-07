<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\SRO\Account\TbUser;
use Illuminate\Http\Request;
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
}
