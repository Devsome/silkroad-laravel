<?php

namespace App\Http\Controllers\Frontend;

use App\DonationMaxiCard;
use App\DonationMaxiCardLog;
use App\Helpers\MaxiCard\MaxiCardApiHelper;
use App\Http\Controllers\Controller;
use App\Http\Model\SRO\Account\SkSilk;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonationsMaxiCardController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function buy()
    {
        return view('frontend.account.donations.maxicard.buy');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function store(Request $request): RedirectResponse
    {
        //validate data
        $request->validate([
            'code' => ['required'],
            'password' => ['required'],
        ]);
        $user = Auth::user();
        $response = MaxiCardApiHelper::sendMaxiCardPostRequest($request->get('code'), $request->get('password'));
        if (trim($response->params->durum) === 'ok' && intval(trim($response->params->siparis_no)) > 0) {

            //order number
            $order_number = intval(trim($response->params->siparis_no));

            //The amount of Epin code in Decimal
            $amount = trim($response->params->tutar);
            $amount = preg_replace('/[^0-9]/', '', $amount);
            $amount = intval($amount);

            //Commission
            $commission = trim($response->params->komisyon);
            $commission = preg_replace('/[^0-9\.]/', '', $commission);

            if (!$amount || $amount <= 0) {
                //return error
                return redirect()->back()->with(['error' => 'This epin is invalid, Please try a valid one']);
            }
            //get epin amount
            $epin = DonationMaxiCard::where('epin_amount', $amount)
                ->first();

            //set silk amount
            if ($epin) {
                $silk_amount = $epin->silk_amount;
            } else {
                $silk_amount = $amount;
            }

            DB::beginTransaction();
            try {
                //add silk to user
                SkSilk::where('JID', $user->jid)
                    ->increment(
                        'silk_own',
                        $silk_amount
                    );

                //add log
                DonationMaxiCardLog::create([
                    'user_id' => $user->id,
                    'order_number' => $order_number,
                    'epin_code' => $request->get('code'),
                    'epin_password' => $request->get('password'),
                    'epin_amount_id' => $epin ? $epin->id : null,
                    'epin_amount' => $silk_amount,
                    'commission' => $commission
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(['error' => 'Something went wrong, Please try again later.']);
            }
            DB::commit();

            //silk amount
            $silk = SkSilk::where('JID', $user->jid)
                ->first()
                ->silk_own;

            return redirect()->back()->with(['success' => "You've successfully purchased {$silk_amount} and your current balance is {$silk}"]);
        } else if (trim($response->params->durum) === 'bayi_hata') {

            //return error with wrong api if the data is wrong in env
            return redirect()->back()->with(['error' => 'Wrong API Key or API Password.']);
        }

        return redirect()->back()->with(['error' => 'This epin is invalid, Please try a valid one']);
    }
}
