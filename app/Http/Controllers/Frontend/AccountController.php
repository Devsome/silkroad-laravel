<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\Frontend\Account\ReferralDataTable;
use App\DataTables\Frontend\Account\VouchersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Library\Services\VouchersService;
use App\SiteSettings;
use App\User;
use App\UserVoucher;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Validator;
use Yajra\DataTables\DataTables;

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
     * @return Renderable
     */
    public function index()
    {
        return view('theme::home');
    }

    /**
     * Show all the Accounts Characters
     *
     * @return Factory|View
     */
    public function charList()
    {
        $account = User::where('id', Auth::id())
            ->with('getTbUser.getShardUser')
            ->with('getTbUser.getShardUser.getGuildUser')
            ->with('getTbUser.getShardUser.getCharOnlineOfflineLoggedIn')
            ->firstOrFail();

        return view('theme::frontend.account.charslist', [
            'account' => $account
        ]);
    }

    /**
     * Show the settings for the Account
     *
     * @return Factory|View
     */
    public function settings()
    {
        $account = User::where('id', Auth::id())
            ->firstOrFail();

        return view('theme::frontend.account.settings', [
            'account' => $account
        ]);
    }

    /**
     * @param ReferralDataTable $dataTable
     * @return Factory|View
     */
    public function referral(ReferralDataTable $dataTable)
    {
        $account = User::where('id', Auth::id())
            ->firstOrFail();

        $siteSettings = SiteSettings::first();

        if ($siteSettings && array_key_exists('signature', $siteSettings->settings)) {
            $signature = $siteSettings->settings['signature'];
        } else {
            $signature = null;
        }
        return $dataTable->render('theme::frontend.account.referral', [
            'account' => $account,
            'signature' => $signature
        ]);
    }


    /**
     * @param VouchersDataTable $dataTable
     * @return Factory|View
     */
    public function voucher(VouchersDataTable $dataTable)
    {
        $account = User::where('id', Auth::id())
            ->firstOrFail();

        return $dataTable->render('theme::frontend.account.voucher', [
            'account' => $account
        ]);
    }


    /**
     * @param Request $request
     * @param VouchersService $vouchersService
     * @return RedirectResponse
     */
    public function voucherUse(
        Request $request,
        VouchersService $vouchersService)
    {
        $validator = Validator::make($request->all(), [
            'voucher' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $checkVoucher = $vouchersService->redeemVoucher(
            $request->get('voucher'),
            Auth::user(),
            $request->ip()
        );

        if ($checkVoucher['success']) {
            return back()->with('success', $checkVoucher['text']);
        }

        return back()->with('error', $checkVoucher['text']);
    }

    /**
     * Udapting the Account settings (web and Silkroad)
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function settingsUpdate(Request $request)
    {
        $user = User::with('getTbUser')
            ->findOrFail(
                Auth::id()
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
