<?php

/*
|--------------------------------------------------------------------------
| Timer Settings
|--------------------------------------------------------------------------
|
| For the icons, check this link out: https://fontawesome.com/icons?m=free
| Look at the examples what stuff you can configure
|
*/

return [
    [
        'name' => 'Capture the flag',
        'hours' => [
            0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23
        ],
        'min' => 30,
    ],
    [
        'name' => 'Fortresswar',
        'days' => [
            'Sunday',
            'Monday',
        ],
        'hour' => 8,
        'min' => 14,
    ],
    [
        'name' => 'Register',
        'type' => 'static',
        'time' => 'Saturday 12:00 - 23:00',
        'icon' => 'fas fa-clock',
    ],
    [
        'name' => 'Medusa',
        'hours' => [
            1,22,23
        ],
        'min' => 14,
        'icon' => 'fas fa-crosshairs',
    ],
];
