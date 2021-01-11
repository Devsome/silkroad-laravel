<?php

return [
    'title' => 'Casa de Subastas',
    'new' => 'Crear Subasta',
    'your' => 'Tus Subastas',
    'no-filter' => 'Sin Filtros',

    'add' => [
        'title' => 'Añadir Ítem a la Casa de Subastas',
        'back' => 'Regresar',
        'form' => [
            'web-inventory' => 'Inventario Web:',
            'selected-item' => 'Ítem seleccionado:',
            'gold-lost' => 'Advertencia, perderás :percent% del oro como a manera de impuesto cuando alguien compre tu ítem.',
            'price' => 'Precio',
            'price_help' => 'El precio inicial para ofertar.',
            'price_instead_help' => 'El precio para comprar el ítem ahora. Si lo dejas vacío, la compra instantánea no estará disponible.',
            'price_instead' => 'Precio para Comprar ahora',
            'until' => 'Hasta',
            'until_help' => 'La fecha y hora en que finaliza la Subasta.',
            'submit-item' => 'Crear Subasta',
            'no-item-help' => 'Si deseas añadir un ítem, por favor visita esta página',
            'no-item-help-href' => 'Inventario Web',
        ]
    ],

    'own' => [
        'title' => 'Tus Subastas',
        'back' => 'Regresar',
        'cancel-title' => 'Cancelar esta Subasta',
        'cancel-message' => '¿Estás seguro de que deseas cancelar la subasta por :item ?',
    ],

    'sidebar' => [
        'filter' => 'Filtrar',
        'weapon' => 'Armas',
        'equipment' => 'Equipamiento',
    ],

    'table' => [
        'item' => 'Item',
        'name' => 'Nombre',
        'price' => 'Precio',
        'price_instead' => 'Precio para comprar ahora',
        'until' => 'Hasta',
        'actions' => 'Subastas',
    ],

    'showitem' => [
        'title' => ':name',
        'own-item' => 'No puedes ofertar o comprar tu propio Ítem.',
        'expired' => 'Esta subasta ha expirado',
        'gold' => 'Oro',
        'npc_price' => 'Precio NPC',
        'price' => 'Precio de la oferta actual',
        'price_instead' => 'Precio para comprar ahora',
        'until' => 'Fecha hasta que la subasta está disponible',
        'bid_price' => 'Tu precio de oferta',
        'bid' => 'Oferta',
        'highest-user' => 'Actualmente eres el mejor postor',
        'current_bids' => '(Actualmente hay :amount ofertas por este Ítem.)',
        'buy_now_text' => 'Puedes comprar este Ítem ahora',
        'buy_now' => '¡Comprar ahora!',
    ],

    'notification' => [
        'add' => [
            'successfully' => 'Ítem añadido Exitosamente a la Casa de Subastas',
            'price' => 'El Precio para comprar ahora no puede ser más bajo que el precio regular.',
            'not-item' => 'Este no es tu Ítem, ¿qué estás intentando?',
        ],
        'buy' => [
            'successfully' => 'Compraste el Ítem exitosamente, revisa tu Inventario Web.',
            'not-enough-gold' => 'No tienes suficiente Oro en tu Inventario Web.',
            'until' => 'La Fecha para comprar el ítem ha expirado.',
            'price-0' => 'El precio para comprar ahora es  0, ¡así que no puedes comprarlo!',
            'error' => 'Ocurrió un error, por favor intenta de nuevo.',
        ],
        'cancel' => [
            'successfully' => '¡Cancelaste esta Subasta Exitosamente!',
        ],
        'bid' => [
            'successfully' => 'Ahora eres el mejor postor en esta Subasta',
            'not-enough-gold' => 'No tienes suficiente Oro en tu Inventario Web.',
            'until' => 'La Fecha para comprar el ítem ha expirado.',
            'not-highest' => 'Alguien acaba de realizar una oferta y es mayor que tu precio actual',
            'error' => 'Ocurrió un error, por favor intenta de nuevo.',
            'already' => 'Ya eres el mejor postor.',
            'bid-higher' => 'No puedes realizar una oferta mayor que el precio de compra inmediata',
        ]
    ],
];
