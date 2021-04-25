<?php

return [
    'paypal' => [
        'title' => 'Paypal ile Öde',
        'disabled' => 'Bu yöntem şu anda devre dışı.',
        'empty' => 'Şu anda hiçbir fiyat paketi eklenmedi, lütfen destek ile iletişime geçin.',
        'pay-text' => ':amount :silk_name için :price öde',
        'submit' => 'Şimdi satın al!',

        'pending' => 'Bekleyen işlemleriniz bulunuyor!',
    ],

    'maxicard' => [
        'title' => 'MaxiCard E-Pin ile Öde',
        'disabled' => 'Bu yöntem şu anda devre dışı.',
        'empty' => 'Şu anda hiçbir fiyat paketi eklenmedi, lütfen destek ile iletişime geçin.',
        'pay-text' => ':amount :silk_name için :price öde',
        'submit' => 'Şimdi satın al!',
    ],
    'stripe' => [
        'title' => 'Stripe ile Öde',
        'disabled' => 'Bu yöntem şu anda devre dışı.',
        'empty' => 'Şu anda hiçbir fiyat paketi eklenmedi, lütfen destek ile iletişime geçin.',
        'pay-text' => ':amount :silk_name için :price öde',
        'submit' => 'Bunu seçin',

        'pending' => 'Bekleyen işlemleriniz bulunuyor!',

        'buy' => [
            'title' => 'Stripe ile hemen satın alın',
            'info' => 'Bilgileriniz',
            'info-body' => ':amount :currency ile :silk ' . config('siteSettings.sro_silk_name', 'Silk') . ' almak üzeresiniz.',
            'card-holder' => 'kart sahibi',
            'submit' => 'Şimdi öde!',
        ],
        'error' => [
            'error-title' => 'İşleminiz iptal edildi!',
            'error-body' => 'İşleminiz kaydedildi, Ne zaman ödeme yapmak isterseiz yapabilirsiniz.',
        ]
    ],
    'notification' => [
        'buy' => [
            'success-title' => 'Tamam!',
            'success-message' => 'Bağışınız başarıyla işlendi, teşekkürler!',
            'success-help' => 'You have just been credited :amount ' . config('siteSettings.sro_silk_name', 'Silk') . ' to your account. Have fun with it!',
            'success-help' => 'Hesabınıza az önce :amount ' . config('siteSettings.sro_silk_name', 'Silk') . ' yüklendi. iyi eğlenceler dileriz!',
            'success-back' => 'Kontrol Panelinize geri dönün',
            'invoice-closed-title' => 'İşleme alındı',
            'invoice-closed-message' => 'Bu bağış zaten işleme alındı, teşekkürler!',
            'invoice-help' => 'Görünüşe göre Paypal\'ın cevabı bize göndermesi için biraz daha uzun süre gerekiyor, lütfen biraz bekleyin, işlem şu anda yapılıyor.',
            'invoice-ahref' => 'Geri dönün',
            'error-title' => 'Ups!',
            'error' => 'Bir şeyler ters gitti, lütfen tekrar deneyin veya bir ticket yazın.',
            'error-helper' => 'Bu işlemi tekrar deneyebilirsiniz, yaptığınız her adımı kaydedilmektedir.',
            'error-ahref' => 'Geri dönün',
            'notification' => 'Başarıyla :amount ' . config('siteSettings.sro_silk_name', 'Silk') . ' satın aldınız.',
        ],
        'error' => [
            'missing-keys' => 'Ödeme yöntemi için bazı bilgiler eksik, lütfen bir yönetici ile iletişime geçin.',
            'missing-methods' => 'Eksik Ödeme Yöntemleri var',
        ]
    ],
];
