<?php

return [
    'title' => 'Dashboard',
    'grid' => [
        'char-list' => 'Daftar Karakter',
        'char-list-desc' => 'Di sini Anda dapat melihat karakter Anda sendiri dengan informasi tambahan.',
        'settings' => 'Pengaturan',
        'settings-desc' => 'Dalam pengaturan, Anda dapat mengubah kata sandi, surel, dan perubahan lainnya. Jika Anda melewatkan sesuatu, beri tahu kami.',
        'donation' => 'Donasi',
        'donation-desc' => 'Di bawah titik ini Anda dapat melakukan sesuatu yang baik dan mendukung kami! Sebagai ucapan terima kasih, Anda akan mendapatkan :silk dalam permaianan.',
        'other' => 'Misc',
        'other-desc' => 'Segala sesuatu yang belum ditempatkan secara tepat, dapat ditemukan di bawah poin ini.',
        'ref' => 'Referral',
        'ref-desc' => 'Untuk melihat siapa yang telah Anda undang dan berapa banyak yang Anda peroleh, klik di sini.',
        'tickets' => 'Tiket',
        'tickets-desc' => 'Anda punya masalah atau permintaan? Di sini Anda dapat membuat tiket dan kami akan mengurusnya.',
        'voucher' => 'Voucher',
        'voucher-desc' => 'Anda memiliki catatan kredit dan ingin menebusnya :silk? Kemudian Anda dapat menebus yang ini',
        'web-inventory' => 'Inventaris Web',
        'web-inventory-help' => 'Di sini Anda dapat menemukan "Inventaris" tempat item yang dibeli atau dijual.',
    ],

    'chars-list' => [
        'title' => 'Daftar Karakter',
        'no-chars' => 'Harap buat karakter untuk fungsi selanjutnya.',
        'last-logout' => 'Terakhir Keluar:',
        'level' => 'Level:',
        'gold' => 'Emas:',
        'guild' => 'Guild:',
        'logged-in' => 'Masuk',
        'logged-out' => 'Keluar',
    ],

    'donations' => [
        'title' => 'Donasi',
        'text' => 'Anda dapat memilih salah satu dari beberapa penyedia tempat Anda dapat menyumbangkan uang. Sebagai imbalannya Anda mendapatkan ' . config('siteSettings.sro_silk_name', 'Silk') . ' di server kami.',
        'no_methods' => 'Tidak ada metode yang ditemukan, administrator tidak mengaktifkannya.',
    ],

    'settings' => [
        'title' => 'Pengaturan',
        'form' => [
            'name' => 'Nama',
            'email' => 'Surel',
            'map' => 'Peta Dunia',
            'referral' => 'Tautan rujukan',
            'show-map' => 'Tunjukkan akun Anda di peta',
            'silkroad-password' => 'Kata sandi silkroad baru',
            'silkroad-password-confirmation' => 'Konfirmasi kata sandi silkroad',
            'web-password' => 'Kata sandi web baru',
            'web-password-confirmation' => 'Konfirmasikan kata sandi web',
            'current-web-password' => 'Kata sandi web saat ini',
            'current-web-password-help' => 'Anda perlu mengisi ini untuk mengubah data apa pun!',
            'submit' => 'Simpan Pengaturan',
            'wrong-current-web-password' => 'Kata sandi yang dimasukkan salah',
            'successfully' => 'Anda telah berhasil mengubah data Anda.',
        ]
    ],

    'ref' => [
        'title' => 'Referral',
        'signature' => 'Tanda tangan',
        'no-signature' => 'Saat ini tidak ada tanda tangan yang ditambahkan.',
        'your-ref' => 'Referral anda',
        'table' => [
            'name' => 'Nama akun',
            'date' => 'Tanggal',
        ]
    ],

    'voucher' => [
        'title' => 'Tukarkan Voucher',
        'table' => [
            'voucher' => 'Voucher',
            'amount' => 'Jumlah',
            'used-at' => 'Digunakan di',
        ],
        'form' => [
            'voucher' => 'Voucher',
            'voucher-help' => 'Di sini Anda dapat menebus kode kredit Anda',
            'submit' => 'Tebus'
        ],
    ],

    'tickets' => [
        'title' => 'Tiket',
        'create-new' => 'Tiket baru',
        'table' => [
            'title' => 'Judul',
            'state' => 'Negara',
            'priority' => 'Prioritas',
            'updated-at' => 'Diperbarui pada',
            'action' => 'Aksi'
        ],

        'new' => [
            'title' => 'Tiket Baru',
            'form' => [
                'title' => 'Judul',
                'category' => 'Kategori',
                'no-categories' => 'Saat ini belum ada kategori',
                'priority' => 'Prioritas',
                'no-priorities' => 'Saat ini belum ada Prioritas',
                'body' => 'Teks',
                'body-placeholder' => 'Di sini Anda dapat menjelaskan permintaan Anda',
                'submit' => 'Buat Tiket',
                'successfully' => 'Anda berhasil membuat tiket.',
            ]
        ],
        'show' => [
            'title' => 'Menampilkan Tiket',
            'form' => [
                'title' => 'Judul:',
                'category' => 'Kategori:',
                'priority' => 'Prioritas:',
                'state' => 'Negara:',
                'reply' => 'Teks balasan',
                'reply-placeholder' => 'Di sini Anda bisa menulis jawaban Anda',
                'submit' => 'Balas tiketnya',
                'submit-close' => 'Tiket ditutup!',
                'closed-state' => 'Saat membalas, Anda membuka kembali tiketnya',
                'wrong-owner' => 'Ada yang tidak beres, sepertinya Anda bukan pemegang tiketnya.',
                'successfully' => 'Anda telah berhasil menjawab tiket ini.',
            ],
        ]
    ]
];
