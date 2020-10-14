<?php

return [
    'player' => [
        'title' => 'खिलाड़ी :charname16',
        'table' => [
            'name' => 'नाम:',
            'level' => 'स्तर:',
            'guild' => 'समाज:',
            'guild-none' => 'कोई नहीं',
            'values' => 'के मान *:',
            'values-data' => '<b>शक्ति:</b> :str अंक <b>बुद्धि:</b> :int अंक',
            'experience' => 'अनुभव *:',
            'skillpoints' => 'हुनरअंक *:',
            'health' => 'स्वास्थय अंक *:',
            'mana' => 'जादू अंक *:',
            'gold' => 'सोना *:',
            'online-state' => 'ऑनलाइन-स्टेट:',
            'last-logout' => 'अंतिम लॉगआउट:',
            'logged-in' => 'आप लॉग इन हैं',
            'logged-out' => 'आप लॉग आउट हैं',
            'gm-info' => 'ग.म. के बारे में जानकारी **',
            'gm-info-data' => 'उपयोगकर्ता :jid',
            'silk' => config('siteSettings.sro_silk_name', 'Silk') . '**',
            'silk-no-entry' => 'कोई सूचना नहीं',

            'only-visible-user' => '* केवल आपके लिए दृश्यमान है',
            'only-visible-gm' => '** केवल ग.म. के लिए दिखाई देता है',
            'only-visible-gm-user' => '* केवल सही उपयोगकर्ता के लिए दृश्यमान',

            'avatar' => 'अवतार:',
            'map-user' => 'वर्तमान पद *:',
            'map-info' => 'सभी खिलाड़ियों के लिए सक्षम',
            'map-all' => 'वर्तमान पद:',
        ],

        'equipment' => [
            'title' => 'उपकरण',
            'inventory' => 'इन्वेंटरी',
            'avatar' => 'अवतार',
        ]
    ],
    'guild' => [
        'title' => 'समाज :name',
        'itempoints' => 'गिल्ड आइटम अंक: :points',
        'master' => 'गिल्ड मास्टर: :name',
        'table' => [
            'char' => 'व्यक्ति',
            'level' => 'स्तर',
            'join' => 'जब आप में शामिल हुए',
            'gp' => 'दान किए हुए गिल्ड अंक',
            'itempoints' => 'आइटम अंक',
        ],
    ],
];
