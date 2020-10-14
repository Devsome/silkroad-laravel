<?php

return [
    'title' => 'Donations Control panel',
    'methods' => [
        'title' => 'Enable / Disable your Donations methods',
        'activate' => 'Activate',
        'slug' => 'Unique url + blade template name:',
        'submit' => 'Save your methods',
    ],
    'logging' => [
        'title' => 'Donations Logging',
        'table' => [
            'user_id' => 'User',
            'name' => 'Name',
            'price' => 'Price',
            'silk' => 'Silk',
            'date' => 'Created at',
        ]
    ],
    'paypal' => [
        'title' => 'PayPal',
        'disabled' => 'This method is currently disabled.',

        'panel-title' => 'Add new amount',
        'add' => 'Add new amount',

        'name' => 'Name',
        'name-help' => 'The name is shown to the user',
        'description' => 'Description',
        'price' => 'Price',
        'price-help' => 'The final amount the user has to pay',
        'silk' => 'Silk',
        'silk-help' => 'The Silk the user gains',
        'action' => 'Action',

        'modal' => [
            'title' => 'Are you sure',
            'message' => 'That you want to delete ":name" from the List?'
        ]
    ]
];
