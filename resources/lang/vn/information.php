<?php

return [
    'player' => [
        'title' => 'Nhân Vật :charname16',
        'table' => [
            'name' => 'Tên:',
            'level' => 'Level:',
            'guild' => 'Guild:',
            'guild-none' => 'Không Có',
            'values' => 'Trị Số *:',
            'values-data' => '<b>Sức Mạnh:</b> :str Điểm <b>Trí Tuệ:</b> :int Điểm',
            'experience' => 'Kinh Nghiệm *:',
            'skillpoints' => 'Điểm Kỹ Năng *:',
            'health' => 'HP *:',
            'mana' => 'MP *:',
            'gold' => 'Gold *:',
            'online-state' => 'Trạng Thái-Online:',
            'last-logout' => 'Lần Cuối Cùng Đăng Xuất:',
            'logged-in' => 'Đăng Nhập',
            'logged-out' => 'Đã Đăng Xuất',
            'gm-info' => 'Thông Tin GM **',
            'gm-info-data' => 'Người Dùng :jid',
            'silk' => config('siteSettings.sro_silk_name', 'Silk') . '**',
            'silk-no-entry' => 'Không Có Thông Tin',

            'only-visible-user' => '* Chỉ Hiển Thị Cho Bạn',
            'only-visible-gm' => '** Chỉ Hiển Thị Cho GMs',
            'only-visible-gm-user' => '* Chỉ Hiển Thị Cho Đúng Người Dùng',

            'avatar' => 'Avatar:',
            'map-user' => 'Vị Trí Hiện Tại *:',
            'map-info' => 'Đã Bật Cho Tất Cả Người Chơi',
            'map-all' => 'Vị Trí Hiện Tại:',
        ],

        'equipment' => [
            'title' => 'Trang Bị',
            'inventory' => 'Thùng Đồ',
            'avatar' => 'Avatar',
        ]
    ],

    'guild' => [
        'title' => 'Guild :name',
        'itempoints' => 'Điểm Trang Bị Guild: :points',
        'master' => 'Chủ Guild: :name',
        'table' => [
            'char' => 'Nhân Vật',
            'level' => 'Level',
            'join' => 'Đã Tham Gia',
            'gp' => 'Điểm Cống Hiến Guild',
            'itempoints' => 'Điểm Trang Bị',
        ],
    ]
];
