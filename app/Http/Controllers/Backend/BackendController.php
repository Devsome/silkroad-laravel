<?php

namespace App\Http\Controllers\Backend;

use App\Model\SRO\Account\TbUser;
use App\User;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

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
}
