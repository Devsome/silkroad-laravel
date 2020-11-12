<?php

return [
    'title' => 'Vote for silk Settings',
    'table' => [
        'title' => 'List for all available vote for silk',
        'id' => 'ID',
        'name' => 'Name',
        'name-help' => 'That name is shown to the user.',
        'reward' => 'Reward',
        'reward-help' => 'The amount the user should receive when he voted.',
        'waiting' => 'Waiting hours',
        'waiting-help' => 'How many hours should the user wait.',
        'active' => 'State',
        'action' => 'Action',
        'state-active' => 'Active',
        'state-inactive' => 'Inactive',
        'empty' => 'Maybe you dont run php artisan db:seed to fill it',
    ],
    'modal' => [
        'title' => 'Are you sure?',
        'message' => 'That you want to toggle that ":name"?',
    ],
    'edit' => [
        'title' => 'Editing Vote',
        'title-help' => 'Editing ":name" vote',


        'back' => 'Return back',
        'submit' => 'Save vote',
    ]
];
