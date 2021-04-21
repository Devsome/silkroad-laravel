<?php

return [
    'paypal' => [
        'title' => 'Beli dengan PayPal',
        'disabled' => 'Saat ini metode dinonaktifkan.',
        'empty' => 'Saat ini tidak ada paket harga yang ditambahkan, silakan hubungi dukungan.',
        'pay-text' => 'Beli :price :currency untuk :amount :silk_name',
        'submit' => 'Beli Sekarang!',

        'pending' => 'Anda memiliki pembayaran yang tertunda!',
    ],

    'maxicard' => [
        'title' => 'Beli dengan MaxiCard E-Pin',
        'disabled' => 'Saat ini metode dinonaktifkan.',
        'empty' => 'Saat ini tidak ada paket harga yang ditambahkan, silakan hubungi dukungan.',
        'pay-text' => 'Beli :price :currency untuk :amount :silk_name',
        'submit' => 'Beli Sekarang!',
    ],
    'notification' => [
        'buy' => [
            'success-title' => 'Selesai',
            'success-message' => 'Donasi anda telah sukses diproses, terimakasih!',
            'success-help' => 'Anda baru saja diberi kredit :amount ' . config('siteSettings.sro_silk_name', 'Silk') . ' ke akun anda. Bersenang-senanglah!',
            'success-back' => 'Kembali ke Dashboard anda',
            'invoice-closed-title' => 'Proses',
            'invoice-closed-message' => 'Donasi ini sudah diproses, terimakasih!',
            'invoice-help' => '
            Sepertinya Paypal butuh waktu lebih lama untuk mengirimkan jawaban kepada kami, mohon tunggu sebentar, transaksi sedang dilakukan sekarang.',
            'invoice-ahref' => 'Kembali',
            'error-title' => 'Ups!',
            'error' => 'Ada yang tidak beres, coba lagi atau tulis tiket.',
            'error-helper' => 'Anda dapat mencobanya lagi, kami mencatat setiap langkah yang Anda lakukan.',
            'error-ahref' => 'Kembali',

            'notification' => 'Sukses membeli :amount ' . config('siteSettings.sro_silk_name', 'Silk'),
        ]
    ],
];
