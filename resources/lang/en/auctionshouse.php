<?php

return [
    'title' => 'Auctions House',
    'new' => 'Create Auction',
    'your' => 'Your own Auctions',
    'no-filter' => 'Currently no Filters',

    'add' => [
        'title' => 'Add Item to Auctions House',
        'back' => 'Back',
        'form' => [
            'web-inventory' => 'Web Inventory:',
            'selected-item' => 'Selected Item:',
            'gold-lost' => 'Warning, you will lose :percent% of the gold as a tax when someone buys your item.',
            'price' => 'Price',
            'price_help' => 'The start price for betting on it.',
            'price_instead_help' => 'The price for buying the item now. If you leave this empty, no instead buy is available.',
            'price_instead' => 'Buy now Price',
            'until' => 'Until',
            'until_help' => 'The datetime the Auction is ending.',
            'submit-item' => 'Create Auction',
        ]
    ],

    'own' => [
        'title' => 'Your own Auctions',
        'back' => 'Back',
        'cancel-title' => 'Cancel this Auction',
        'cancel-message' => 'Are you sure you want to cancel the auction for :item ?',
    ],

    'sidebar' => [
        'filter' => 'Filter',
        'weapon' => 'Weapons',
        'equipment' => 'Equipment',
    ],

    'table' => [
        'name' => 'Name',
        'price' => 'Price',
        'price_instead' => 'Buy now Price',
        'until' => 'Until',
        'actions' => 'Actions',
    ],

    'showitem' => [
        'title' => ':name',
        'own-item' => 'You can not bid or buy your own Item.',
        'expired' => 'This auction has expired',
        'gold' => 'Gold',
        'npc_price' => 'NPC price',
        'price' => 'Current bid price',
        'price_instead' => 'Buy now price',
        'until' => 'Date until the auction is running',
        'bid_price' => 'Your bid price',
        'bid' => 'Bid',
        'highest-user' => 'You are currently the highest bidder',
        'current_bids' => '(There are currently :amount bids on that Item.)',
        'buy_now_text' => 'You can buy this Item now',
        'buy_now' => 'Buy now!',
    ],

    'notification' => [
        'add' => [
            'successfully' => 'Item Successfully added to the Auctions House',
            'price' => 'The Price of buying now can not be lower then the normal price.',
            'not-item' => 'This is not your Item, what are you trying?',
        ],
        'buy' => [
            'successfully' => 'You bought that Item successfully, check your Web Inventory.',
            'not-enough-gold' => 'You do not have enough Gold on your Web Inventory.',
            'until' => 'The Time for buying that item has passed.',
            'error' => 'Something went wrong, please try it again.',
        ],
        'cancel' => [
            'successfully' => 'You canceld this Auctions Successfully!',
        ],
        'bid' => [
            'successfully' => 'You are now the highest on this Auction',
            'not-enough-gold' => 'You do not have enough Gold on your Web Inventory.',
            'until' => 'The Time for buying that item has passed.',
            'not-highest' => 'Someone just placed a bid and it\'s higher than your current price',
            'error' => 'Something went wrong, please try it again.',
            'already' => 'You are already the one with the highest bid.',
            'bid-higher' => 'You cannot bid higher than the immediate purchase price',
        ]
    ],
];
