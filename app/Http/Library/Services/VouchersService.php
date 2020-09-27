<?php

namespace App\Http\Library\Services;

use App\Model\SRO\Account\SkSilk;
use App\Model\SRO\Account\SkSilkBuyList;
use App\User;
use App\UserVoucher;
use App\Voucher;
use Carbon\Carbon;

class VouchersService
{
    /** @var VoucherGeneratorService */
    private $generator;

    /**
     * VouchersService constructor.
     * @param VoucherGeneratorService $generator
     */
    public function __construct(VoucherGeneratorService $generator)
    {
        $this->generator = $generator;
    }

    /**
     * @param int $silk
     * @param int $amount
     * @param array $data
     * @param null $expires_at
     * @return array
     */
    public function createVouchers(int $silk, int $amount, array $data = [], $expires_at = null): array
    {
        return $this->create($silk, $amount, $data, $expires_at);
    }

    /**
     * @param int $silk
     * @param array $data
     * @param null $expires_at
     * @return mixed
     */
    public function createVoucher(int $silk, array $data = [], $expires_at = null)
    {
        $voucher = $this->create($silk, 1, $data, $expires_at);

        return $voucher[0];
    }

    /**
     * Generate the specified amount of codes and return
     * an array with all the generated codes.
     *
     * @param int $amount
     * @return array
     */
    private function generate(int $amount = 1): array
    {
        $codes = [];

        for ($i = 1; $i <= $amount; $i++) {
            $codes[] = $this->getUniqueVoucher();
        }

        return $codes;
    }

    /**
     * @param int $quantity
     * @param int $amount
     * @param array $data
     * @param null $expires_at
     * @return array
     */
    private function create(int $quantity = 1, int $amount = 1, array $data = [], $expires_at = null): array
    {
        $vouchers = [];

        foreach ($this->generate($amount) as $voucherCode) {
            $vouchers[] = Voucher::create([
                'code' => $voucherCode,
                'amount' => $quantity,
                'data' => $data,
                'expires_at' => $expires_at,
            ]);
        }

        return $vouchers;
    }

    /**
     * @param string $code
     * @param Voucher $voucher
     * @return array
     */
    private function check(string $code, Voucher $voucher = null): array
    {
        if ($voucher === null) {
            return [
                'success' => false,
                'text' => __('voucher.invalid', ['voucher' => $code])
            ];
        }
        if ($voucher->isExpired()) {
            return [
                'success' => false,
                'text' => __('voucher.expired', ['voucher' => $code])
            ];
        }
        if ($voucher->isRedeemed()) {
            return [
                'success' => false,
                'text' => __('voucher.already', ['voucher' => $code])
            ];
        }
        return [
            'success' => true,
            'text' => __('voucher.success', ['voucher' => $code]),
            'voucher' => $voucher
        ];
    }

    /**
     * @param string $code
     * @param User $user
     * @param $ip
     * @return array
     */
    public function redeemVoucher(string $code, User $user, $ip): array
    {
        $voucher = Voucher::whereCode($code)->first();
        $checkCode = $this->check($code, $voucher);
        if($checkCode['success'] === false)
        {
            return $checkCode;
        }
        $getTbUser = $user->getTbUser()->firstOrFail();

        $voucher->redeemed_at = Carbon::now();
        $voucher->save();

        UserVoucher::create([
            'user_id' => $user->id,
            'voucher_id' => $voucher->id,
            'redeemed_at' => Carbon::now()
        ]);

        SkSilkBuyList::create([
            'UserJID' => $getTbUser->JID,
            'Silk_Type' => SkSilkBuyList::SilkTypeVoucher,
            'Silk_Reason' => SkSilkBuyList::SilkReasonWeb,
            'Silk_Offset' => SkSilk::where('JID', $getTbUser->JID)->pluck('silk_own')->first(),
            'Silk_Remain' => SkSilk::where('JID', $getTbUser->JID)->pluck('silk_own')->first() + $voucher->amount,
            'ID' => $getTbUser->JID,
            'BuyQuantity' => $voucher->amount,
            'OrderNumber' => 0,
            'AuthDate' => Carbon::now()->format('Y-m-d H:i:s'),
            'SlipPaper' => 'Voucher',
            'IP' => $ip,
            'RegDate' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        SkSilk::where('JID', $getTbUser->JID)
            ->increment(
                'silk_own', $voucher->amount
            );
        return $checkCode;
    }


    /**
     * @return string
     */
    protected function getUniqueVoucher(): string
    {
        $voucher = $this->generator->generateUnique();

        while (Voucher::whereCode($voucher)->count() > 0) {
            $voucher = $this->generator->generateUnique();
        }

        return $voucher;
    }
}
