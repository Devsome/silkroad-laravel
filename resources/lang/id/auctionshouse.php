<?php

return [
    'title' => 'Rumah Lelang',
    'new' => 'Buat Lelang',
    'your' => 'Your own Auctions',
    'no-filter' => 'Currently no Filters',

    'add' => [
        'title' => 'Tambahkan Item ke Rumah Lelang',
        'back' => 'Kembali',
        'form' => [
            'web-inventory' => 'Penyimpanan Web:',
            'selected-item' => 'Item Terpilih:',
            'gold-lost' => 'Peringatan, Anda akan kehilangan :percent% emas sebagai pajak ketika seseorang membeli item Anda.',
            'price' => 'Harga',
            'price_help' => 'Harga awal untuk bertaruh.',
            'price_instead_help' => 'Harga untuk membeli item sekarang. Jika Anda membiarkannya kosong, tidak ada pembelian yang tersedia.',
            'price_instead' => 'Harga membeli sekarang',
            'until' => 'Sampai',
            'until_help' => 'Tanggal waktu Lelang berakhir.',
            'submit-item' => 'Buat Lelang',
            'no-item-help' => 'Jika Anda ingin menambahkan Item, silakan buka halaman ini',
            'no-item-help-href' => 'Penyimpanan-Web',
        ]
    ],

    'own' => [
        'title' => 'Lelang Milik Anda',
        'back' => 'Kembali',
        'cancel-title' => 'Batalkan lelang ini',
        'cancel-message' => 'Yakin ingin membatalkan lelang untuk :item ?',
    ],

    'sidebar' => [
        'filter' => 'Penyaringan',
        'weapon' => 'Senjata',
        'equipment' => 'Peralatan',
    ],

    'table' => [
        'name' => 'Nama',
        'price' => 'Harga',
        'price_instead' => 'Harga Beli Sekarang',
        'until' => 'Sampai',
        'actions' => 'Aksi',
    ],

    'showitem' => [
        'title' => ':name',
        'own-item' => 'Anda tidak dapat menawar atau membeli Item Anda sendiri.',
        'expired' => 'Lelang ini telah kedaluwarsa',
        'gold' => 'Emas',
        'npc_price' => 'Harga NPC',
        'price' => 'Penawaran Harga Sekarang',
        'price_instead' => 'Harga Beli Sekarang',
        'until' => 'Tanggal hingga lelang berjalan',
        'bid_price' => 'Tawaran Harga Anda',
        'bid' => 'Tawaran',
        'highest-user' => 'Anda sekarang adalah penawar tertinggi.',
        'current_bids' => '(Saat ini ada :amount tawaran pada Item itu.)',
        'buy_now_text' => 'Anda bisa beli item ini sekarang.',
        'buy_now' => 'Beli sekarang!',
    ],

    'notification' => [
        'add' => [
            'successfully' => 'Item Berhasil ditambahkan ke Rumah Lelang',
            'price' => 'Harga beli sekarang tidak bisa lebih rendah dari harga normal.',
            'not-item' => 'Ini bukan Item Anda, apa yang Anda coba?',
        ],
        'buy' => [
            'successfully' => 'Anda berhasil membeli Item tersebut, periksa Inventaris Web Anda.',
            'not-enough-gold' => 'Anda tidak memiliki cukup Emas di Inventaris Web Anda.',
            'until' => 'Waktu untuk membeli barang itu telah berlalu.',
            'price-0' => 'Harga beli sekarang adalah 0, jadi anda tidak bisa membelinya!',
            'error' => 'Ada yang tidak beres, coba lagi.',
        ],
        'cancel' => [
            'successfully' => 'Anda berhasil membatalkan Lelang ini!',
        ],
        'bid' => [
            'successfully' => 'Anda sekarang adalah yang tertinggi di Lelang ini',
            'not-enough-gold' => 'Anda tidak memiliki cukup Emas di Inventaris Web Anda.',
            'until' => 'Waktu untuk membeli barang itu telah berlalu.',
            'not-highest' => 'Seseorang baru saja mengajukan tawaran dan itu lebih tinggi dari harga Anda saat ini',
            'error' => 'Ada yang tidak beres, coba lagi.',
            'already' => 'Anda sudah menjadi orang dengan tawaran tertinggi.',
            'bid-higher' => 'Anda tidak dapat menawar lebih tinggi dari harga pembelian langsung',
        ]
    ],
];
