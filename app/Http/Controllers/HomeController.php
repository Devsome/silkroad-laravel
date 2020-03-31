<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $account = User::where('id', Auth::id())
            ->with('getTbUser')
            ->with('getTbUser.getSkSilk')
            ->with('getTbUser.getShardUser')
            ->firstOrFail();

        return view('home', [
            'account' => $account
        ]);
    }
}
