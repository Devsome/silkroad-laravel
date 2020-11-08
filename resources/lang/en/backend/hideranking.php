<?php

return [
    'title' => 'Hide Players in Ranking',
    'table' => [
        'charname' => 'Charname',
        'actions' => 'Actions'
    ],
    'delete-title' => 'Are you sure',
    'delete-message' => 'That you want to delete ":charname" from the List?',
    'form' => [
        'title' => 'Add new Charname',
        'charname' => 'Charname:',
        'hide-gamemaster' => 'Hide all Gamemaster accounts',
        'submit' => 'Save',
    ],

    'guild' => [
        'title' => 'Hide Guild in Ranking',
        'table' => [
            'guild' => 'Guild',
            'actions' => 'Actions'
        ],
        'delete-title' => 'Are you sure',
        'delete-message' => 'That you want to delete ":guild" from the List?',
        'form' => [
            'title' => 'Add new Guild',
            'title-help' => 'Every Character in that guild are also hide in the ranking!',
            'guild' => 'Guild:',
            'submit' => 'Save',
        ],
    ]
];
