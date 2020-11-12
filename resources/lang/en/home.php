<?php

return [
    'title' => 'Dashboard',
    'grid' => [
        'char-list' => 'Char list',
        'char-list-desc' => 'Here you can see your own characters with additional information.',
        'settings' => 'Settings',
        'settings-desc' => 'In the settings you can change your passwords, e-mail and other changes. If you miss something, let us know.',
        'donation' => 'Donations',
        'donation-desc' => 'Under this point you can do something good and support us! As a thank you you will get :silk in the game.',
        'other' => 'Misc',
        'other-desc' => 'Everything that has not yet been placed exactly, can be found under this point.',
        'ref' => 'Referral',
        'ref-desc' => 'To see who you have already invited and how much you have earned, click here.',
        'tickets' => 'Tickets',
        'tickets-desc' => 'You have a problem or a request? Here you can create a ticket and we will take care of it.',
        'voucher' => 'Voucher',
        'voucher-desc' => 'You have a credit note and want to redeem it for :silk? Then you can redeem this one',
        'web-inventory' => 'Web Inventory',
        'web-inventory-help' => 'Here you can find your "Inventory" where your bought or sold items are.',
        'voteforsilk' => 'Vote for silk',
        'voteforsilk-help' => 'You want to gain easy silk? Here you can vote for our Server and gain some.',
    ],

    'chars-list' => [
        'title' => 'Char list',
        'no-chars' => 'Please create a character for further functions.',
        'last-logout' => 'Last Logout:',
        'level' => 'Level:',
        'gold' => 'Gold:',
        'guild' => 'Guild:',
        'logged-in' => 'Logged in',
        'logged-out' => 'Logged out',
    ],

    'donations' => [
        'title' => 'Donations',
        'text' => 'You can choose one of several providers where you can donate money. In return you get ' . config('siteSettings.sro_silk_name', 'Silk') . ' on our server.',
        'no_methods' => 'No methods where found, the administrator did not activated one.',
    ],

    'settings' => [
        'title' => 'Settings',
        'form' => [
            'name' => 'Name',
            'email' => 'E-Mail',
            'map' => 'Worldmap',
            'referral' => 'Referral link',
            'show-map' => 'Show your accounts on the map',
            'silkroad-password' => 'New silkroad password',
            'silkroad-password-confirmation' => 'Confirm silkroad password',
            'web-password' => 'New web password',
            'web-password-confirmation' => 'Confirm web password',
            'current-web-password' => 'Current web password',
            'current-web-password-help' => 'You need to fill this to change any data!',
            'submit' => 'Save settings',
            'wrong-current-web-password' => 'The entered password is wrong',
            'successfully' => 'You have successfully changed your data.',
        ]
    ],

    'ref' => [
        'title' => 'Referral',
        'signature' => 'Signature',
        'no-signature' => 'Currently is no signature added.',
        'your-ref' => 'Your referral',
        'table' => [
            'name' => 'Account Name',
            'date' => 'Date',
        ]
    ],

    'voucher' => [
        'title' => 'Redeem Voucher',
        'table' => [
            'voucher' => 'Voucher',
            'amount' => 'Amount',
            'used-at' => 'Used at',
        ],
        'form' => [
            'voucher' => 'Voucher',
            'voucher-help' => 'Here you can redeem your credit code',
            'submit' => 'Redeem'
        ],
    ],

    'voteforsilk' => [
        'title' => 'Vote for silk',
        'reward' => 'You will gain :reward ' . config('siteSettings.sro_silk_name', 'Silk') . ' for that vote.',
        'empty' => 'No votes active until yet',
        'wait' => 'Wait :time minutes',
        'submit' => 'Vote now!',
    ],

    'tickets' => [
        'title' => 'Tickets',
        'create-new' => 'New ticket',
        'table' => [
            'title' => 'Title',
            'state' => 'State',
            'priority' => 'Priority',
            'updated-at' => 'Updated at',
            'action' => 'Action'
        ],

        'new' => [
            'title' => 'New ticket',
            'form' => [
                'title' => 'Title',
                'category' => 'Category',
                'no-categories' => 'Currently there are no categories yet',
                'priority' => 'Priority',
                'no-priorities' => 'Currently there are no Priorities yet',
                'body' => 'Text',
                'body-placeholder' => 'Here you can describe your request',
                'submit' => 'Create ticket',
                'successfully' => 'You have successfully created a ticket.',
            ]
        ],
        'show' => [
            'title' => 'Showing Ticket',
            'form' => [
                'title' => 'Title:',
                'category' => 'Category:',
                'priority' => 'Priority:',
                'state' => 'State:',
                'reply' => 'Reply text',
                'reply-placeholder' => 'Here you can write your answer',
                'submit' => 'Reply to the ticket',
                'submit-close' => 'Ticket closed!',
                'closed-state' => 'When replying you reopen the ticket',
                'wrong-owner' => 'Something\'s not right, looks like you\'re not the ticket holder.',
                'successfully' => 'You have successfully answered to this ticket.',
            ],
        ]
    ]
];
