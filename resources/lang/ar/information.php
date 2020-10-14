<?php

return [
    'player' => [
        'title' => 'الشخصية :charname16',
        'table' => [
            'name' => 'الاسم:',
            'level' => 'المستوى:',
            'guild' => 'النقابة:',
            'guild-none' => 'لايوجد',
            'values' => 'Values *:',
            'values-data' => '<b>Strength:</b> :str Points <b>Intellect:</b> :int Points',
            'experience' => 'Experience *:',
            'skillpoints' => 'Skillpoints *:',
            'health' => 'HP *:',
            'mana' => 'MP *:',
            'gold' => 'Gold *:',
            'online-state' => 'الحالة:',
            'last-logout' => 'آخر خروج:',
            'logged-in' => 'تم الدخول:',
            'logged-out' => 'تم الخروج',
            'gm-info' => 'GM معلومات لـ **',
            'gm-info-data' => 'الحساب :jid',
            'silk' => config('siteSettings.sro_silk_name', 'Silk') . '**',
            'silk-no-entry' => 'لا يوجد معلومات',

            'only-visible-user' => 'تظهر لك فقط *',
            'only-visible-gm' => '** GMsتظهر فقط لـ',
            'only-visible-gm-user' => ' تظهر فقط للمستخدم المالك *',

            'avatar' => 'الصورة الرمزية:',
            'map-user' => 'الموقع الحالي *:',
            'map-info' => 'مفعل لجميع اللاعبين',
            'map-all' => 'الموقع الحالي:',
        ],

        'equipment' => [
            'title' => 'Equipment',
            'inventory' => 'Inventory',
            'avatar' => 'Avatar',
        ]
    ],

    'guild' => [
        'title' => 'النقابة :name',
        'itempoints' => 'Guild Item Points: :points',
        'master' => 'رئيس النقابة: :name',
        'table' => [
            'char' => 'Char',
            'level' => 'Level',
            'join' => 'Joined at',
            'gp' => 'Donated Guild Points',
            'itempoints' => 'Item Points',
        ],
    ]
];
