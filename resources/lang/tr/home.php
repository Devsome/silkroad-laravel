<?php

return [
    'title' => 'Kontrol Paneli',
    'grid' => [
        'char-list' => 'Karakter Listesi',
        'char-list-desc' => 'Burada kendi karakterleriniz hakkında ek bilgileri görebilirsiniz.',
        'settings' => 'Ayarlar',
        'settings-desc' => 'bu alanda şifrelerinizi, e-postanızı ve hesabınızla ilgili değişiklikleri yapabilirsiniz.',
        'donation' => 'Bağışlar',
        'donation-desc' => 'Bu noktada bir iyilik yapabilir ve bize destek olabilirsiniz! Bir teşekkür olarak oyunda :silk alacaksınız.',
        'other' => 'Ortak',
        'other-desc' => 'Henüz tam olarak yerleştirilmemiş her şey bu noktada bulunabilir.',
        'ref' => 'Referans',
        'ref-desc' => 'Kimi davet ettiğinizi ve ne kazandığınızı görmek için burayı tıklayın.',
        'tickets' => 'Ticket',
        'tickets-desc' => 'Bir sorunun veya isteğin mi var? Burada bir ticket oluşturabilir ve bizi bilgilendirebilirsiniz.',
        'voucher' => 'Kupon',
        'voucher-desc' => 'Bir kuponunuz var ve onu :silk için mi kullanmak istiyorsunuz? O zaman bu alanı kullanabilirsiniz.',
        'web-inventory' => 'Web Envanteri',
        'web-inventory-help' => 'Burada, satın aldığınız veya sattığınız ürünlerin olduğu "Envanterinizi" bulabilirsiniz',
        'voteforsilk' => 'Vote for silk',
        'voteforsilk-help' => 'You want to gain easy silk? Here you can vote for our Server and gain some.',
        'web-mall' => 'Web Mall',
        'web-mall-help' => 'Here you can buy items from "Web Mall" using silk, it will be added instantly to your storage.',
    ],

    'chars-list' => [
        'title' => 'Karakter Listesi',
        'no-chars' => 'Lütfen diğer işlevler için bir karakter oluşturun.',
        'last-logout' => 'Son Çıkış:',
        'level' => 'Level:',
        'gold' => 'Gold:',
        'guild' => 'Guild:',
        'logged-in' => 'Oturum aktif',
        'logged-out' => 'Oturum kapalı',
    ],

    'donations' => [
        'title' => 'Bağış yapın',
        'text' => 'Para bağışlayabileceğiniz birkaç sağlayıcıdan birini seçebilirsiniz. Karşılığında sunucumuzda ' . config('siteSettings.sro_silk_name', 'Silk') . ' alırsınız.',
        'no_methods' => 'Bulunan hiçbir yöntem yok, yönetici birini etkinleştirmedi.',
    ],

    'settings' => [
        'title' => 'Ayarlar',
        'form' => [
            'name' => 'İsim',
            'email' => 'E-Mail',
            'map' => 'Worldmap',
            'referral' => 'Referans link',
            'show-map' => 'Hesaplarınızı mapte gösterin',
            'silkroad-password' => 'Yeni silkroad şifresi',
            'silkroad-password-confirmation' => 'Silkroad şifresini onaylayın',
            'web-password' => 'Yeni web şifresi',
            'web-password-confirmation' => 'Web şifresini onaylayın',
            'current-web-password' => 'Mevcut web şifresi',
            'current-web-password-help' => 'Herhangi bir veriyi değiştirmek için bunu doldurmanız gerekiyor!',
            'submit' => 'Ayarları kaydet',
            'wrong-current-web-password' => 'Girilen şifre yanlış',
            'successfully' => 'Şifrenizi başarıyla değiştirdiniz.',
        ]
    ],

    'ref' => [
        'title' => 'Referans',
        'signature' => 'İmza',
        'no-signature' => 'Şu anda imza eklenmedi.',
        'your-ref' => 'referans kodunuz',
        'table' => [
            'name' => 'Hesap Adı',
            'date' => 'Tarih',
        ]
    ],

    'voucher' => [
        'title' => 'Kupon Kullan',
        'table' => [
            'voucher' => 'Kupon',
            'amount' => 'Miktar',
            'used-at' => 'Kullanıldığı tarih',
        ],
        'form' => [
            'voucher' => 'Kupon',
            'voucher-help' => 'Burada kupon kodunuzu kullanabilirsiniz',
            'submit' => 'Kullan'
        ],
    ],

    'tickets' => [
        'title' => 'Tickets',
        'create-new' => 'Yeni ticket',
        'table' => [
            'title' => 'Başlık',
            'state' => 'Durum',
            'priority' => 'Öncelik',
            'updated-at' => 'Güncellendiği Tarih',
            'action' => 'Aksiyon'
        ],

        'new' => [
            'title' => 'Yeni ticket',
            'form' => [
                'title' => 'Başlık',
                'category' => 'Kategori',
                'no-categories' => 'Şu anda henüz kategori yok',
                'priority' => 'Öncelik',
                'no-priorities' => 'Şu anda henüz Öncelik yok',
                'body' => 'Metin',
                'body-placeholder' => 'Burada isteğinizi açıklayabilirsiniz',
                'submit' => 'Ticket oluştur',
                'successfully' => 'Başarıyla bir Ticket oluşturdunuz.',
            ]
        ],
        'show' => [
            'title' => 'Ticket Detayı',
            'form' => [
                'title' => 'Başlık:',
                'category' => 'Kategori:',
                'priority' => 'Öncelik:',
                'state' => 'Durum:',
                'reply' => 'Cevap metni',
                'reply-placeholder' => 'Buraya cevabınızı yazabilirsiniz',
                'submit' => 'Ticket\'e cevap ver',
                'submit-close' => 'Ticket kapalı!',
                'closed-state' => 'Cevap verirken Ticket\'i yeniden açarsınız',
                'wrong-owner' => 'Bir sorun var, görünüşe göre ticket sahibi siz değilsiniz.',
                'successfully' => 'Bu Ticketi başarıyla cevapladınız.',
            ],
        ]
    ]
];
