<?php

return [
    'player' => [
        'title' => 'Karakter :charname16',
        'table' => [
            'name' => 'Nama:',
            'level' => 'Level:',
            'guild' => 'Guild:',
            'guild-none' => 'none',
            'values' => 'Isi *:',
            'values-data' => '<b>Kekuatan:</b> :str Poin <b>Kecerdasan:</b> :int Point',
            'experience' => 'Pengalaman *:',
            'skillpoints' => 'Point Skill *:',
            'health' => 'HP *:',
            'mana' => 'MP *:',
            'gold' => 'Emas *:',
            'online-state' => 'Negara Online:',
            'last-logout' => 'Terakhir Keluar:',
            'logged-in' => 'Masuk',
            'logged-out' => 'Keluar',
            'gm-info' => 'GM Info **',
            'gm-info-data' => 'Pengguna :jid',
            'silk' => config('siteSettings.sro_silk_name', 'Silk') . '**',
            'silk-no-entry' => 'Tidak ada informasi',

            'only-visible-user' => '* Hanya terlihat oleh anda',
            'only-visible-gm' => '** Hanya terlihat oleh GM',
            'only-visible-gm-user' => '* Hanya terlihat oleh pemain yang berhak',

            'avatar' => 'Avatar:',
            'map-user' => 'Posisi sekarang *:',
            'map-info' => 'Diaktifkan untuk semua pemain',
            'map-all' => 'Posisi sekarang:',
        ],

        'equipment' => [
            'title' => 'Peralatan',
            'inventory' => 'Inventaris',
            'avatar' => 'Avatar',
        ]
    ],

    'guild' => [
        'title' => 'Guild :name',
        'itempoints' => 'Guild Item Point: :points',
        'master' => 'Ketua Guild: :name',
        'table' => [
            'char' => 'Karakter',
            'level' => 'Level',
            'join' => 'Bergabung pada',
            'gp' => 'Donasi Point Guild',
            'itempoints' => 'Item Point',
        ],
    ]
];
