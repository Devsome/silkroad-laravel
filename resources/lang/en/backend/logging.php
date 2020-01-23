<?php

return [
    'smc' => [
        'title' => 'SMC Logging',
        'table' => [
            'szuserid' => 'szUserId',
            'catagory' => 'Category',
            'szlog' => 'Log',
            'dlogdate' => 'Date'
        ]
    ],

    'users' => [
        'title' => 'Created Users Accounts',
        'menu-title' => 'Showing for the last :end days',
        'info' => 'At every night there runs a job for getting the newest created accounts.',
    ],

    'chart' => [
        'tooltip-title' => 'Accounts',
    ]
];
