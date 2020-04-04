<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    /**
     * Udapting the Account settings (web and Silkroad)
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function settingsUpdate(Request $request)
    {
        $user = User::with('getTbUser')
            ->findOrFail(
                Auth::user()->id
            );

        $this->validate($request, [
            '_token' => 'required',
            'name' => ['required', 'string', 'min:4', 'max:16'],
            'email' => ['unique:users,email,' . $user->id],
            'sro_password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'web_password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'current_web_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!\Hash::check($value, $user->password)) {
                    return $fail(__('home.settings.form.wrong-current-web-password'));
                }
            }],
        ]);

//        @Todo check if there is a better option as this shit

        $name = $request->get('name');
        $email = $request->get('email');
        $map = $request->has('show_map');
        $sroPassword = $request->get('sro_password');
        $webPassword = $request->get('web_password');

        $user->updated_at = Carbon::now();

        if ($sroPassword) {
            $user->getTbUser->password = md5(
                $sroPassword
            );
        }

        if ($webPassword) {
            $user->password = Hash::make($webPassword);
        }

        if ($name) {
            $user->name = $name;
            $user->getTbUser->Name = $name;
        }

        if ($email) {
            $user->email = $email;
            $user->getTbUser->Email = $email;
        }

        $user->show_map = $map ? 1 : 0;
        $user->push();

        return redirect()->back()->with('success', __('home.settings.form.successfully'));
    }
}
