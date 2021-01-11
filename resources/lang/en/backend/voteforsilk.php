<?php

return [
    'title' => 'Vote for silk Settings',
    'pingback-strong' => 'Important:',
    'pingback' => 'Please use this <mark>:site</mark> as pingback for the voting sites.',
    'table' => [
        'title' => 'List for all available vote for silk',
        'id' => 'ID',
        'name' => 'Name',
        'name-help' => 'That name is shown to the user.',
        'reward' => 'Reward',
        'reward-help' => 'The amount the user should receive when he voted.',
        'pingback' => 'Voting url:',
        'pingback-help' => 'Please replace the Information in the {} with yours',
        'pingback-info' => 'Please do not change {JID} this is filled automatic with the User JID.',
        'pingback-legend' => '{SID} => Server ID',
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
