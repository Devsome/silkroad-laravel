<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
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
            ->firstOrFail();

        return view('home', [
            'account' => $account
        ]);
    }

    /**
     * Show all the Accounts Characters
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function charList()
    {
        $account = User::where('id', Auth::id())
            ->with('getTbUser')
            ->with('getTbUser.getSkSilk')
            ->with('getTbUser.getShardUser')
            ->with('getTbUser.getShardUser.getGuildUser')
            ->with('getTbUser.getShardUser.getCharOnlineOfflineLoggedIn')
            ->firstOrFail();

        return view('frontend.account.charslist', [
            'account' => $account
        ]);
    }

    /**
     * Show the settings for the Account
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settings()
    {
        $account = User::where('id', Auth::id())
            ->with('getTbUser')
            ->with('getTbUser.getSkSilk')
            ->firstOrFail();

        return view('frontend.account.settings', [
            'account' => $account
        ]);
    }
}
