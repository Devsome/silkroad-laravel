<?php

return [
    'title' => 'Tablero',
    'grid' => [
        'char-list' => 'Lista de personajes',
        'char-list-desc' => 'Aquí puedes ver tus personajes con información adicional.',
        'settings' => 'Configuración',
        'settings-desc' => 'En la configuración puedes cambiar tus contraseñas, correo electrónico y hacer otros cambios. Si necesitas algo más, haznos saber.',
        'donation' => 'Donaciones',
        'donation-desc' => '¡En este punto puedes hacer algo bueno y apoyarnos! Como agradecimiento recibirás :silk en el juego.',
        'other' => 'Misc',
        'other-desc' => 'Todo lo que no ha sido colocado exactamente, se puede encontrar bajo este punto.',
        'ref' => 'Referencia',
        'ref-desc' => 'Para ver a quién ya has invitado y cuánto has ganado, haz clic aquí.',
        'tickets' => 'Tickets',
        'tickets-desc' => '¿Tienes un problema o una petición? Aquí puedes crear un tícket y nos encargaremos de ello.',
        'voucher' => 'Voucher',
        'voucher-desc' => '¿Tienes una nota de crédito y quieres canjearla por :silk? Aquí puedes canjearla',
        'web-inventory' => 'Inventario Web',
        'web-inventory-help' => 'Aquí puedes encontrar tu "Inventario" donde se encuentran tus items comprados o vendidos.',
        'voteforsilk' => 'Vote for silk',
        'voteforsilk-help' => 'You want to gain easy silk? Here you can vote for our Server and gain some.',
        'web-mall' => 'Web Mall',
        'web-mall-help' => 'Here you can buy items from "Web Mall" using silk, it will be added instantly to your storage.',
    ],

    'chars-list' => [
        'title' => 'Lista de personajes',
        'no-chars' => 'Por favor crea un personaje para más funciones.',
        'last-logout' => 'Último cierre de sesión:',
        'level' => 'Nivel:',
        'gold' => 'Oro:',
        'guild' => 'Gremio:',
        'logged-in' => 'Sesión iniciada',
        'logged-out' => 'Sesión cerrada',
    ],

    'donations' => [
        'title' => 'Donaciones',
        'text' => 'Puedes escoger uno de varios proveedores donde puedes donar dinero. A cambio obtienes ' . config('siteSettings.sro_silk_name', 'Silk') . ' en nuestro servidor.',
        'no_methods' => 'No se encontraron métodos, el administrador no activó ninguno.',
    ],

    'settings' => [
        'title' => 'Configuración',
        'form' => [
            'name' => 'Nombre',
            'email' => 'Correo electrónico',
            'map' => 'Mapa mundial',
            'referral' => 'Enlace de referencia',
            'show-map' => 'Muestra tus cuentas en el mapa',
            'silkroad-password' => 'Nueva contraseña de silkroad',
            'silkroad-password-confirmation' => 'Confirmar contraseña de silkroad',
            'web-password' => 'Nueva contraseña web',
            'web-password-confirmation' => 'Confirmar contraseña web',
            'current-web-password' => 'Actual contraseña web',
            'current-web-password-help' => '¡Necesitas llenar este campo para cambiar cualquier dato!',
            'submit' => 'Guardar configuración',
            'wrong-current-web-password' => 'La contraseña introducida es incorrecta',
            'successfully' => 'Has cambiado tus datos exitosamente.',
        ]
    ],

    'ref' => [
        'title' => 'Referencia',
        'signature' => 'Firma',
        'no-signature' => 'Actualmente no hay ninguna firma añadida.',
        'your-ref' => 'Tu referencia',
        'table' => [
            'name' => 'Nombre de la cuenta',
            'date' => 'Fecha',
        ]
    ],

    'voucher' => [
        'title' => 'Canjear Voucher',
        'table' => [
            'voucher' => 'Voucher',
            'amount' => 'Cantidad',
            'used-at' => 'Usado en',
        ],
        'form' => [
            'voucher' => 'Voucher',
            'voucher-help' => 'Aquí puedes canjear tu código de crédito',
            'submit' => 'Canjear'
        ],
    ],

    'tickets' => [
        'title' => 'Tickets',
        'create-new' => 'Nuevo tícket',
        'table' => [
            'title' => 'Título',
            'state' => 'Estado',
            'priority' => 'Prioridad',
            'updated-at' => 'Actualizado el',
            'action' => 'Acción'
        ],

        'new' => [
            'title' => 'Nuevo tícket',
            'form' => [
                'title' => 'Título',
                'category' => 'Categoría',
                'no-categories' => 'Actualmente no hay categorías',
                'priority' => 'Prioridad',
                'no-priorities' => 'Actualmente no hay Prioridades',
                'body' => 'Texto',
                'body-placeholder' => 'Aquí puedes describir tu petición',
                'submit' => 'Crear tícket',
                'successfully' => 'Has creado un tícket de manera exitosa.',
            ]
        ],
        'show' => [
            'title' => 'Mostrando Tícket',
            'form' => [
                'title' => 'Título:',
                'category' => 'Categoría:',
                'priority' => 'Prioridad:',
                'state' => 'Estado:',
                'reply' => 'Texto de respuesta',
                'reply-placeholder' => 'Aquí puedes escribir tu respuesta',
                'submit' => 'Responder al tícket',
                'submit-close' => '¡Tícket cerrado!',
                'closed-state' => 'Cuando respondes reabres el tícket',
                'wrong-owner' => 'Algo no está bien, parece que no eres el dueño del tícket.',
                'successfully' => 'Has respondido a este tícket de manera exitosa.',
            ],
        ]
    ]
];
