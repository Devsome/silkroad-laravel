<?php

return [
    'title' => 'Açık Artırma',
    'new' => 'Açık Artırma Oluştur',
    'your' => 'Mevcut Açık Artırmalarınız',
    'no-filter' => 'Şu anda Filtre yok',

    'add' => [
        'title' => 'Açık arttırmaya item ekle',
        'back' => 'Geri dön',
        'form' => [
            'web-inventory' => 'Web Envanteri:',
            'selected-item' => 'Seçilen Item:',
            'gold-lost' => 'Uyarı, birisi iteminizi aldığında item fiyatının %:percent\'i işlem vergisi olarak alınacaktır.',
            'price' => 'Fiyat',
            'price_help' => 'Iteme verilen başlangıç fiyatıdır.',
            'price_instead_help' => 'Itemi şimdi satın almanın fiyatı. Bunu boş bırakırsanız, bu item üzerinde satın alma işlemi yapılamaz.',
            'price_instead' => 'Hemen Al fiyatı',
            'until' => '\'a kadar.',
            'until_help' => 'Açık Artırmanın sona ereceği tarih.',
            'submit-item' => 'Açık artırma oluştur',
            'no-item-help' => 'Bir Item eklemek istiyorsanız, lütfen bu sayfaya gidin',
            'no-item-help-href' => 'Web-Envanteri',
        ]
    ],

    'own' => [
        'title' => 'Mevcut açık artırmalarınız',
        'back' => 'Geri dön',
        'cancel-title' => 'Bu açık artırmayı iptal et',
        'cancel-message' => ':item üzerinde Açık artırmayı iptal etmek istediğinizden emin misiniz?',
    ],

    'sidebar' => [
        'filter' => 'Filtre',
        'weapon' => 'Silahlar',
        'equipment' => 'Giysiler',
    ],

    'table' => [
        'name' => 'Adı',
        'price' => 'Fiyat',
        'price_instead' => 'Hemen Al fiyatı',
        'until' => '\'a kadar',
        'actions' => 'Aksiyon',
    ],

    'showitem' => [
        'title' => ':name',
        'own-item' => 'Kendi Iteminize fiyat teklif edemez veya satın alamazsınız.',
        'expired' => 'Bu açık artırmanın süresi doldu',
        'gold' => 'Gold',
        'npc_price' => 'NPC Fiyatı',
        'price' => 'Mevcut verilen teklif fiyatı',
        'price_instead' => 'Hemen Al fiyatı',
        'until' => 'Açık artırmanın başlayacağı tarih',
        'bid_price' => 'Teklif fiyatınız',
        'bid' => 'Teklif ver',
        'highest-user' => 'Şu anda en yüksek teklifi veren sizsiniz',
        'current_bids' => '(Şu anda bu item için :amount teklif bulunuyor.)',
        'buy_now_text' => 'Bu itemi şimdi satın alabilirsiniz',
        'buy_now' => 'Hemel al!',
    ],

    'notification' => [
        'add' => [
            'successfully' => 'Item Açık artırma kısmına başarıyla eklendi',
            'price' => 'Hemel al fiyatı normal fiyattan daha düşük olamaz.',
            'not-item' => 'Bu senin itemin değil, ne deniyorsun?',
        ],
        'buy' => [
            'successfully' => 'Bu Itemi başarıyla satın aldınız, Web Envanterinizi kontrol edin.',
            'not-enough-gold' => 'Web Envanterinizde yeterli Goldunuz yok.',
            'until' => 'Bu itemi satın alma süresi geçti.',
            'price-0' => 'Şimdi satın al fiyatı 0, yani satın alamazsınız!',
            'error' => 'Bir şeyler ters gitti, lütfen tekrar deneyin.',
        ],
        'cancel' => [
            'successfully' => 'Bu Açık Artırmaları Başarıyla iptal ettiniz!',
        ],
        'bid' => [
            'successfully' => 'Şu anda en yüksek teklifi veren sizsiniz',
            'not-enough-gold' => 'Web Envanterinizde yeterli Goldunuz yok.',
            'until' => 'Bu itemi satın alma süresi geçti.',
            'not-highest' => 'Birisi az önce bir teklif verdi ve bu sizin mevcut teklifinizden daha yüksek',
            'error' => 'Bir şeyler ters gitti, lütfen tekrar deneyin.',
            'already' => 'Zaten en yüksek teklifi veren sizsiniz.',
            'bid-higher' => 'Hemen satın alma fiyatından daha yüksek teklif veremezsiniz',
        ]
    ],
];
