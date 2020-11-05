<?php

return [
    'player' => [
        'title' => 'Karakter :charname16',
        'table' => [
            'name' => 'Adı:',
            'level' => 'Level:',
            'guild' => 'Guild:',
            'guild-none' => 'Yok',
            'values' => 'Values *:',
            'values-data' => '<b>Strength:</b> :str Points <b>Intellect:</b> :int Points',
            'experience' => 'Experience *:',
            'skillpoints' => 'Skillpoints *:',
            'health' => 'HP *:',
            'mana' => 'MP *:',
            'gold' => 'Gold *:',
            'online-state' => 'Çevrimiçi-Durum:',
            'last-logout' => 'Oyundan Son Çıkış:',
            'logged-in' => 'Çevrimiçi',
            'logged-out' => 'Çevrimdışı',
            'gm-info' => 'GM Info **',
            'gm-info-data' => 'User :jid',
            'silk' => config('siteSettings.sro_silk_name', 'Silk') . '**',
            'silk-no-entry' => 'No Information',

            'only-visible-user' => '* Only visible for you',
            'only-visible-gm' => '** Only visible for GMs',
            'only-visible-gm-user' => '* Only visible for the right User',

            'avatar' => 'Avatar:',
            'map-user' => 'Current position *:',
            'map-info' => 'Enabled for all players',
            'map-all' => 'Current position:',
        ],

        'equipment' => [
            'title' => 'Equipment',
            'inventory' => 'Inventory',
            'avatar' => 'Avatar',
        ]
    ],

    'guild' => [
        'title' => 'Guild :name',
        'itempoints' => 'Guild Item Puanı: :points',
        'master' => 'Guild Sahibi: :name',
        'table' => [
            'char' => 'Karakter',
            'level' => 'Level',
            'join' => 'Katıldığı tarih',
            'gp' => 'Bağışlanan Guild Puanı',
            'itempoints' => 'Item puanı',
        ],
    ]
];
