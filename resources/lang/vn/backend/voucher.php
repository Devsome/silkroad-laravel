<?php

return [
    'title' => 'Phiếu thưởng',
    'title-create' => 'Tạo phiếu thưởng',

    'modal-delete-title' => 'Xóa phiếu thưởng này',
    'modal-delete-message' => 'Bạn thật sự muốn xóa phiếu thưởng này :code?',

    'table' => [
        'code' => 'Phiếu thưởng',
        'amount' => 'Số lượng Silk ',
        'redeemed_at' => 'Đổi tại',
        'expires_at' => 'Hết hạn lúc',
        'created_at' => 'Được tạo lúc',
        'action' => 'Hành động',
    ],

    'create' => [
        'title' => 'Tạo phiếu thưởng(s)',
        'create' => 'Tạo',

        'amount' => 'Số lượng',
        'amount-help' => 'Bạn muốn tạo bao nhiêu phiếu thưởng?',
        'silk' => config('siteSettings.sro_silk_name', 'Silk') . ' số lượng',
        'expired-at' => 'Hết hạn lúc',
        'silk-help' => 'Số lượng Silk của phiếu thưởng(s)',

        'submit' => 'Tạo Phiếu Thưởng(s)',
        'back' => 'Quay lại',
    ]
];
